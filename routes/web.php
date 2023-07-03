<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MbarangController;
use App\Http\Controllers\MsuplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengambilanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/do-login',[LoginController::class,'authenticate'])->name('do.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::resource('user',UserController::class);
    Route::resource('banner',BannerController::class);
    Route::resource('barang',MbarangController::class);
    Route::resource('suplier',MsuplierController::class);
    Route::resource('pengambilan',PengambilanController::class);
    Route::resource('pembelian',PembelianController::class);

    Route::get('report-stok',[ReportController::class,'index'])->name('report-stok');
    Route::get('report-pembelian',[ReportController::class,'indexpembelian'])->name('report-pembelian');
    Route::get('filter-pembelian/{start}/{end}',[ReportController::class,'filterpembelian']);
    Route::get('filter-pembelian-barang/{barang_id}',[ReportController::class,'filterpembelianbarang']);
    Route::get('report-pengambilan',[ReportController::class,'indexpengambilan'])->name('report-pengambilan');
    Route::get('filter-pengambilan/{start}/{end}',[ReportController::class,'filterpengambilan']);
    Route::get('filter-pengambilan-barang/{barang_id}',[ReportController::class,'filterpengambilanbarang']);

});
