@extends('layouts.admin.master')

@section('title')
    Edit Restaurant Gallery
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Add Menu Items</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('manager/gallery') }}">Restaurant Gallery</a></li>
                    <li class="breadcrumb-item active"> Edit Restaurant Gallery</li>
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
                        <form method="post" action="{{ route('manager.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Example form field for restaurant_id -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image">Image*</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if ($gallery->image)
                                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->name }}"
                                                class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        @endif
                                        @error('image') <small>{{ $message }}</small> @enderror
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
