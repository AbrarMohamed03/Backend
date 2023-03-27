<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
