@extends('layouts.admin.master')
@section('title','Order Details')
@section('content')
<div class="container-fluid">
<div class="row">
            <div class="col-md-12">


                @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif                        
                        <h3> Order Details
                     </h3>
                     <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/list/orders') }}">Orders list</a></li>
                        <li class="breadcrumb-item active">View Order</li>
                     </ol>
  













<div class="row">
    <div class="col-xl-12">
       <div class="card mb-4">
          <div class="card-header">
             <i class="fas fa-table mr-1"></i>
             Order Details
          </div>
          <div class="card-body">
             <div class="card mb-4 order-list">
                <div class="gold-members p-4">
                   <a href="#">
                   </a>
                   <div class="media">
                      <a href="#">
                      <img class="mr-4" src="img/3.jpg" alt="Generic placeholder image">
                      </a>
                      <div class="media-body">
                         <a href="#">
                         </a>
                         <h6 class="mb-3"><a href="#">
                            </a><a href="detail.html" class="text-dark">{{ $order->name }}
                            </a>
                         </h6>
                         <p class="text-black-50 mb-1"><i class="feather-map-pin"></i> {{ $order->address }}
                         </p>
                         <p class="text-black-50 mb-3"><i class="feather-list"></i> ORDER {{ $order->order_no }} <i class="feather-clock ml-2"></i>{{ $order->date }}</p>
    
                           <p class="text-dark">
                            <strong>Order Items:</strong>
                            <ul class="p-0">
                                @foreach ($orderItems as $item)

                                        {{ $item->menu->name }} x  {{ $item->quantity }}
                            
                                @endforeach
                            </ul>
                        </p>
                        <hr>
                        
       
<?php
$totalAmount = 0;

foreach ($orderItems as $item) {
    $quantity = (int) $item->quantity;
    $price = (float) $item->price;
    $totalAmount += $quantity * $price;
}
?>

                        <p class="mb-0 text-dark text-dark pt-2">
                            <span class="text-dark font-weight-bold">Total Quantity:</span>
                            ${{ $totalAmount }}
                        </p>
                        
                         
                      </div>
                   </div>
                </div>
             </div>
             <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($orderItems as $item) 
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                    @endforeach
                </tbody>
                </table>
             </div>
             <div class="row justify-content-end total_order">
                <div class="col-xl-3 col-lg-4 col-md-5">
                   <ul class="list-unstyled text-muted font-weight-bold">

                      <li class="d-flex align-items-center justify-content-between text-danger">
                         <span>Total</span>${{ $totalAmount }}
                      </li>
                   </ul>
                   <a href="#0" class="btn btn-success btn-block">Place Order</a>
                </div>
             </div>
          </div>
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