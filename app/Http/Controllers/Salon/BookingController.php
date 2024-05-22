<?php

namespace App\Http\Controllers\Salon;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $admin = session('admin');
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->pluck('id');

        $orderBy = $request->query('OrderBy', 'id');
        $orderDirection = 'DESC';

        if ($orderBy == 'Older' || $orderBy == 'Newer') {
            $orderBy = 'Date';
            $orderDirection = $orderBy == 'Older' ? 'DESC' : 'ASC';
        }
        
        $query = DB::table('bookings')
            ->join('users', 'bookings.UserID', '=', 'users.id')
            ->join('services', 'bookings.ServiceID', '=', 'services.id')
            ->join('staffs', 'bookings.StaffID', '=', 'staffs.id')
            ->join('service_categories', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->whereIn('bookings.ServiceProviderID', $serviceProviderID)
            ->select('bookings.*', 'users.Name as UserName', 'users.Surname as UserSurname', 'staffs.Name as StaffName', 'service_categories.ServiceCategoryName', 'services.ServiceName');

        if ($orderBy == 'StaffID' && $request->has('StaffName')) {
            $query->where('staffs.Name', $request->query('StaffName'));
        } elseif ($orderBy == 'CategoryName' && $request->has('CategoryPass')) {
            $query->where('service_categories.ServiceCategoryName', $request->query('CategoryPass'));
        } elseif ($orderBy == 'ServiceID' && $request->has('ServicePass')) {
            $query->where('services.ServiceName', $request->query('ServicePass'));
        } elseif ($orderBy == 'BookingStatus' && $request->has('StatusName')) {
            $query->where('bookings.BookingStatus', $request->query('StatusName'));
        }
        if ($orderBy == 'CategoryName') {
            $orderBy = 'id';
        }
        $bookings = $query->orderBy('bookings.' . $orderBy, $orderDirection)->get();

        $staffs = DB::table('staffs')
            ->whereIn('ServiceProviderID', $serviceProviderID)
            ->orderBy('Name', 'ASC')
            ->pluck('Name');

        $categories = DB::table('service_categories')
            ->join('services', 'services.ServiceCategoryID', '=', 'service_categories.id')
            ->whereIn('services.ServiceProviderID', $serviceProviderID)
            ->orderBy('ServiceCategoryName', 'ASC')
            ->distinct('service_categories.Name')
            ->pluck('ServiceCategoryName');

        $services = DB::table('services')
            ->whereIn('ServiceProviderID', $serviceProviderID)
            ->orderBy('ServiceName', 'ASC')
            ->pluck('ServiceName');

        return view('salon.bookings.index', compact('bookings', 'staffs', 'categories', 'services'));
    }

    public function manage(Request $request){
        $request->validate([
            'BookingID' => 'required',
            'Action' => 'required'
        ]);
        Booking::where('id', $request->BookingID)->update([
            'BookingStatus' => $request->Action
        ]);

        return redirect()->to(route('salon.bookings'));
    }
}
