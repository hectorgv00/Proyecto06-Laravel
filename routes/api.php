<?php

use App\Http\Controllers\PlayersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Players Routes

Route::get("/players",[PlayersController::class, "getAllPlayers"]);
Route::post('players/login',[PlayersController::class, "logInAPlayer"]);
Route::put('players/modify',[PlayersController::class, "modifyAPlayer"]);
Route::delete('players/modify',[PlayersController::class, "deleteAPlayer"]);