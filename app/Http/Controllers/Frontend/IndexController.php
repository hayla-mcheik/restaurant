<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;

class IndexController extends Controller
{
    public function index()
    {
       $categories = RestaurantCategory::where('status','0')->get();
       $restaurants = RestaurantModel::where('status','0')->get();
       $restaurantssection = RestaurantModel::where('status','0')->take(4)->get();
       $popularrestaurants = RestaurantModel::withCount('order')
       ->orderByDesc('order_count')
       ->get();
       
        return view('frontend.home.index', compact('categories','restaurants','restaurantssection','popularrestaurants'));
    }

    public function thanks()
    {
        return view('frontend.thanks');
    }
}
