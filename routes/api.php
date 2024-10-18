<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

// Route existante pour récupérer l'utilisateur connecté
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register'])->name('users.register');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Routes pour les opérations CRUD sur les restaurant
Route::group(['prefix' => 'restaurant', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [RestaurantController::class, 'index']);
    Route::post('/', [RestaurantController::class, 'store']);
    Route::get('/{id}', [RestaurantController::class, 'show']);
    Route::put('/{id}', [RestaurantController::class, 'update']);
    Route::delete('/{id}', [RestaurantController::class, 'destroy']);
});
