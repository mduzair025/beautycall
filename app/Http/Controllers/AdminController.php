<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\OpeningTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $request->ProfileImage->move('assets/images/admin', $imageName);

        // Create new administrator
        $admin = Administrator::create([
            'AdministratorName'    => $request->AdministratorName,
            'AdministratorSurname' => $request->AdministratorSurname,
            'Username'             => $request->Username,
            'Password'             => Hash::make($request->Password), // Remember to hash the password
            'Country'              => $request->Country,
            'City'                 => $request->City,
            'Address'              => $request->Address,
            'PostalCode'           => $request->PostalCode,
            'Email'                => $request->Email,
            'PhoneNumber'          => $request->PhoneNumber,
            'AdministratorImage'   => 'assets/images/admin/' . $imageName,
        ]);

        session(['admin' => $admin]);

        return redirect()->route('salon.create')->with('success', 'Administrator registered successfully!');
    }

    public function salonHome(){
        $salon = session('admin');
        return view('salon.index', compact('salon'));
    }
    
    public function salonCreate(){
        return view('salon.register');
    }
    
    public function salonStore(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Country' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'Address' => 'required|string|max:255',
            'PostalCode' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'PhoneNumber' => 'required|string|max:255',
            'ShortDescription' => 'required|string|max:255',
            'MondayOpen' => 'required|date_format:H:i',
            'MondayClosing' => 'required|date_format:H:i',
            'TuesdayOpen' => 'required|date_format:H:i',
            'TuesdayClosing' => 'required|date_format:H:i',
            'WednesdayOpen' => 'required|date_format:H:i',
            'WednesdayClosing' => 'required|date_format:H:i',
            'ThursdayOpen' => 'required|date_format:H:i',
            'ThursdayClosing' => 'required|date_format:H:i',
            'FridayOpen' => 'required|date_format:H:i',
            'FridayClosing' => 'required|date_format:H:i',
            'SaturdayOpen' => 'required|date_format:H:i',
            'SaturdayClosing' => 'required|date_format:H:i',
            'SundayOpen' => 'required|date_format:H:i',
            'SundayClosing' => 'required|date_format:H:i',
        ]);

        $admin = session('admin');

        // Insert opening times
        $openingTimeID = DB::table('opening_times')->insertGetId([
            'Monday' => $request->MondayOpen . '-' . $request->MondayClosing,
            'Tuesday' => $request->TuesdayOpen . '-' . $request->TuesdayClosing,
            'Wednesday' => $request->WednesdayOpen . '-' . $request->WednesdayClosing,
            'Thursday' => $request->ThursdayOpen . '-' . $request->ThursdayClosing,
            'Friday' => $request->FridayOpen . '-' . $request->FridayClosing,
            'Saturday' => $request->SaturdayOpen . '-' . $request->SaturdayClosing,
            'Sunday' => $request->SundayOpen . '-' . $request->SundayClosing,
            'AdministratorID' => $admin['id'],
        ]);

        // Insert service provider
        DB::table('service_providers')->insert([
            'Name' => $request->Name,
            'Country' => $request->Country,
            'City' => $request->City,
            'Address' => $request->Address,
            'PostalCode' => $request->PostalCode,
            'ShortDescription' => $request->ShortDescription,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'AdministratorID' => $admin['id'],
            'OpeningTimeID' => $openingTimeID,
            'Status' => 'Non Confermato',
        ]);

        return redirect()->route('salon.index')->with('success', 'Salon registered successfully.');
    }

    public function salonShow(Request $request){
        return view('salon.information');
    }

    public function manageOpeningTime()
    {
        $admin = session('admin');
        $openingTimes = OpeningTime::where('AdministratorID', $admin['id'])->first();

        return view('salon.manage-opening-time', compact('openingTimes'));
    }

    public function updateOpeningTime(Request $request)
    {
        $admin = session('admin');

        $data = [
            'Monday' => $request->has('MondayAllDay') ? null : $request->input('MondayOpen') . "-" . $request->input('MondayClosing'),
            'Tuesday' => $request->has('TuesdayAllDay') ? null : $request->input('TuesdayOpen') . "-" . $request->input('TuesdayClosing'),
            'Wednesday' => $request->has('WednesdayAllDay') ? null : $request->input('WednesdayOpen') . "-" . $request->input('WednesdayClosing'),
            'Thursday' => $request->has('ThursdayAllDay') ? null : $request->input('ThursdayOpen') . "-" . $request->input('ThursdayClosing'),
            'Friday' => $request->has('FridayAllDay') ? null : $request->input('FridayOpen') . "-" . $request->input('FridayClosing'),
            'Saturday' => $request->has('SaturdayAllDay') ? null : $request->input('SaturdayOpen') . "-" . $request->input('SaturdayClosing'),
            'Sunday' => $request->has('SundayAllDay') ? null : $request->input('SundayOpen') . "-" . $request->input('SundayClosing'),
        ];

        OpeningTime::where('AdministratorID', $admin['id'])->update($data);

        return redirect()->route('salon.manage.opening-time')->with('success', 'Opening times updated successfully.');
    }


    public function logout() {
        Session::flush();
        Session::forget('admin');
        return redirect()->to(route('login'));
    }


}
