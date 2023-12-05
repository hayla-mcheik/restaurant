@extends('layouts.admin.master')
@section('title')
Categories list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Categories list
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm float-end">
                        Add Category
</a>
                </h3>
</div>

<div class="card-body">

 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($category as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->slug }}</td>
        <td>
            @if($value->status == 1)
                Active
            @else
                Hide
            @endif
        </td>

        <td>
            <a href="{{ route('admin.category.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ route('admin.category.delete', $value->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>       
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Restaurant Category Available</td>
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
