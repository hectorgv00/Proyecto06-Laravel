<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register a user

    public function register(Request $request)
    {
        Log::info("Registering a user");
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $user = User::create([
                'username' => $request->get('username'),
                'steamUsername' => $request->get('steamUsername'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user', 'token'), 201);
        } catch (\Throwable $th) {


            Log::error("ERROR CREATING THE User" . $th->getMessage());

            return response([
                'success' => false,
                'message' => 'Failed to create a User' . $th->getMessage()
            ], 500);
        }
    }


    // Login a user

    public function login(Request $request)
    {
        Log::info("Loggin in a user");
        try {

            $input = $request->only('email', 'password');
            $jwt_token = null;

            if (!$jwt_token = JWTAuth::attempt($input)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 403);
            }

            return response()->json([
                'success' => true,
                "message" => "logged in successfully",
                'token' => $jwt_token,
            ]);
        } catch (\Throwable $th) {
            Log::alert("Login unsuccessfull => " . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to Login a User' . $th->getMessage()
            ], 500);
        }
    }

    // Logout

    public function logout(Request $request)
    {
        try {
            auth()->logout();
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out ' . $th->getMessage()
            ], 500);
        }
    }

    // Me

    public function me()
    {
        return response()->json(auth()->user());;
    }
}
