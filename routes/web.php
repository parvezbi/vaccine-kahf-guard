<?php

use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;


Route::controller(VaccineController::class)->group(function () {
    Route::get('/', 'index')->name('welcome');
    Route::get('/registration', 'registration')->name('vaccine.registration');
    Route::get('/success', 'success')->name('vaccine.success');
    Route::post('/store', 'store')->name('vaccine.store');
    Route::get('/search', 'vaccineRegistrationCheck');
});

require __DIR__.'/auth.php';
