<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\RiwayatController;
use App\Models\tbl_reservasi;

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

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group( function () {

    Route::redirect('/', '/admin/dashboard');

    Route::resource('dashboard', 'App\Http\Controllers\DashboardController');

    Route::resource('kamar', 'App\Http\Controllers\KamarController');

    Route::resource('fasilitas', 'App\Http\Controllers\FasilitasKamarController');

    Route::resource('reservasi', 'App\Http\Controllers\ReservasiController');


    Route::resource('riwayat', 'App\Http\Controllers\RiwayatController');
    
    Route::prefix('gallery')->name('gallery.')->group( function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::post('/save', [GalleryController::class, 'save'])->name('save');
    });

    Route::resource('contact', 'App\Http\Controllers\ContactMessageController');

    Route::resource('daftarTamu', 'App\Http\Controllers\DaftarTamuController');
    Route::prefix('daftarTamu')->name('daftarTamu.')->group( function () {
        Route::get('/{id}/checkout', [RiwayatController::class, 'checkout'])->name('checkout');
    } );

    Route::resource('laporanKeuangan', 'App\Http\Controllers\LaporanKeuanganController');
    
    Route::resource('UsersAdmin', 'App\Http\Controllers\UsersAdminController');
    

    Route::prefix('reservasi')->name('reservasi.')->group( function () {
        Route::get('/check/in/{id}', [ReservasiController::class, 'check_in'])->name('check.in');
        Route::get('/payment/{id}', [ReservasiController::class, 'payment'])->name('payment');
        Route::get('/both/{id}', [ReservasiController::class, 'check_in_and_payment'])->name('check.in.payment');
        Route::get('/batalkan/{id}', [ReservasiController::class, 'batalkan'])->name('batalkan');
        Route::put('/simpan/kode/kamar/{id}', [ReservasiController::class, 'pilih_kode_kamar'])->name('simpan.kode.kamar');
    } );
    
});


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::put('/home/submit', [HomeController::class, 'homeSubmit'])->name('home.submit');

Route::put('/kamar/submit', [HomeController::class, 'kamarSubmit'])->name('kamar.submit');

Route::get('/test', function () {
    
    $reservasi = tbl_reservasi::find(8);

    return view('selesai', compact('reservasi'));
});

Route::put('/kamar/keranjang/save', [HomeController::class, 'kamar_keranjang'])->name('keranjang');

Route::put('/selesai', [HomeController::class, 'selesai'])->name('selesai');

Route::get('/ulang', [HomeController::class, 'ulang'])->name('ulang');


Route::get('/kamar', [HomeController::class, 'kamar_dan_biaya'])->name('kamar');

Route::get('/pengantar', [HomeController::class, 'pengantar'])->name('pengantar');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

Route::get('/room/{id}/detail', [HomeController::class, 'detail_kamar'])->name('kamar.detail');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::post('/contact/save', [HomeController::class, 'contact_save'])->name('contact.save');


require __DIR__.'/auth.php';
