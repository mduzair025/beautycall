<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'ServiceProviderID',
        'BookingRatingID',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function bookingRating()
    {
        return $this->belongsTo(BookingRating::class);
    }
}
