<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameServerController;

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

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthController::class, 'getAuthenticatedUser']);


Route::middleware('auth:api')->group(function () {

    //nameserver
    Route::apiResource('name-servers', NameServerController::class);

    // Todo
    Route::get('todo', [TodoController::class, 'index']);
    Route::post('todo', [TodoController::class, 'store']);
    Route::put('todo/{todo}', [TodoController::class, 'update']);
    Route::post('todo/update-order', [TodoController::class, 'updateOrder']);
    Route::post('todo/submit', [TodoController::class, 'submit']);
    Route::delete('todo/{todo}', [TodoController::class, 'destroy']);

    // User
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
});
