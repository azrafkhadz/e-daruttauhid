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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->cascadeOnDelete();
            $table->foreignId('sesi_absensi_id')->constrained('sesi_absensi')->cascadeOnDelete();
            $table->enum('status', ['hadir', 'terlambat', 'alfa', 'izin']); // Status final[cite: 1]
            $table->dateTime('waktu_scan')->nullable(); // Waktu_scan nullable untuk alfa/izin[cite: 1]

            // Untuk fitur koreksi jika kartu tertinggal/sistem error
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('alasan_koreksi', ['lupa_scan', 'kartu_bermasalah', 'sistem_tidak_mendeteksi', 'kesalahan_pencatatan', 'lainnya'])->nullable(); // Pilihan sistem agar data konsisten[cite: 1]
            $table->string('catatan')->nullable();
            $table->timestamps();

            // Constraint: 1 santri hanya boleh punya 1 absensi dalam 1 sesi[cite: 1]
            $table->unique(['santri_id', 'sesi_absensi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
