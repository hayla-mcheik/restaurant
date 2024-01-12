<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishlistModel;
class WishlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user) {
            $wishlist = $user->wishlist;
            return view('user.wishlist.index', compact('wishlist'));
        } else {
            return redirect()->route('login'); 
        }
    }

    public function remove($id)
    {
        $wishlist = WishlistModel::find($id);
    
        if (!$wishlist) {
            return redirect()->route('wishlist.index')->with('error', 'No Wishlist found');
        }
    
        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Wishlist has been deleted successfully');
    }
    
}
