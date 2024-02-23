<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\LoginController;
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
// Login Route
Route::post('login',[LoginController::class,'login']);

Route::group(['middleware' => ['api.auth','cros']], function ($router) {
    // Login Route
    Route::post('logout',[LoginController::class,'logout']);
    Route::post('refresh',[LoginController::class,'refresh']);
    Route::post('me',[LoginController::class,'me']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
