<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantModel;
use App\Models\GalleryModel;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $restaurants = $user->restaurant;
        $gallery = $restaurants->gallery;

        return view('manager.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('manager.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gallery = $this->uploadGalleryImage($request);

        return redirect()->route('manager.gallery')->with('success', 'Restaurant Image Created Successfully');
    }

    public function edit($id)
    {
        $gallery = GalleryModel::find($id);

        return view('manager.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gallery = GalleryModel::find($id);
        $this->uploadGalleryImage($request, $gallery);

        return redirect()->route('manager.gallery')->with('success', 'Restaurant Image Updated Successfully');
    }

    public function delete($id)
    {
        $gallery = GalleryModel::find($id);

        if (!$gallery) {
            return redirect()->route('manager.gallery')->with('error', 'No Restaurant Image found');
        }

        $gallery->delete();
        return redirect()->route('manager.gallery')->with('success', 'Restaurant Image has been deleted successfully');
    }

    private function uploadGalleryImage(Request $request, GalleryModel $gallery = null)
    {
        if (!$gallery) {
            $gallery = new GalleryModel();
        }

        $gallery->restaurant_id = auth()->user()->restaurant->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/restaurant/gallery/'), $fileName);

            $imagePath = 'upload/restaurant/gallery/' . $fileName;

            $gallery->image = $imagePath;
        }

        $gallery->save();

        return $gallery;
    }
}
