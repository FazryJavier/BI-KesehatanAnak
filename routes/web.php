<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User.index');
});

Route::get('/about', function () {
    return view('User.about');
});

Route::get('/service', function () {
    return view('User.service');
});

Route::get('/contact', function () {
    return view('User.contact');
});

Route::get('/Admin', [UserController::class, 'index'])->name('Admin');
Route::post('/Admin', [UserController::class, 'authenticate']);

Route::get('/Regis', [RegistrationController::class, 'index'])->name('Regis');
Route::post('/Regis', [RegistrationController::class, 'store']);
