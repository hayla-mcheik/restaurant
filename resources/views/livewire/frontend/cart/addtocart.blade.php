

<div>
    <div class="row">
<!-- Your other HTML code -->

<h5 class="mb-4 mt-3 col-md-12">Best Sellers</h5>

@foreach($bestSeller as $item)
@if ($item['best_seller'])
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
                <div class="favourite-heart text-danger position-absolute">
                    <button class="btn btn-sm float-right mx-1" wire:click="addToWishlist({{ $item['item']->id }})">
                        <i class="icofont-heart"></i>
                    </button>
                </div>
                <h6 class="category-name badge badge-info position-absolute">{{ $item['item']->menucategories->name }}</h6>


                    <div class="star position-absolute">
                        <span class="badge badge-success">
                            <i class="icofont-star"></i> Orders: {{ $item['best_seller']['total_quantity'] }}
                        </span>
                    </div>
      
                <div class="member-plan position-absolute">
                    <span class="badge badge-dark">Best Seller</span>
                </div>
                <a href="#">
                    <img src="{{ asset($item['item']->image) }}" class="img-fluid item-img">
                </a>
            </div>
            <div class="p-3 position-relative">
                <div class="list-card-body">
                    <h6 class="mb-1"><a href="#" class="text-black">{{ $item['item']->name }}</a></h6>
                    <p class="text-gray mb-2">{{ $item['item']->description }}</p>

                    @if ($item['offers']->isNotEmpty())
                        @foreach ($item['offers'] as $offer)
                            @php
                                $now = now();
                                $endDate = $offer->end_date ? \Carbon\Carbon::parse($offer->end_date) : null;
                                $startDate = $offer->start_date ? \Carbon\Carbon::parse($offer->start_date) : null;
                            @endphp

                            @if ((!$endDate || $endDate->isFuture()) && (!$startDate || $startDate->isPast()))
                                <p class="text-gray mb-3 time">
                                    <span class="text-black-50">
                                        {{ $offer->name }} with:
                                        <div class="d-flex">
                                            @foreach($offer->menuItems as $key => $offerMenuItem)
                                                <p>{{ $offerMenuItem->name }}@if ($key === count($offer->menuItems) - 2) and &nbsp; @endif</p>
                                            @endforeach
                                        </div>
                                        for
                                        {{ $offer->discount_type == 'percentage' ? $offer->discount_value.'% off' : '$'.$offer->discount_value.' off' }}
                                    </span>
                                </p>
                            @endif
                        @endforeach
                    @endif

                    <p class="text-gray time mb-0">
                        <a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">Original Price:{{ $item['item']->price }}</a>
                        <span class="float-right">
                            <button class="btn btn-outline-secondary btn-sm float-right mx-1" wire:click="addToCart({{ $item['item']->id }})">
                                <i class="fa fa-shopping-cart"></i>Add to Cart
                            </button>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

@endforeach

<!-- Your other HTML code -->

    
    </div>
    

<div class="row">
    @foreach ($menucategories as $category)
        <h5 class="mb-4 mt-3 col-md-12">{{ $category->name }} <small class="h6 text-black-50">{{ $category->menuitems->count() }} ITEMS</small></h5>
        
        <div class="col-md-12">
            <div class="bg-white rounded border shadow-sm mb-4">
                @foreach ($category->menuitems as $menuItem)

                @if($menuItem->quantity)
                <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                @else
                <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
            @endif

                    <div class="menu-list p-3 border-bottom">
                        <button class="btn btn-outline-secondary btn-sm  float-right mx-1" 
                        wire:click="addToCart({{ $menuItem->id }})"
                        > <i class="fa fa-shopping-cart"></i>Add to Cart</button>
                        <button class="btn btn-outline-secondary btn-sm  float-right mx-1"   
                        wire:click="addToWishlist({{ $menuItem->id }})"
                        > <i class="fa fa-shopping-cart"></i>Add to Wishlist</button>
                        <div class="media">
                            <img class="mr-3 rounded-pill" src="{{ asset($menuItem->image) }}" alt="{{ $menuItem->name }}">
                            <div class="media-body">
                                <h6 class="mb-1">{{ $menuItem->name }}</h6>
                                <p class="text-gray mb-0">${{ $menuItem->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
</div>