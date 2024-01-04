<?php

namespace App\Livewire\Frontend\Checkout;

use Livewire\Component;
use App\Models\CartItem;
class Index extends Component
{
    public $carts, $totalProductAmount;
    public $subtotal = 0;
    protected $listeners = ['CartAddedUpdated' => 'updateSubtotal'];
    public function calculateTotalProductAmount()
    {
        $this->carts = CartItem::where('user_id', auth()->user()->id)->get();
        $this->totalProductAmount = 0;

        if ($this->carts->isNotEmpty()) {
            foreach ($this->carts as $cartItem) {
                $this->totalProductAmount += $cartItem->menuitems->price * $cartItem->quantity;
            }
        } else {
            $this->totalProductAmount = 0;
        }

        $this->dispatch('orderPlaced', $this->totalProductAmount);
    }

    public function updateSubtotal()
    {
        $user = auth()->user();
        if ($user) {
            $cartItems = CartItem::where('user_id', $user->id)->get();

            $this->subtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->menuitems->price * $cartItem->quantity;
            });
        }

    }
    public function render()
    {
        $this->calculateTotalProductAmount();
        
        return view('livewire.frontend.cart.subtotal', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
