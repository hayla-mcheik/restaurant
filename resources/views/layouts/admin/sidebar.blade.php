<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
       <div class="sb-sidenav-menu">


    
          <div class="nav">
             <div class="sb-sidenav-menu-heading">Core</div>
             @if(auth()->user()->role_as == '1' )
             <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
                Dashboard
             </a> 
             <a class="nav-link" href="{{ url('admin/status/users') }}">
               <div class="sb-nav-link-icon"><i class="feather-users"></i></div>
          Users Status
            </a> 
             <a class="nav-link" href="{{ url('admin/list/orders') }}">
               <div class="sb-nav-link-icon"><i class="feather-shopping-bag"></i></div>
               Orders
            </a>
             <a class="nav-link" href="{{ url('admin/category/restaurant/list') }}">
               <div class="sb-nav-link-icon"><i class="feather-grid"></i></div>
             Restaurant categories
            </a>
             <a class="nav-link" href="{{ url('admin/list/restaurant') }}">
                <div class="sb-nav-link-icon"><i class="feather-clipboard"></i></div>
            List of Restaurant
             </a>
   
            <a class="nav-link" href="{{ url('admin/list/menu') }}">
               <div class="sb-nav-link-icon"><i class="feather-menu"></i></div>
                Menu List
            </a>
        @else
        @if(auth()->user()->role_as == '2' )

        <a class="nav-link" href="{{ url('manager/dashboard') }}">
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
         Dashboard
      </a> 
      <a class="nav-link" href="{{ url('manager/orders') }}">
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
     Orders Management
      </a> 
      
      <a class="nav-link" href="{{ route('manager.restaurant') }}">
         <div class="sb-nav-link-icon"><i class="feather-clipboard"></i></div>
         Restaurant Management
     </a>
     
     @auth
     @if(auth()->user()->restaurant)
     
      <a class="nav-link" href={{ route('manager.menu.categories') }}>
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
Menu Categories
      </a> 
      <a class="nav-link" href="{{route('manager.menu.items') }}">
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
Menu Items
      </a> 

      <a class="nav-link" href="{{route('manager.gallery') }}">
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
Gallery
      </a> 

      <a class="nav-link" href="{{route('manager.offers.index') }}">
         <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
Offers
      </a> 

     

      @endif
      @endauth
      
             <a class="nav-link" href="{{ route('manager.profile') }}">
                <div class="sb-nav-link-icon"><i class="feather-user"></i></div>
                My Profile
             </a>
             <div class="sb-sidenav-menu-heading">Interface</div>

             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="feather-book"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                      Authentication
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                   </a>
                   <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                      <nav class="sb-sidenav-menu-nested nav">
                         <a class="nav-link" href="login.html">Login</a>
                         <a class="nav-link" href="register.html">Register</a>
                         <a class="nav-link" href="password.html">Forgot Password</a>
                      </nav>
                   </div>
                   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                      Error
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                   </a>
                   <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                      <nav class="sb-sidenav-menu-nested nav">
                         <a class="nav-link" href="401.html">401 Page</a>
                         <a class="nav-link" href="404.html">404 Page</a>
                         <a class="nav-link" href="500.html">500 Page</a>
                      </nav>
                   </div>
                </nav>
             </div>

             @else
             @if(auth()->user()->role_as == '3' )

             <a class="nav-link" href="{{ url('user/dashboard') }}">
               <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
               Dashboard
            </a> 

            <a class="nav-link" href="{{ url('user/orders') }}">
               <div class="sb-nav-link-icon"><i class="feather-shopping-bag"></i></div>
               My Orders
            </a>
            

            <a class="nav-link" href="{{ url('user/addresses') }}">
               <div class="sb-nav-link-icon"><i class="feather-home"></i></div>
          Addresses
            </a> 
            <a class="nav-link" href="{{ url('user/wishlist') }}">
               <div class="sb-nav-link-icon"><i class="fa fa-heart"></i></div>
               My Favorite 
            </a>
            <a class="nav-link" href="{{ url('user/profile') }}">
               <div class="sb-nav-link-icon"><i class="feather-user"></i></div>
               My Profile
            </a>
            
            @endif
            @endif
         @endif
          </div>
       </div>
       <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Ask Bootstrap
       </div>
    </nav>
 </div>