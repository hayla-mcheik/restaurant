@extends('layouts.admin.master')
@section('title')
list of Menu Items
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
      
     
                <h3>list of Menu Items
                    <a href="{{ route('manager.menu.create') }}" class="btn btn-primary btn-sm float-end">
                        Add Menu Items
</a>
                </h3>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">list of Menu Items</li>
                 </ol>
                 <div class="card">
<div class="card-body">

 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Menu Category</th>
            <th>Name</th>
            <th>price</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($menuitems as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->menucategories->name }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->price }}</td>
        <td>
            <a href="{{ route('manager.menu.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ route('manager.menu.delete', $value->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>       
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Category Available</td>
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
