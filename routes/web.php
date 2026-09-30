 <?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\User\KatalogController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return redirect()->route('login');
});

// Admin
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Buku
        Route::resource('/buku', BukuController::class);

        // User
        Route::resource('/user', UserController::class);

        // Peminjaman
        Route::resource('/peminjaman', PeminjamanController::class);

        // Pengembalian
        Route::patch(
            '/peminjaman/{peminjaman}/kembali',
            [PeminjamanController::class, 'updateStatus']
        )->name('peminjaman.kembali');
    });

// User
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [KatalogController::class, 'index'])
        ->name('dashboard');

    // Pinjam
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])
        ->name('user.pinjam');

    // Kembalikan
    Route::patch('/dashboard/kembali/{id}', [KatalogController::class, 'kembali'])
        ->name('user.kembali');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Katalog
Route::get('/buku', [BukuController::class, 'index'])
    ->name('buku.index');

// Auth
require __DIR__.'/auth.php';
