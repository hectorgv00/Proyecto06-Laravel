<?php

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

Route::get("/users",[UsersController::class, "getAllUsers"]);
Route::post('users/login',[UsersController::class, "logInAUser"]);
Route::put('users/modify',[UsersController::class, "modifyAUser"]);
Route::delete('users/modify',[UsersController::class, "deleteAUser"]);