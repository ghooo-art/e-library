<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController; // Cukup panggil satu kali di atas
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminBookController; // Tambahkan ini untuk rute admin
// Rute Publik
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/collections', [BookController::class, 'collections'])->name('collections');
Route::get('/buku/{id}', [BookController::class, 'show'])->name('buku.show');

// Rute Terproteksi (Hanya bisa diakses jika sudah login)
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk memproses pengembalian buku
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
  // Rute memproses peminjaman
    Route::post('/buku/{id}/pinjam', [PeminjamanController::class, 'store'])->name('buku.pinjam');
Route::get('/buku/{id}/baca', [PeminjamanController::class, 'baca'])->name('buku.baca');
    Route::get('/buku/{id}/stream', [PeminjamanController::class, 'streamFile'])->name('buku.stream');
   // GANTI rute dashboard yang lama dengan ini:
    Route::get('/dashboard', function (Illuminate\Http\Request $request) {
        // Mengambil data peminjaman milik user yang sedang login
        $query = App\Models\Peminjaman::with('book')
                        ->where('user_id', Illuminate\Support\Facades\Auth::id());
        
        // Fitur Pencarian di My Shelf
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('book', function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('penulis', 'LIKE', "%{$search}%");
            });
        }
                        
        $peminjamans = $query->orderBy('created_at', 'desc')->get();
                        
        return view('dashboard', compact('peminjamans'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ZONA ADMIN (Hanya bisa diakses oleh role 'admin')
// ZONA ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminBookController::class, 'index'])->name('dashboard');
    
    // Rute untuk menampilkan form tambah buku
    Route::get('/buku/create', [AdminBookController::class, 'create'])->name('buku.create');
    
    // Rute untuk memproses data form dan file PDF yang diupload
    Route::post('/buku', [AdminBookController::class, 'store'])->name('buku.store');
    Route::get('/buku/{id}/edit', [AdminBookController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [AdminBookController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [AdminBookController::class, 'destroy'])->name('buku.destroy');
// Rute memantau transaksi peminjaman
    Route::get('/monitoring', [AdminBookController::class, 'monitoring'])->name('monitoring');
    // Rute untuk Admin melihat PDF
    Route::get('/buku/{id}/pdf', [AdminBookController::class, 'viewPdf'])->name('buku.pdf');
});
require __DIR__.'/auth.php';