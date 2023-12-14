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
                        <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('manager/orders') }}">Orders list</a></li>
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


<div class="float-right">
   <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
       <i class="feather-check-circle"></i> Approve
   </a>
   <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
       <i class="feather-trash"></i> Rejected
   </a>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="approveModalLabel">Approve Order</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <p>Are you sure you want to approve this order?</p>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <form action="{{ url('manager/orders', ['id' => $order->id]) }}" method="POST">
                   @csrf
                   @method('PUT')
                   <input type="hidden" name="order_status" value="approve">
                   <button type="submit" class="btn btn-success">Approve</button>
               </form>
           </div>
       </div>
   </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="rejectModalLabel">Reject Order</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <p>Are you sure you want to reject this order?</p>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <form action="{{ url('manager/orders', ['id' => $order->id]) }}" method="POST">
                   @csrf
                   @method('PUT')
                   <input type="hidden" name="order_status" value="reject">
                   <button type="submit" class="btn btn-danger">Reject</button>
               </form>
           </div>
       </div>
   </div>
</div>


                        <p class="mb-0 text-dark text-dark pt-2">
                            <span class="text-dark font-weight-bold">Total Paid:</span>
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