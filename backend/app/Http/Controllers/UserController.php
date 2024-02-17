<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $formData = $request->validate([
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'name' => ['required', 'max:255', 'min:3', Rule::unique('users', 'name')],
                'password' => ['required', 'min:8']
            ]);
    
            $user = User::create([
                'name' => $formData['name'],
                'email' => $formData['email'],
                'password' => bcrypt($formData['password']),
            ]);

            Auth::login($user);
            $token = $user->createToken('AuthToken')->plainTextToken;
    
            return response()->json(['user' => $user, 'message' => 'User registered successfully',  'token' => $token], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function getUserData()
    {
        // Retrieve the authenticated user using the Auth facade
        $user = Auth::user();

        // Return the user data as a JSON response
        return response()->json(['user' => $user]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    
}
