<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        return view('user.index');
    }
    public function profile()
    {

        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'Name'          => 'nullable|string|max:255',
            'Username'      => 'nullable|string|max:255',
            'Country'       => 'nullable|string|max:255',
            'City'          => 'nullable|string|max:255',
            'Address'       => 'nullable|string|max:255',
            'PostalCode'    => 'nullable|string|max:255',
            'Email'         => 'nullable|email|max:255|unique:users,Email,' . $user->id,
            'PhoneNumber'   => 'nullable|string|max:255',
            'Password'      => 'nullable|string|min:8|confirmed',
            'UserImageName' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->filled('Password')) {
            $input['Password'] = Hash::make($request->Password);
        } else {
            unset($input['Password']);
        }

        if ($request->hasFile('UserImageName')) {
            $imageName = time() . '.' . $request->UserImageName->extension();
            $request->UserImageName->move('assets/images', $imageName);
            $input['UserImageName'] = "assets/images/" . $imageName;

            // Delete old profile image if exists
            if ($user->UserImageName) {
                unlink($user->UserImageName);
            }
        }

        $user->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
