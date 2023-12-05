@extends('layouts.admin.master')
@section('title')
Add Category
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Category
                    <a href="{{ url('admin/category/restaurant/list') }}" class="btn btn-danger btn-sm float-end">
                        Back
</a>
                </h3>
</div>

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
<form action="{{ url('admin/category/restaurant/list') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="row">
<div class="mb-3">
<label>Name*</label>
<input type="text" name="name" value="{{ old('name') }}"  class="form-control"/>
@error('name') <small>{{ $message}}</small> @enderror
</div>

<div class="mb-3">
    <label>Slug*</label>
    <input type="text" name="slug"  value="{{ old('slug') }}"  class="form-control"/>
    @error('slug') <small>{{ $message}}</small> @enderror
    </div>
    <div class="mb-3">
        <label>Status*</label>
        <input  type="checkbox"  name="status"  />
        </div>



<div class="col-md-12 mb-3">
    <button type="btn" class="btn btn-primary float-end">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>

</div>

@endsection
