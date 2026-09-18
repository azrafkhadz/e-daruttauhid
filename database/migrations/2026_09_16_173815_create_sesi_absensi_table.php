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
        Schema::create('sesi_absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->cascadeOnDelete();
            $table->foreignId('dibuka_oleh')->constrained('users')->cascadeOnDelete(); // Akun Admin yang membuka sesi[cite: 1]
            $table->dateTime('waktu_mulai'); // Waktu mulai aktual[cite: 1]
            $table->dateTime('batas_absensi'); // Penentu status kehadiran[cite: 1]
            $table->dateTime('dibuka_pada')->nullable();
            $table->dateTime('ditutup_pada')->nullable();
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif'); // Status sesi[cite: 1]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_absensi');
    }
};
