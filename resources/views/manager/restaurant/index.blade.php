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
<form action="{{ route('manager.restaurant.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Category*</label>
                    <select name="category_id" class="form-control">
                        <option value="" selected disabled>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ optional($restaurant)->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            
         <div class="col-md-6">
<div class="mb-3">
<label>Name*</label>
<input type="text" name="name" value="{{ old('name', $restaurant->name ?? '') }}"   class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
            </div>
            <div class="col-md-6">
<div class="mb-3">
    <label>Slug*</label>
    <input type="text" name="slug"   value="{{ old('slug', $restaurant->slug ?? '') }}"   class="form-control"/>
    @error('slug') <small>{{ $message}}</small> @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
        <label>Address*</label>
        <input type="text" name="address"   value="{{ old('address', $restaurant->address ?? '') }}"   class="form-control"/>
        @error('address') <small>{{ $message}}</small> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Map*</label>
            <input type="text" name="map"  value="{{ old('map',$restaurant->map ?? '') }}"  class="form-control"/>
            @error('map') <small>{{ $message}}</small> @enderror
            </div>
        </div>

            
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Phone*</label>
                    <input type="text" name="phone" value="{{ old('phone', $restaurant->phone ?? '') }}"  class="form-control"/>
                    @error('phone') <small>{{ $message}}</small> @enderror
                    </div>
                </div>
            

                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Email*</label>
                        <input type="text" name="email" value="{{ old('email', $restaurant->email ?? '') }}"   class="form-control"/>
                        @error('email') <small>{{ $message}}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Delivery Time*</label>
                            <input type="text" name="deliverytime" value="{{ old('deliverytime', $restaurant->deliverytime ?? '') }}"  class="form-control"/>
                            @error('deliverytime') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Opening Hours*</label>
                                  <textarea style="height:100px;" class="form-control" value="{{ old('openninghours',$restaurant->openninghours ?? '') }}"  name="openninghours" placeholder="Personal info">{{ old('openninghours', $restaurant->openninghours ?? '') }} </textarea>
                                  @error('openninghours') <small>{{ $message}}</small> @enderror
                                </div>
                            </div>
                      

                        
             
    
                            <div class="mb-3">
                                <label for="image">Image*</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if($restaurant && $restaurant->image)
                                    <img src="{{ asset($restaurant->image) }}" alt="Restaurant Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                @endif
                                @error('image') <small>{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="coverimage">Cover Image*</label>
                                <input type="file" name="coverimage" class="form-control" accept="image/*">
                                @if($restaurant && $restaurant->coverimage)
                                    <img src="{{ asset($restaurant->coverimage) }}" alt="Cover Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                @endif
                                @error('coverimage') <small>{{ $message }}</small> @enderror
                            </div>                         

                            <div class="mb-3">
                                <label>Status*</label>
                                <input type="checkbox" name="status" {{ $restaurant->status ? 'checked' : '' }} />
                            </div>
                            
                            <div class="mb-3">
                                <label>Popular*</label>
                                <input type="checkbox" name="popular" {{ $restaurant->popular ? 'checked' : '' }} />
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
