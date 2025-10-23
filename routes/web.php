<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Dashboard sebagai halaman utama
Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

// Login (GET menampilkan form, POST meng-handle login)
Route::match(['get','post'], '/login', [PageController::class, 'login'])->name('login');

// Pengelolaan (index + crud via session)
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
Route::get('/pengelolaan/create', [PageController::class, 'create'])->name('pengelolaan.create');
Route::post('/pengelolaan/store', [PageController::class, 'store'])->name('pengelolaan.store');
Route::get('/pengelolaan/{id}/edit', [PageController::class, 'edit'])->name('pengelolaan.edit');
Route::post('/pengelolaan/{id}/update', [PageController::class, 'update'])->name('pengelolaan.update');
Route::post('/pengelolaan/{id}/delete', [PageController::class, 'destroy'])->name('pengelolaan.destroy');

// Profile
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Logout (simple: redirect to dashboard without username)
Route::get('/logout', function () {
    return redirect()->route('dashboard');
})->name('logout');
