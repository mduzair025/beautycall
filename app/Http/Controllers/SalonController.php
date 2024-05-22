<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalonController extends Controller
{
    public function index()
    {
        $salons = DB::table('service_providers')
            ->select('id as ServiceProviderID', 'Name', 'City', 'AverageSalonRating', 'Address', 'ShortDescription')
            ->orderBy('Name', 'DESC')
            ->limit(7)
            ->get();

        foreach ($salons as $salon) {
            $category = DB::table('service_categories')
                ->join('services', 'service_categories.id', '=', 'services.ServiceCategoryID')
                ->where('services.ServiceProviderID', $salon->ServiceProviderID)
                ->select('ServiceCategoryName')
                ->first();
            
            $salon->defaultCategory = $category->ServiceCategoryName ?? 'Hairstyle';
            $salon->categories = DB::table('service_categories')
                ->join('services', 'service_categories.id', '=', 'services.ServiceCategoryID')
                ->where('services.ServiceProviderID', $salon->ServiceProviderID)
                ->select('ServiceCategoryName')
                ->distinct()
                ->limit(5)
                ->get();

            $salon->image = DB::table('service_provider_images')
                ->where('ServiceProviderID', $salon->ServiceProviderID)
                ->select('ImageName')
                ->first();
        }
        return view('user.salons.index', compact('salons'));
    }

    public function getSalons(Request $request)
    {
        $term = $request->get('term', '');

        $salons = DB::table('service_providers')
            ->select('id','Name')
            ->where('Name', 'LIKE', '%' . $term . '%')
            ->distinct()
            ->get();
        if ($salons->isEmpty()) {
            return '<a class="list-group-item list-group-item-action border-1"><p>No matches found</p></a>';
        }

        $result = '';
        foreach ($salons as $salon) {
            
            $category = DB::table('service_categories')
                ->join('services', 'service_categories.id', '=', 'services.ServiceCategoryID')
                ->where('services.ServiceProviderID', $salon->id)
                ->select('ServiceCategoryName')
                ->first();

            
            $defaultCategory = $category->ServiceCategoryName ?? 'Hairstyle';

            $result .= '<a href="' . route('user.salon.view', ['salon' => $salon->Name, 'category' => $defaultCategory]) . '" class="list-group-item list-group-item-action Red">';
            $result .= $salon->Name;
            $result .= '</a>';
        }

        return $result;
    }

    public function show(Request $request, $salonName, $categoryName)
    {
        $salon = ServiceProvider::where('Name', $salonName)->first();
        
        $categories = ServiceCategory::distinct()
            ->join('services', 'service_categories.id', '=', 'services.ServiceCategoryID')
            ->join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
            ->where('service_providers.id', $salon->ServiceProviderID)
            ->orderBy('service_providers.Name', 'DESC')
            ->get();

        $services = Service::distinct()
            ->join('service_categories', 'service_categories.id', '=', 'services.ServiceCategoryID')
            ->join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
            ->where('service_providers.Name', $salonName)
            ->where('service_categories.ServiceCategoryName', $categoryName)
            ->orderBy('service_providers.Name', 'DESC')
            ->get();
        
        return view('user.salons.view')->with([
            'salon'        => $salon,
            'categories'   => $categories,
            'services'     => $services,
            'categoryName' => $categoryName
        ]);
    
    }

    public function serviceView(Request $request)
    {
        if (!$request->has('date')) {
            return redirect()->route('user.index');
        }

        $servicePass = $request->ServicePass;
        $salonview = $request->Salonview;
        $categoryview = $request->Categoryview;
        $date = $request->date;

        // Getting the time needed for the service
        $serviceTime = DB::table('services')
            ->join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
            ->where('services.ServiceName', $servicePass)
            ->where('service_providers.Name', $salonview)
            ->select('services.TimeDurationHours', 'services.TimeDurationMinutes')
            ->first();

        if (!$serviceTime) {
            return redirect()->route('homepage');
        }

        $totalMinutesNeeded = ($serviceTime->TimeDurationHours * 60) + $serviceTime->TimeDurationMinutes;

        // Getting all the staff for the salon
        $staffs = DB::table('Staffs')
            ->join('service_providers', 'Staffs.ServiceProviderID', '=', 'service_providers.id')
            ->where('service_providers.Name', $salonview)
            ->select('Staffs.id as StaffID', 'Staffs.Name', 'Staffs.ImageName')
            ->get();

        $staffAvailability = [];

        foreach ($staffs as $staff) {
            $bookings = DB::table('bookings')
                ->join('service_providers', 'bookings.ServiceProviderID', '=', 'service_providers.id')
                ->where('service_providers.Name', $salonview)
                ->where('bookings.Date', $date)
                ->where('bookings.StaffID', $staff->StaffID)
                ->orderBy('bookings.BeginTime', 'ASC')
                ->select('bookings.BeginTime', 'bookings.FinishTime')
                ->get();

            $intervals = $this->calculateAvailableIntervals($bookings, $totalMinutesNeeded);

            $staffAvailability[] = [
                'id' => $staff->StaffID,
                'name' => $staff->Name,
                'image' => $staff->ImageName,
                'intervals' => $intervals
            ];
        }

        return view('user.service.view', compact('staffAvailability'));
    }

    private function calculateAvailableIntervals($bookings, $totalMinutesNeeded)
    {
        $intervals = [];
        $sevenAM = new \DateTime('07:00:00');
        $eightPM = new \DateTime('20:00:00');

        if ($bookings->isEmpty()) {
            $intervals[] = ['start' => '07:00:00', 'end' => '20:00:00'];
            return $intervals;
        }

        $prevFinishTime = $sevenAM;

        foreach ($bookings as $booking) {
            $beginTime = new \DateTime($booking->BeginTime);
            $finishTime = new \DateTime($booking->FinishTime);

            $intervalMinutes = ($beginTime->getTimestamp() - $prevFinishTime->getTimestamp()) / 60;

            if ($intervalMinutes >= $totalMinutesNeeded) {
                $intervals[] = [
                    'start' => $prevFinishTime->format('H:i:s'),
                    'end' => (clone $beginTime)->modify('-' . $totalMinutesNeeded . ' minutes')->format('H:i:s')
                ];
            }

            $prevFinishTime = $finishTime;
        }

        $intervalMinutes = ($eightPM->getTimestamp() - $prevFinishTime->getTimestamp()) / 60;
        if ($intervalMinutes >= $totalMinutesNeeded) {
            $intervals[] = [
                'start' => $prevFinishTime->format('H:i:s'),
                'end' => $eightPM->modify('-' . $totalMinutesNeeded . ' minutes')->format('H:i:s')
            ];
        }

        if (empty($intervals)) {
            $intervals[] = ['start' => 'All Day Booked', 'end' => 'All Day Booked'];
        }

        return $intervals;
    }
}
