<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    * Endpoint for register new users.
    */
    public function register(Request $request)
    {
        // Data validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'email' => 'required|string|email|max:120|unique:users',
            'password' => 'required|string|min:6',
        ]);
        // Access denied
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 401);
        }

        // New user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Make token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return data
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /*
    * Endpoint for authentication.
    */
    public function login(Request $request)
    {
        // Data validation
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid authentication. Please try again.',
            ], 401);
        }

        // Get user from database
        $user = User::where('email', $request['email'])->firstOrFail();

        // Generate the token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return data
        return response()->json([
            'message' => 'Welcome '.$user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /*
    * Endpoint for refresh token.
    */
    public function refresh()
    {
        // Get user by Auth facade
        $user = Auth::user();
        // Generate the token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return data
        return response()->json([
            'message' => $user->name.' has a new token.',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /*
    * Endpoint for revoking token.
    */
    public function logout()
    {
        // Get user by Auth facade
        $user = Auth::user();
        // Revoking token
        $user->tokens()->delete();

        // Return data
        return response()->json([
            'message' => 'Token successfully destroyed for '.$user->name.'.',
        ]);
    }
}
