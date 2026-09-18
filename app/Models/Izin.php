<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izin'; // Pastikan menunjuk ke tabel 'izin' yang baru
    protected $guarded = ['id'];

    // Membuat relasi: 1 Izin dimiliki oleh 1 Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
