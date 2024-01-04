@extends('layouts.admin.master')

@section('title')
    Edit Menu Items
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit Menu Items</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('manager/menu/items') }}">Menu Items list</a></li>
                    <li class="breadcrumb-item active">Edit Menu Items</li>
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
                        <form action="{{ route('manager.menu.update', $menuitems->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Category*</label>
                                        <select class="form-control" name="menu_category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $menuitems->category_id ? 'selected' :'' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Name*</label>
                                        <input type="text" name="name" value="{{ $menuitems->name }}"
                                            class="form-control" />
                                        @error('name') <small>{{ $message}}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Slug*</label>
                                        <input type="text" name="slug" value="{{ $menuitems->slug }}"
                                            class="form-control" />
                                        @error('slug') <small>{{ $message}}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Quantity*</label>
                                        <input type="number" name="quantity" value="{{ $menuitems->quantity }}"
                                            class="form-control" />
                                        @error('quantity') <small>{{ $message}}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Price*</label>
                                        <input type="text" name="price" value="{{ $menuitems->price }}"
                                            class="form-control" />
                                        @error('price') <small>{{ $message}}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image">Image*</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if ($menuitems->image)
                                            <img src="{{ asset($menuitems->image) }}" alt="{{ $menuitems->name }}"
                                                class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        @endif

                
                                        @error('image') <small>{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Status*</label>
                                        <input type="checkbox" name="status" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success float-end">
                                    <i class="feather-send"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
