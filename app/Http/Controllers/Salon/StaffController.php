<?php

namespace App\Http\Controllers\Salon;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');

        $staffs = DB::table('Staffs')
            ->where('ServiceProviderID', $serviceProviderID)
            ->get();


        $selectedStaff = null;
        if ($request->has('StaffManageName')) {
            $selectedStaff = DB::table('Staffs')
                ->where('ServiceProviderID', $serviceProviderID)
                ->where('Name', $request->query('StaffManageName'))
                ->first();
            
            if ($selectedStaff) {
                $categories = DB::table('service_categories')
                    ->join('services', 'services.ServiceCategoryID', '=', 'service_categories.id')
                    ->where('services.ServiceProviderID', $serviceProviderID)
                    ->orderBy('ServiceCategoryName', 'ASC')
                    ->get();

                $staffCategories = DB::table('staff_categories')
                    ->join('service_categories', 'staff_categories.ServiceCategoryID', '=', 'service_categories.id')
                    ->where('StaffID', $selectedStaff->id)
                    ->pluck('ServiceCategoryName')
                    ->toArray();

                return view('salon.staffs.index', compact('staffs', 'selectedStaff', 'categories', 'staffCategories'));
            }
        }

        return view('salon.staffs.index', compact('staffs', 'selectedStaff'));
    }

    public function create()
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');
        $categories = DB::table('service_categories')
            ->join('services', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->where('services.ServiceProviderID', $serviceProviderID)
            ->orderBy('ServiceCategoryName', 'ASC')
            ->get();

        return view('salon.staffs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');
        $request->validate([
            'Name' => 'required|string|max:255',
            'Surname' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'required|string|max:255',
            'fileToUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'Name' => $request->input('Name'),
            'Surname' => $request->input('Surname'),
            'Email' => $request->input('Email'),
            'PhoneNumber' => $request->input('Phone'),
            'ServiceProviderID' => $serviceProviderID,
        ];

        if ($request->hasFile('fileToUpload')) {
            $image = $request->file('fileToUpload');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('assets/images/staffs', $imageName);
            $data['ImageName'] = "assets/images/staffs/".$imageName;
        }

        $staffID = DB::table('Staffs')->insertGetId($data);

        // Add staff categories
        $categories = DB::table('service_categories')
            ->join('services', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->where('services.ServiceProviderID', $serviceProviderID)
            ->pluck('service_categories.id', 'service_categories.ServiceCategoryName');

        foreach ($categories as $categoryName => $categoryID) {
            if ($request->has($categoryName)) {
                DB::table('staffcategories')->insert([
                    'StaffID' => $staffID,
                    'ServiceCategoryID' => $categoryID,
                ]);
            }
        }

        return redirect()->route('salon.staffs')->with('success', 'Staff added successfully.');
    }

    public function update(Request $request)
    {        
        $request->validate([
            'StaffID' => 'required|integer',
            'Name' => 'required|string|max:255',
            'Surname' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'required|string|max:255',
            'fileToUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staffID = $request->input('StaffID');
        
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');

        $data = [
            'Name' => $request->input('Name'),
            'Surname' => $request->input('Surname'),
            'Email' => $request->input('Email'),
            'PhoneNumber' => $request->input('Phone'),
        ];

        if ($request->hasFile('fileToUpload')) {
            $image = $request->file('fileToUpload');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('assets/images/staffs', $imageName);
            $data['ImageName'] = "assets/images/staffs/". $imageName;
        }

        DB::table('Staffs')
            ->where('id', $staffID)
            ->update($data);

        // Update staff categories
        DB::table('staff_categories')->where('StaffID', $staffID)->delete();

        $categories = DB::table('service_categories')
            ->join('services', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->where('services.ServiceProviderID', $serviceProviderID)
            ->pluck('service_categories.id', 'service_categories.ServiceCategoryName');
        
        
        foreach ($categories as $categoryName => $categoryID) {
            if ($request->has($categoryName)) {
                DB::table('staff_categories')->insert([
                    'StaffID' => $staffID,
                    'ServiceCategoryID' => $categoryID,
                ]);
            }
        }

        return redirect()->route('salon.staffs')->with('success', 'Staff updated successfully.');
    }

    
}
