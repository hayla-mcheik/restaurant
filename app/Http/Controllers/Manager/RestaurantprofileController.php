<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Models\RestaurantModel;
class RestaurantprofileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant; 
        $categories = RestaurantCategory::all();
        return view('manager.restaurant.index', compact('restaurant', 'categories'));
    }


    public function update(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_id' => 'required|exists:restaurant_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'map' => 'required|string|max:255',
            'phone' => 'required|digits_between:8,12',
            'email' => 'required|email|max:255',
            'openninghours' => 'required|string|max:255',
            'deliverytime' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'coverimage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable',
            'popular' => 'nullable',
        ]);
    
        $user = auth()->user();
        $restaurant = $user->restaurant;

        $restaurant->fill([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'address' => $request->input('address'),
            'map' => $request->input('map'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'openninghours' => $request->input('openninghours'),
            'deliverytime' => $request->input('deliverytime'),
            'status' => $request->has('status') ? 1 : 0,
            'popular' => $request->has('popular') ? 1 : 0,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'upload/restaurant');
            if ($restaurant->image != null) unlink($restaurant->image);
            $restaurant->image = $imagePath;
        }

        if ($request->hasFile('coverimage')) {
            $coverImagePath = $this->uploadFile($request->file('coverimage'), 'upload/restaurant');
            if ($restaurant->coverimage != null) unlink($restaurant->coverimage);
            $restaurant->coverimage = $coverImagePath;
        }

        $restaurant->save();
    
        return redirect()->route('manager.restaurant')->with('success', 'Restaurant Updated Successfully');
    }
    
    private function uploadFile($file, $uploadFolder)
    {
        $fileName = time() . rand(1000, 50000) . '.' . $file->getClientOriginalExtension();
        $file->move($uploadFolder, $fileName);
    
        return "$uploadFolder/$fileName";
    }
    

}

