
@extends('layouts.app')

@section('content')




<section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
    <div class="container">
       <div class="row">
          <div class="col-md-8">
             <div class="offer-dedicated-body-left">
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                   <h6 class="mb-3">You may also like</h6>
         
                   <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel">
                     @foreach($menucategories as $menucateg)
                      <div class="item">
                         <div class="mall-category-item position-relative">
                            <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                            <img class="img-fluid" src="{{ asset($menucateg->image) }}">
                            <h6>{{ $menucateg->name }}</h6>
                            <small>{{ $menucateg->menuitems_count }}</small>
                         </div>
                      </div>
    
             @endforeach
                   </div>
                </div>
      
                <livewire:frontend.order.index />


             </div>
          </div>




  <div class="col-md-4">
   <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
      <div class="d-flex mb-4 osahan-cart-item-profile">
         <div class="d-flex flex-column">
           <h6 class="mb-1 text-white">Your Orders</h6>
            </h6>
            <p class="mb-0 text-white"><i class="icofont-location-pin"></i> 2036 2ND AVE, NEW YORK, NY 10029</p>
         </div>
      </div>
      <div class="bg-white rounded shadow-sm mb-2">
         @if($cartitems->isNotEmpty())
             @php
                 $hasOffer = $cartitems->contains(function ($order) {
                     return $order->appliedOffer;
                 });
             @endphp
 
             @foreach($cartitems as $item)
                 @if($hasOffer && $item->appliedOffer)
                     <div class="gold-members p-2 border-bottom">
                         <div class="gold-members p-2 border-bottom">
                             <p class="text-gray mb-0 float-right ml-2">${{ $item->appliedOffer->offer->discount_value }}</p>
                             <div class="media">
                                 <img class="mr-3" src="{{ asset($item->appliedOffer->offer->image) }}" alt="{{ $item->appliedOffer->offer->name }}" width="60" >
                                 <div class="media-body">
                                     <span class="count-number float-right">
                                         <button class="btn btn-outline-secondary btn-sm left dec" wire:click="decrementQuantity({{ $item->id }})"> <i class="icofont-minus"></i> </button>
                                         <input class="count-number-input input-quantity" type="text" value="{{ $item->quantity }}" readonly="">
                                         <button class="btn btn-outline-secondary btn-sm right inc" wire:click="incrementQuantity({{ $item->id }})"> <i class="icofont-plus"></i> </button>
                                     </span>
                                     x {{ $item->quantity }} items
                                     <p class="mt-1 mb-0 text-black"></p>
                                     <p class="mt-1 mb-0 text-black">{{ $item->appliedOffer->offer->name }}</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @else
                     @foreach($item->menuitems as $menuitem)
                         <div class="gold-members p-2 border-bottom">
                             <div class="gold-members p-2 border-bottom">
                                 <p class="text-gray mb-0 float-right ml-2">${{ $menuitem->price }}</p>
                                 <div class="media">
                                     <img class="mr-3" src="{{ asset($menuitem->image) }}" alt="{{ $menuitem->name }}" width="60" >
                                     <div class="media-body">
                                         <span class="count-number float-right">
                                             <button class="btn btn-outline-secondary btn-sm left dec" wire:click="decrementQuantity({{ $item->id }})"> <i class="icofont-minus"></i> </button>
                                             <input class="count-number-input input-quantity" type="text" value="{{ $item->quantity }}" readonly="">
                                             <button class="btn btn-outline-secondary btn-sm right inc" wire:click="incrementQuantity({{ $item->id }})"> <i class="icofont-plus"></i> </button>
                                         </span>
                                         x {{ $item->quantity }} items
                                         <p class="mt-1 mb-0 text-black"></p>
                                         <p class="mt-1 mb-0 text-black">{{ $menuitem->name }}</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
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
      <div class="mb-2 bg-white rounded p-2 clearfix">
         <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control" placeholder="Enter promo code">
            <div class="input-group-append">
               <button class="btn btn-primary" type="button" id="button-addon2"><i class="icofont-sale-discount"></i> APPLY</button>
            </div>
         </div>
         <div class="input-group mb-0">
            <div class="input-group-prepend">
               <span class="input-group-text"><i class="icofont-comment"></i></span>
            </div>
            <textarea class="form-control" placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"></textarea>
         </div>
      </div>


   
      <a href="thanks.html" class="btn btn-success btn-block btn-lg">PAY 
      <i class="icofont-long-arrow-right"></i></a>
   </div>
   <div class="pt-2"></div>
   <div class="alert alert-success" role="alert">
      You have saved <strong>$1,884</strong> on the bill
   </div>
   <div class="pt-2"></div>
   <div class="text-center pt-2">
   <img class="img-fluid" src="https://dummyimage.com/352x504/ccc/ffffff.png&text=Google+ads">
   </div>
</div>
       </div>
    </div>
 </section>



 @endsection