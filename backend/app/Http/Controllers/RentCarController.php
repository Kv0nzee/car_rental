<?php

namespace App\Http\Controllers;

use App\Models\RentCar;
use Exception;
use Illuminate\Http\Request;

class RentCarController extends Controller
{
    public function index(){
        try{
            $rentCars = RentCar::latest()
            ->filter(request(["car", "user"]))
            ->join('cars', 'rent_cars.car_id', '=', 'cars.id')
            ->join('users', 'rent_cars.user_id', '=', 'users.id')
            ->join('categories', 'cars.category_id', '=', 'categories.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->select('rent_cars.*', 'cars.name as car_name', 'cars.year', 'users.name as user_name', 'cars.id as car_id', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        return $rentCars;
        }catch( Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        };
    }

    public function show(RentCar $rentCar){
        try{
            if(!$rentCar){
                return response()->json([  
                    'message' => 'car not found',
                    'status' => 500
                ],404);
            }

            return $rentCar;
            
        }catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    public function store(Request $request){
        try{
            $rentData =$request->validate([
                'days' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:1',
                'pricePerDay' => 'required|numeric|min:1',
                'car_id' => 'required|exists:cars,id',
                'user_id' => 'required|exists:users,id'
            ]);
    
            // Create a new rental record
            $rental = RentCar::create([
                'days' =>  $rentData['days'],
                'total_price' =>  $rentData['total_price'],
                'pricePerDay'=> $rentData['pricePerDay'],
                'car_id' =>  $rentData['car_id'],
                'user_id' =>  $rentData['user_id'],
            ]);
    
            return response()->json(['rental' => $rental], 201);

        }catch(Exception $e){
           return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the rental record by its ID
            $rental = RentCar::findOrFail($id);

            // Validate the request data
            $rentData = $request->validate([
                'days' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:1',
                'car_id' => 'required|exists:cars,id',
                'user_id' => 'required|exists:users,id'
            ]);

            // Update the rental record with the validated data
            $rental->update($rentData);

            // Return a success response
            return response()->json([
                'message' => 'Record updated successfully',
                'rental' => $rental
            ], 200);
        } catch (Exception $e) {
            // Return an error response if an exception occurs
            return response()->json([
                'message' => 'Error updating record',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id){
        try{
            $rentCar = RentCar::findOrFail($id);
        
            $rentCar->delete();
            return response()->json(['message' => 'Record deleted successfully'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'message' => 'Error updating record',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
