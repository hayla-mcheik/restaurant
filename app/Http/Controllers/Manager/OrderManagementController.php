<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\orderItems;
class OrderManagementController extends Controller
{
        
    public function index()
    {
        $user = auth()->user();
        $order= $user->restaurant->order;
        return view('manager.orders.list',compact('order'));
    }
public function edit($id)
{
    $order= OrderModel::find($id);
    $orderItems = orderItems::all();             
    return view('manager.orders.edit',compact('order','orderItems'));
}
public function updateOrderStatus(int $orderId, Request $request)
{
    $order = OrderModel::find($orderId);

    if (!$order) {
        return redirect('manager/orders')->with('message', 'Order not found');
    }
    $validStatuses = ['approve', 'reject'];
    if (!in_array($request->order_status, $validStatuses)) {
        return redirect('manager/orders')->with('message', 'Invalid Order Status');
    }
    $order->update([
        'status_message' => $request->order_status == 'approve' ? 1 : 2,
    ]);

    return redirect()->back()->with('success', 'Order Status Updated');
}

}
