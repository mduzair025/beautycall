<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    
        return view('user.index');
    }
    
    public function categories(){
        $categories = ServiceCategory::select('ServiceCategoryName', 'ImageName')
            ->distinct()
            ->orderBy('ServiceCategoryName', 'desc')
            ->get();

        return view('user.category', compact('categories'));
    }
    
    public function category(Request $request, $category){
        $salons = Service::join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
        ->join('service_categories', 'services.ServiceCategoryID', '=', 'service_categories.id')
        ->leftJoin('service_provider_images', 'service_providers.id', '=', 'service_provider_images.ServiceProviderID')
        ->where('service_categories.ServiceCategoryName', $category)
        ->where('service_providers.Status', 'Confirmed')
        ->orderBy('service_providers.Name', 'DESC')
        ->select('service_providers.*', 'services.*', 
        'service_provider_images.ImageName as ImageName') // Select necessary fields
        ->distinct() // Ensure distinct service providers
        ->get();

        return view('user.salon-category', compact('salons', 'category'));
    }
    public function viewSalon(Request $request, $category){
        $salons = Service::join('service_providers', 'services.ServiceProviderID', '=', 'service_providers.id')
        ->join('service_categories', 'services.ServiceCategoryID', '=', 'service_categories.id')
        ->leftJoin('service_provider_images', 'service_providers.id', '=', 'service_provider_images.ServiceProviderID')
        ->where('service_categories.ServiceCategoryName', $category)
        ->where('service_providers.Status', 'Confirmed')
        ->orderBy('service_providers.Name', 'DESC')
        ->select('service_providers.*', 'services.*', 
        'service_provider_images.ImageName as ImageName') // Select necessary fields
        ->distinct() // Ensure distinct service providers
        ->get();

        return view('user.salon-category', compact('salons', 'category'));
    }

    public function ricercaCategory(Request $request){
        $html = '';
        if ($request->has('term')) {
            $term = '%' .$request->input('term') . '%';
            $categories = ServiceCategory::where('ServiceCategoryName', 'LIKE', $term)->get();
            
            if ($categories->isNotEmpty()) {
                foreach ($categories as $category) {
                    $html .= '
                        <a href="'.route('user.category.salons', ['category' => $category->ServiceCategoryName]).'"         class="list-group-item list-group-item-action Red">'.
                        $category->ServiceCategoryName.
                        '</a>';
                }
            } else {
                $html.= '<a class="list-group-item list-group-item-action border-1">
                            <p>No matches found</p>
                        </a>';
            }
        }

        return $html;
    }
}
