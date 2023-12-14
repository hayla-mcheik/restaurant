<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\MenuItems;
class MenuController extends Controller
{
    public function index()
    {
        $menu = MenuItems::orderBy('id', 'desc');
        
        if (!empty(request()->get('name'))) {
            $menu = $menu->where('name', 'like', '%' . request()->get('name') . '%');
        }
        $menu = $menu->get();
        return view('admin.menu.list',compact('menu'));
    }

    public function show($id)
    {
        $menu = MenuItems::find($id);
    
        if (!$menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu item not found.');
        }
    
        return view('admin.menu.view', compact('menu'));
    }
    

}
