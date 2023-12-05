@extends('layouts.app')

@section('content')

<div class="bg-primary p-20">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
   
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
    
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
    
                                        <div class="row py-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input id="name" type="text" placeholder="Enter first name"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>                    
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter last name" class="form-control py-4 @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required />
                                             @error('lname')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                             @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group py-2">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input id="password" type="password" placeholder="Enter password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                             
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="user" id="role_user" name="role_as">
                                            <label class="form-check-label" for="role_user">
                                                User
                                            </label>
                                        </div>
                                        
            
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="manager" id="role_manager" name="role_as">
                                            <label class="form-check-label" for="role_manager">
                                                Manager
                                            </label>
                                        </div>
                                        


                                        <div class="form-group mt-4 mb-0"> <button class="btn btn-primary btn-block" type="submit">Create Account</button></div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="{{ url('login') }}">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
        </div>

    </div>
   
</div>
@endsection
