@extends('layouts.admin.master')
@section('title')
My Orders
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
    
       
                    <h3>My Orders list
                    </h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders List</li>
                     </ol>
                     <div class="card">
    <div class="card-body">
    
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>image</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                @forelse($wishlist as $wish)
                <tbody>
       
                    <tr>
                        <td>{{ $wish->id }}</td>
                        <td>{{ $wish->menuitems->name }}</td>
                        <td><img src="{{ asset($wish->menuitems->image) }}"  style="width:50px;"/></td>
                        <td>{{ $wish->menuitems->price }}</td>
                        <td><a href="{{ route('frontend.wishlist.remove', $wish->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>       
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Wishlist Available</td>
                </tr>
                </tbody>
                @endforelse
                </table>
            </div>
          </div>
       </div>
    </div>
    </div>


 @endsection