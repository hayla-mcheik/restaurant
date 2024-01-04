@extends('layouts.admin.master')
@section('title')
Addresses list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">

   
                <h3>Addresses list
                </h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Addresses List</li>
                 </ol>
                 <div class="card">
<div class="card-body">

 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Label</th>
            <th>Addresses</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($userAddresses as $addr)
<tr>
    <td>{{ $addr->id }}</td>
    <td>{{ $addr->label }}</td>
    <td>{{ $addr->address }}</td>
    <td>
        <a href="{{ route('user.address.edit', $addr->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
        <a href="{{ route('user.address.delete', $addr->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>       
</td>
</tr>
@empty
<tr>No User Addresses</tr>
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
