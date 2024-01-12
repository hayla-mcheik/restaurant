<?php

namespace App\Livewire\Frontend\Cart;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
class Showorders extends Component
{
    public $orders = [] , $cartItems;
    public $subtotal = 0;

    protected $listeners = [
        'CartAddedUpdated' => 'updateOrdersAndSubtotal',
    ];

    public function mount()
    {
        $this->updateOrdersAndSubtotal();
    }

    public function decrementQuantity($orderId)
    {
        $order = CartItem::findOrFail($orderId);
    
        if ($order->quantity > 1) {
            $order->decrement('quantity');
            $this->dispatch('CartAddedUpdated');
            
            $this->dispatch('message', [
                'text'   => 'Quantity Updated',
                'type'   => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatch('message', [
                'text'   => 'Quantity cannot be less than 1.',
                'type'   => 'success',
                'status' => 200,
            ]);
        }

    }
    

    public function incrementQuantity($orderId)
    {
        $order = CartItem::findOrFail($orderId);
    
        $increment = false;
    
        foreach ($order->menuitems as $menuItem) {
            if ($menuItem->quantity > $order->quantity) {
                $increment = true;
                break;
            }
        }
    
        if ($increment) {
            $order->increment('quantity');
    
            $this->dispatch('CartAddedUpdated');
            $this->dispatch('message', [
                'text'   => 'Quantity Updated',
                'type'   => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatch('message', [
                'text'   => 'No items with quantity greater than the menu quantity.',
                'type'   => 'success',
                'status' => 200,
            ]);
        }
    
    }
    
    
    public function updateOrdersAndSubtotal()
    {
        $user = auth()->user();
        
        if ($user) {
            $this->orders = CartItem::where('user_id', auth()->user()->id)->get();
            $this->cartItems = CartItem::where('user_id', auth()->user()->id)->get();
        
            $this->subtotal = $this->cartItems->sum(function ($item) {
                if ($item->appliedOffer) {
                    return $item->appliedOffer->discount_value * $item->quantity;
                } else {
                    return $item->menuitems->sum(function ($menuItem) use ($item) {
                        return $menuItem->price * $item->quantity;
                    });
                }
            });

        }
    }
    
    
    public function removeCartItem($orderId)
    {
        $order = CartItem::findOrFail($orderId);

        $order->delete();

        $this->updateOrdersAndSubtotal();

        $this->dispatch('CartAddedUpdated');
        $this->dispatch('message', [
            'text'   => 'Item removed from the cart.',
            'type'   => 'success',
            'status' => 200,
        ]);
    }

    

    public function render()
    {
        return view('livewire.frontend.cart.showorders', [
            'orders' => $this->orders,
            'cartItems' => $this->cartItems,
            'subtotal' => $this->subtotal,
        ]);
    }
}
