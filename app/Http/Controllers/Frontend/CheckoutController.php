<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\RestaurantModel;
use App\Models\MenuCategories;
class CheckoutController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $cartitems = CartItem::where('user_id', auth()->user()->id)->get();
            $menucategories = MenuCategories::all();

            $subtotal = $cartitems->sum(function ($item) {
                if ($item->appliedOffer) {
                    return $item->appliedOffer->discount_value * $item->quantity;
                } else {
                    return $item->menuitems->sum(function ($menuItem) use ($item) {
                        return $menuItem->price * $item->quantity;
                    });
                }
            });

            return view('frontend.checkout.index', compact('cartitems', 'menucategories','subtotal'));

        } else {
            return redirect()->route('login');
        }
    }


}
