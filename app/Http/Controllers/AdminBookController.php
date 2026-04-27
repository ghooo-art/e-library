<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua genre unik untuk filter
        $categories = Book::select('genre')->distinct()->pluck('genre')->filter()->values();
        
        // Mulai query buku
        $query = Book::query();

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('genre', $request->category);
        }

        // Fitur Pencarian (Judul atau Penulis)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('penulis', 'LIKE', "%{$search}%");
            });
        }

        $books = $query->latest()->get();
        
        // Mengarahkan ke file view admin/dashboard.blade.php
        return view('admin.dashboard', compact('books', 'categories'));
    }
    // Menampilkan halaman form
    public function create()
    {
        return view('admin.create');
    }

    // Memproses data yang dikirim dari form
    public function store(Request $request)
    {
        // 1. Validasi input: pastikan data tidak kosong dan file harus PDF
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'file_ebook' => 'required|mimes:pdf|max:10000', // Maksimal 10MB
        ]);

        // 2. Simpan file PDF ke folder rahasia 'storage/app/ebooks'
        // Fungsi store() ini otomatis membuat nama file acak yang unik agar aman
        $pathPdf = $request->file('file_ebook')->store('ebooks');

        // 3. Masukkan data ke database MySQL
        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'genre' => $request->genre,
            'file_path' => $pathPdf, 
        ]);

        // 4. Kembalikan admin ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Buku baru berhasil diunggah!');
    }
    // 1. Menampilkan form Edit dengan data buku lama
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.edit', compact('book'));
    }

    // 2. Memproses perubahan data dari form Edit
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'file_ebook' => 'nullable|mimes:pdf|max:10000', // nullable karena admin tidak wajib ganti PDF
        ]);

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'genre' => $request->genre,
        ];

        // Jika admin mengupload PDF baru, hapus yang lama, ganti yang baru
        if ($request->hasFile('file_ebook')) {
            Storage::delete($book->file_path); // Hapus PDF lama
            $data['file_path'] = $request->file('file_ebook')->store('ebooks'); // Simpan PDF baru
        }

        $book->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Data buku berhasil diperbarui!');
    }

    // 3. Menghapus buku (Data di Database + File PDF fisiknya)
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        // Hapus file fisik PDF-nya dari folder storage
        Storage::delete($book->file_path);
        
        // Hapus data dari tabel database
        $book->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Buku dan file e-book berhasil dihapus!');
    }
    public function monitoring()
    {
        // Mengambil semua data peminjaman, diurutkan dari yang terbaru
        // with(['user', 'book']) berfungsi agar loading data lebih cepat (Eager Loading)
        $semuaPeminjaman = \App\Models\Peminjaman::with(['user', 'book'])
                            ->latest()
                            ->get();

        return view('admin.monitoring', compact('semuaPeminjaman'));
    }
    // Fungsi VVIP agar Admin bisa melihat isi PDF di browser
    public function viewPdf($id)
    {
        $book = Book::findOrFail($id);
        
        // Mencari lokasi file asli di dalam folder storage
        $path = storage_path('app/' . $book->file_path);

        // Jika file tidak ada, tampilkan error 404
        if (!file_exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        // Tampilkan PDF langsung di browser
        return response()->file($path);
    }
}