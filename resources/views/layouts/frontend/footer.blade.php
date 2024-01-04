<section class="section pt-5 pb-5 text-center bg-white">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h5 class="m-0">Operate food store or restaurants? <a class="text-red" href="{{ url('register') }}">Work With Us</a></h5>
         </div>
      </div>
   </div>
</section>

<section class="footer pt-5 pb-5">
   <div class="container">
      <div class="row">
         @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <div class="col-md-4 col-12 col-sm-12">
            <h6 class="mb-3">Subscribe to our Newsletter</h6>
            <form class="newsletter-form mb-1" action="{{ route('subscribe') }}" method="POST" >
               @csrf
               <div class="input-group">
                  <input type="text" placeholder="Please enter your email"  name="email" class="form-control">
                  <div class="input-group-append">
                     <button type="submit" class="btn btn-primary">
                     Subscribe
                     </button>
                  </div>
               </div>
            </form>
            <p><a class="text-info font-weight-bold" href="{{ url('register') }}">Register now</a> to get updates on <a class="text-red" href="{{ url('offers') }}">Offers and Coupons</a></p>
            <div class="app">
               <p class="mb-2">DOWNLOAD APP</p>
               <a href="#">
               <img class="img-fluid" src="{{ asset('frontend/img/google.png') }}">
               </a>
               <a href="#">
               <img class="img-fluid" src="{{ asset('frontend/img/apple.png') }}">
               </a>
            </div>
         </div>
         <div class="col-md-1 col-sm-6 mobile-none">
         </div>
         <div class="col-md-2 col-6 col-sm-4">
            <h6 class="mb-3">About OE</h6>
            <ul>
               <li><a href="#">About Us</a></li>
               <li><a href="#">Culture</a></li>
               <li><a href="#">Blog</a></li>
               <li><a href="#">Careers</a></li>
               <li><a href="#">Contact</a></li>
            </ul>
         </div>
         <div class="col-md-2 col-6 col-sm-4">
            <h6 class="mb-3">For Foodies</h6>
            <ul>
               <li><a href="#">Community</a></li>
               <li><a href="#">Developers</a></li>
               <li><a href="#">Blogger Help</a></li>
               <li><a href="#">Verified Users</a></li>
               <li><a href="#">Code of Conduct</a></li>
            </ul>
         </div>
         <div class="col-md-2 m-none col-4 col-sm-4">
            <h6 class="mb-3">For Restaurants</h6>
            <ul>
               <li><a href="#">Advertise</a></li>
               <li><a href="#">Add a Restaurant</a></li>
               <li><a href="#">Claim your Listing</a></li>
               <li><a href="#">For Businesses</a></li>
               <li><a href="#">Owner Guidelines</a></li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section class="footer-bottom-search pt-5 pb-5 bg-white">
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <p class="text-black">POPULAR COUNTRIES</p>
            <div class="search-links">
               <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>  |  <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a><a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>  |  <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>
            </div>
            <p class="mt-4 text-black">POPULAR FOOD</p>
            <div class="search-links">
               <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a> |  <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a><a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a> |  <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a>
            </div>
         </div>
      </div>
   </div>
</section>