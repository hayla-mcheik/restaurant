@extends('layouts.admin.master')
@section('title')
Restaurant Profile
@endsection
@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Restaurant Profile</li>
                 </ol>
                 <div class="card">
<div class="card-body">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('manager.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">

         <div class="col-md-6">
<div class="mb-3">
<label>Name*</label>
<input type="text" name="name"  value="{{ $owner->name }}"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
            </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Email*</label>
                        <input type="text" name="email" value="{{ $owner->email  }}"   class="form-control"/>
                        @error('email') <small>{{ $message}}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Password*</label>
                            <input type="password" name="password" value="{{ $owner->password}}"   class="form-control"/>
                            @error('password') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
    

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Phone*</label>
                                <input type="text" name="phone" value="{{ $owner->phone}}" class="form-control"/>
                                @error('phone') <small>{{ $message}}</small> @enderror
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label>Personal info</label>
                                  <textarea style="height:100px;" class="form-control" value="{{ $owner->info }}" name="info" placeholder="Personal info">{{ $owner->info }}</textarea>
                               </div>
                            </div>
                         </div>

        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-success float-end">
                <i class="feather-send"></i> Save
            </button>
        </div>
</div>
</form>
</div>
</div>
</div>

</div>
</div>
@endsection
