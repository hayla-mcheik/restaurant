@extends('layouts.admin.master')
@section('title')
Dashboard
@endsection
@section('content')
    <div class="container-fluid">
       <h1 class="mt-4">My Profile</h1>
       <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">My Profile</li>
       </ol>

       <div class="row">
          <div class="col-xl-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')

             <div class="card mb-4 order-list">
                <div class="gold-members p-4">
                   <a href="#">
                   </a>
                       <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label>My Profile</label>
                            <div class="col-md-12">
                              <div class="mb-3">
                                 <label for="image">Image*</label>
                                 <input type="file" name="image" class="form-control" accept="image/*">
                                 @if($user && $user->image)
                                     <img src="{{ asset($user->image) }}" alt="User Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                 @endif
                                 @error('image') <small>{{ $message }}</small> @enderror
                             </div>
                             
                           </div>
                         </div>
                      </div>
                      <div class="col-md-8 add_top_30">
                         <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control"  name="name" value="{{ $user->name }}" placeholder="Your name">
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Last name</label>
                                  <input type="text" class="form-control" value="lname" value="{{ $user->lname }}"  placeholder="Your last name">
                               </div>
                            </div>
                         </div>
                         <!-- /row-->
                         <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Telephone</label>
                                  <input type="text" class="form-control" value="{{ $user->phone }}" name="phone" placeholder="Your telephone number">
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="Your email">
                               </div>
                            </div>
                         </div>
                         <!-- /row-->
                         <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label>Personal info</label>
                                  <textarea style="height:100px;" class="form-control" value="{{ $user->info }}" name="info" placeholder="Personal info">{{ $user->info }}</textarea>
                               </div>
                            </div>
                         </div>
                         <!-- /row-->
                      </div>
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                   <div class="card mb-4 order-list">
                      <div class="gold-members">
                         <div class="box_general padding_bottom">
                            <div class="header_box version_2 border-bottom p-3">
                               <h6 class="m-0"><i class="fa fa-lock text-muted mr-2"></i>Change password</h6>
                            </div>
                            <div class="p-3">
                              <div class="form-group">
                                 <label>Old password</label>
                                 <input class="form-control" name="password"  value="{{ $user->password }}"  type="password">
                             </div>
                             
                               <div class="form-group">
                                  <label>New password</label>
                                  <input class="form-control" name="currentpassword" value="{{ $user->currentpassword }}"  type="password">
                               </div>
                  
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="card mb-4 order-list">
                      <div class="gold-members">
                         <div class="box_general padding_bottom">
                            <div class="header_box version_2 border-bottom p-3">
                               <h6 class="m-0"><i class="fa fa-envelope text-muted mr-2"></i>Change email</h6>
                            </div>
                            <div class="p-3">
                               <div class="form-group">
                                  <label>Old email</label>
                                  <input class="form-control" name="email" value="{{ $user->email }}"  id="old_email" type="email">
                               </div>
                               <div class="form-group">
                                  <label>New email</label>
                                  <input class="form-control" name="currentemail" value="{{ $user->currentemail }}"  id="new_email" type="email">
                               </div>
                     
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="save mb-2">
                <button type="submit" class="btn btn-success">Save</button>
             </div>

            </form>
          </div>
       </div>


@endsection