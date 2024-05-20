<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ServiceName',
        'ServiceCategoryID',
        'Price',
        'TimeDurationHours',
        'TimeDurationMinutes',
        'ShortDescription',
        'ServiceProviderID',
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class);
    }
    
}
