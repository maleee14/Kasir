<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori
    Route::resource('/kategori', CategoryController::class);
    // Produk
    Route::resource('/produk', ProductController::class)->except('show');
    Route::get('/produk/barcode', [ProductController::class, 'cetakBarcode'])->name('cetak.barcode');
    // Member
    Route::resource('/member', MemberController::class);
    // Supplier
    Route::resource('/supplier', SupplierController::class);
    // Pengeluaran
    Route::resource('/pengeluaran', ExpenditureController::class);
    // Pembelian
    Route::resource('/pembelian', PurchaseController::class)->except('create');
    Route::get('/pembelian/create/{id}', [PurchaseController::class, 'create'])->name('pembelian.create');
    // Pembelian Detail
    Route::resource('/pembelian-detail', PurchaseDetailController::class);
    // Setting
    Route::resource('/setting', SettingController::class)->except('show', 'create', 'store', 'edit', 'destroy');
    // Penjualan
    Route::resource('/penjualan', SaleController::class);
    // Transaksi
    Route::resource('/transaksi', SaleDetailController::class);
    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/filter', [ReportController::class, 'filter'])->name('laporan.filter');
});

require __DIR__ . '/auth.php';
