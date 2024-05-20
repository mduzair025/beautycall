<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Country',
        'City',
        'Address',
        'PostalCode',
        'ShortDescription',
        'Email',
        'PhoneNumber',
        'AverageSalonRating',
        'AdministratorID',
        'OpeningTimeID',
        'Status',
        'RatingsNumber',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function openingTime()
    {
        return $this->belongsTo(OpeningTime::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
