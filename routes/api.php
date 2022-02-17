<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeskController;
use App\Http\Controllers\API\DeskListController;

Route::get('users', [UserController::class, 'index']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('desks', DeskController::class);
    Route::resource('desk-lists', DeskListController::class);
});
