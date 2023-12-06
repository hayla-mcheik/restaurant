@extends('layouts.admin.master')
@section('title')
Menu list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
      
     
                <h3>Menu list
                </h3>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Menu List</li>
                 </ol>
                 <div class="card">
<div class="card-body">
 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>image</th>
            <th>price</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($menu as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->image }}</td>
        <td>{{ $value->price }}</td>

        <td>
            <a href="{{ route('admin.menu.view', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>    
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Menu Available</td>
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
