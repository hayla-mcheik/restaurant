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
                    <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
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
