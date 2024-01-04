<?php

namespace App\Livewire\Frontend\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CartItem;
class Subtotal extends Component
{
    public $subtotal = 0;

    protected $listeners = ['CartAddedUpdated' => 'updateSubtotal'];

    public function updateSubtotal()
    {
        $user = auth()->user();
    
        if ($user) {
            $cartItems = CartItem::where('user_id', $user->id)->get();
    
            $this->subtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->menuitems->sum(function ($menuItem) use ($cartItem) {
                    return $menuItem->price * $cartItem->quantity;
                });
            });
        }
    }
    
    public function render()
    {
        return view('livewire.frontend.cart.subtotal')->layout('layouts.app');
    }
}
