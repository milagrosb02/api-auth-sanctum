<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


// Defino rutas
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Hago uso del middleware
Route::group(['middleware' => ["auth:sanctum"]], function(){

    // Rutas para perfil de usuario y logout
    

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
