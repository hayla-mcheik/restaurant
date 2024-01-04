<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItems;
use App\Models\MenuCategories;
class MenuItemsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
            $menucategories = $user->restaurant->menuCategories;
            $menuitems = [];

            foreach ($menucategories as $category) {
                $menuitems = array_merge($menuitems, $category->menuitems->all());
            }
            return view('manager.menu-items.index',compact('menuitems'));
    }
    public function create()
    {
        $user = auth()->user();
        $categories = $user->restaurant->menuCategories;
        return view('manager.menu-items.create',compact('categories'));   
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menu_items',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $menuitems=new MenuItems();
        $menuitems->menu_category_id = $request->input('menu_category_id');
        $menuitems->name = $request->input('name');
        $menuitems->slug = $request->input('slug');
        $menuitems->quantity = $request->input('quantity');
        $menuitems->price = $request->input('price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/restaurant/menuitems', $fileName);
        
            $imagePath = 'upload/restaurant/menuitems/' . $fileName;
        
            $menuitems->image = $imagePath;
        }
        $menuitems->save();
        return redirect()->route('manager.menu.items')->with('success', 'Menu Items  Created Successfully');
    }

    public function edit($id)
    {
        $menuitems=MenuItems::find($id);
     $user = auth()->user();
        $categories = $user->restaurant->menuCategories;

        return view('manager.menu-items.edit',compact('menuitems','categories'));   
    }


    public function update(Request $request , $id)
    {
        $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $menuitems=MenuItems::find($id);
        
        $menuitems->menu_category_id = $request->input('menu_category_id');
        $menuitems->name = $request->input('name');
        $menuitems->slug = $request->input('slug');
        $menuitems->quantity = $request->input('quantity');
        $menuitems->price = $request->input('price');
        if ($request->hasFile('image')) {
            if ($menuitems->image != null) unlink($menuitems->image);
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/restaurant/menuitems', $fileName);
        
            $imagePath = 'upload/restaurant/menuitems/' . $fileName;
        
            $menuitems->image = $imagePath;
        }
        $menuitems->update();
        return redirect()->route('manager.menu.items')->with('success', 'Menu Items Updated Successfully');
    }

    public function destroy($id)
    {
        $menuitems=MenuItems::find($id);
        if($menuitems)
        {
            $menuitems->delete(); 
            return redirect()->route('manager.menu.categories')->with('success', 'Menu Items has been deleted successfully');
        }
        return redirect()->route('manager.menu.categories')->with('success', ' No Menu Items found');
    }
    
}
