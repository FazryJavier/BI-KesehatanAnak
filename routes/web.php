<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LookerStudioController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $aboutController = app()->make(AboutUsController::class);
    $aboutContent = $aboutController->showContent();

    $lookerController = app()->make(LookerStudioController::class);
    $lookerContent = $lookerController->showContent();

    return view('User.index', [
        'aboutContent' => $aboutContent,
        'lookerContent' => $lookerContent,
    ]);
});

Route::get('/about', function () {
    $aboutController = app()->make(AboutUsController::class);
    $aboutContent = $aboutController->showContent();

    return view('User.about', [
        'aboutContent' => $aboutContent,
    ]);
});

Route::get('/service', function () {
    return view('User.service');
});

Route::get('/looker', function () {
    $lookerController = app()->make(LookerStudioController::class);
    $lookerContent = $lookerController->showContent();

    return view('User.looker', [
        'lookerContent' => $lookerContent,
    ]);
});

Route::get('/Admin', [UserController::class, 'index'])->name('Admin');
Route::post('/Admin', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/Regis', [RegistrationController::class, 'index'])->name('Regis');
Route::post('/Regis', [RegistrationController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // About Us
    Route::get('/AboutUs', [AboutUsController::class, 'index']);
    Route::get('/AboutUs/create', [AboutUsController::class, 'create']);
    Route::post('/AboutUs', [AboutUsController::class, 'store']);
    Route::get('/AboutUs/{id}/update', [AboutUsController::class, 'edit']);
    Route::put('/AboutUs/{id}', [AboutUsController::class, 'update']);
    Route::delete('/AboutUs/{id}', [AboutUsController::class, 'destroy']);

    // Looker Studio
    Route::get('/LookerStudio', [LookerStudioController::class, 'index']);
    Route::get('/LookerStudio/create', [LookerStudioController::class, 'create']);
    Route::post('/LookerStudio', [LookerStudioController::class, 'store']);
    Route::get('/LookerStudio/{id}/update', [LookerStudioController::class, 'edit']);
    Route::put('/LookerStudio/{id}', [LookerStudioController::class, 'update']);
    Route::delete('/LookerStudio/{id}', [LookerStudioController::class, 'destroy']);

    // Info Admin
    Route::get('/InfoAdmin', [UserController::class, 'infoAdmin']);
    Route::get('/InfoAdmin/create', [UserController::class, 'create']);
    Route::post('/InfoAdmin', [UserController::class, 'store']);
});
