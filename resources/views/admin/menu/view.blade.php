@extends('layouts.admin.master')
@section('title')
Orders list
@endsection
@section('content')
<div class="container-fluid">

    <div class="row">
        <h3>View Menu</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/list/menu') }}">Menu List</a></li>
            <li class="breadcrumb-item active">View Menu</li>
         </ol>
        <div class="col-xl-12">
           <div class="card mb-4">
              <div class="card-header">
                 <i class="fas fa-table mr-1"></i>
                 Menu Details
              </div>
              <div class="card-body">
                 <div class="card mb-4 order-list">
                    <div class="gold-members p-4">
                       <a href="#">
                       </a>
                       <div class="media">
                          <a href="#">
                          <img class="mr-4" src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
                          </a>
                          <div class="media-body">
                          <p>
                            Menu Category:{{ $menu->menucategories->name }}
                          </p>
                             <h6 class="mb-3"><a href="#">
                                </a><a href="detail.html" class="text-dark">{{ $menu->name }}
                                </a>
                             </h6>
                             </p>
                             <p class="text-black-50 mb-3">Price: {{ $menu->price }}</p>
                             </p>
                             <hr>

                          </div>
                       </div>
                    </div>
                 </div>
   

              </div>
           </div>
        </div>
     </div>
</div>
@endsection 