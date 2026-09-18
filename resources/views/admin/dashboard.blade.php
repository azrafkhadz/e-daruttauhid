@extends('layouts')

@section('title', 'Dashboard Utama - e-Daruttauhid')
@section('header-title', 'Dashboard Operasional Admin')

@section('content')
<!-- Statistik Operasional -->
<div class="stats-grid">
   <div class="stat-card">
      <h3>Total Santri</h3>
      <div class="number">{{ $totalSantri ?? 0 }}</div>
   </div>
   <div class="stat-card" style="border-left-color: #d97706;">
      <h3>Menunggu Persetujuan</h3>
      <div class="number">{{ $izinMenunggu ?? 0 }}</div>
   </div>
   <div class="stat-card" style="border-left-color: #2563eb;">
      <h3>Izin Aktif / Keluar</h3>
      <div class="number">{{ $izinAktif ?? 0 }}</div>
   </div>
   <div class="stat-card" style="border-left-color: #dc2626;">
      <h3>Alfa Hari Ini</h3>
      <div class="number">0</div>
   </div>
</div>

<!-- Panel Cepat / Menu Navigasi Modul -->
<div class="card">
   <div class="card-title">
      <span>Akses Cepat Modul Utama</span>
   </div>
   <p style="color: #6b7280; margin-bottom: 15px; font-size: 0.95rem;">
      Silakan kelola data perizinan santri atau pantau absensi harian melalui tombol di bawah ini.
   </p>
   <a href="/perizinan/dashboard" class="btn">Kelola Perizinan & Telegram</a>
</div>
@endsection