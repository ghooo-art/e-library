# Pustaka Digital (Arvia Library) \- Technical Overview

Dokumen ini merangkum apa yang sudah ada di project ini berdasarkan isi workspace saat ini (Laravel 11 + Breeze).

## Ringkasan Cepat

Project ini adalah perpustakaan digital sederhana dengan tiga alur utama:

1. Katalog publik: user bisa melihat daftar buku dan detail buku tanpa login.
1. Peminjaman: user login bisa meminjam buku (durasi 7 hari) dan melihat daftar pinjamannya di dashboard.
1. Ruang baca: user login yang masih punya peminjaman aktif bisa membuka PDF lewat halaman baca (PDF di-stream dari server via route terproteksi).

## Stack & Tooling

1. Backend: Laravel 11 (`laravel/framework`), PHP ^8.2
1. Auth scaffolding: Laravel Breeze (Blade + Alpine.js)
1. Frontend build: Vite (`laravel-vite-plugin`)
1. Styling: Tailwind CSS + `@tailwindcss/forms`
1. DB default (env example): SQLite

File penting:

1. `composer.json`: dependency PHP + script `composer run dev` (server/queue/log/vite).
1. `package.json`: script `npm run dev` dan `npm run build`.
1. `vite.config.js`, `tailwind.config.js`, `postcss.config.js`: pipeline aset.

## Struktur Folder (Yang Dipakai)

1. `routes/`: definisi endpoint web (`web.php`) dan auth (`auth.php`).
1. `app/Http/Controllers/`: logika katalog (`BookController`) dan peminjaman/baca (`PeminjamanController`).
1. `app/Models/`: entity `Book`, `Peminjaman`, `User`.
1. `database/migrations/`: skema tabel.
1. `database/seeders/`: seeder contoh.
1. `resources/views/`: UI Blade (katalog, detail, dashboard, baca).

## Data Model

### `books`

Dibuat oleh migration `database/migrations/2026_04_25_114843_create_books_table.php`.

Kolom:

1. `id`
1. `judul` (string)
1. `penulis` (string)
1. `genre` (string)
1. `deskripsi` (text, nullable)
1. `cover_image` (string, nullable)
1. `file_path` (string) \- path relatif file e-book di storage
1. timestamps

Model: `app/Models/Book.php` (saat ini masih minimal).

### `peminjamans`

Dibuat oleh migration `database/migrations/2026_04_25_114857_create_peminjamen_table.php`.

Kolom:

1. `id`
1. `user_id` (FK `users`)
1. `book_id` (FK `books`)
1. `tanggal_pinjam` (datetime)
1. `tanggal_jatuh_tempo` (datetime)
1. `status` enum: `Aktif` | `Kedaluwarsa`
1. timestamps

Model: `app/Models/Peminjaman.php`

1. Tabel dipaksa ke `peminjamans` (`protected $table = 'peminjamans'`).
1. `guarded = []` agar bisa `create([...])`.
1. Relasi: `Peminjaman belongsTo Book` via `book()`.

## Routing & Endpoint

Semua rute utama ada di `routes/web.php`.

### Rute publik

1. `GET /` \- `BookController@index` \- daftar buku (katalog)
1. `GET /buku/{id}` \- `BookController@show` \- detail buku

View terkait:

1. `resources/views/welcome.blade.php` \- grid daftar buku
1. `resources/views/buku/show.blade.php` \- detail buku + tombol pinjam

### Rute terproteksi (`auth` + `verified`)

1. `POST /buku/{id}/pinjam` \- `PeminjamanController@store` \- membuat peminjaman 7 hari
1. `GET /buku/{id}/baca` \- `PeminjamanController@baca` \- halaman ruang baca (iframe)
1. `GET /buku/{id}/stream` \- `PeminjamanController@streamFile` \- streaming PDF (akses diproteksi)
1. `GET /dashboard` \- closure \- menampilkan `My Library` berdasarkan `Peminjaman` milik user

View terkait:

1. `resources/views/dashboard.blade.php` \- daftar peminjaman user + tombol `Baca Buku`
1. `resources/views/buku/baca.blade.php` \- layout ruang baca + `iframe` ke route stream

Auth routes (login/register/dll) berasal dari Breeze: `routes/auth.php`.

## Alur Fitur (End-to-End)

### 1) Katalog dan detail buku

1. User membuka `GET /`.
1. `BookController@index` menjalankan `Book::all()` dan me-render `welcome`.
1. Saat klik buku, user menuju `GET /buku/{id}`.
1. `BookController@show` memanggil `Book::findOrFail($id)` dan me-render `buku.show`.

### 2) Peminjaman buku

Implementasi: `app/Http/Controllers/PeminjamanController.php` method `store($id)`.

1. Validasi anti-duplikasi: cek apakah ada peminjaman `Aktif` untuk pasangan `(user_id, book_id)`.
1. Jika ada, redirect back dengan flash `error`.
1. Jika tidak ada, membuat record `Peminjaman`:
   - `tanggal_pinjam = now()`
   - `tanggal_jatuh_tempo = now() + 7 hari`
   - `status = Aktif`
1. Redirect ke `dashboard` dengan flash `success`.

### 3) Dashboard (My Library)

Implementasi ada di closure route `GET /dashboard`.

1. Query `Peminjaman::with('book')` untuk user login.
1. Order by `created_at desc`.
1. Render `resources/views/dashboard.blade.php`.

Di view:

1. Jika `status=Aktif`, tombol `Baca Buku` mengarah ke `GET /buku/{id}/baca`.
1. Jika `status=Kedaluwarsa`, tombol disabled.

### 4) Ruang baca + stream PDF

Implementasi: `PeminjamanController@baca($id)` dan `PeminjamanController@streamFile($id)`.

1. `GET /buku/{id}/baca`
   - Cek peminjaman user untuk buku tersebut dengan `status=Aktif`.
   - Jika tidak ada, redirect ke dashboard dengan flash `error`.
   - Jika ada, render `resources/views/buku/baca.blade.php`.
1. Di halaman baca, `iframe` memanggil `GET /buku/{id}/stream`.
1. `streamFile` mengulang pengecekan peminjaman aktif.
1. Jika valid, file diambil via `storage_path('app/' . $book->file_path)` lalu di-serve dengan `response()->file($path)`.

Catatan UI:

1. Halaman baca menonaktifkan context menu (klik kanan) dan memblok beberapa shortcut (Ctrl+P/Ctrl+S/Ctrl+U/F12). Ini membantu UX, tapi bukan kontrol keamanan yang kuat.

## Penyimpanan File E-book

Saat ini, path file ditentukan oleh kolom `books.file_path` dan dibaca langsung dari filesystem dengan `storage_path('app/...')`.

Contoh dari `BookSeeder`:

1. `file_path = ebooks/laravel.pdf` artinya file harus ada di `storage/app/ebooks/laravel.pdf`.

Konfigurasi `config/filesystems.php` juga mengubah disk `local` root menjadi `storage/app/private`, tapi implementasi streaming saat ini tidak menggunakan Storage facade (langsung ke `storage_path`).

## Seeder

1. `database/seeders/DatabaseSeeder.php`: membuat `Test User`.
1. `database/seeders/BookSeeder.php`: membuat 2 data buku contoh (mengandalkan `Book::create`).

## Hal Yang Sudah Kamu Bangun (Inti Pekerjaanmu)

1. Entity `Book` dan `Peminjaman` + migration-nya.
1. UI katalog buku (Blade + Tailwind).
1. Halaman detail buku + tombol pinjam.
1. Mekanisme peminjaman 7 hari dan pencegahan pinjam dobel.
1. Dashboard `My Library` yang menampilkan peminjaman user.
1. Ruang baca berbasis `iframe` dengan endpoint streaming file yang dicek berdasarkan peminjaman.

## Catatan Teknis / Risiko (Yang Terdeteksi Dari Kode Saat Ini)

1. `BookSeeder` kemungkinan gagal karena `app/Models/Book.php` belum mengatur `$fillable` atau `$guarded`. Default Eloquent menolak mass assignment pada `create([...])`.
1. `BookSeeder` belum dipanggil dari `DatabaseSeeder` (jadi `php artisan db:seed` tidak otomatis mengisi buku).
1. Migration `2026_04_25_114857_create_peminjamen_table.php`:
   - `down()` melakukan `dropIfExists('peminjamen')` padahal tabel dibuat bernama `peminjamans`.
1. Status `Kedaluwarsa` belum dihitung/diupdate otomatis berdasarkan `tanggal_jatuh_tempo`.
1. Kontrol anti-download/anti-print di UI (JS) tidak bisa dianggap sebagai proteksi DRM.

## Cara Menjalankan (Local)

1. `composer install`
1. `npm install`
1. `cp .env.example .env`
1. `php artisan key:generate`
1. `php artisan migrate`
1. Jalankan:
   - `composer run dev` (server + queue + log + vite), atau
   - `php artisan serve` dan `npm run dev`.
