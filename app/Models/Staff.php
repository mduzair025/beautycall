<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $table = 'staffs';

    protected $fillable = [
        'Name',
        'Surname',
        'Email',
        'PhoneNumber',
        'ServiceProviderID',
        'ImageName',
    ];

    // Define the relationship with ServiceProvider model
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
