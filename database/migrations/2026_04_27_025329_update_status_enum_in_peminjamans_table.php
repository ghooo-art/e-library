<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan 'Dikembalikan' ke dalam daftar ENUM
        DB::statement("ALTER TABLE peminjamans MODIFY COLUMN status ENUM('Aktif', 'Kedaluwarsa', 'Dikembalikan') DEFAULT 'Aktif'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan ke kondisi semula jika migrasi di-rollback
        DB::statement("ALTER TABLE peminjamans MODIFY COLUMN status ENUM('Aktif', 'Kedaluwarsa') DEFAULT 'Aktif'");
    }
};