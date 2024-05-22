<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $input = $request->all();
        
        if ($request->hasFile('UserImageName')) {
            
            // Delete old profile image if exists
            if ($user->UserImageName) {
                unlink($user->UserImageName);
            }

            $file = $request->file('UserImageName');
            $filename = round(microtime(true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/users'), $filename);

            $input['UserImageName'] = "assets/images/users/" . $filename;

        }
        
        if ($request->filled('Password')) {
            $input['Password'] = Hash::make($request->Password);
        } else {
            unset($input['Password']);
        }

       

        $user->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
