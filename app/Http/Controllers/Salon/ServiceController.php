<?php

namespace App\Http\Controllers\Salon;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ServiceController extends Controller
{
    public function index()
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');

        $services = DB::table('services')
            ->select('services.id as ServiceId', 'services.*', 'service_categories.*')
            ->join('service_categories', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->where('services.ServiceProviderID', $serviceProviderID)
            ->orderBy('services.id', 'desc')
            ->get();

        return view('salon.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::get();
        return view('salon.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->value('id');

        $serviceID = DB::table('services')->insertGetId([
            'ServiceName' => $request->ServiceName,
            'ServiceCategoryID' => $request->Category,
            'Price' => $request->Price,
            'TimeDurationHours' => $request->TimeDurationHours,
            'TimeDurationMinutes' => $request->TimeDurationMinutes,
            'ShortDescription' => $request->ShortDescription,
            'ServiceProviderID' => $serviceProviderID,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            $filename = round(microtime(true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/services'), $filename);

            ServiceImage::create([
                'ImageName' => 'assets/images/services/'.$filename,
                'ServiceID' => $serviceID,
            ]);
        }

        return redirect()->route('salon.services')->with('success', 'Service created successfully.');
    }

    public function update(Request $request)
    {
        $serviceID = $request->ServiceID;

        DB::table('services')
            ->where('id', $serviceID)
            ->update([
                'ServiceName'         => $request->ServiceName,
                'ShortDescription'    => $request->ShortDescription,
                'Price'               => $request->Price,
                'TimeDurationHours'   => $request->TimeDurationHours,
                'TimeDurationMinutes' => $request->TimeDurationMinutes,
            ]);

        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            $filename = round(microtime(true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/services'), $filename);

            ServiceImage::create([
                'ImageName' => 'assets/images/services/' . $filename,
                'ServiceID' => $serviceID,
            ]);
        }

        return redirect()->route('salon.services')->with('success', 'Service updated successfully.');
    }

    public function cancelImage(Request $request)
    {
        $imageID = $request->ServiceImageID;
        $imageName = $request->ImageName;

        ServiceImage::where('id', $imageID)->delete();
        if(strpos($imageName, 'https') !== 0)
            unlink(public_path($imageName));

        return redirect()->route('salon.services')->with('success', 'Image deleted successfully.');
    }
}