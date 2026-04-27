<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Halaman Home Inspirasional
        return view('welcome');
    }

    public function collections(Request $request)
    {
        // Halaman Katalog Buku
        $categories = Book::select('genre')->distinct()->pluck('genre')->filter()->values();
        $query = Book::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('genre', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('penulis', 'LIKE', "%{$search}%");
            });
        }

        $books = $query->latest()->get();
        
        return view('collections', compact('books', 'categories'));
    }

    // Fungsi baru untuk menampilkan detail satu buku
    public function show($id)
    {
        // Mencari buku berdasarkan ID, jika tidak ada akan memunculkan error 404
        $book = Book::findOrFail($id); 
        return view('buku.show', compact('book'));
    }
}