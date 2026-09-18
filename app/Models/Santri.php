<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik
    protected $table = 'santri';

    // Mengizinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];

    // Relasi ke tabel User (Opsional untuk disiapkan sekarang)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
