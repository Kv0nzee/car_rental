<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        try{
            $cars = Car::latest()
            ->filter(request(["category", "brand"]))
            ->join('categories', 'cars.category_id', '=', 'categories.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->select('cars.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        return $cars;
        }catch( Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        };
    }

    public function show(Car $car){
        try{
            if(!$car){
                return response()->json([  
                    'message' => 'car not found',
                    'status' => 500
                ],404);
            }

            return $car;
            
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
