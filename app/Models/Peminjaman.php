<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // Tambahkan baris ini untuk mengunci nama tabel
    protected $table = 'peminjamans';

    protected $guarded = [];
    // Relasi: Satu peminjaman dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu peminjaman merujuk ke satu Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}