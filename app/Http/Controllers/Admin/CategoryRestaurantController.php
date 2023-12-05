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
            'name' => 'required',
            'slug' => 'required|max:255|unique:restaurant_categories,slug',
        ]);
        $category = new RestaurantCategory();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('slug'));
        $category->status = $request->has('status') ? '1' : '0';
        $category->save();
        return redirect('admin.category.index')->with('success', "Category has been created successfully");
    }

    public function edit($id)
    {
        $category = RestaurantCategory::find($id);
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request , $id)
    {
        $category = RestaurantCategory::find($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('slug'));
        $category->status = $request->has('status') ? '1' : '0';
        $category->update();
        return redirect('admin.category.index')->with('success',"Category has been created successfully");
    }

    public function delete($id)
    {
        $category = RestaurantCategory::find($id);
    
        if(!$category) {
            return redirect('admin.category.delete')->with('error', "Category not found");
        }
    
        $category->delete();
    
        return redirect('admin.category.delete')->with('success', "Category has been deleted successfully");
    }
    
}
