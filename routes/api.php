<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\UsersController;
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

// Users Routes

Route::get("/users", [UsersController::class, "getAllUsers"]);

// Auth Routes

Route::post('users/register', [AuthController::class, 'register']);
Route::post('users/login', [AuthController::class, 'login']);

// Auth
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::delete('users/delete', [UsersController::class, "deleteAUser"]);
    Route::post('users/logout', [AuthController::class, 'logout']);
    Route::get('users/me', [AuthController::class, 'me']);
    Route::put('users/modify', [UsersController::class, "modifyAUser"]);
});

// Parties
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('party/create', [PartiesController::class, 'createParty']);
    Route::get('party/findByVideogame/{game}', [PartiesController::class, 'findPartiesByVideogame']);
    Route::get('party/{name}', [PartiesController::class, 'getMessagesFromAParty']);
    Route::post('party/join/', [PartiesController::class, 'joinAPartyById']);
    Route::post('party/leave/', [PartiesController::class, 'leaveAPartyById']);
});

// Messages
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('message/create', [MessagesController::class, 'createMessage']);
    Route::delete('message/delete', [MessagesController::class, "deleteAMessage"]);
    Route::put('message/modify', [MessagesController::class, "modifyAMessage"]);

});