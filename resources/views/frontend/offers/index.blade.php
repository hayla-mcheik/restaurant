@extends('layouts.app')

@section('content')
<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
    <h1 class="text-white">Offers for you</h1>
    <h6 class="text-white-50">Explore top deals and offers exclusively for you!</h6>
 </section>
 <section class="section pt-5 pb-5">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <h4 class="font-weight-bold mt-0 mb-3">Available Coupons</h4>
          </div>

          @foreach($offers as $offer)
          <div class="col-md-4">
             <div class="card offer-card border-0 shadow-sm">
                <div class="card-body">
                   <h5 class="card-title"><img src="{{ asset($offer->image) }}">{{ $offer->name }}</h5>
                   @if ($offer->discount_type === 'percentage')
                   <h6 class="card-subtitle mb-2 text-block">Get {{ $offer->discount_value }}% OFF on your 
                    @foreach ($offer->menuItems as $menuItem)
                    {{ $menuItem->name }},
                @endforeach           
            </h6>

            @elseif ($offer->discount_type === 'fixed_amount')
            <h6 class="card-subtitle mb-2 text-block">Get items with only {{ $offer->discount_value }}$ on your 
               @foreach ($offer->menuItems as $menuItem)
               {{ $menuItem->name }},
           @endforeach           
       </h6>
            @endif
            <p>Menu Categories:
                @foreach ($offer->menuItems as $menuItem)
                    {{ $menuItem->menucategories->name }},
                @endforeach
            </p>
       
                </div>
             </div>
          </div>
          @endforeach
       </div>


    </div>
 </section>
@endsection