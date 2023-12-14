<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
class DashboardController extends Controller
{
    public function admindashboard()
    {
        $admin = auth()->user();
    
        $orders = OrderModel::all();
    $totalOrders = OrderModel::count();
    $totalrescategories = RestaurantCategory::count();
    $totalrestaurant = RestaurantModel::count();
        return view('admin.dashboard',compact('totalOrders','totalrescategories','totalrestaurant','orders'));
    }


    public function managerdashboard()
    {
      $owner = auth()->user();
      $orders = OrderModel::all();
      $totalOrders = OrderModel::count();
      $restaurant = RestaurantModel::where('user_id', $owner->id)->first();
      $menuCategories = $restaurant->menuCategories();
      $totalMenuCategories = $menuCategories->count();
      $menuCategories = $restaurant->menuCategories;
      $menuItems = $menuCategories->flatMap->menuItems; // To get all menu items
      $menuItemCount = $menuCategories->flatMap->menuItems->count(); // To get the count of menu items
      
      
    
      return view('manager.dashboard', compact('totalOrders', 'totalMenuCategories','menuItems','menuItemCount','orders'));
    }
    public function userdashboard()
    {
        if (auth()->user()) {
            $user = auth()->user();
    
            $orders = $user->orders()->with('restaurant')->get();
    
            $totalOrders = $user->orders()->count();
            return view('user.dashboard', compact('orders', 'user','totalOrders'));
        }
    
        return redirect('login');
    }
}
