<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'level:1'], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Pengeluaran
        Route::resource('/pengeluaran', ExpenditureController::class);
        // Setting
        Route::resource('/setting', SettingController::class)->except('show', 'create', 'store', 'edit', 'destroy');
        // Laporan
        Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/filter', [ReportController::class, 'filter'])->name('laporan.filter');
        Route::get('/laporan/pdf', [ReportController::class, 'exportPDF'])->name('laporan.pdf');
        // User
        Route::resource('/user', UserController::class)->except('show');
    });

    Route::group(['middleware' => 'level:1,2'], function () {
        // Kategori
        Route::resource('/kategori', CategoryController::class);
        // Produk
        Route::resource('/produk', ProductController::class)->except('show');
        Route::get('/produk/barcode', [ProductController::class, 'cetakBarcode'])->name('cetak.barcode');
        // Member
        Route::resource('/member', MemberController::class);
        // Supplier
        Route::resource('/supplier', SupplierController::class);
        // Pembelian
        Route::resource('/pembelian', PurchaseController::class)->except('create');
        Route::get('/pembelian/create/{id}', [PurchaseController::class, 'create'])->name('pembelian.create');
        // Pembelian Detail
        Route::resource('/pembelian-detail', PurchaseDetailController::class);
        // Penjualan
        Route::resource('/penjualan', SaleController::class);
        // Transaksi
        Route::resource('/transaksi', SaleDetailController::class);
        // User
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.update_profile');
    });
});

require __DIR__ . '/auth.php';
