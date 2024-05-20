<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'BookingRatingNumber',
        'UserID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
