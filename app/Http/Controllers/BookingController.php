<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(){

        
        $bookings = Booking::join('service_providers', 'bookings.ServiceProviderID', '=', 'service_providers.id')
            ->join('services', 'bookings.ServiceID', '=', 'services.id')
            ->join('staffs', 'bookings.StaffID', '=', 'staffs.id')
            ->leftJoin('booking_ratings', 'bookings.BookingRatingID', '=', 'booking_ratings.id')
            ->where('bookings.UserID', auth()->id())
            ->select(
                'bookings.id as BookingID',
                'bookings.Date',
                'bookings.BeginTime',
                'bookings.FinishTime',
                'service_providers.id as ServiceProviderID',
                'service_providers.Name as SalonName',
                'services.ServiceName',
                'staffs.Name as StaffName',
                'bookings.BookingStatus',
                'bookings.deleted',
                'booking_ratings.id as BookingRatingID',
                'booking_ratings.BookingRatingNumber'
            )
            ->orderByDesc('bookings.id')
            ->get();

        return view('user.booking.index', compact('bookings'));
    }

    public function dateSelector(){
        return view('user.booking.date-selector');
    }

    public function confirmBooking(Request $request)
    {
        // Validate the request
        $request->validate([
            'InsertBeginTime' => 'required|date_format:H:i',
            'Date' => 'required|date',
            'StaffID' => 'required|integer',
        ]);

        // Getting ServiceProviderID
        $serviceProviderID = DB::table('service_providers')
            ->where('Name', $request->Salonview)
            ->value('id');

        if (!$serviceProviderID) {
            return redirect()->back()->withErrors('Service provider not found.');
        }

        // Getting ServiceID and time duration
        $service = DB::table('services')
            ->where('ServiceName', $request->ServicePass)
            ->select('id as ServiceID', 'TimeDurationHours', 'TimeDurationMinutes')
            ->first();

        if (!$service) {
            return redirect()->back()->withErrors('Service not found.');
        }

        // Calculate finish time
        $totalMinutes = ($service->TimeDurationHours * 60) + $service->TimeDurationMinutes;
        $beginTime = $request->InsertBeginTime . ":00";
        $beginTimeInSeconds = strtotime($beginTime);
        $finishTimeInSeconds = $beginTimeInSeconds + ($totalMinutes * 60);
        $finishTime = date("H:i:s", $finishTimeInSeconds);

        // Insert booking
        DB::table('bookings')->insert([
            'BeginTime' => $beginTime,
            'Date' => $request->Date,
            'BookingStatus' => 'Booked',
            'ServiceProviderID' => $serviceProviderID,
            'ServiceID' => $service->ServiceID,
            'UserID' => Auth::id(),
            'FinishTime' => $finishTime,
            'StaffID' => $request->StaffID,
        ]);

        return redirect()->route('user.bookings.index');
    }

    public function giveReview(Request $request)
    {
        $request->validate([
            'Rate' => 'required|numeric|min:1|max:5',
            'ServiceProviderID' => 'required|integer',
            'BookingID' => 'required|integer',
        ]);

        $userID = auth()->id(); // Assuming you use Laravel's Auth system

        DB::beginTransaction();

        try {
            // Insert into bookingratings
            $bookingRatingID = DB::table('booking_ratings')->insertGetId([
                'BookingRatingNumber' => $request->Rate,
                'UserID' => $userID,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert into serviceproviderratings
            DB::table('service_provider_ratings')->insert([
                'ServiceProviderID' => $request->ServiceProviderID,
                'BookingRatingID' => $bookingRatingID,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update bookings table
            DB::table('bookings')->where('Id', $request->BookingID)->update([
                'BookingRatingID' => $bookingRatingID,
                'updated_at' => now(),
            ]);

            // Get the current RatingsNumber
            $serviceProvider = DB::table('service_providers')->where('id', $request->ServiceProviderID)->first();
            $IncNum = ($serviceProvider->RatingsNumber ?? 0) + 1;

            // Update the RatingsNumber in serviceproviders
            DB::table('service_providers')->where('id', $request->ServiceProviderID)->update([
                'RatingsNumber' => $IncNum,
                'updated_at' => now(),
            ]);

            // Calculate the new average rating
            $ratings = DB::table('booking_ratings')
                ->join('service_provider_ratings', 'booking_ratings.id', '=', 'service_provider_ratings.BookingRatingID')
                ->where('service_provider_ratings.ServiceProviderID', $request->ServiceProviderID)
                ->pluck('booking_ratings.BookingRatingNumber');

            $averageRating = ceil($ratings->avg());

            // Update the AverageSalonRating in serviceproviders
            DB::table('service_providers')->where('id', $request->ServiceProviderID)->update([
                'AverageSalonRating' => $averageRating,
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('user.bookings.index')->with('status', 'Rating submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('user.bookings.index')->with('error', 'Failed to submit rating.');
        }
    }

    public function cancel(Request $request, $id){
        Booking::where('id', $id)->update([
            'BookingStatus' => 'Canceled'
        ]);

        return redirect()->route('user.bookings.index')->with('status', 'Booking cancel successfully!');
    }


}
