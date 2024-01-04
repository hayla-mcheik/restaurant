<?php

namespace App\Livewire\Frontend\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\AppliedOffer;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\DB;

class Addtocart extends Component
{
    public $bestSeller , $menucategories , $menuItems, $quantityCount = 1;

public function incrementQuantity()
{
    if($this->quantityCount < 10){
        $this->quantityCount++;
    }
}

public function decremenetQuanity()
{
    if($this->quantityCount > 1){
        $this->quantityCount--;  
    }
}

public function addToCart(int $menuItemId)
{
    if (Auth::check()) {
        if (auth()->user()->role_as == '1' || auth()->user()->role_as == '2') {
            $this->dispatch('message', [
                'text' => 'Only users can add to cart',
                'type' => 'warning',
                'status' => 422
            ]);
        } else {
            $menuItem = $this->menuItems->firstWhere('id', $menuItemId);

            if ($menuItem) {
                $existingCartItem = CartItem::where('user_id', auth()->user()->id)
                ->where('menu_item_id', $menuItem->id) 
                    ->first();

                if ($existingCartItem) {
                    $this->dispatch('message', [
                        'text' => 'Item already added to cart',
                        'type' => 'warning',
                        'status' => 422
                    ]);
                } else {
                    if ($menuItem->quantity > 0) {
                        if ($menuItem->quantity >= $this->quantityCount) {
                            if ($menuItem->offers->isNotEmpty()) {
                                $this->handleItemWithOfferAndPriceAdjustment($menuItem);
                            } else {
                                $this->handleItemWithoutOfferAndPriceAdjustment($menuItem);
                            }
                        } else {
                            $this->dispatch('message', [
                                'text' => 'Only ' . $menuItem->quantity . ' Quantity Available',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatch('message', [
                            'text' => 'Out of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            }
        }
    } else {
        $this->dispatch('message', [
            'text' => 'Please login to add to cart',
            'type' => 'warning',
            'status' => 401
        ]);
    }
}

private function handleItemWithoutOfferAndPriceAdjustment($menuItem)
{
    $discountedPrice = $this->calculateDiscountedPrice($menuItem->price, null, null);

    $cartItem = auth()->user()->cartItems()->create([
        'menu_item_id' => $menuItem->id,
        'quantity' => $this->quantityCount,
        'price' => $discountedPrice,
    ]);

    // Attach the menu item ID to the cart_item_menu_item relationship
    $cartItem->menuitems()->attach($menuItem->id, ['quantity' => $this->quantityCount]);

    $this->dispatch('CartAddedUpdated');
    $this->dispatch('message', [
        'text' => 'Product Added to Cart',
        'type' => 'success',
        'status' => 200
    ]);
}
private function handleItemWithOfferAndPriceAdjustment($menuItem)
{
    $existingCartItem = CartItem::where('user_id', auth()->user()->id)
        ->whereIn('menu_item_id', $menuItem->offers->pluck('menuItems.*.id')->flatten()->toArray())
        ->first();

    if ($existingCartItem) {
        $this->dispatch('message', [
            'text' => 'Item with offer already added to cart',
            'type' => 'warning',
            'status' => 422
        ]);
        return;
    }

    foreach ($menuItem->offers as $offer) {
        $offerMenuItemIds = $offer->menuItems->pluck('id')->toArray();
        $discountedPrice = $this->calculateDiscountedPrice($menuItem->price, $offer->discount_type, $offer->discount_value);

        $cartItem = CartItem::create([
            'user_id' => auth()->user()->id,
            'menu_item_id' => $offerMenuItemIds[0] ?? null,
            'quantity' => $this->quantityCount,
            'price' => $discountedPrice,
        ]);

        // Attach the menu item IDs to the cart_item_menu_item relationship
        $cartItem->menuitems()->attach($offerMenuItemIds, ['quantity' => $this->quantityCount]);

        AppliedOffer::create([
            'cart_item_id' => $cartItem->id,
            'offer_id' => $offer->id,
            'discount_value' => $offer->discount_value,
        ]);
    }

    $this->dispatch('CartAddedUpdated');
    $this->dispatch('message', [
        'text' => 'Product with offer added to Cart',
        'type' => 'success',
        'status' => 200
    ]);
}



private function calculateDiscountedPrice($originalPrice, $discountType, $discountValue)
{
    if ($discountType === 'percentage') {
        return $originalPrice - ($originalPrice * ($discountValue / 100));
    } elseif ($discountType === 'fixed_amount') {
        return $discountValue;
    } else {
        return $originalPrice;
    }
}


public function addToWishlist(int $menuItemId)
{
    if (Auth::check()) {
        if (auth()->user()->role_as == '1' || auth()->user()->role_as == '2') {
            $this->dispatch('message', [
                'text' => 'Only users can add to wishlist',
                'type' => 'warning',
                'status' => 422
            ]);
        } else {
            $menuItem = $this->menuItems->firstWhere('id', $menuItemId);
            if ($menuItem) {
                $existingWishlistItem = WishlistModel::where('user_id', auth()->user()->id)
                    ->where('menu_item_id', $menuItemId)
                    ->first();

                if ($existingWishlistItem) {
                    $this->dispatch('message', [
                        'text' => 'Item already added to wishlist',
                        'type' => 'warning',
                        'status' => 422
                    ]);
                } else {
                    // Check if the item has an offer similar to the one in the wishlist
                    $menuItem->load('offers:id'); // Ensure offers relationship is loaded

                    $similarOfferInWishlist = WishlistModel::where('user_id', auth()->user()->id)
                        ->whereHas('offers', function ($query) use ($menuItem) {
                            $query->whereIn('offers.id', $menuItem->offers->pluck('id'));
                        })
                        ->first();

                    if ($similarOfferInWishlist) {
                        $this->dispatch('message', [
                            'text' => 'Offer already added to wishlist',
                            'type' => 'info',
                            'status' => 200
                        ]);
                    } else {
                        auth()->user()->wishlist()->create(['menu_item_id' => $menuItemId]);                
                        $this->dispatch('message', [
                            'text' => 'Item Added to Wishlist',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    } 
                }
            }
        }
    } else {
        $this->dispatch('message', [
            'text' => 'Please login to add to wishlist',
            'type' => 'warning',
            'status' => 401
        ]);
    }
}


    public function render()
    {

        return view('livewire.frontend.cart.addtocart');

    }
}
