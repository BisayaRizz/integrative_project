<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator; 

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt($request->only(['email', 'password']))) {
            $token = auth()->user()->createToken('tokens');

            return response()->json([
                'status' => true,
                'message' => 'Login Successfully',
                'user' => auth()->user(),
                'access_token' => $token->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials',
            ]);
        }
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max=255',
            'email' => 'required|string|email|max=255|unique:users', 
            'password' => 'required|string|min=8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422); 
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('tokens');

        return response()->json([
            'status' => true,
            'message' => 'Registration Successful',
            'user' => $user,
            'access_token' => $token->plainTextToken,
        ]);
    }
}
