<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [NewsController::class, 'index']); 

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('registerPost');
});

Route::middleware('auth')->group(function () {
    Route::get('/admins', function () {
        return view('admin.master');
    })->name('admin');
    
    Route::resource('categories', CategoryController::class);

    Route::get('/news', [newsController::class, 'adminIndex'])->name('NewsAdmin');
    Route::get('/news/create', [newsController::class, 'adminCreate'])->name('NewsCreate');
    Route::post('/news', [newsController::class, 'adminStore'])->name('NewsStore');
    Route::get('/news/{news}/edit', [newsController::class, 'adminEdit'])->name('admin.news.edit');
    Route::put('/news/{news}', [newsController::class, 'adminUpdate'])->name('admin.news.update');
    Route::delete('/news/{news}', [newsController::class, 'adminDestroy'])->name('admin.news.destroy');
    Route::post('/news/upload', [newsController::class, 'uploadImage'])->name('NewsUploadImage');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
