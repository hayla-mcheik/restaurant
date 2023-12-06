<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
class RestaurantprofileController extends Controller
{
    public function index($id)
    {
        $restaurant = RestaurantModel::findOrFail($id);
        $categories = RestaurantCategory::all();

        return view('manager.restaurant.index', compact('restaurant', 'categories'));
    }


    public function update(Request $request, $id)
{
    // Validate the request
    $validatedData = $request->validate([
        'category_id' => 'required|exists:restaurant_categories,id',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'map' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'openninghours' => 'required|string|max:255',
        'deliverytime' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'coverimage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'nullable|boolean',
    ]);

    $restaurant = RestaurantModel::findOrFail($id);
    $restaurant->update($validatedData);

    // Handle file uploads
    if ($request->hasFile('image')) {
        if ($restaurant->image != null) unlink($restaurant->image);
        $image = $request->file('image');
        $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/restaurant', $fileName);
    
        $imagePath = 'upload/restaurant/' . $fileName;
    
        $restaurant->image = $imagePath;
    }

    if ($request->hasFile('coverimage')) {
        if ($restaurant->coverimage != null) unlink($restaurant->coverimage);
        $coverimage = $request->file('coverimage');
        $fileName = time() . rand(1000, 50000) . '.' . $coverimage->getClientOriginalExtension();
        $coverimage->move('upload/restaurant', $fileName);
    
        $imagePath = 'upload/restaurant/' . $fileName;
    
        $restaurant->coverimage = $imagePath;
    }

    return redirect()->route('manager.restaurant.index')->with('success', 'Restaurant  Updated Successfully');
}

}
