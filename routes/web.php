<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('/meja', MejaController::class);
    Route::resource('/menu', MenuController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/pesanan', PesananController::class);
    Route::get('/pesanan/{id}/total', [PesananController::class, 'getTotal'])->name('pesanan.getTotal');
    Route::resource('/pembayaran', PembayaranController::class);
    Route::get('pembayaran/bayar/{id}', [PembayaranController::class, 'bayar'])->name('pembayaran.bayar');
});
