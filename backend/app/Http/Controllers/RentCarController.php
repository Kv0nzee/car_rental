<?php

namespace App\Http\Controllers;

use App\Models\RentCar;
use Exception;
use Illuminate\Http\Request;

class RentCarController extends Controller
{
    public function store(Request $request){
        try{
            $rentData =$request->validate([
                'days' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:1',
                'car_id' => 'required|exists:cars,id',
                'user_id' => 'required|exists:users,id'
            ]);
    
            // Create a new rental record
            $rental = RentCar::create([
                'days' =>  $rentData['days'],
                'total_price' =>  $rentData['total_price'],
                'car_id' =>  $rentData['car_id'],
                'user_id' =>  $rentData['user_id']
            ]);
    
            return response()->json(['rental' => $rental], 201);

        }catch(Exception $e){
           return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
