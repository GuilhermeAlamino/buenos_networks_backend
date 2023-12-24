<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\NotificationSendController;

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

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/store', [AuthController::class, 'store'])->name('store');
    Route::delete('/logout', [AuthController::class, 'delete'])->name('delete');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('index');
    Route::post('/store', [RegisterController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/edit', [ProfileController::class, 'update'])->name('update');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('can:isAdmin,App\Models\User');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit')->middleware('can:isAdmin,App\Models\User');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update')->middleware('can:isAdmin,App\Models\User');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete')->middleware('can:isAdmin,App\Models\User');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('can:isAdmin,App\Models\User');
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('can:isAdmin,App\Models\User');
    });

    Route::post('/subscribe', [NotificationSendController::class, 'store'])->name('subscribe');

    Route::get('/push', [NotificationSendController::class, 'push'])->name('push');
});
