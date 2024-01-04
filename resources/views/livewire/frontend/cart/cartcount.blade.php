<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
       <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="{{ url('/offers') }}"><i class="icofont-sale-discount"></i> Offers <span class="badge badge-danger">New</span></a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="{{ url('listing') }}">
          Restaurants
          </a>
       </li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pages
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
             <a class="dropdown-item" href="track-order.html">Track Order</a>
             <a class="dropdown-item" href="invoice.html">Invoice</a>
             <a class="dropdown-item" href="404.html">404</a>
             <a class="dropdown-item" href="extra.html">Extra :)</a>
          </div>
       </li>
       @guest
       <!-- Guest Links -->
       @if (Route::has('login'))
           <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
           </li>
       @endif
   
       @if (Route::has('register'))
           <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
           </li>
       @endif
   @else
       <!-- Authenticated User Links -->
       <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img alt="Generic placeholder image" src="{{ asset(auth()->check() ? auth()->user()->image : 'frontend/img/user/4.png') }}" class="nav-osahan-pic rounded-pill">
               {{ Auth::user()->name }}
           </a>
           <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
             @if(auth()->user()->role_as == '1')
             <a class="dropdown-item" href="{{ url('admin/dashbiard') }}"><i class="feather-edit"></i>Dashboard</a>
         @elseif(auth()->user()->role_as == '2')
             <a class="dropdown-item" href="{{ url('manager/dashboard') }}"><i class="feather-edit"></i>Dashboard</a>
         @elseif(auth()->user()->role_as == '3')
             <a class="dropdown-item" href="{{ url('user/dashboard') }}"><i class="feather-edit"></i>Dashboard</a>
         @endif
               <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
              </a>
              
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              
           </div>
       </li>
   @endguest
   
   <li class="nav-item dropdown dropdown-cart">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-shopping-basket"></i> Cart
          <span class="badge badge-success">{{ $cartCount }}</span>
      </a>

<div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
    @forelse($cartItems as $item)
    <div class="dropdown-cart-top-body border-top p-2">
      @if($item->appliedOffer )
          {{-- Display content for items with applied offers --}}
          <p class="mb-2">
              <i class="icofont-ui-press text-danger food-item"></i>
              {{ $item->appliedOffer->offer->name }} x {{ $item->quantity }}
              <span class="float-right text-secondary">${{ $item->appliedOffer->discount_value }}</span>
          </p>
      @elseif($item->menuitems->isNotEmpty())
          {{-- Display content for items without applied offers (many menu items) --}}
          @foreach($item->menuitems as $menuItem)
              <p class="mb-2">
                  <i class="icofont-ui-press text-danger food-item"></i>
                  {{ $menuItem->name }} x {{ $item->quantity }}
                  <span class="float-right text-secondary">${{ $menuItem->price }}</span>
              </p>
          @endforeach
      @else
          {{-- Handle the case where there are no applied offers or menu items --}}
          <p>No menu items available for this cart item</p>
      @endif
  </div>
  
    @empty
        <p>No items in the cart</p>
    @endforelse

    <div class="dropdown-cart-top-footer border-top p-2">
        <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">${{ $cartItems->sum(function ($item) { return $item->quantity * (optional($item->appliedOffer)->discount_value ?: optional($item->menuitems->first())->price); }) }}</span></p>
        <small class="text-info">Extra charges may apply</small>
    </div>

    <div class="dropdown-cart-top-footer border-top p-4">
        <a class="btn btn-success btn-block btn-lg" href="{{ url('checkout') }}">Checkout</a>
    </div>
</div>

  </li>
</ul>
</div>