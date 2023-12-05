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
             <div class="card-body">26 New Messages!</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="messages.html">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
             <div class="card-body">10 New Bookings!</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="bookings.html">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-success text-white mb-4">
             <div class="card-body">11 New Reviews!</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="reviews.html">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
             </div>
          </div>
       </div>
       <div class="col-xl-3 col-md-6">
          <div class="card bg-danger text-white mb-4">
             <div class="card-body">10 New Bookmarks!</div>
             <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="bookmarks.html">View Details</a>
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
                      <th>User</th>
                      <th>User Name</th>
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
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/1.png"></td>
                      <td> Rhona Davidson	</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-success btn-round">delivered</button></td>
                      <td>Sat, Jul 11, 2020 1:38 AM</td>
                      <td>$262.49</td>
                      <td>4</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/2.png"></td>
                      <td> Herrod Chandler	</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-danger btn-round">cancel</button></td>
                      <td>Fri, Jul 10, 2020 4:55 PM</td>
                      <td>$170.77</td>
                      <td>5</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/3.png"></td>
                      <td> Airi Satou	</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-success btn-round">delivered</button></td>
                      <td>Fri, Jul 10, 2020 3:48 PM</td>
                      <td>$26.78</td>
                      <td>2</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/4.png"></td>
                      <td> Brielle Williamson	</td>
                      <td>The Square restaurants</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-primary btn-round">created</button></td>
                      <td>Fri, Jul 10, 2020 2:24 PM</td>
                      <td>$81.23</td>
                      <td>2</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/5.png"></td>
                      <td> Cedric Kelly	</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-success btn-round">delivered</button></td>
                      <td>Fri, Jul 10, 2020 11:45 AM</td>
                      <td>$1578.00</td>
                      <td>1</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/6.png"></td>
                      <td> Ashton Cox	</td>
                      <td>The Square restaurants</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-primary btn-round">created</button></td>
                      <td>Fri, Jul 10, 2020 11:37 AM</td>
                      <td>$238.53</td>
                      <td>4</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/1.png"></td>
                      <td> Garrett Winters	</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-danger btn-round">rejected</button></td>
                      <td>Thu, Jul 9, 2020 3:54 PM</td>
                      <td>$107.85</td>
                      <td>2</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/2.png"></td>
                      <td> Tiger Nixon	</td>
                      <td>The Square restaurants</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-danger btn-round">rejected</button></td>
                      <td>Thu, Jul 9, 2020 3:19 PM</td>
                      <td>$83.65</td>
                      <td>2</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/3.png"></td>
                      <td> AMITKUMAR CHAUHAN</td>
                      <td>Jassi de Parathe</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-primary btn-round">created</button></td>
                      <td>Thu, Jul 9, 2020 2:28 PM</td>
                      <td>$46.62</td>
                      <td>2</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                   <tr>
                      <td><img class="img-profile rounded-circle" src="img/user/4.png"></td>
                      <td> Umed Ibodulloev</td>
                      <td>Metro Resto</td>
                      <td><button disabled="" type="button" class="btn btn-sm btn-success btn-round">delivered</button></td>
                      <td>Thu, Jul 9, 2020 1:26 PM</td>
                      <td>$66.71</td>
                      <td>1</td>
                      <td><a href="edit-order.html" class="btn btn-primary btn-sm">View</a></td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
    </div>
 </div>
@endsection