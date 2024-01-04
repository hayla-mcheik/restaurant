<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAddress;
class AddressesController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $userAddresses = $user->addresses;
        return view('user.addresses.list', compact('userAddresses'));
    }

    public function saveAddress(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'label' => 'required|string',
            'address' => 'required|string',
        ]);

        $user->addresses()->create($data);
        return redirect()->back()->with('success', 'Address added successfully.');
    }

    public function edit($id)
    {
        $address = UserAddress::find($id);
        return view('user.addresses.edit',compact('address'));
    }

    public function update(Request $request , $id)
    {
        $user = Auth::user();
        $data = $request->validate([
            'label' => 'required|string',
            'address' => 'required|string',
        ]);

        $user->addresses()->update($data);
        return redirect()->back()->with('success', 'Address updated successfully.'); 
    }

    public function delete($id)
    {
        $user = Auth::user();
        $address = UserAddress::find($id);
        if ($address && $address->user_id === $user->id) {
            $address->delete();
            return redirect()->back()->with('success', 'Address deleted successfully.');
        }
        return redirect()->back()->with('error', 'Address not found or unauthorized to delete.');
    }
}
