<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        try{
            $cars = Car::latest()->filter(request(["category", "brand"]))->get(); // Fetch the data
            return $cars;
        }catch( Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        };
        // 'blogs'=>Blog::latest()
        // ->filter(request(['search', 'category', 'author']))
        // ->paginate(6)
        // ->withQueryString()
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
