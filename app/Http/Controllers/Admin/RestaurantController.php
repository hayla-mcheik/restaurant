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
        $restaurant =RestaurantModel::orderBy('id', 'desc');
        
        if (!empty(request()->get('name'))) {
            $restaurant = $restaurant->where('name', 'like', '%' . request()->get('name') . '%');
        }
        $restaurant = $restaurant->get();

        return view('admin.restaurant.list',compact('restaurant'));
    }
    public function edit($id)
{
    $restaurant = RestaurantModel::find($id);
    return view('admin.restaurant.edit', compact('restaurant')); // Use the correct view name
}

public function update(Request $request, $id)
{
    $restaurant = RestaurantModel::find($id);
    $restaurant->status = $request->input('status') === 'active' ? '0' : '1';
    $restaurant->save();
    return redirect()->route('admin.restaurant.index')->with('success', 'Restaurant status has been updated successfully');
}


}
