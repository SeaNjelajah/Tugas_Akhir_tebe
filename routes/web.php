<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->group( function () {
    Route::view('/' , 'admin.dashboard.main')->name('dashboard');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/kamar', function() {
    return view('rooms-tariff');
})->name('kamar');

Route::get('/pengantar', function() {
    return view('introduction');
})->name('pengantar');

Route::get('/gallery', function() {
    return view('gallery');
})->name('gallery');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

