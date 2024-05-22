<?php

namespace App\Http\Controllers\Salon;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(){
        $admin = session('admin');
        
        $serviceProviderID = ServiceProvider::where('AdministratorID', $admin['id'])->get()->pluck('id');

        $clients = DB::table('users')
            ->join('bookings', 'bookings.UserID', '=', 'users.id')
            ->whereIn('bookings.ServiceProviderID', $serviceProviderID)
            ->select('users.id', 'users.Name', 'users.Surname')
            ->distinct()
            ->orderBy('users.Surname', 'ASC')
            ->get();
        
        

        $clientBookings = [];

        foreach ($clients as $client) {
            
            $NOB = DB::table('bookings')
                ->where('UserID', $client->id)
                ->whereIn('ServiceProviderID', $serviceProviderID)
                ->count();

            $clientBookings[] = [
                'name'    => $client->Name,
                'surname' => $client->Surname,
                'NOB'     => $NOB
            ];
        }

        return view('salon.clients.index', compact('clientBookings'));
    }
}
