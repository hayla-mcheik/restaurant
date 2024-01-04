<div>
    <h5 class="mb-1 text-white">Your Order</h5>
    <p class="mb-4 text-white">
    @if($cartItems)
    {{ $cartItems->count() }} ITEMS
    @else
    0 items
@endif</p>
    <div class="bg-white rounded shadow-sm mb-2">
        @if($cartItems && $cartItems->count() > 0)
            @foreach($cartItems as $item)
                @if($item->appliedOffer)
                    <div class="gold-members p-2 border-bottom">
                        <p class="text-gray mb-0 float-right ml-2">${{ optional($item->appliedOffer->offer)->discount_value }}</p>
                        <div class="media">
                            <img class="mr-3" src="{{ asset(optional($item->appliedOffer->offer)->image) }}" alt="{{ optional($item->appliedOffer->offer)->name }}" width="60" >
                            <div class="media-body">
                                <span class="count-number float-right">
                                    <button class="btn btn-outline-secondary btn-sm left dec" wire:click="decrementQuantity({{ $item->id }})"> <i class="icofont-minus"></i> </button>
                                    <input class="count-number-input input-quantity" type="text" value="{{ $item->quantity }}" readonly="">
                                    <button class="btn btn-outline-secondary btn-sm right inc" wire:click="incrementQuantity({{ $item->id }})"> <i class="icofont-plus"></i> </button>
                                    <button class="btn btn-outline-danger btn-sm ml-2" wire:click="removeCartItem({{ $item->id }})"> <i class="icofont-trash"></i>  </button>
                                </span>
                                x {{ $item->quantity }} items
                                <p class="mt-1 mb-0 text-black"></p>
                                <p class="mt-1 mb-0 text-black">{{ optional($item->appliedOffer->offer)->name }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    @if($item->menuitems && $item->menuitems->count() > 0)
                        @foreach($item->menuitems as $menuitem)
                            <div class="gold-members p-2 border-bottom">
                                <p class="text-gray mb-0 float-right ml-2">${{ $menuitem->price }}</p>
                                <div class="media">
                                    <img class="mr-3" src="{{ asset($menuitem->image) }}" alt="{{ $menuitem->name }}" width="60" >
                                    <div class="media-body">
                                        <span class="count-number float-right">
                                            <button class="btn btn-outline-secondary btn-sm left dec" wire:click="decrementQuantity({{ $item->id }})"> <i class="icofont-minus"></i> </button>
                                            <input class="count-number-input input-quantity" type="text" value="{{ $item->quantity }}" readonly="">
                                            <button class="btn btn-outline-secondary btn-sm right inc" wire:click="incrementQuantity({{ $item->id }})"> <i class="icofont-plus"></i> </button>
                                            <button class="btn btn-outline-danger btn-sm ml-2" wire:click="removeCartItem({{ $item->id }})"> <i class="icofont-trash"></i> </button>
                                        </span>
                                        x {{ $item->quantity }} items
                                        <p class="mt-1 mb-0 text-black"></p>
                                        <p class="mt-1 mb-0 text-black">{{ $menuitem->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            @endforeach
        @else
            <p>No cart items</p>
        @endif
    </div>

    <div class="mb-2 bg-white rounded p-2 clearfix">
        @if($subtotal != '0')
            <p class="mb-1">Item Total <span class="float-right text-dark">${{ $subtotal }}</span></p>
            <p class="mb-1">Delivery Fee <span class="text-info" data-toggle="tooltip" data-placement="top" title="Total discount breakup">
                <i class="icofont-info-circle"></i>
            </span> <span class="float-right text-dark">$10</span></p>
            <hr />

            @php
                $totalorderprice = $subtotal + 10;
            @endphp

            <h6 class="font-weight-bold mb-0">TO PAY  <span class="float-right">${{ $totalorderprice }}</span></h6>

        @endif
    </div>

    @if(auth()->user() && $subtotal > 0) 
        <a href="{{ url('checkout') }}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
    @else
        <button class="btn btn-secondary btn-block btn-lg" disabled>Checkout <i class="icofont-long-arrow-right"></i></button>
        <p class="text-muted text-center mt-2">Your cart is empty. Please add items before proceeding to checkout.</p>
    @endif
</div>
