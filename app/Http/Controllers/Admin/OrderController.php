<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\orderItems;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
        public function index()
        {
            $order= OrderModel::all();
            return view('admin.orders.list',compact('order'));
        }
    
    /**
     * Show the form for creating a new resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order= OrderModel::where('id',$id)->first();
        $orderItems = orderItems::all();      
          
        if($order)
        {
            return view('admin.orders.view',compact('order','orderItems'));
        }

        else 
        {
            return redirect('admin/list/orders')->with('message','Order Id not Found');
        }
    }
    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = OrderModel::where('id', $orderId)->first(); 
        if ($order) {
            $validStatuses = ['approve', 'rejected'];
            if (in_array($request->order_status, $validStatuses)) {
                $order->update([
                    'status_message' => array_search($request->order_status, $validStatuses),
                ]);
                return redirect('admin/list/orders/'.$orderId)->with('success', 'Order Status Updated');
          
            } else {
                return redirect('admin/list/orders/'.$orderId)->with('message', 'Invalid Order Status');               
            }
        } else {
            return redirect('admin/list/orders/'.$orderId)->with('message', 'Order Id not Found');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
