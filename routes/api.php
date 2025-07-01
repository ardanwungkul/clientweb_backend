<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
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

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthController::class, 'getAuthenticatedUser']);

Route::middleware('auth:api')->group(function () {
    Route::get('todo', [TodoController::class, 'index']);
    Route::post('todo', [TodoController::class, 'store']);
    Route::put('todo/{todo}', [TodoController::class, 'update']);
    Route::delete('todo/{todo}', [TodoController::class, 'destroy']);
});
