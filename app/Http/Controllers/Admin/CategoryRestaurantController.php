<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class CategoryRestaurantController extends Controller
{
    public function index()
    {
        $category= RestaurantCategory::all();
        return view('admin.categories.list',compact('category'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|max:255|unique:restaurant_categories,slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable',
        ]);
    
        $category = new RestaurantCategory();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('slug'));
        $category->status = $request->has('status') ? '1' : '0';

        if ($request->hasFile('image')) {
            if ($category->image != null) unlink($category->image);
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/restaurantcategory', $fileName);
        
            $imagePath = 'upload/restaurant/' . $fileName;
        
            $category->image = $imagePath;
        }

        $category->save();    
        return redirect()->route('admin.category.index')->with('success', 'Category has been created successfully');
    }

    public function edit($id)
    {
        $category = RestaurantCategory::find($id);
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = RestaurantCategory::find($id);
    
        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Category not found');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|max:255|unique:restaurant_categories,slug,' . $id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable',
        ]);
    
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('slug'));
        $category->status = $request->has('status') ? '1' : '0';
        if ($request->hasFile('image')) {
            if ($category->image != null) unlink($category->image);
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/restaurantcategory', $fileName);
        
            $imagePath = 'upload/restaurant/' . $fileName;
        
            $category->image = $imagePath;
        }
        $category->update();
    
        return redirect()->route('admin.category.index')->with('success', 'Category has been updated successfully');
    }

    public function delete($id)
    {
        $category = RestaurantCategory::find($id);
    $category->restaurants()->delete();
        if(!$category) {
            return redirect()->route('admin.category.index')->with('error', "Category not found");
        }
    
        $category->delete();
    
        return redirect()->route('admin.category.index')->with('success', "Category has been deleted successfully");
    }
    
}
