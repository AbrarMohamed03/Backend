<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'adress',
        'bedrooms',
        'bathrooms',
        'max_persons',
        'price_per_night',
        'service_id',
        'city_id',
        'type_id'
    ];
}
