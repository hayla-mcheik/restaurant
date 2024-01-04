<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\MenuItems;
use App\Models\MenuCategories;
use App\Models\RestaurantModel;
class OfferController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant; 
        $offers = Offer::where('restaurant_id', $restaurant->id)
            ->where('is_published', true)
            ->get();
        return view('manager.offers.index', compact('offers'));
    }

    public function create()
    {
        $user = auth()->user();
        $menuCategories = $user->restaurant->menuCategories;
        $menuitems = $menuCategories->flatMap->menuitems;
        return view('manager.offers.create',compact('menuitems','menuCategories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'minimum_order_amount' => 'nullable|numeric',
            'is_published' => 'nullable',
            'menu_items' => ['nullable', 'array', 'min:2'],
            'menu_category_id' => 'required|exists:menu_categories,id',
            'menu_items.*' => 'required|exists:menu_items,id',
        ]);

        $user = auth()->user();
        $validatedData['restaurant_id'] = $user->restaurant->id;

        $validatedData['is_published'] = $request->has('is_published');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/offers', $fileName);
        
            $imagePath = 'upload/offers/' . $fileName;
        
            $validatedData['image']= $imagePath;
        }
        // Create the offer
        $offer = Offer::create($validatedData);
        if ($request->has('menu_items')) {
            $offer->menuItems()->attach($request->menu_items);
        }
    
        return redirect()->route('manager.offers.index')->with('success', 'Offer created successfully.');
    }
    
    public function edit($offer)
    {
        $offer = Offer::find($offer);
        $user = auth()->user();
        $menuCategories = $user->restaurant->menuCategories;
        $menuitems = $menuCategories->flatMap->menuitems;
        return view('manager.offers.edit',compact('offer','menuitems','menuCategories'));
    }

    public function update(Request $request, $offer)
    {
        // Find the offer by ID
        $offer = Offer::find($offer);
    
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'minimum_order_amount' => 'nullable|numeric',
            'is_published' => 'nullable',
            'menu_items' => ['nullable', 'array', 'min:2'],
            'menu_items.*' => 'exists:menu_items,id',
        ]);
        $user = auth()->user();
        $validatedData['restaurant_id'] = $user->restaurant->id;
        $validatedData['is_published'] = $request->has('is_published');
        // Update image if a new one is provided
        if ($request->hasFile('image') && $offer->image) {
            // Delete the old image file
            if (file_exists($offer->image)) {
                unlink($offer->image);
            }
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/offers', $fileName);
    
            $imagePath = 'upload/offers/' . $fileName;
    
            $validatedData['image'] = $imagePath;
        }
    
        // Update the offer
        $offer->update($validatedData);
    
        // Sync menu items (detach existing, attach new)
        if ($request->has('menu_items')) {
            $offer->menuItems()->sync($request->menu_items);
        } else {
            // If no menu items are provided, detach all existing items
            $offer->menuItems()->detach();
        }
    
        return redirect()->route('manager.offers.index')->with('success', 'Offer updated successfully.');
    }
    
    
public function destroy($offer)
{
    $offer = Offer::find($offer);
    $offer->delete();

    return redirect()->route('manager.offers.index')->with('success', 'Offer deleted successfully.');
}

public function getMenuItems(Request $request, $categoryId)
{
    try {
        $menuItems = MenuItems::where('menu_category_id', $categoryId)->get();
        return response()->json($menuItems);
    } catch (\Exception $e) {
        \Log::error('Failed to load menu items:', $e);
        return response()->json(['error' => 'Failed to load menu items.'], 500);
    }
}

}
