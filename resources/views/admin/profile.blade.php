@extends('layouts.admin.master')
@section('title')
Admin Profile
@endsection
@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin Profile</li>
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
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">

         <div class="col-md-6">
<div class="mb-3">
<label>Name*</label>
<input type="text" name="name"  value="{{ $admin->name }}"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
            </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Email*</label>
                        <input type="text" name="email" value="{{ $admin->email  }}"   class="form-control"/>
                        @error('email') <small>{{ $message}}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Password*</label>
                            <input type="password" name="password" value="{{ $admin->password}}"   class="form-control"/>
                            @error('password') <small>{{ $message}}</small> @enderror
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
