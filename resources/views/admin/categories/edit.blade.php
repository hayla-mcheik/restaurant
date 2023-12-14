@extends('layouts.admin.master')
@section('title')
    Edit Category
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        
          
                    <h3>Edit New Category
                 
                    </h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/category/restaurant/list') }}">Categories list</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
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

                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name*</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required />
                                @error('name') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Slug*</label>
                                <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" />
                                @error('slug') <small>{{ $message}}</small> @enderror
                            </div>   
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image">Image*</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                        class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                @endif
                                @error('image') <small>{{ $message }}</small> @enderror
                            </div>
                        </div>

                            <div class="mb-3">
                                <label>Status*</label>
                                <input  type="checkbox"  name="status"  {{ $category->status ? 'checked' : '' }} />
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
