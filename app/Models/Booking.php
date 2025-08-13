<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'check_in',
        'check_out',

    ];
}
