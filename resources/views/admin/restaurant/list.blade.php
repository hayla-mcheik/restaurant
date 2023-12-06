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
