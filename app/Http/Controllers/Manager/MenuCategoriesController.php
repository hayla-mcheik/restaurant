<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MenuCategories; 

class MenuCategoriesController extends Controller
{
    public function index()
    {
        $categories = MenuCategories::all();
        return view('manager.menu-category.index',compact('categories'));
    }
    public function create()
    {
        return view('manager.menu-category.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $category = new MenuCategories();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->status = $request->has('status') ? 1 : 0;
        $category->save();

        return redirect()->route('manager.menu.categories')->with('success', 'Category has been created successfully');
    }
    public function edit($id)
    {
        $category = MenuCategories::find($id);
        return view('manager.menu-category.edit',compact('category'));
    }
    public function update(Request $request , $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $category = MenuCategories::find($id);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->status = $request->has('status') ? 1 : 0;
        $category->update();
        return redirect()->route('manager.menu.categories')->with('success', 'Category has been updated successfully');
    }

    public function destroy($id)
    {
        $category = MenuCategories::find($id);
        if($category)
        {
            $category->delete(); 
            return redirect()->route('manager.menu.categories')->with('success', 'Category has been deleted successfully');
        }
        return redirect()->route('manager.menu.categories')->with('success', ' No Category found');
    }
}
