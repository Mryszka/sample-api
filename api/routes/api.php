<?php

use App\Http\Controllers\UserController;
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

Route::get('/user', [UserController::class, 'index'])->middleware('auth:api');
Route::get('/user/{id}', [UserController::class, 'getOne'])->where('id', '[0-9]+');
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user/{id}',[UserController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/user/{id}',[UserController::class, 'delete'])->where('id', '[0-9]+');