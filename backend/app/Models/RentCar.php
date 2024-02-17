<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;
    protected $fillable = ['days', 'total_price', 'car_id', 'user_id'];
}
