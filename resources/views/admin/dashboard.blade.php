@extends('layouts.admin.master')
@section('title')
Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
       <li class="breadcrumb-item active">Welcome {{ auth()->user()->name }} to Our Dashboard</li>
    </ol>
    <div class="row">
       <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Orders: 
               <p class="text-white">
                   <br/>
                   @if($totalOrders)
                       {{ $totalOrders }}
                   @else
                       No orders available.
                   @endif
               </p>
           </div>
           
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ url('admin/list/orders') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
             <div class="card-body">Total Restaurant Categories:
               <p class="text-white">
                  <br/>
                  @if($totalrescategories)
                      {{ $totalrescategories }}
                  @else
                      No Restaurant Categories available.
                  @endif
              </p>
             </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ url('/category/restaurant/list') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-success text-white mb-4">
             <div class="card-body">Total Restaurant:
               <p class="text-white">
                  <br/>
               @if($totalrestaurant)
               {{ $totalrestaurant }}
               @else
               No Restaurant Available
               @endif
               </p>
             </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ url('admin/list/restaurant') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-danger text-white mb-4">
             <div class="card-body">Total Menu List!</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ url('admin/list/menu') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-xl-6">
          <div class="card mb-4">
             <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Sales earnings this month
             </div>
             <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="40"></canvas>
             </div>
          </div>
       </div>
       <div class="col-xl-6">
          <div class="card mb-4">
             <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                All Time Earnings
             </div>
             <div class="card-body">
                <canvas id="myBarChart" width="100%" height="40"></canvas>
             </div>
          </div>
       </div>
    </div>
    <div class="card mb-4">
       <div class="card-header">
          <i class="fas fa-table mr-1"></i>
          RECENT 10 ORDER
       </div>
       <div class="card-body">
         <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr class="text-uppercase">
                     <th>Order Name</th>
                     <th>Restaurant</th>
                     <th>Status</th>
                     <th>Ordered on</th>
                     <th>Total</th>
                     <th>Quantity</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <!----><!---->
                  @forelse($orders as $order)
                  <tr>
                     <td> {{ $order->name }}	</td>
                     <td> {{ $order->restaurant->name }} </td>
                     <td>
                       @switch($order->status_message)
                       @case(0)
                       <button disabled="" type="button" class="btn btn-sm btn-danger btn-round"> Pending </button>
                           @break
                       @case(1)
                       <button disabled="" type="button" class="btn btn-sm btn-success btn-round">Approve </button>
                           @break
                       @case(2)
                    <button disabled="" type="button" class="btn btn-sm btn-danger btn-round"> Rejected </button>
                           @break
                       @default
                           Unknown Status
                   @endswitch
                    </td>
                    <td>
                       @if ($order->created_at)
                           {{ $order->created_at->format('Y-m-d H:i:s') }}
                       @else
                           N/A
                       @endif
                   </td>
                   
                     <td>
                       @foreach($order->orderItems as $item)
                           ${{ $item->price }}<br>
                       @endforeach
                   </td>
                     <td>
                       @foreach($order->orderItems as $item)
                       {{ $item->quantity }}<br>
                   @endforeach</td>
                     <td><a href="{{ route('admin.orders.view', $item->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a> </td>  
                  </tr>
           @empty
           <tr>
              <td>no orders</td>
           </tr>
           @endforelse
               </tbody>
            </table>
         </div>
      </div>
    </div>
 </div>
@endsection