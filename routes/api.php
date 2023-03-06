<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login' , [AuthController::class , 'login']);
Route::post('/register' , [AuthController::class , 'register']);
Route::post('/logout' , [AuthController::class , 'logout']);
//middleware('auth:sanctum')->
Route::prefix('v1')->middleware('auth:sanctum')->group(function (){ // كل اروابط تكون محمية من ال token
    // Route::get('products' , function(){
    //     return 'ddd';
    // });
    Route::apiResource('products' , ProductController::class);
    Route::apiResource('categories' , CategoryController::class);
});

