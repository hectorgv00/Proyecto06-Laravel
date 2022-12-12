<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class PartiesController extends Controller
{

    // Create a party

    public function createParty(Request $request)
    {

        Log::info("Creating a party");

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'game' => 'required|integer|max:255',
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $userToken = auth()->user();

            $user = Party::create([
                'name' => $request->get('name'),
                'game' => $request->get('game'),
                'owner' => $userToken->id,
            ]);

            $user->save();

            return response([
                'success' => true,
                'message' => "the party has been created successfully",
                "data" => $user
            ], 200);
        } catch (\Throwable $th) {
            Log::alert("The party could not be created");

            return response([
                'success' => false,
                'message' => "the party could not be created " . $th->getMessage(),
            ], 500);
        }
    }

    // Get all parties by videogame id

    public function findPartiesByVideogame($game){

        Log::info("Finding the parties by videogames");

        try {
            $party = DB::select( "SELECT * FROM parties WHERE game = {$game}" );

            return response([
                'success' => true,
                'message' => "the parties have been found",
                "data" => $party
            ], 200);
        } catch (\Throwable $th) {
            Log::alert("The parties could not be found");

            return response([
                'success' => false,
                'message' => "the party could not be created " . $th->getMessage(),
            ], 500);
        }

    }
}
