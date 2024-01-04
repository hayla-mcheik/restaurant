<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\orderItems;
class OrderUserController extends Controller
{

public function list()
{
    $user = auth()->user();
$orders = $user->orders;
    return view('user.orders.list',compact('orders'));
}


public function view(string $id)
{
    $order= OrderModel::where('id',$id)->first();
    $orderItems = orderItems::all();      
      
    if($order)
    {
        return view('user.orders.view',compact('order','orderItems'));
    }

    else 
    {
        return redirect('user/orders')->with('message','Order Id not Found');
    }
}

}
