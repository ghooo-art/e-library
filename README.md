# Pustaka Digital (Arvia Library)

Aplikasi perpustakaan digital berbasis Laravel 11: katalog buku, peminjaman dengan durasi (7 hari), dan ruang baca yang menampilkan PDF via streaming route terproteksi.

Dokumentasi teknis lebih detail: `docs/TECHNICAL_OVERVIEW.md`.

## Stack

- PHP 8.2 + Laravel 11
- Laravel Breeze (Blade + Alpine.js) untuk autentikasi dan layout dashboard
- Vite + Tailwind CSS untuk aset frontend
- Database default: SQLite (lihat `.env.example`)

## Fitur Utama

- Katalog publik
  - Halaman beranda menampilkan daftar buku (`GET /`)
  - Halaman detail buku (`GET /buku/{id}`)
- Autentikasi
  - Login, register, reset password, profile (scaffolding Breeze)
- Peminjaman
  - Pinjam buku 7 hari (`POST /buku/{id}/pinjam`)
  - Cegah pinjam dobel: user tidak bisa meminjam buku yang sama jika masih `status=Aktif`
- My Library (Dashboard)
  - Menampilkan daftar peminjaman milik user yang sedang login
- Ruang baca (terproteksi)
  - UI baca via `iframe` (`GET /buku/{id}/baca`)
  - PDF di-stream dari server (`GET /buku/{id}/stream`) setelah lolos pengecekan peminjaman

## Struktur Kode (Yang Paling Relevan)

- `routes/web.php`: routing katalog, peminjaman, ruang baca, dan dashboard
- `app/Http/Controllers/BookController.php`: list buku + detail buku
- `app/Http/Controllers/PeminjamanController.php`: membuat peminjaman + validasi akses baca + stream PDF
- `app/Models/Book.php`: model buku
- `app/Models/Peminjaman.php`: model peminjaman + relasi ke buku
- `database/migrations/*create_books_table.php`: tabel `books`
- `database/migrations/*create_peminjamen_table.php`: tabel `peminjamans`
- `resources/views/welcome.blade.php`: UI katalog
- `resources/views/buku/show.blade.php`: UI detail buku + tombol pinjam
- `resources/views/dashboard.blade.php`: UI rak buku (peminjaman user)
- `resources/views/buku/baca.blade.php`: UI ruang baca (iframe PDF)

## Setup Lokal

1. Install dependency backend: `composer install`
1. Install dependency frontend: `npm install`
1. Siapkan env: `cp .env.example .env` lalu `php artisan key:generate`
1. Migrasi database: `php artisan migrate`
1. Jalankan dev server:
   - Semua sekaligus: `composer run dev`
   - Atau terpisah: `php artisan serve` dan `npm run dev`

## Data Contoh (Seeder)

Ada `database/seeders/BookSeeder.php` (contoh buku) dan `DatabaseSeeder.php` (contoh user). Jika ingin mengisi buku contoh:

1. Pastikan file PDF tersedia di `storage/app/ebooks/` sesuai `file_path` (contoh: `storage/app/ebooks/laravel.pdf`).
1. Jalankan seeder buku: `php artisan db:seed --class=BookSeeder`.

## Catatan Teknis (Yang Perlu Kamu Tahu)

- `BookSeeder` belum dipanggil dari `DatabaseSeeder`.
- `app/Models/Book.php` belum mengatur `$fillable`/`$guarded`; `Book::create([...])` di seeder biasanya akan gagal tanpa itu.
- Validasi akses baca saat ini berbasis `status` peminjaman; belum ada proses otomatis yang mengubah status menjadi `Kedaluwarsa` ketika melewati `tanggal_jatuh_tempo`.
- Migration `create_peminjamen_table` bagian `down()` menjatuhkan tabel yang namanya tidak konsisten (typo).
- `config/filesystems.php` mengubah disk `local` root menjadi `storage/app/private`. Pastikan konsisten dengan lokasi `file_path` e-book yang kamu pakai.
