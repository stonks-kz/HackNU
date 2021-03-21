<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
Route::post('registration', [\App\Http\Controllers\Api\Auth\LoginController::class, 'registration']);
Route::post('profileChange', [\App\Http\Controllers\Api\Auth\LoginController::class, 'profileChange']);

Route::get('tagList' , [\App\Http\Controllers\Api\ApiHandler::class, 'getTagList']);
Route::post('addPost' , [\App\Http\Controllers\Api\ApiHandler::class, 'addPost']);
Route::get('profileGetPosts' , [\App\Http\Controllers\Api\ApiHandler::class, 'profileGetPosts']);

Route::get('getPostById/{id}' , [\App\Http\Controllers\Api\ApiHandler::class, 'getPostById']);

Route::get('getUserData/{id}' , [\App\Http\Controllers\Api\ApiHandler::class, 'getUserData']);

Route::post('setComment' , [\App\Http\Controllers\Api\ApiHandler::class, 'setComment']);

Route::get('getComments/{id}' , [\App\Http\Controllers\Api\ApiHandler::class, 'getComments']);

Route::get('getAllPosts' , [\App\Http\Controllers\Api\ApiHandler::class, 'getAllPosts']);

Route::post('addLikeC' , [\App\Http\Controllers\Api\ApiHandler::class, 'addLikeC']);

Route::post('addDLikeC' , [\App\Http\Controllers\Api\ApiHandler::class, 'addDLikeC']);

Route::post('likePost' , [\App\Http\Controllers\Api\ApiHandler::class, 'likePost']);

Route::post('dislikePost' , [\App\Http\Controllers\Api\ApiHandler::class, 'dislikePost']);
