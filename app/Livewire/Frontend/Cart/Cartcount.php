<?php

namespace App\Livewire\Frontend\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CartItem;
class Cartcount extends Component
{
    public $cartCount, $cartItems;
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount()
    {
        if (Auth::check()) {
            $this->cartItems = CartItem::where('user_id', auth()->user()->id)->get();
            $this->cartCount = $this->cartItems->count();
        } else {
            $this->cartCount = 0;
            $this->cartItems = collect(); // Set an empty collection for guest users
        }
    }

    public function render()
    {
        $this->checkCartCount();
        return view('livewire.frontend.cart.cartcount', [
            'cartCount' => $this->cartCount,
            'cartItems' => $this->cartItems
        ]);
    }
}
