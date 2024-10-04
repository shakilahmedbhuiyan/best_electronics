<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/country', App\Http\Controllers\api\CountryController::class)->name('country.search');
