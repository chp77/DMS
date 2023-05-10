<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

route::get('/register', [LoginController::class, 'register'])->name('register');
route::post('/register/user', [LoginController::class, 'registeruser'])->name('registeruser');
route::get('/login', [LoginController::class, 'login'])->name('login');
route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/{any}', [\App\Http\Controllers\DashboardController::class, 'index'])->where('any', '.*');
});