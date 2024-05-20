<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'StaffID',
        'ServiceCategoryID',
    ];

    // Define the relationship with Staff model
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    // Define the relationship with ServiceCategory model
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
