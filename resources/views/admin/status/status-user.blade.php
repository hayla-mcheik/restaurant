@extends('layouts.admin.master')
@section('title')
Users list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Users list
                </h3>
</div>

<div class="card-body">

 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($user as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ $value->status }}</td>

        <td>
            <a href="{{ route('admin.status.users.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ route('admin.status.users.delete', $value->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
               
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Users Available</td>
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
