<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'firstName',
        'lastName',
        'phoneNumber',
        'password',
        'CIN',
        'photo'

    ];
}
