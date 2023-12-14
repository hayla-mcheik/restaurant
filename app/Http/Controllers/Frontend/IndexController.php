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
       $restaurants = RestaurantModel::all();
       $restaurantssection = RestaurantModel::take(4)->get();

    $popularrestaurant = RestaurantModel::where('popular','1')->get();
        return view('frontend.home.index', compact('categories','restaurants','restaurantssection','popularrestaurant'));
    }
}
