<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental_photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'rental_id', 
    ];
}
