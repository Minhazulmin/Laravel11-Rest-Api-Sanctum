<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get( '/user', function ( Request $request ) {
    return $request->user();
} )->middleware( 'auth:sanctum' );

Route::get( '/', function () {
    return 'API Alive';
} );

Route::apiResource( 'posts', PostController::class );

// Register and login api
Route::post( 'register', [AuthController::class, 'register'] );
Route::post( 'login', [AuthController::class, 'login'] );

// Logout api
Route::post( 'logout', [AuthController::class, 'logout'] )->middleware( 'auth:sanctum' );