<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc', 
        'location',
        'duration', 
        'duration_type',
        'price_per_person', 
        'service_id', 
        'city_id',
        'type_id'
    ];
}
