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
<form action="{{ route('manager.restaurant.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Category*</label>
                    <select name="category_id" class="form-control">
                        <option value="" selected disabled>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
         <div class="col-md-6">
<div class="mb-3">
<label>Name*</label>
<input type="text" name="name" value="{{ old('name') }}"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
            </div>
            <div class="col-md-6">
<div class="mb-3">
    <label>Slug*</label>
    <input type="text" name="slug"  value="{{ old('slug') }}"  class="form-control"/>
    @error('slug') <small>{{ $message}}</small> @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
        <label>Address*</label>
        <input type="text" name="address"  value="{{ old('address') }}"  class="form-control"/>
        @error('address') <small>{{ $message}}</small> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Map*</label>
            <input type="text" name="map"  value="{{ old('map') }}"  class="form-control"/>
            @error('map') <small>{{ $message}}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Address*</label>
                <input type="text" name="address"  value="{{ old('address') }}"  class="form-control"/>
                @error('address') <small>{{ $message}}</small> @enderror
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Phone*</label>
                    <input type="text" name="phone"  value="{{ old('phone') }}"  class="form-control"/>
                    @error('phone') <small>{{ $message}}</small> @enderror
                    </div>
                </div>
            

                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Email*</label>
                        <input type="text" name="email"  value="{{ old('email') }}"  class="form-control"/>
                        @error('email') <small>{{ $message}}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Opening Hours*</label>
                            <input type="text" name="openninghours"  value="{{ old('openninghours') }}"  class="form-control"/>
                            @error('openninghours') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Delivery Time*</label>
                                <input type="text" name="openninghours"  value="{{ old('openninghours') }}"  class="form-control"/>
                                @error('openninghours') <small>{{ $message}}</small> @enderror
                                </div>
                            </div>
    

                            <div class="mb-3">
                                <label for="image">Image*</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @error('image') <small>{{ $message }}</small> @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="coverimage">Cover Image*</label>
                                <input type="file" name="coverimage" class="form-control" accept="image/*">
                                @error('coverimage') <small>{{ $message }}</small> @enderror
                            </div>


    <div class="mb-3">
        <label>Status*</label>
        <input  type="checkbox"  name="status"  />
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
