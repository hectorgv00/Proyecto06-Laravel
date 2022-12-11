<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    // Get All Users

    public function getAllUsers(){
        Log::info("Getting all Users");
        try {
            $Users = DB::table('users')->get();

            return response([
                'success' => true,
                'message' => 'All Users retrieved successfully',
                'data' => $Users
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => "Users' info could not be gotten"
            ], 500);        }
    }

    // LogIn a User

    public function logInAUser(Request $request){
        Log::info("loggin in a user");
        try {
            $validator = Validator::make($request -> all(), [
               "username"=> ["required", "max:20"],
               "steamUsername"=> ["required", "max:20"],
               "email"=> ["required", "max:50"],

            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $username = $request->input('username');
            $steamUsername = $request->input('steamUsername');
            $email = $request->input('email');

            $newUser = new User();
            $newUser -> username = $username;
            $newUser -> steamUsername = $steamUsername;
            $newUser -> email = $email;
            $newUser -> save();

            return response([
                'success' => true,
                'message' => 'User created'
            ], 200);

        } catch (\Throwable $th) {
        Log::error("ERROR CREATING THE User".$th->getMessage());

        return response([
            'success' => false,
            'message' => 'Failed to create a User'.$th->getMessage()
        ], 500);
        }
    }


    // Modify a User

    public function modifyAUser(Request $request){
        Log::info("User Modify");

        try {
            $validator = Validator::make($request -> all(), [
                "username"=> ["required", "max:20"],
                "steamUsername"=> ["required", "max:20"],
                "email"=> ["required", "max:50"],
 
             ]);

             if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    // Delete User

    public function deleteAUser(Request $request){
        try {
            Log::info("Deletting a User");

            $UserId = $request->input("id");
            
        } catch (\Throwable $th) {
            Log::info("Trying to delete a User but something went wrong ".$th->getMessage());
        }
    }

}
