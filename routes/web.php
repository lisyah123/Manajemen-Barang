<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminRequestController;

// Route untuk Login & Logout
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard (dilindungi oleh middleware 'auth' bawaan Laravel)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});

// Route KHUSUS Super Admin
    Route::middleware(['role:super_admin'])->group(function () {
        // Ini akan otomatis membuatkan route untuk index, create, store, edit, update, dan destroy
        Route::resource('super_admin/categories', CategoryController::class);
        Route::resource('super_admin/users', UserController::class);
        Route::get('super_admin/reports/items', [ReportController::class, 'itemsReport'])->name('reports.index');
        Route::get('super_admin/reports/transactions', [ReportController::class, 'transactionsReport'])->name('reports.index2');
        Route::get('super_admin/reports/items/pdf', [ReportController::class, 'exportItemsPdf'])->name('print.index');
        Route::get('/super-admin/laporan-transaksi/pdf', [ReportController::class, 'exportTransactionsPdf'])->name('print.index2');
    });

    // Route KHUSUS Admin Gudang
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('admin/items', ItemController::class);
        Route::resource('admin/transactions', TransactionController::class)->only(['index', 'create', 'store']);
        // Route untuk Approval Permintaan Barang
        Route::get('/requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
        Route::post('/requests/{id}/approve', [AdminRequestController::class, 'approve'])->name('admin.requests.approve');
        Route::post('/requests/{id}/reject', [AdminRequestController::class, 'reject'])->name('admin.requests.reject');
    });

   // Route KHUSUS Pengguna (Staff)
    Route::middleware(['role:pengguna'])->group(function () {
        // Rute untuk melihat katalog
        Route::get('/katalog-barang', [ItemController::class, 'katalogPengguna'])->name('pengguna.items.index');
        
        // Rute untuk memproses form pengajuan (PASTIKAN BARIS INI ADA)
        Route::post('/katalog-barang/request', [StaffController::class, 'storeRequest'])->name('pengguna.request.store');
        
        // Rute untuk melihat riwayat (PASTIKAN BARIS INI ADA)
        Route::get('/riwayat-permintaan', [StaffController::class, 'index'])->name('pengguna.items.history');
    });