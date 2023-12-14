@extends('layouts.admin.master')
@section('title')
Orders list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">

   
                <h3>Orders list
                </h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders List</li>
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
    @forelse($order as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>
            @switch($value->status_message)
            @case(0)
            <button disabled="" type="button" class="btn btn-sm btn-danger btn-round"> Pending </button>
                @break
            @case(1)
            <button disabled="" type="button" class="btn btn-sm btn-success btn-round">Approve </button>
                @break
            @case(2)
         <button disabled="" type="button" class="btn btn-sm btn-danger btn-round"> Rejected </button>
                @break
            @default
                Unknown Status
        @endswitch
        </td>

        <td>   
            <a href="{{ route('manager.orders.status.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>      
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Orders Available</td>
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
