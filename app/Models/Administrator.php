<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'AdministratorName',
        'AdministratorSurname',
        'Username',
        'Password',
        'Country',
        'City',
        'Address',
        'PostalCode',
        'Email',
        'PhoneNumber',
        'AdministratorImage',
    ];

    public function openingTimes()
    {
        return $this->hasOne(OpeningTime::class);
    }
}
