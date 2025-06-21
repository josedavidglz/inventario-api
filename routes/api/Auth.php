<?php

use Illuminate\Support\Facades\Route;

Route::post('login', function () {
    return response()->json('login');
});

Route::post('register', function () {
    return response()->json('register');
});