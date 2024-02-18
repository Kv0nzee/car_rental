<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;
    protected $fillable = ['days', 'total_price', 'car_id', 'user_id', 'pricePerDay'];

    public function scopeFilter($query, $filters){
        $query->when($filters['car'] ?? false, function($query, $name){
            $query->whereHas('car', function($query) use ($name){
                $query->where('name', $name);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $name){
            $query->whereHas('user', function($query) use ($name){
                $query->where('name', $name);
            });
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function car(){
        return $this->belongsTo(Car::class);
    }

}
