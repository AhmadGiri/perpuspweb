<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController; // Import PeminjamanController
use App\Http\Controllers\User\KatalogController;
use Illuminate\Support\Facades\Route;

// Redirect Halaman Utama ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Katalog Buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

// Route khusus Admin
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route CRUD Buku
    Route::resource('/admin/buku', BukuController::class, ['as' => 'admin']);

    // Route CRUD User / Anggota
    Route::resource('/admin/user', UserController::class, ['as' => 'admin']);

    // Route CRUD Transaksi Peminjaman
    Route::resource('/admin/peminjaman', PeminjamanController::class, ['as' => 'admin']);
    Route::patch('/admin/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.kembali');

    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route Katalog Buku untuk User
    Route::get('/dashboard', [KatalogController::class, 'index'])
        ->name('dashboard');

    // Route Peminjaman Buku
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])
        ->name('user.pinjam');

    // Route Pengembalian Buku
    Route::patch('/dashboard/kembali/{id}', [KatalogController::class, 'kembali'])
        ->name('user.kembali');
});


require __DIR__.'/auth.php';