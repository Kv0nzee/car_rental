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

    public function edit(Request $request, Car $car){
        try{
            $request['brand_id'] = $request->brand_name;
            $request['category_id'] = $request->category_name;

    
            // Validate the request data with the updated parameter names
            $carData = $request->validate([
                'brand_id' => 'required|exists:brands,id',
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string',
                'city_mpg' => 'required|integer|min:0',
                'highway_mpg' => 'required|integer|min:0',
                'combination_mpg' => 'required|integer|min:0',
                'cylinders' => 'required|integer|min:0',
                'displacement' => 'required|numeric|min:0',
                'drive' => 'required|string',
                'fuel_type' => 'required|string',
                'transmission' => 'required|string',
                'year' => 'required|integer|min:1900|max:'.date('Y'),
            ]);
            
    
            // Update the car model with the validated data
            $car->update($carData);
    
            // Return JSON response with the updated car data
            return response()->json(['car' => $car], 201);
    
        }catch(Exception $e){
            // Return JSON response with error message
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }    

    public function delete($id){
        try{
            $car = Car::findOrFail($id);
        
            $car->delete();
            return response()->json(['message' => 'Car deleted successfully'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'message' => 'Error updating record',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
