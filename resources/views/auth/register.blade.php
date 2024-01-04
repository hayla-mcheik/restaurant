<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>Restaurant test</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/favicon.png">
      <!-- Bootstrap core CSS-->
      <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{ asset('frontend/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="{{ asset('frontend/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset('frontend/css/osahan.css') }}" rel="stylesheet">
      <style>
.form-label-group>input , .form-label-group>label {
    background: white !important; /* Set the initial background color for the input */
}

.form-label-group input:focus~label,
.form-label-group input:not(:placeholder-shown)~label {
    background: transparent !important; /* Set the background color for the label when focused or not placeholder-shown */
}

.form-label-group>input,
.form-label-group>label {
    border: none;
    border-bottom: 1px solid #ced4da;
}
.nav-tabs .nav-link{
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
    width: 100px;
padding: 10px;
}
.nav-tabs .nav-link.active{
    border: none !important;
}
        </style>
</head>
<body class="bg-white">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                                <h3 class="login-heading mb-4">New Buddy!</h3>
                                <div class="d-flex mb-3">
                                    <ul class="nav nav-tabs" id="roleTabs">
                                        <li class="nav-item">
                                            <a class="nav-link active btn btn-lg btn-outline-primary btn-block btn-login d-flex justify-content-center" id="user-tab" data-toggle="tab" href="#userFields">User</a>
                                        </li>
                                        <li class="nav-item mx-2">
                                            <a class="nav-link btn btn-lg btn-outline-primary btn-block btn-login  d-flex justify-content-center" id="manager-tab" data-toggle="tab" href="#managerFields">Manager</a>
                                        </li>
                                    </ul>
                                </div>

                         
                                    @csrf
                                    <div class="tab-content">
                                        <!-- User Fields Tab -->
                                        <div class="tab-pane fade show active" id="userFields" value="user" id="role_user" name="role_as">
                                            <!-- ... (user fields) ... -->
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                            <input type="hidden" name="role_as" value="user">
                                            <div class="form-label-group">
                                                <input type="text" id="user_name" class="form-control" name="name" placeholder="Your Name">
                                                <label for="user_name">Name</label>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input type="email" id="user_email" class="form-control" name="email" placeholder="Email address">
                                                <label for="user_email">Email address / Mobile</label>
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input type="password" id="user_password" class="form-control" placeholder="Password" name="password">
                                                <label for="user_password">Password</label>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>


                                            
                                            <div class="form-label-group">
                                                <input type="text" id="user_phone" class="form-control" placeholder="Phone" name="phone">
                                                <label for="user_phone">Phone</label>
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>


                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="user_customCheck1" name="user_remember" {{ old('user_remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="user_customCheck1">Remember password</label>
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</button>

                                        </form>
                                        </div>
                                

                                        <!-- Manager Fields Tab -->
                                        <div class="tab-pane fade" id="managerFields" value="manager" id="role_manager" name="role_as">
                                            <form method="POST" action="{{ route('register') }}">
                                           @csrf
                                                <!-- ... (manager fields) ... -->
                                            <input type="hidden" name="role_as" value="manager">
                                            <div class="form-label-group">
                                                <input type="text" id="manager_name" class="form-control" name="name" placeholder="Your Name">
                                                <label for="manager_name">Name</label>
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input type="email" id="manager_email" class="form-control" name="email" placeholder="Email address">
                                                <label for="manager_email">Email address / Mobile</label>
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input type="password" id="manager_password" class="form-control" placeholder="Password" name="password">
                                                <label for="manager_password">Password</label>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="form-label-group">
                                                <input type="text" id="manager_phone" class="form-control" placeholder="Phone" name="phone">
                                                <label for="manager_phone">Phone</label>
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                            <div class="form-label-group">
                                                <input type="text" id="manager_info" class="form-control" placeholder="Your business" name="info">
                                                <label for="manager_info">Small Description</label>
                                                @error('info')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="manager_customCheck1" name="manager_remember" {{ old('manager_remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="manager_customCheck1">Remember password</label>
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up as partner</button>
                                        </form>

                                        </div>

                                    </div>
                            
                                <!-- ... (your existing code) ... -->

                                <script src="{{ asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js') }}"></script>
                                <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                           
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




