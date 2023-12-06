<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;
class MenuController extends Controller
{
    public function index()
    {
        $menu = MenuModel::all();
        return view('admin.menu.list',compact('menu'));
    }

    public function show($id)
    {
        $menu = MenuModel::find($id);
    
        if (!$menu) {
            return redirect()->route('admin.menu.index')->with('error', 'Menu item not found.');
        }
    
        return view('admin.menu.view', compact('menu'));
    }
    

}
