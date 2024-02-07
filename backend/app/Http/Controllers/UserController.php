<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){
        try{

            $formData=request()->validate([
                'email'=>['required','email',Rule::unique('users', 'email')],
                'name'=>['required','max:255','min:3',Rule::unique('users', 'name')],
                'password'=>['required','min:8']
            ]);
            $user=User::create($formData);

            return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
            
        }catch( Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ],500);
        };
    }
}
