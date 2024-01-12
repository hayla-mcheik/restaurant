<?php

namespace App\Livewire\Frontend\Order;

use Livewire\Component;
use Livewire\Livewire;
use App\Models\OrderModel;
use App\Models\Orderitems;
use App\Models\CartItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stripe\PaymentIntent; 
use Exception;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use Session;
use Stripe\Token;
use Stripe\Customer;
use Stripe;
use Stripe\Charge;
use Stripe\PaymentMethod;
use Illuminate\Support\Facades\Log;
class Index extends Component
{
    public $carts , $totalProductAmount = 0 ;
    public $fullname , $email , $phone , $payment_mode = NULL , $payment_id = NULL;
    public $selectedAddressId;
    public $totalAmount;

    
    public function selectedAddress($addressId)
    {
        $this->selectedAddressId = $addressId;
    }

    
    public function placeOrder()
    {
        $cart = CartItem::where('user_id', auth()->user()->id)->first();
        if ($this->carts->isEmpty()) {
        $this->dispatch('message', [
            'text'   => 'Cart is empty. Add items to your cart before placing an order.',
            'type'   => 'error',
            'status' => 400,
        ]);
return;
    }
       $selectedAddress = auth()->user()->addresses
            ->where('id', $this->selectedAddressId)
            ->first();
    
        $restaurantId = $cart->menuitems->first()->menucategories->first()->restaurant->id;
    
        $order = OrderModel::create([
            'user_id' => auth()->user()->id,
            'order_no' => 'restaurant-' . Str::random(10),
            'restaurant_id' => $restaurantId,
            'fullname' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'address' => $selectedAddress->address ?? null,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
    
        $this->carts = CartItem::where('user_id', auth()->user()->id)->get();
    
        foreach ($this->carts as $cartItem) {
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

        return $order;
    }
    

    public function codOrder()
    {
        \Log::info('address id in codOrder : ' . $this->selectedAddressId);
        $this->payment_mode = 'Cash on Delivery';
        if (!$this->selectedAddressId) {
            $this->dispatch('message', [
                'text'   => 'Selected address not found.',
                'type'   => 'error',
                'status' => 400,
            ]);
            return;
        }

        $codOrder = $this->placeOrder();
        if ($codOrder) {

            CartItem::where('user_id', auth()->user()->id)->delete();
            $this->dispatch('CartAddedUpdated');
            $this->dispatch('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->route('thanks');
        }
    }


    public function stripePayment(Request $request)
{
    \Log::info('address id in stripe payment : ' . $this->selectedAddressId);
    $selectedAddress = auth()->user()->addresses
    ->where('id', $this->selectedAddressId)
    ->first();
    try {
        $this->carts = CartItem::where('user_id', auth()->user()->id)->get();
    
        $this->totalProductAmount = $this->carts->sum(function ($item) {
            if ($item->appliedOffer) {
                return $item->appliedOffer->discount_value * $item->quantity;
            } else {
                return $item->menuitems->sum(function ($menuItem) use ($item) {
                    return $menuItem->price * $item->quantity;
                });
            }
        });

        
        $this->payment_mode = 'Stripe';
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \Stripe\Customer::create([
            'email' => auth()->user()->email,
        ]);

        $charge = \Stripe\Charge::create([
            'amount' => $this->totalProductAmount * 100, 
            'currency' => 'usd',
            'description' => 'Test payment from tecomsa.com.',
            'source' => $request->stripeToken,
        ]);

        if ($charge->status === 'succeeded') {
            $order = $this->placeOrder();
            if($order);
            {
                $order->update([
                    'payment_id' => $charge->id,
                    'status_message' => 'Payment successful',  
                ]);
                Session::flash('success', 'Payment successful! Order placed.');
                return redirect()->route('thanks');
            }
   } else {
            Session::flash('error', 'Payment failed. Please try again.');
        }
    } catch (\Exception $e) {
        Log::error('Exception in processPayment:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        Session::flash('error', 'Cart is empty. Add items to your cart before placing an order.');
    }   
        CartItem::where('user_id', auth()->user()->id)->delete();

    return redirect()->back();
}

    
    public function render()
    {
        $this->carts = CartItem::where('user_id', auth()->user()->id)->get();
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        return view('livewire.frontend.order.index');
    }
}
