<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            // Berelasi langsung dengan santri
            $table->foreignId('santri_id')->constrained('santri')->cascadeOnDelete();

            // Modul Telegram Kita
            $table->text('keperluan');
            $table->dateTime('waktu_berangkat'); // Menggunakan DATETIME agar sinkron dengan jadwal pondok[cite: 1]
            $table->dateTime('waktu_kembali');   // Sama dengan waktu selesai[cite: 1]

            // Status Persetujuan Telegram
            $table->enum('status', ['menunggu', 'boleh', 'tidak'])->default('menunggu');

            // Status & Verifikasi Scan QR Code di Gerbang
            $table->enum('status_kembali', ['belum kembali', 'tepat waktu', 'telat'])->nullable();
            $table->dateTime('waktu_aktual_kembali')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
