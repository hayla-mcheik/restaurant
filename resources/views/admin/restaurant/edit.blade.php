@extends('layouts.admin.master')
@section('title')
    Edit Category
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Status
                        <a href="{{ url('admin/category/restaurant/list') }}" class="btn btn-danger btn-sm float-end">
                            Back
                        </a>
                    </h3>
                </div>

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-warning">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }} </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('admin.category.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <option value="pending" {{ $restaurant->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ $restaurant->status === 'active' ? 'selected' : '' }}>Active</option>
                                </select>
                                @error('status') <small>{{ $message}}</small> @enderror
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
</div>
@endsection
