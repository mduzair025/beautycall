<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function registerShow(){
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'AdministratorName'    => 'required|string|max:255',
            'AdministratorSurname' => 'required|string|max:255',
            'Username'             => 'required|string|max:255|unique:administrators',
            'Password'             => 'required|string|max:255',
            'Country'              => 'required|string|max:255',
            'City'                 => 'required|string|max:255',
            'Address'              => 'required|string|max:255',
            'PostalCode'           => 'required|string|max:255',
            'Email'                => 'required|string|email|max:255|unique:administrators',
            'PhoneNumber'          => 'required|string|max:255',
            'ProfileImage'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        $imageName = time().'.'.$request->ProfileImage->extension();  
        $request->ProfileImage->move(public_path('images'), $imageName);

        // Create new administrator
        Administrator::create([
            'AdministratorName'    => $request->AdministratorName,
            'AdministratorSurname' => $request->AdministratorSurname,
            'Username'             => $request->Username,
            'Password'             => $request->Password, // Remember to hash the password
            'Country'              => $request->Country,
            'City'                 => $request->City,
            'Address'              => $request->Address,
            'PostalCode'           => $request->PostalCode,
            'Email'                => $request->Email,
            'PhoneNumber'          => $request->PhoneNumber,
            'AdministratorImage'   => $imageName,
        ]);

        return redirect()->route('login')->with('success', 'Administrator registered successfully!');
    }
}
