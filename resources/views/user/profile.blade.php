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
             <div class="card mb-4 order-list">
                <div class="gold-members p-4">
                   <a href="#">
                   </a>
                   <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label>Your photo</label>
                            <form action="/file-upload" class="dropzone dz-clickable">
                               <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                            </form>
                         </div>
                      </div>
                      <div class="col-md-8 add_top_30">
                         <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control" placeholder="Your name">
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Last name</label>
                                  <input type="text" class="form-control" placeholder="Your last name">
                               </div>
                            </div>
                         </div>
                         <!-- /row-->
                         <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Telephone</label>
                                  <input type="text" class="form-control" placeholder="Your telephone number">
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" class="form-control" placeholder="Your email">
                               </div>
                            </div>
                         </div>
                         <!-- /row-->
                         <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label>Personal info</label>
                                  <textarea style="height:100px;" class="form-control" placeholder="Personal info"></textarea>
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
                                  <input class="form-control" type="password">
                               </div>
                               <div class="form-group">
                                  <label>New password</label>
                                  <input class="form-control" type="password">
                               </div>
                               <div class="form-group">
                                  <label>Confirm new password</label>
                                  <input class="form-control" type="password">
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
                                  <input class="form-control" name="old_email" id="old_email" type="email">
                               </div>
                               <div class="form-group">
                                  <label>New email</label>
                                  <input class="form-control" name="new_email" id="new_email" type="email">
                               </div>
                               <div class="form-group">
                                  <label>Confirm new email</label>
                                  <input class="form-control" name="confirm_new_email" id="confirm_new_email" type="email">
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="save mb-2">
                <a href="#" class="btn btn-success">Save</a>
             </div>
          </div>
       </div>
@endsection