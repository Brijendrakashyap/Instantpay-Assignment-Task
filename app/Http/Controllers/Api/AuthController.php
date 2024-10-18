<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Handle user signup/registration
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

    // Create a new user in the database with the validated data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Handle user login
    public function login(Request $request)
    {
        // Validate the incoming request data for email and password
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();
       
        // Check if user exists and password is correct, otherwise throw a validation exception
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
       
        // Generate a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success response with access token and token type
        return response()->json([
            'message' => 'Login successful',  
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

     // Handle user logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

}
