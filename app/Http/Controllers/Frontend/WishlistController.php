<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishlistModel;
class WishlistController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Check if the user is authenticated
        if ($user) {
            // Fetch wishlist items related to the authenticated user
            $wishlist = $user->wishlist;

            // Pass the wishlist items to the view
            return view('user.wishlist.index', compact('wishlist'));
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->route('login'); // Redirect to the login page or handle as needed
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
