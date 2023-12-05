@extends('layouts.admin.master')
@section('title')
Restaurant list
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Restaurant list

                </h3>
</div>

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
                Pending
            @else
                Approve
            @endif
        </td>

        <td>
            <a href="{{ route('admin.category.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>    
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
