@extends('layouts.admin.master')
@section('title')
    Edit Restaurant Status
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
      
                    <h3>Edit Status
                    </h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/category/restaurant/list') }}">Restaurant list</a></li>
                        <li class="breadcrumb-item active">Edit Restaurant</li>
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

                    <form action="{{ route('admin.restaurant.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label>Name*</label>
                                <input type="text" name="name" value="{{ $restaurant->name }}" class="form-control" disabled readonly/>
                                @error('name') <small>{{ $message}}</small> @enderror
                            </div>
                 
                            <div class="mb-3">
                                <label>Status*</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ trim($restaurant->status) == '0' ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ trim($restaurant->status) == '1' ? 'selected' : '' }}>Pending</option>
                                </select>
                                @error('status') <small>{{ $message }}</small> @enderror
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
