@extends('layouts.admin.master')
@section('title')
    Edit User
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
         
        
                    <h3>Edit New User
              
                    </h3>
           
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin//status/users') }}">Users Status List</a></li>
                        <li class="breadcrumb-item active">Edit Users Status</li>
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

                    
                    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif


                    <form action="{{ route('admin.status.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name*</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                @error('name') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email*</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control" />
                                @error('email') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Password*</label>
                                <input type="text" name="password" value="{{ $user->password }}" class="form-control" />
                                @error('password') <small>{{ $message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status*</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                </select>
                                @error('status') <small>{{ $message}}</small> @enderror
                            </div>
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
