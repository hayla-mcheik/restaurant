<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
class ListingRestaurantController extends Controller
{
    public function index()
    {
        $categories = RestaurantCategory::where('status','0')->get();
        $restaurants = RestaurantModel::all();
        return view('frontend.restaurants.index',compact('categories','restaurants'));
    }
}
