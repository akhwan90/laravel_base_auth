<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TelegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'front']);
Route::post('/telegram', [TelegramController::class, 'webhook']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerStore']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProccess']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/resetPassword', [AuthController::class, 'resetPassword']);
    Route::post('/resetPassword', [AuthController::class, 'resetPasswordProccess']);
    
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/themesChange', [AuthController::class, 'themesChange']);

});


require __DIR__ . '/admin.php';