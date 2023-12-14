@extends('layouts.admin.master')
@section('title')
Add Category
@endsection
@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
       
     
                <h3>Add New Category
                </h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/category/restaurant/list') }}">Categories list</a></li>
                    <li class="breadcrumb-item active">Create Category</li>
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
<form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="row">
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

<div class="mb-3">
    <label for="image">Image*</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @error('image') <small>{{ $message }}</small> @enderror
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
