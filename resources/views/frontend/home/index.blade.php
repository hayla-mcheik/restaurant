@extends('layouts.app')

@section('content')

<section class="pt-5 pb-5 homepage-search-block position-relative">
    <div class="banner-overlay"></div>
    <div class="container">
       <div class="row d-flex align-items-center">
          <div class="col-md-8">
             <div class="homepage-search-title">
                <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Find Awesome Deals</span> in Australia</h1>
                <h5 class="mb-5 text-secondary font-weight-normal">Lists of top restaurants, cafes, pubs, and bars in Melbourne, based on trends</h5>
             </div>
             <div class="homepage-search-form">
                <form class="form-noborder">
                   <div class="form-row">
                      <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                         <div class="location-dropdown">
                            <i class="icofont-location-arrow"></i>
                            <select class="custom-select form-control-lg">
                               <option> Quick Searches </option>
                               <option> Breakfast </option>
                               <option> Lunch </option>
                               <option> Dinner </option>
                               <option> Cafés </option>
                               <option> Delivery </option>
                            </select>
                         </div>
                      </div>
                      <div class="col-lg-7 col-md-7 col-sm-12 form-group">
                         <input type="text" placeholder="Enter your delivery location" class="form-control form-control-lg">
                         <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                         <a href="listing.html" class="btn btn-primary btn-block btn-lg btn-gradient">Search</a>
                         <!--<button type="submit" class="btn btn-primary btn-block btn-lg btn-gradient">Search</button>-->
                      </div>
                   </div>
                </form>
             </div>
             @php
                $firstFiveCategories = $categories->take(5);
             @endphp
             <h6 class="mt-4 text-shadow font-weight-normal">E.g. 
               
               @foreach ($firstFiveCategories as $category)
               {{ $category->name }}
           @endforeach ...</h6>
             <div class="owl-carousel owl-carousel-category owl-theme">
               @foreach ($categories as $category)
                   <div class="item">
                       <div class="osahan-category-item">
                           <a href="#">
                               <!-- Your category image -->
                               <img class="img-fluid" src="{{ asset($category->image) }}" alt="">
                               <h6>{{ $category->name }}</h6>
                               <p>{{ $category->restaurant_count }} restaurants</p>
                           </a>
                       </div>
                   </div>
               @endforeach
           </div>
          </div>

          <div class="col-md-4">
            <div class="osahan-slider pl-4 pt-3">
               <div class="owl-carousel homepage-ad owl-theme">
                  @foreach($restaurants as $restaurant)
                  <div class="item">
                     <a href="{{ url('/listing/restaurant/details/'.$restaurant->id) }}"><img class="img-fluid rounded" src="{{ asset($restaurant->image) }}"></a>
                  </div>
                  @endforeach
  
               </div>
            </div>
         </div>
       </div>
    </div>
 </section>
 <section class="section pt-5 pb-5 bg-white homepage-add-section">
    <div class="container">
       <div class="row">
         @foreach($restaurantssection as $restaurant)
          <div class="col-md-3 col-6">
             <div class="products-box">
                <a href="{{ url('/listing/restaurant/details/'.$restaurant->id) }}"><img alt="" src="{{ asset($restaurant->image) }}" class="img-fluid rounded"></a>
             </div>
          </div>
          @endforeach

       </div>
    </div>
 </section>
 <section class="section pt-5 pb-5 products-section">
    <div class="container">
       <div class="section-header text-center">
          <h2>Popular Restaurants</h2>
          <p>Top restaurants, cafes, pubs, and bars in Ludhiana, based on trends</p>
          <span class="line"></span>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="owl-carousel owl-carousel-four owl-theme">

               @foreach($popularrestaurants as $popularrestaurant)
                <div class="item">
                   <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                      <div class="list-card-image">
                         <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                         <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                         <a href="{{ url('/listing/restaurant/details/'.$popularrestaurant->id) }}">
                         <img src="{{ asset($popularrestaurant->image) }}" class="img-fluid item-img">
                         </a>
                      </div>
                      <div class="p-3 position-relative">
                         <div class="list-card-body">
                            <h6 class="mb-1" ><a href="{{ url('/listing/restaurant/details/'.$restaurant->id) }}" class="text-000">{{ $popularrestaurant->name }}</a></h6>
                            <p class="text-gray d-flex mb-3">
                              @foreach($popularrestaurant->menuCategories as $category)
                              {{ $category->name }}
                              @endforeach
                            </p>

                            <div class="list-card-badge">
                              <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                           </div>
                           </div>
                         
       
                      </div>
                   </div>
                </div>
                @endforeach
             </div>
          </div>
       </div>
    </div>
 </section>
 <section class="section pt-5 pb-5 bg-white becomemember-section border-bottom">
    <div class="container">
       <div class="section-header text-center white-text">
          <h2>Become a Member</h2>
          <p>Lorem Ipsum is simply dummy text of</p>
          <span class="line"></span>
       </div>
       <div class="row">
          <div class="col-sm-12 text-center">
             <a href="{{ url('register') }}" class="btn btn-success btn-lg">
             Create an Account <i class="fa fa-chevron-circle-right"></i>
             </a>
          </div>
       </div>
    </div>
 </section>

@endsection