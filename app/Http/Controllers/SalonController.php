<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function viewSalon(Request $request, $salonName, $categoryName)
    {
        $salon = ServiceProvider::where('Name', $salonName)->first();
        
        $categories = ServiceCategory::distinct()
            ->join('services', 'service_categories.id', '=', 'services.ServiceCategoryID')
            ->join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
            ->where('service_providers.id', $salon->ServiceProviderID)
            ->orderBy('service_providers.Name', 'DESC')
            ->get(['service_categories.ServiceCategoryName']);

        $services = Service::distinct()
            ->join('service_categories', 'service_categories.id', '=', 'services.ServiceCategoryID')
            ->join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
            ->where('service_providers.Name', $salonName)
            ->where('service_categories.ServiceCategoryName', $categoryName)
            ->orderBy('service_providers.Name', 'DESC')
            ->get(['services.*']);

        return view('user.salon')->with([
            'salon'        => $salon,
            'categories'   => $categories,
            'services'     => $services,
            'categoryName' => $categoryName
        ]);
    
    }
}
