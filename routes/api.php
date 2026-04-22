<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryService;
use App\Http\Controllers\Api\NewsService;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryService::class, 'index']);
    Route::get('/{id}', [CategoryService::class, 'show']);
    Route::post('/', [CategoryService::class, 'store']);
    Route::put('/{id}', [CategoryService::class, 'update']);
    Route::delete('/{id}', [CategoryService::class, 'destroy']);
});

Route::prefix('news')->group(function () {
    Route::get('/', [NewsService::class, 'index']);      
    Route::get('/{id}', [NewsService::class, 'show']);   
    Route::post('/', [NewsService::class, 'store']);     
    Route::put('/{id}', [NewsService::class, 'update']); 
    Route::delete('/{id}', [NewsService::class, 'destroy']); 
});