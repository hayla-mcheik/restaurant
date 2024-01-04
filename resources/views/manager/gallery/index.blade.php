@extends('layouts.admin.master')
@section('title')
list of Restaurant Gallery
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
      
     
                <h3>list of Restaurant Gallery
                    <a href="{{ route('manager.gallery.create') }}" class="btn btn-primary btn-sm float-end">
                        list of Restaurant Gallery
</a>
                </h3>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">list of Restaurant Gallery</li>
                 </ol>
                 <div class="card">
<div class="card-body">

 <table class="table table-sm table-bordered table-striped">
    <thead>
        
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    @forelse($gallery as $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>
            @if($value->image)
                <img src="{{ asset($value->image) }}" alt="{{ $value->name }}" style="max-width: 100px; max-height: 100px;">
            @else
                No image available
            @endif
        </td>
        <td>
            <a href="{{ route('manager.gallery.edit', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
            <a href="{{ route('manager.gallery.delete', $value->id) }}" onclick="return confirm('Are your sure you want to delete this data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>       
</td>
</tr>
    @empty
    <tr>
        <td colspan="5">No Restaurant Image Available</td>
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
