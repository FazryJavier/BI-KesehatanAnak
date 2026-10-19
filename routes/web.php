<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/kabar', [PageController::class, 'news']);
Route::get('/kabar/{slug}', [PageController::class, 'newsShow'])->name('news.show');
Route::get('/service', [PageController::class, 'services']);
Route::get('/looker', [PageController::class, 'looker']);
