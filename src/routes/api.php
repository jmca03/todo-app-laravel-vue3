<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * |--------------------------------------------------
 * | Health check
 * |--------------------------------------------------
 * 
 * Determine if the api is reachable via http request
 */
Route::get('health-check', fn () => Response::json([
    'statusCode' => 200,
    'message' => 'Server is healthy',
    'data' => [
        'timestamp' => now()->format('Y-m-d H:i:s')
    ]
]));

/**
 * |--------------------------------------------------
 * | Authorization Route
 * |--------------------------------------------------
 */
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});


Route::middleware('auth:api')->group(function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('todo', TodoController::class);
});
