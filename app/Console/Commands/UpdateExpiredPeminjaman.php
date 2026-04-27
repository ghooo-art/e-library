<?php

namespace App\Console\Commands;

use App\Models\Peminjaman;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateExpiredPeminjaman extends Command
{
    // Ini adalah nama perintah yang akan kita panggil nanti
    protected $signature = 'peminjaman:check-expired';

    // Deskripsi singkat tentang apa yang dilakukan perintah ini
    protected $description = 'Mengubah status peminjaman menjadi Kedaluwarsa jika sudah melewati tenggat waktu';

    public function handle()
    {
        // LOGIKA UTAMA:
        // Cari semua data di tabel peminjamans yang statusnya masih 'Aktif'
        // DAN tanggal_jatuh_tempo nya sudah lebih kecil (lewat) dari waktu sekarang.
        $expiredCount = Peminjaman::where('status', 'Aktif')
            ->where('tanggal_jatuh_tempo', '<', Carbon::now())
            ->update(['status' => 'Kedaluwarsa']);

        $this->info("Berhasil! {$expiredCount} data peminjaman telah diubah menjadi Kedaluwarsa.");
    }
}