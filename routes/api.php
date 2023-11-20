<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


// Defino rutas
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Hago uso del middleware
// En estos metodos necesito el token
Route::group(['middleware' => ["auth:sanctum"]], function(){

    // Rutas para perfil de usuario y logout
    Route::get('user-profile', [UserController::class, 'profile']);

    Route::get('logout', [UserController::class, 'logout']);

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
