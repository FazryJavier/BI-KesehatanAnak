<?php

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
