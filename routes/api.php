<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');



Route::middleware('auth:api')->group(function () {
    Route::post('/add-comment', 'App\Http\Controllers\CommentController@add');
});

Route::get('/get-comment', 'App\Http\Controllers\CommentController@all');
Route::get('/get-column-comment-id', 'App\Http\Controllers\CommentController@one');
Route::get('/get-user-id', 'App\Http\Controllers\UserController@one');
