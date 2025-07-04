<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contacts.list');
});

Route::get('/contacts/get-data', [ContactController::class, 'getContactData'])->name('contacts.get-data');
Route::get('/contacts/add-form', [ContactController::class, 'addConatctForm'])->name('contacts.add-form');

Route::resource('/contacts', ContactController::class);