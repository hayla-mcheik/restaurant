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
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-label-group">
                    <input type="text" id="ptext" class="form-control" name="name" placeholder="Your Name ">
                    <label for="ptext">Name</label>
                 </div>
                         <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address">
                            <label for="inputEmail">Email address / Mobile</label>
                         </div>
                         
                         <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" >
                            <label for="inputPassword">Password</label>
                         </div>

                         <div class="d-flex">
                         <div class="form-check">
                            <input class="form-check-input" type="radio" value="user" id="role_user" name="role_as">
                            <label class="form-check-label" for="role_user">
                                User
                            </label>
                        </div>
                                             
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" value="manager" id="role_manager" name="role_as">
                            <label class="form-check-label" for="role_manager">
                                Manager
                            </label>
                        </div>
                    </div>
                         <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                         </div>
                         <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</button>
                         <div class="text-center pt-3">
                            Already have an Account? <a class="font-weight-bold" href="{{ route('login') }}">Sign In</a>
                         </div>
                      </form>

                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

      <!-- jQuery -->
      <script src="{{ asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js') }}"></script>
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{ asset('frontend/vendor/select2/js/select2.min.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>
</html>




