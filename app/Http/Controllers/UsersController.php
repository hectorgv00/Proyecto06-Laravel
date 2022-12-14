<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{

    // Get All Users

    public function getAllUsers()
    {
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
            ], 500);
        }
    }


    // Delete User

    public function deleteAUser(Request $request)
    {
        Log::info("Deletting a User");
        try {

            $userIdToken = auth()->user()->id;

            $userId = $request->input("id");

            if($userIdToken !== $userId){
                return response([
                    'success' => false,
                    'message' => "You can only delete your account"
                ], 401);
            }

            $user = User::find($userId);


            if(!$user){
                response([
                    'success' => true,
                    'message' => "The user could not be found"
                ], 404);
            }

            $user->delete();

            return response([
                'success' => true,
                'message' => "You have deleted your account",
                "data" => $user
            ], 401);

        } catch (\Throwable $th) {
            Log::info("Trying to delete a User but something went wrong " . $th->getMessage());

            response([
                'success' => false,
                'message' => "Users could not be deleted => ".$th->getMessage()
            ], 500);
        }
    }

    // Modify a User

    public function modifyAUser(Request $request)
    {
        Log::info("User Modify");

        try {

            $user = auth()->user();

            $steamUsername = ($request->steamUsername !== null) ? $request->steamUsername : $user->steamUsername;
            $username = ($request->username !== null) ? $request->username : $user->username;

            $user->username = $username;
            $user->steamUsername = $steamUsername;

            $user->save();

            return response([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "User could not be updated" . $th->getMessage()
            ], 500);
        }
    }
}
