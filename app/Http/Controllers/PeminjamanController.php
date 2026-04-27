<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon; // Library bawaan Laravel untuk memanipulasi waktu
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function store($id)
    {
        // 1. Cek apakah user sudah meminjam buku ini dan masih aktif (mencegah pinjam dobel)
        $cekPinjaman = Peminjaman::where('user_id', Auth::id())
                                 ->where('book_id', $id)
                                 ->where('status', 'Aktif')
                                 ->first();

        if ($cekPinjaman) {
            return redirect()->back()->with('error', 'Kamu masih dalam masa peminjaman buku ini.');
        }

        // 2. Jika aman, catat peminjaman baru ke database
        Peminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'tanggal_pinjam' => Carbon::now(), // Waktu saat ini
            'tanggal_jatuh_tempo' => Carbon::now()->addDays(7), // Jatuh tempo 7 hari ke depan
            'status' => 'Aktif',
        ]);

        // 3. Arahkan user ke halaman My Library (Dashboard) setelah sukses
        return redirect()->route('dashboard')->with('success', 'Buku berhasil dipinjam!');
    }
    // 1. Fungsi untuk menampilkan UI Ruang Baca
    public function baca($id)
    {
        // CEK KEAMANAN: Pastikan user login meminjam buku ini & statusnya Aktif
        $pinjaman = Peminjaman::with('book')
                    ->where('user_id', Auth::id())
                    ->where('book_id', $id)
                    ->where('status', 'Aktif')
                    ->first();

        // Jika tidak ada data atau sudah kedaluwarsa, tendang balik ke dashboard
        if (!$pinjaman) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak! Masa pinjam habis atau kamu belum meminjam buku ini.');
        }

        return view('buku.baca', compact('pinjaman'));
    }

    // 2. Fungsi untuk mengalirkan (stream) file PDF secara aman tanpa link publik
    public function streamFile($id)
    {
        $pinjaman = Peminjaman::with('book')
                    ->where('user_id', Auth::id())
                    ->where('book_id', $id)
                    ->where('status', 'Aktif')
                    ->first();

        if (!$pinjaman) {
            abort(403, 'Akses PDF Ditolak.');
        }

        // Ambil path file dari storage tersembunyi
        $path = storage_path('app/' . $pinjaman->book->file_path);

        if (!file_exists($path)) {
            abort(404, 'File E-book tidak ditemukan di server.');
        }

        // Tampilkan file langsung ke browser (bukan didownload)
        return response()->file($path);
    }
    public function kembalikan($id)
    {
        // 1. Cari data peminjaman berdasarkan ID
        // Keamanan: Pastikan hanya data milik user yang sedang login yang bisa diubah
        $peminjaman = \App\Models\Peminjaman::where('id', $id)
                                ->where('user_id', auth()->user()->id)
                                ->firstOrFail();

        // 2. Pastikan statusnya masih 'Aktif'
        if ($peminjaman->status === 'Aktif') {
            $peminjaman->update([
                'status' => 'Dikembalikan' // Ubah statusnya
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan. Terima kasih!');
        }

        return redirect()->back()->with('error', 'Buku ini sudah dikembalikan atau kedaluwarsa.');
    }
}