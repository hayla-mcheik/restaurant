<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use \Validator;
use App\Mail\SubscriptionConfirmation; 
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\GalleryModel;
use App\Models\CartItem;
use App\Models\Offer;
use App\Models\OrderModel;
use App\Models\Orderitems;
use App\Models\WishlistModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;

use Illuminate\Support\Facades\Auth;
class ApiController extends Controller
{

    public function OrderCreation(Request $request)
    {
        try {
            $user = auth()->user();
            if ( !$user || $user->role_as !== 3) {
                return response()->json([
                    'message' => 'Unauthorized to create order'
                ], 401);
            }
            $orderData = $request->all();
            $validator = Validator::make($orderData, [
                'payment_mode' => 'required',
                'address' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $cart = CartItem::where('user_id', $user->id)->first();

            if (!$cart) {
                return response()->json([
                    'message' => 'Cart is empty. Add items to your cart before placing an order.'
                ], 400);
            }

            $restaurantId = $cart->menuitems->first()->menucategories->first()->restaurant->id;

            $totalProductAmount = 0;

            $carts = CartItem::where('user_id', $user->id)->get();
            $totalProductAmount = $carts->sum(function ($item) {
                if ($item->appliedOffer) {
                    return $item->appliedOffer->discount_value * $item->quantity;
                } else {
                    return $item->menuitems->sum(function ($menuItem) use ($item) {
                        return $menuItem->price * $item->quantity;
                    });
                }
            });
            if ($orderData['payment_mode'] === 'Stripe') {
                Stripe::setApiKey(config('services.stripe.secret'));

                $paymentIntent = PaymentIntent::create([
                    'amount' => $totalProductAmount * 100,
                    'currency' => 'usd',
                    'description' => 'Test payment from tecomsa.com.',
                    'source' => $request->stripeToken,
                ]);   
                $orderData['payment_id'] = $paymentIntent->id;
            }

            $order = OrderModel::create([
                'user_id' => $user->id,
                'order_no' => 'restaurant-' . Str::random(10),
                'restaurant_id' => $restaurantId,
                'fullname' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => 1,
                'status_message' => 'in progress',
                'payment_mode' => $orderData['payment_mode'],
                'payment_id' => $orderData['payment_id'],
            ]);

            foreach ($carts as $cartItem) {
                foreach ($cartItem->menuitems as $menuItem) {
                    $offers = $menuItem->offers;

                    foreach ($offers as $offer) {
                        $existingOrderItem = Orderitems::where('order_id', $order->id)
                            ->where('menu_id', $offer->id)
                            ->first();

                        if (!$existingOrderItem) {
                            Orderitems::create([
                                'order_id' => $order->id,
                                'menu_id' => $offer->id,
                                'price' => $offer->discount_value,
                                'quantity' => $cartItem->quantity,
                            ]);
                        }
                    }

                    if ($offers->isEmpty()) {
                        Orderitems::create([
                            'order_id' => $order->id,
                            'menu_id' => $menuItem->id,
                            'price' => $menuItem->price,
                            'quantity' => $cartItem->quantity,
                        ]);
                    }
                }
            }

            return response()->json([
                'message' => 'Order created successfully',
                'order' => $order
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

public function HomeScreen()
{
    $categories = RestaurantCategory::where('status','0')->get();
    $restaurants = RestaurantModel::where('status','0')->get();
    $restaurantssection = RestaurantModel::where('status','0')->take(4)->get();
    $popularrestaurants = RestaurantModel::withCount('order')
    ->orderByDesc('order_count')
    ->get();

    return response()->json([
        'status' => 200 , 'categories' => $categories , 'restaurants' => $restaurants , 
        'restaurantssection' => $restaurantssection, 'popularrestaurants' => $popularrestaurants
    ]);
}



public function CategoriesScreen()
{
    $restaurantcategories = RestaurantCategory::where('status','0')->get();
    return response()->json([
'status' => 200 , 'restaurantcategories' => $restaurantcategories
    ]);  
}
public function ListingScreen($categoryId = null)
{

    if ($categoryId && !is_numeric($categoryId)) {
        return response()->json([
            'error' => 'Invalid category ID'
        ], 400);
    }

    $restaurants = RestaurantModel::with('category')->where('status', '0')
        ->when($categoryId, function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })
        ->get();

    $categories = RestaurantCategory::where('status', '0')->get();
    $gallery = GalleryModel::all();

    return response()->json([
        'status' => 200,
        'restaurants' => $restaurants,
        'categories' => $categories,
        'gallery' => $gallery
    ]);
}

public function ListingScreenDetails($restaurant_id)
{
    $restaurant = RestaurantModel::find($restaurant_id);
    $gallery = GalleryModel::all();
    $menucategories = $restaurant->menuCategories()->with('menuitems.offers')->get();
    $menuItems = $menucategories->flatMap(function ($category) {
        return $category->menuitems;
    });
    $mostPopularCategories = $menuItems->isNotEmpty() ? $menuItems->first()->mostPopularCategories() : collect();    
    $bestSeller = $menuItems->map(function ($item) {
        return [
            'item' => $item,
            'best_seller' => $item->bestSeller(),
            'offers' => $item->offers, 
        ];
    });

    return response()->json([
        'status' => 200 , 'restaurant' => $restaurant , 'mostPopularCategories' => $mostPopularCategories , 
        'gallery' => $gallery , 'bestSeller' => $bestSeller
    ]);
}



public function OfferScreen()
{
    $offers = Offer::where('start_date', '<=', now())
    ->where('end_date', '>=', now())->get();
    return response()->json([
        'status' => 200 , 'offers' => $offers 
    ]);
}




    public function subscribe(Request $request)
{
    $rules = [
        'email' => 'required|email|unique:subscriptions,email',
    ];

    $validator = Validator::make($request->all(), $rules);
    
    if ($validator->fails()) {
        return response()->json($validator->errors()->first(), 400);
    } else {
        $sub = new Subscriptions();
        $sub->email = $request->email;
        $sub->save();

    try {
        Mail::to($sub->email)->send(new SubscriptionConfirmation($sub));
        return response()->json(['msg' => 'success']);
    } catch (\Exception $e) {
    return response()->json(['error' => 'Error sending mail'],500);
    }

    }
}

public function CheckoutScreen(Request $request)
{
    if (!auth()->check()) {
        return response()->json(['message' => 'Unauthenticated user'], 401);
    }

    $cartItems = CartItem::where('user_id', auth()->user()->id)->get();

    $menuCategories = MenuCategories::all();

    $subtotal = $cartItems->sum(function ($item) {
        if ($item->appliedOffer) {
            return $item->appliedOffer->discount_value * $item->quantity;
        } else {
            return $item->menuitems->sum(function ($menuItem) use ($item) {
                return $menuItem->price * $item->quantity;
            });
        }
    });

    return response()->json([
        'cartItems' => $cartItems,
        'menuCategories' => $menuCategories,
        'subtotal' => $subtotal,
    ]);
}

public function AddToCartApi(Request $request)
{
    $validator = Validator::make($request->all(), [
        'menu_item_id' => 'required|exists:menu_items,id',
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    $menuItemId = $request->input('menu_item_id');
    $quantity = $request->input('quantity');

    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthenticated user'], 401);
    }

    $user = auth()->user();
    if ($user->role_as == '1' || $user->role_as == '2') {
        return response()->json(['message' => 'Only users can add to cart'], 422);
    }

    $menuItem = MenuItems::find($menuItemId);
    if (!$menuItem) {
        return response()->json(['message' => 'Menu item not found'], 404);
    }

    $existingCartItem = CartItem::where('user_id', $user->id)
        ->where('menu_item_id', $menuItem->id)
        ->first();

    if ($existingCartItem) {
        return response()->json(['message' => 'Item already added to cart'], 422);
    }

    if ($menuItem->quantity <= 0 || $menuItem->quantity < $quantity) {
        return response()->json(['message' => 'Item is out of stock or not enough quantity available'], 404);
    }

    $cartItem = CartItem::create([
        'user_id' => $user->id,
        'menu_item_id' => $menuItem->id,
        'quantity' => $quantity,
    ]);

    return response()->json(['message' => 'Item added to cart successfully', 'cart_item' => $cartItem]);
}

public function showorder()
{
    try {
        $user = auth()->user();


        $orders = OrderModel::where('user_id', $user->id)->get();

        return response()->json(['orders' => $orders], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error fetching orders', 'error' => $e->getMessage()], 500);
    }
}
public function cartcount()
{
    try {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated user'], 401);
        }
        $cartCount = CartItem::where('user_id', $user->id)->count();
        return response()->json(['cartCount' => $cartCount], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error fetching cart count', 'error' => $e->getMessage()], 500);
    }
}
public function addtowishlist(Request $request, $menuItemId)
{
    try {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated user'], 401);
        }

        if ($user->role_as == '1' || $user->role_as == '2') {
            return response()->json(['message' => 'Only users can add to wishlist', 'type' => 'warning'], 422);
        }

        $menuItem = MenuItems::find($menuItemId);

        if (!$menuItem) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $existingWishlistItem = WishlistModel::where('user_id', $user->id)
            ->where('menu_item_id', $menuItemId)
            ->first();

        if ($existingWishlistItem) {
            return response()->json(['message' => 'Item already added to wishlist', 'type' => 'warning'], 422);
        }

        $menuItem->load('offers:id');

        $similarOfferInWishlist = WishlistModel::where('user_id', $user->id)
            ->whereHas('offers', function ($query) use ($menuItem) {
                $query->whereIn('offers.id', $menuItem->offers->pluck('id'));
            })
            ->first();

        if ($similarOfferInWishlist) {
            return response()->json(['message' => 'Offer already added to wishlist', 'type' => 'info'], 200);
        }

        $user->wishlist()->create(['menu_item_id' => $menuItemId]);

        return response()->json(['message' => 'Item added to wishlist successfully', 'type' => 'success'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error adding to wishlist', 'error' => $e->getMessage()], 500);
    }
}

}
