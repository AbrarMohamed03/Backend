<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie_photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'activities_id', 
    ];
}
