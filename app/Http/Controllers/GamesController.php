<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GamesController extends Controller
{
    //

    // Create a game

public function createAGame(Request $request){
   Log::info("Creating a game");

   try {

    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'thumbnailUrl' => 'required|string|max:255',
        'url' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response([
            'success' => false,
            'message' => $validator->messages()
        ], 400);
    }

    
    $userId = auth()->user()->id;
    $gameTitle = $request->title;
    $thumbnailUrl = $request->thumbnailUrl;
    $url = $request->url;
    


    $game = Game::create([
        'createdBy' => $userId,
        'title' => $gameTitle,
        'thumbnail_url' => $thumbnailUrl,
        'url' => $url,
    ]);

    $game->save();

    return response([
        'success' => true,
        'message' => "the game has been created successfully",
        "data" => $game
    ], 200);

} catch (\Throwable $th) {
    return response([
        'success' => false,
        'message' => "the game could not be created => ".$th->getMessage(),
    ], 500);
   }
}

}
