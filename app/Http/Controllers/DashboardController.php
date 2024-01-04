<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
use App\Models\MenuItems;
class DashboardController extends Controller
{
    public function admindashboard()
    {
        $admin = auth()->user();
    
        $orders = OrderModel::all();
    $totalOrders = OrderModel::count();
    $totalrescategories = RestaurantCategory::count();
    $totalrestaurant = RestaurantModel::count();
    $totalmenu = MenuItems::count();
        return view('admin.dashboard',compact('totalOrders','totalrescategories','totalrestaurant','orders','totalmenu'));
    }


    public function managerdashboard()
    {
      $owner = auth()->user();
      $orders= $owner->restaurant->order;
      $totalOrders = $orders->count();
      $restaurant = RestaurantModel::where('user_id', $owner->id)->first();
      if($restaurant)
      {
      $menuCategories = $restaurant->menuCategories();
      $totalMenuCategories = $menuCategories->count();
      $menuCategories = $restaurant->menuCategories;
      $menuItems = $menuCategories->flatMap->menuItems; // To get all menu items
      $menuItemCount = $menuCategories->flatMap->menuItems->count(); // To get the count of menu items     
      }
      else
      {
        $totalMenuCategories = 0;
        $menuItems = 0;
        $menuItemCount = 0;
      }
      return view('manager.dashboard', compact('totalOrders', 'totalMenuCategories','menuItems','menuItemCount','orders'));
    }
    public function userdashboard()
    {
        $orders = null; // Initialize $orders outside the if block
    
        if (auth()->user()) {
            $user = auth()->user();
            
            if ($user->orders) {
                $orders = $user->orders;
                $totalOrders = $orders->count();
            } else {
                $totalOrders = 0;
            }
            return view('user.dashboard', compact('orders', 'user', 'totalOrders'));
        }
    
        return redirect('login');
    }
}
