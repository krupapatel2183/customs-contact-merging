<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contacts.list');
});

Route::resource('/contacts', ContactController::class);