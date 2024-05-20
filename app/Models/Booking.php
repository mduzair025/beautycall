<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'BeginTime',
        'Date',
        'BookingStatus',
        'ServiceProviderID',
        'ServiceID',
        'BookingRatingID',
        'UserID',
        'FinishTime',
        'StaffID',
        'Deleted',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookingRating()
    {
        return $this->belongsTo(BookingRating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}

