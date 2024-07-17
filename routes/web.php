<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\SatuanProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MetodeMooraController;
use App\Http\Controllers\MetodeBWMController;

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
// Route::get('/', function () {
//     return view('admin/layout');
// });


/* API */
Route::get('selectKota', [APIController::class, 'kota'])->name('kota.index');
Route::post('selectKecamatan', [APIController::class, 'kecamatan'])->name('selectKecamatan');


/* Login dan Register */
Route::get('login', [AuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('register', [AuthController::class, 'register'])->middleware('alreadyLoggedIn');
Route::post('login/store', [AuthController::class, 'loginStore']);
Route::post('register/store', [AuthController::class, 'registerStore']);
Route::post('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'isLoggedIn'], function() {

  /* Dashboard */
  Route::get('/', [AuthController::class, 'dashboard']);

  
    /* Admin */
    Route::get('admin', [AdminController::class, 'index']);
    // Route::get('admin', function () { return view('admin/layout'); });
    Route::post('admin/profil/store', [AdminController::class, 'store']);
    Route::put('admin/profil/update/{id}', [AdminController::class, 'update']);

    /* Admin - Kriteria */
    Route::get('admin/kriteria', [KriteriaController::class, 'index']);
    Route::get('admin/kriteria/baru', [KriteriaController::class, 'baru']);
    Route::post('admin/kriteria/store', [KriteriaController::class, 'store']);
    Route::get('admin/kriteria/edit/{id}', [KriteriaController::class, 'edit']);
    Route::put('admin/kriteria/update/{id}', [KriteriaController::class, 'update']);
    Route::delete('admin/kriteria/delete/{id}', [KriteriaController::class, 'delete']);

    /* Admin - Supplier */
    Route::get('admin/supplier', [SupplierController::class, 'index']);
    Route::get('admin/supplier/baru', [SupplierController::class, 'baru']);
    Route::post('admin/supplier/store', [SupplierController::class, 'store']);
    Route::get('admin/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::put('admin/supplier/update/{id}', [SupplierController::class, 'update']);
    Route::delete('admin/supplier/delete/{id}', [SupplierController::class, 'delete']);

    /* Admin - Kategori Produk */
    Route::get('admin/kategoriproduk', [KategoriProdukController::class, 'index']);
    Route::get('admin/kategoriproduk/baru', [KategoriProdukController::class, 'baru']);
    Route::post('admin/kategoriproduk/store', [KategoriProdukController::class, 'store']);
    Route::get('admin/kategoriproduk/edit/{id}', [KategoriProdukController::class, 'edit']);
    Route::put('admin/kategoriproduk/update/{id}', [KategoriProdukController::class, 'update']);
    Route::delete('admin/kategoriproduk/delete/{id}', [KategoriProdukController::class, 'delete']);
    
    /* Admin - Satuan Produk */
    Route::get('admin/satuanproduk', [SatuanProdukController::class, 'index']);
    Route::get('admin/satuanproduk/baru', [SatuanProdukController::class, 'baru']);
    Route::post('admin/satuanproduk/store', [SatuanProdukController::class, 'store']);
    Route::get('admin/satuanproduk/edit/{id}', [SatuanProdukController::class, 'edit']);
    Route::put('admin/satuanproduk/update/{id}', [SatuanProdukController::class, 'update']);
    Route::delete('admin/satuanproduk/delete/{id}', [SatuanProdukController::class, 'delete']);

    /* Admin - Produk */
    Route::get('admin/produk', [ProdukController::class, 'index']);
    Route::get('admin/produk/baru', [ProdukController::class, 'baru']);
    Route::post('admin/produk/store', [ProdukController::class, 'store']);
    Route::get('admin/produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::put('admin/produk/update/{id}', [ProdukController::class, 'update']);
    Route::delete('admin/produk/delete/{id}', [ProdukController::class, 'delete']);

    /* Admin - Penilaian */
    Route::get('admin/metode-moora', [MetodeMooraController::class, 'index']);
    Route::post('admin/metode-moora', [MetodeMooraController::class, 'searchPost']);
    Route::get('admin/metode-moora/{id}/detail', [MetodeMooraController::class, 'detail']);
    Route::get('admin/metode-bwm', [MetodeBWMController::class, 'index']);
    Route::post('admin/metode-bwm', [MetodeBWMController::class, 'import_excel']);
    Route::get('admin/metode-bwm/download-template', [MetodeBWMController::class, 'download_template']);
  
});