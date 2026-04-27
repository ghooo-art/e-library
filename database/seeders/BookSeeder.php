<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Book::truncate();
        Schema::enableForeignKeyConstraints();

        // Create specific books
        Book::create([
            'judul' => 'Pemrograman Laravel 11',
            'penulis' => 'Arhan Ma\'arif',
            'genre' => 'Teknologi',
            'deskripsi' => 'Panduan lengkap membangun aplikasi web modern menggunakan Laravel 11.',
            'file_path' => 'ebooks/laravel.pdf',
        ]);

        Book::create([
            'judul' => 'Seni Merangkai Kode',
            'penulis' => 'Ghooo-Art',
            'genre' => 'Desain',
            'deskripsi' => 'Eksplorasi keindahan dalam penulisan kode yang bersih and efisien.',
            'file_path' => 'ebooks/seni.pdf',
        ]);

        // Create 200 random books
        Book::factory()->count(200)->create();
    }
}