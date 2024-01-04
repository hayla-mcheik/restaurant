@extends('layouts.admin.master')
@section('title')
Add Restaurant Gallery
@endsection
@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
                <h3>Add Restaurant Gallery
                </h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('manager/gallery') }}">Restaurant Gallery</a></li>
                    <li class="breadcrumb-item active">Create Restaurant Gallery</li>
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
<form action="{{ route('manager.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="row">
    <div class="mb-3">
        <label for="image">Image*</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @error('image') <small>{{ $message }}</small> @enderror
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
