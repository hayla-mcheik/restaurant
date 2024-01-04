<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\GalleryModel;
class ListingRestaurantController extends Controller
{
    public function index()
    {
        $restaurant = RestaurantModel::where('status','0')->get();
        $categories = RestaurantCategory::where('status','0')->get();
        $gallery = GalleryModel::all();
        return view('frontend.restaurants.index',compact('categories','restaurant'));
    }
    public function restaurantdetails($restaurant_id)
    {
        $restaurant = RestaurantModel::find($restaurant_id);
        $gallery = GalleryModel::all();
        $menucategories = $restaurant->menuCategories()->with('menuitems.offers')->get();
        $menuItems = $menucategories->flatMap(function ($category) {
            return $category->menuitems;
        });
        $mostPopularCategories = $menuItems->isNotEmpty() ? $menuItems->first()->mostPopularCategories() : collect();    
        // Fetch best-selling items with associated offers
        $bestSeller = $menuItems->map(function ($item) {
            return [
                'item' => $item,
                'best_seller' => $item->bestSeller(),
                'offers' => $item->offers, // Eager load offers
            ];
        });
    
        return view('frontend.restaurants.view', compact('restaurant','menucategories','menuItems','mostPopularCategories', 'bestSeller','gallery'));
    }
    
    

}
