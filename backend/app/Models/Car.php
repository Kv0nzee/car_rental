<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['category'] ?? false, function ($query, $name) {
            $query->whereHas('category', function ($query) use ($name) {
                $query->where('name', $name);
            });
        });

        $query->when($filters['brand'] ?? false, function ($query, $name) {
            $query->whereHas('brand', function ($query) use ($name) {
                $query->where('name', $name);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
