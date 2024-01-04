@extends('layouts.admin.master')
@section('title')
    Edit Address
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        
          
                    <h3>Edit Address
                 
                    </h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('user/addresses') }}">Edit Address</a></li>
                        <li class="breadcrumb-item active">Edit Address</li>
                     </ol>
                    <div class="card">
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }} </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('user.address.update', $address->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label>Label*</label>
                                <input type="text" name="label" value="{{ $address->label }}" class="form-control"  />
                                @error('label') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Address*</label>
                                <input type="text" name="address" value="{{ $address->address }}" class="form-control" />
                                @error('address') <small>{{ $message}}</small> @enderror
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
