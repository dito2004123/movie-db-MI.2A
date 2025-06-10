<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use Illuminate\Auth\Events\Login;

Route::get('/',[MovieController::class, 'homePage']);

Route::get('movie/{id}/{slug}',[MovieController::class, 'detail']);

Route::get('create_movie', [MovieController::class, 'create'])->name('createMovie')->middleware('auth');

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');

Route::get('/login',[AuthController::class, 'LoginForm'])->name('login');

Route::post('/login',[AuthController::class,'Login']);

// ✅ Logout (sudah tidak merah lagi)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');
