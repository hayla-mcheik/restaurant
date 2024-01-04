
@extends('layouts.app')

@section('content')
<div>
    <section class="restaurant-detailed-banner">
        <div class="text-center">
           <img class="img-fluid cover" src="{{ asset($restaurant->coverimage) }}">
        </div>
        <div class="restaurant-detailed-header">
           <div class="container">
              <div class="row d-flex align-items-end">
                 <div class="col-md-8">
                    <div class="restaurant-detailed-header-left">
                       <img class="img-fluid mr-3 float-left" alt="osahan" src="{{ asset($restaurant->image) }}">
                       <h2 class="text-white">{{ $restaurant->name }}</h2>
                       <p class="text-white mb-1"><i class="icofont-location-pin"></i> {{ $restaurant->address }} <span class="badge badge-success">OPEN</span>
                       </p>
                       <p class="text-white mb-0"><i class="icofont-food-cart"></i> {{ $restaurant->category->name }}
                       </p>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="restaurant-detailed-header-right text-right">
                       <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> 25–35 min
                       </button>
                       <h6 class="text-white mb-0 restaurant-detailed-ratings"><span class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span> 23 Ratings  <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        </div> 
     </section>
     <section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
        <div class="container">
           <div class="row">
              <div class="col-md-12">
                 <span class="restaurant-detailed-action-btn float-right">
                 <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-heart text-danger"></i> Mark as Favourite</button>
                 <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-cauli-flower text-success"></i>  Pure Veg</button>
                 <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i>  OFFERS</button>
                 </span>
                 <ul class="nav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                       <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Order Online</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Restaurant Info</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" id="pills-book-tab" data-toggle="pill" href="#pills-book" role="tab" aria-controls="pills-book" aria-selected="false">Book A Table</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
                    </li>
                 </ul>
              </div>
           </div>
        </div>
     </section>
     <section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
        <div class="container">
           <div class="row">
              <div class="col-md-8">
                 <div class="offer-dedicated-body-left">
                    <div class="tab-content" id="pills-tabContent">
                       <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                          <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
         
                           <h6 class="mb-3">Most Popular</h6>
                           <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel mb-3">
                               @foreach($mostPopularCategories as $category)
                                   <div class="item">
                                       <div class="mall-category-item">
                                           <a href="#">
                                               <img class="img-fluid" src="{{ asset($category->image) }}">
                                               <h6>{{ $category->name }}</h6>
                                               <small>{{ $category->total_items_sold }} ITEMS</small>
                                           </a>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                          </div>
               
                       
                          <livewire:frontend.cart.addtocart :menucategories="$menucategories" :menuItems="$menuItems" :bestSeller="$bestSeller" wire:key="uniqueKey" />

                    
                   
                       </div>
                       <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                          <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                             <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                <div class="owl-carousel owl-theme homepage-ad">

                              @foreach($restaurant->gallery as $gallery)
                                   <div class="item">
                                      <img class="img-fluid" src="{{ asset($gallery->image) }}">
                                   </div>
                                   @endforeach

                                </div>
                                <div class="position-absolute restaurant-slider-pics bg-dark text-white">2 of 14 Photos</div>
                                <div class="position-absolute restaurant-slider-view-all"><button type="button" class="btn btn-light bg-white">See all Photos</button></div>
                             </div>
                          </div>
                       </div>
                       <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                          <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                             <div class="address-map float-right ml-5">
                                <div class="mapouter">
                                   <div class="gmap_canvas"><iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                </div>
                             </div>
                             <h5 class="mb-4">Restaurant Info</h5>
                             <p class="mb-3">{{ $restaurant->address }}
                             </p>
                             <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i>{{ $restaurant->phone }}</p>
                             <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i>{{ $restaurant->email }}</p>
                             <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i>{{ $restaurant->openninghours }}
                                <span class="badge badge-success"> OPEN NOW </span>
                             </p>
                             <hr class="clearfix">
                             <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p>
                             <hr class="clearfix">
                             <h5 class="mt-4 mb-4">More Info</h5>
                             <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali, Laccha Paratha, Butter Naan</p>
                             <div class="border-btn-main mb-4">
                                <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                                <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                             </div>
                          </div>
                       </div>
                       <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                          <div id="book-a-table" class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                             <h5 class="mb-4">Book A Table</h5>
                             <form>
                                <div class="row">
                                   <div class="col-sm-6">
                                      <div class="form-group">
                                         <label>Full Name</label>
                                         <input class="form-control" type="text" placeholder="Enter Full Name">
                                      </div>
                                   </div>
                                   <div class="col-sm-6">
                                      <div class="form-group">
                                         <label>Email Address</label>
                                         <input class="form-control" type="text" placeholder="Enter Email address">
                                      </div>
                                   </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                      <div class="form-group">
                                         <label>Mobile number</label>
                                         <input class="form-control" type="text" placeholder="Enter Mobile number">
                                      </div>
                                   </div>
                                   <div class="col-sm-6">
                                      <div class="form-group">
                                         <label>Date And Time</label>
                                         <input class="form-control" type="text" placeholder="Enter Date And Time">
                                      </div>
                                   </div>
                                </div>
                                <div class="form-group text-right">
                                   <button class="btn btn-primary" type="button"> Submit </button>
                                </div>
                             </form>
                          </div>
                       </div>
                       <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                          <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating">
                             <span class="star-rating float-right">
                             <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                             <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                             <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                             <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                             </span>
                             <h5 class="mb-0 pt-1">Rate this Place</h5>
                          </div>
                          <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                             <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                             <div class="graph-star-rating-header">
                                <div class="star-rating">
                                   <a href="#"><i class="icofont-ui-rating active"></i></a>
                                   <a href="#"><i class="icofont-ui-rating active"></i></a>
                                   <a href="#"><i class="icofont-ui-rating active"></i></a>
                                   <a href="#"><i class="icofont-ui-rating active"></i></a>
                                   <a href="#"><i class="icofont-ui-rating"></i></a>  <b class="text-black ml-2">334</b>
                                </div>
                                <p class="text-black mb-4 mt-2">Rated 3.5 out of 5</p>
                             </div>
                             <div class="graph-star-rating-body">
                                <div class="rating-list">
                                   <div class="rating-list-left text-black">
                                      5 Star
                                   </div>
                                   <div class="rating-list-center">
                                      <div class="progress">
                                         <div style="width: 56%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                            <span class="sr-only">80% Complete (danger)</span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="rating-list-right text-black">56%</div>
                                </div>
                                <div class="rating-list">
                                   <div class="rating-list-left text-black">
                                      4 Star
                                   </div>
                                   <div class="rating-list-center">
                                      <div class="progress">
                                         <div style="width: 23%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                            <span class="sr-only">80% Complete (danger)</span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="rating-list-right text-black">23%</div>
                                </div>
                                <div class="rating-list">
                                   <div class="rating-list-left text-black">
                                      3 Star
                                   </div>
                                   <div class="rating-list-center">
                                      <div class="progress">
                                         <div style="width: 11%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                            <span class="sr-only">80% Complete (danger)</span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="rating-list-right text-black">11%</div>
                                </div>
                                <div class="rating-list">
                                   <div class="rating-list-left text-black">
                                      2 Star
                                   </div>
                                   <div class="rating-list-center">
                                      <div class="progress">
                                         <div style="width: 2%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                            <span class="sr-only">80% Complete (danger)</span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="rating-list-right text-black">02%</div>
                                </div>
                             </div>
                             <div class="graph-star-rating-footer text-center mt-3 mb-3">
                                <button type="button" class="btn btn-outline-primary btn-sm">Rate and Review</button>
                             </div>
                          </div>
                          <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                             <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a>
                             <h5 class="mb-1">All Ratings and Reviews</h5>
                             <div class="reviews-members pt-4 pb-4">
                                <div class="media">
                                   <a href="#"><img alt="Generic placeholder image" src="img/user/1.png" class="mr-3 rounded-pill"></a>
                                   <div class="media-body">
                                      <div class="reviews-members-header">
                                         <span class="star-rating float-right">
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating"></i></a>
                                         </span>
                                         <h6 class="mb-1"><a class="text-black" href="#">Singh Osahan</a></h6>
                                         <p class="text-gray">Tue, 20 Mar 2020</p>
                                      </div>
                                      <div class="reviews-members-body">
                                         <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections </p>
                                      </div>
                                      <div class="reviews-members-footer">
                                         <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 856M</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 158K</a> 
                                         <span class="total-like-user-main ml-2" dir="rtl">
                                         <a data-toggle="tooltip" data-placement="top" title="Gurdeep Osahan" href="#"><img alt="Generic placeholder image" src="img/user/5.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Gurdeep Singh" href="#"><img alt="Generic placeholder image" src="img/user/2.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Askbootstrap" href="#"><img alt="Generic placeholder image" src="img/user/3.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Osahan" href="#"><img alt="Generic placeholder image" src="img/user/4.png" class="total-like-user rounded-pill"></a>
                                         </span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <hr>
                             <div class="reviews-members pt-4 pb-4">
                                <div class="media">
                                   <a href="#"><img alt="Generic placeholder image" src="img/user/6.png" class="mr-3 rounded-pill"></a>
                                   <div class="media-body">
                                      <div class="reviews-members-header">
                                         <span class="star-rating float-right">
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating active"></i></a>
                                         <a href="#"><i class="icofont-ui-rating"></i></a>
                                         </span>
                                         <h6 class="mb-1"><a class="text-black" href="#">Gurdeep Singh</a></h6>
                                         <p class="text-gray">Tue, 20 Mar 2020</p>
                                      </div>
                                      <div class="reviews-members-body">
                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                      </div>
                                      <div class="reviews-members-footer">
                                         <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 88K</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 1K</a> 
                                         <span class="total-like-user-main ml-2" dir="rtl">
                                         <a data-toggle="tooltip" data-placement="top" title="Gurdeep Osahan" href="#"><img alt="Generic placeholder image" src="img/user/5.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Gurdeep Singh" href="#"><img alt="Generic placeholder image" src="img/user/2.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Askbootstrap" href="#"><img alt="Generic placeholder image" src="img/user/3.png" class="total-like-user rounded-pill"></a>
                                         <a data-toggle="tooltip" data-placement="top" title="Osahan" href="#"><img alt="Generic placeholder image" src="img/user/4.png" class="total-like-user rounded-pill"></a>
                                         </span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <hr>
                             <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a>
                          </div>
                          <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                             <h5 class="mb-4">Leave Comment</h5>
                             <p class="mb-2">Rate the Place</p>
                             <div class="mb-4">
                                <span class="star-rating">
                                <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                </span>
                             </div>
                             <form>
                                <div class="form-group">
                                   <label>Your Comment</label>
                                   <textarea class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary btn-sm" type="button"> Submit Comment </button>
                                </div>
                             </form>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="pb-2">
                 <div class="bg-white rounded shadow-sm text-white mb-4 p-4 clearfix restaurant-detailed-earn-pts card-icon-overlap">
                    <img class="img-fluid float-left mr-3" src="img/earn-score-icon.png">
                    <h6 class="pt-0 text-primary mb-1 font-weight-bold">OFFER</h6>
                    <p class="mb-0">60% off on orders above $99 | Use coupon <span class="text-danger font-weight-bold">OSAHAN50</span></p>
                    <div class="icon-overlap">
                       <i class="icofont-sale-discount"></i>
                    </div>
                 </div>
                 </div>
      
                 <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                  <!-- livewire view file -->
                  
                 <livewire:Frontend.cart.showorders />
                 <livewire:Frontend.cart.subtotal />
                 </div>
                 
                 <div class="text-center pt-2 mb-4">
                 <img class="img-fluid" src="https://dummyimage.com/352x600/ccc/ffffff.png&text=Google+ads">
                 </div>
                 <div class="text-center pt-2">
                 <img class="img-fluid" src="https://dummyimage.com/352x568/ccc/ffffff.png&text=Google+ads">
                 </div>
              </div>
           </div>
        </div>
     </section>

</div>

@endsection