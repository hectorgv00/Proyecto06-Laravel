<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PlayersController extends Controller
{

    // Get All Players

    public function getAllPlayers(){
        Log::info("Getting all Players");
        try {
            $players = DB::table('players')->get();

            return response([
                'success' => true,
                'message' => 'All players retrieved successfully',
                'data' => $players
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => "Players' info could not be gotten"
            ], 500);        }
    }

    // LogIn a Player

    public function logInAPlayer(Request $request){
        Log::info("loggin in a player");
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

            $newPlayer = new Player();
            $newPlayer -> username = $username;
            $newPlayer -> steamUsername = $steamUsername;
            $newPlayer -> email = $email;
            $newPlayer -> save();

            return response([
                'success' => true,
                'message' => 'Player created'
            ], 200);

        } catch (\Throwable $th) {
        Log::error("ERROR CREATING THE PLAYER".$th->getMessage());

        return response([
            'success' => false,
            'message' => 'Failed to create a player'.$th->getMessage()
        ], 500);
        }
    }


    // Modify a player

    public function modifyAPlayer(Request $request){
        Log::info("Player Modify");

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

    // Delete player

    public function deleteAPlayer(Request $request){
        try {
            Log::info("Deletting a player");

            $playerId = $request->input("id");
            
        } catch (\Throwable $th) {
            Log::info("Trying to delete a player but something went wrong ".$th->getMessage());
        }
    }

}
