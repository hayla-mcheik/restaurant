<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\RestaurantModel;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = RestaurantModel::all();
        return view('admin.restaurant.list',compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
//     public function store(Request $request)
//     {
//         $restaurant = new RestaurantModel();
//         $restaurant->category_id = $request->input('category_id');  
//         $restaurant->name = $request->input('name');
//         $restaurant->slug = Str::slug($request->input('slug'));
//         $restaurant->address = $request->input('address');
//         $restaurant->map = $request->input('map');
//         $restaurant->phone = $request->input('phone');
//         $restaurant->email = $request->input('email');
//         $restaurant->openninghours = $request->input('openninghours');
//         $restaurant->deliverytime = $request->input('deliverytime');
//         $restaurant->status = $request->has('status') ? '1' : '0';
//         $restaurant->save();
// return redirect('admin.restaurant.list')->with('success','Restaurant has been created successfully')
//     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $restaurant = RestaurantModel::find($id);
        return view('admin.restaurant.list',compact('restaurant'));
    }


    public function update(Request $request, $id)
    {
        $restaurant = RestaurantModel::find($id);
        $restaurant->status = $request->has('status') ? '1' : '0';
        $restaurant->save();
        return redirect('admin.restaurant.list')->with('success','Restaurant status has been updated successfully'); 
    }
}
