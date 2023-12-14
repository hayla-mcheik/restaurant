@extends('layouts.admin.master')
@section('title')
Restaurant list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
  

                <h3>Restaurant list

                </h3>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Restaurant list</li>
 </ol>
 <div class="card">
<div class="card-body">

 <table class="table table-sm table-bordered table-striped">

    <form action="" method="get" class="float-end">
        @csrf
        <div class="row justify-content-end">

<div class="mb-3 col-md-3">
<input type="text" name="name"  class="form-control" value="{{ Request::get('name') }}" required/>
@error('name') <small>{{ $message}}</small> @enderror
</div>
<div class="col-md-3">
    <button type="btn" class="btn btn-primary">Search by Name</button>
</div>
</div>
</form>

    <thead>
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($restaurant as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>
            @if($value->status == 1)
            <button disabled="" type="button" class="btn btn-sm btn-danger btn-round"> Pending </button>
            @else
            <button disabled="" type="button" class="btn btn-sm btn-success btn-round"> Approve </button>
            @endif
        </td>

        <td>
            <a href="{{ route('admin.restaurant.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>    
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Restaurant Available</td>
</tr>
    @endforelse

</tbody>
</table> 
<div class="pt-2 float-end">

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
