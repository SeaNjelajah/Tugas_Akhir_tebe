<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasiController;
use App\Models\tbl_reservasi;
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

    Route::resource('kamar', 'App\Http\Controllers\KamarController');

    Route::resource('reservasi', 'App\Http\Controllers\ReservasiController');

    Route::prefix('reservasi')->name('reservasi.')->group( function () {
        Route::get('/check/in/{id}', [ReservasiController::class, 'check_in'])->name('check.in');
        Route::get('/payment/{id}', [ReservasiController::class, 'payment'])->name('payment');
        Route::get('/both/{id}', [ReservasiController::class, 'check_in_and_payment'])->name('check.in.payment');
    } );
    

    Route::view('/gallery', 'admin.gallery.main')->name('gallery');

    Route::view('/message', 'admin.contact_message.main')->name('contact-message');
});


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::put('/home/submit', [HomeController::class, 'homeSubmit'])->name('home.submit');

Route::get('/test', function () {
    
    $reservasi = tbl_reservasi::find(8);

    return view('selesai', compact('reservasi'));
});

Route::put('/kamar/keranjang/save', [HomeController::class, 'kamar_keranjang'])->name('keranjang');

Route::put('/selesai', [HomeController::class, 'selesai'])->name('selesai');




Route::get('/kamar', [HomeController::class, 'kamar_dan_biaya'])->name('kamar');

Route::get('/pengantar', [HomeController::class, 'pengantar'])->name('pengantar');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

Route::get('/room/{id}/detail', [HomeController::class, 'detail_kamar'])->name('kamar.detail');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

