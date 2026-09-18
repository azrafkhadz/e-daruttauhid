<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'e-Daruttauhid')</title>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <style>
      * {
         box-sizing: border-box;
         margin: 0;
         padding: 0;
         font-family: 'Inter', sans-serif;
      }

      body {
         background-color: #f8fafc;
         display: flex;
         height: 100vh;
         overflow: hidden;
      }

      /* Sidebar Styling (Sesuai Desain Figma) */
      .sidebar {
         width: 260px;
         background-color: #022c22;
         color: white;
         display: flex;
         flex-direction: column;
      }

      .sidebar-header {
         padding: 25px 20px;
         display: flex;
         align-items: center;
         gap: 12px;
      }

      .sidebar-header .icon {
         font-size: 1.8rem;
      }

      .sidebar-header .logo-text h2 {
         font-size: 1.2rem;
         font-weight: 700;
         line-height: 1.2;
         letter-spacing: 0.5px;
      }

      .sidebar-header .logo-text p {
         font-size: 0.75rem;
         color: #a7f3d0;
         font-weight: 500;
      }

      .sidebar-menu {
         list-style: none;
         padding: 10px 0;
         flex: 1;
         overflow-y: auto;
      }

      .sidebar-menu li {
         padding: 4px 15px;
      }

      .sidebar-menu li a {
         display: flex;
         align-items: center;
         gap: 12px;
         padding: 12px 15px;
         color: #d1d5db;
         text-decoration: none;
         font-size: 0.95rem;
         font-weight: 500;
         border-radius: 8px;
         transition: all 0.2s ease;
      }

      .sidebar-menu li a:hover {
         background-color: #064e3b;
         color: white;
      }

      /* Desain menu aktif sesuai Figma */
      .sidebar-menu li a.active {
         background-color: #10b981;
         color: white;
         box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
      }

      /* Footer Sidebar (Settings & Logout) */
      .sidebar-footer {
         padding: 15px;
         border-top: 1px solid #064e3b;
         display: flex;
         flex-direction: column;
         gap: 5px;
      }

      .sidebar-footer a {
         display: flex;
         align-items: center;
         gap: 12px;
         padding: 12px 15px;
         text-decoration: none;
         font-size: 0.95rem;
         font-weight: 500;
         border-radius: 8px;
         transition: 0.2s;
      }

      .sidebar-footer a.settings {
         color: #d1d5db;
      }

      .sidebar-footer a.settings:hover {
         background-color: #064e3b;
         color: white;
      }

      .sidebar-footer a.logout {
         color: #ef4444;
      }

      .sidebar-footer a.logout:hover {
         background-color: rgba(239, 68, 68, 0.1);
      }

      /* Main Content & Header */
      .main-content {
         flex: 1;
         display: flex;
         flex-direction: column;
         overflow-y: auto;
      }

      .header {
         background: white;
         padding: 15px 30px;
         display: flex;
         justify-content: space-between;
         align-items: center;
         border-bottom: 1px solid #e5e7eb;
      }

      /* Search Bar Header */
      .header-search {
         flex: 1;
         max-width: 500px;
      }

      .search-box {
         display: flex;
         align-items: center;
         background-color: #f1f5f9;
         border: 1px solid #e2e8f0;
         border-radius: 9999px;
         padding: 8px 16px;
         width: 100%;
         transition: 0.2s;
      }

      .search-box:focus-within {
         border-color: #10b981;
         background-color: white;
         box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
      }

      .search-box input {
         border: none;
         background: transparent;
         outline: none;
         width: 100%;
         padding-left: 10px;
         font-size: 0.9rem;
         color: #334155;
      }

      /* User Profile Header */
      .header-right {
         display: flex;
         align-items: center;
         gap: 20px;
      }

      .notification-icon {
         font-size: 1.2rem;
         color: #64748b;
         cursor: pointer;
      }

      .user-profile {
         display: flex;
         align-items: center;
         gap: 12px;
         cursor: pointer;
      }

      .user-info {
         text-align: right;
         display: flex;
         flex-direction: column;
      }

      .user-info .name {
         font-size: 0.9rem;
         font-weight: 600;
         color: #1e293b;
      }

      .user-info .role {
         font-size: 0.75rem;
         color: #64748b;
      }

      .user-avatar {
         width: 40px;
         height: 40px;
         background-color: #0f172a;
         color: white;
         border-radius: 50%;
         display: flex;
         justify-content: center;
         align-items: center;
         font-weight: bold;
         font-size: 0.9rem;
      }

      /* Area Konten Utama */
      .container {
         padding: 30px;
      }

      /* Komponen Card (Sudah disesuaikan agar lebih flat dan modern) */
      .stats-grid {
         display: grid;
         grid-template-columns: repeat(4, 1fr);
         gap: 20px;
         margin-bottom: 30px;
      }

      .stat-card {
         background: white;
         padding: 20px;
         border-radius: 12px;
         box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
         border: 1px solid #e5e7eb;
      }

      .stat-card h3 {
         font-size: 0.75rem;
         color: #64748b;
         margin-bottom: 8px;
         text-transform: uppercase;
         font-weight: 600;
         letter-spacing: 0.5px;
      }

      .stat-card .number {
         font-size: 1.8rem;
         font-weight: 700;
         color: #0f172a;
      }

      .card {
         background: white;
         border-radius: 12px;
         box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
         border: 1px solid #e5e7eb;
         padding: 20px;
         margin-bottom: 20px;
      }

      .card-title {
         font-size: 1.1rem;
         font-weight: 600;
         color: #1e293b;
         margin-bottom: 15px;
      }

      .btn {
         background: #10b981;
         color: white;
         padding: 10px 18px;
         border-radius: 8px;
         text-decoration: none;
         font-size: 0.9rem;
         font-weight: 500;
         display: inline-block;
         transition: 0.2s;
      }

      .btn:hover {
         background: #059669;
      }
   </style>
</head>

<body>

   <!-- Sidebar Admin -->
   <div class="sidebar">
      <div class="sidebar-header">
         <div class="icon">🛡️</div>
         <div class="logo-text">
            <h2>Admin</h2>
            <p>Operational Panel</p>
         </div>
      </div>
      <ul class="sidebar-menu">
         <ul class="sidebar-menu">
            @auth
            <!-- ========================================== -->
            <!-- MENU KHUSUS SUPER ADMIN                    -->
            <!-- ========================================== -->
            @if(auth()->user()->role == 'super_admin')
            <li><a href="/super-admin/dashboard" class="{{ Request::is('super-admin/dashboard') ? 'active' : '' }}">📊 Dashboard Utama</a></li>
            <li><a href="#">📋 Monitoring Absensi</a></li>
            <li><a href="/perizinan/dashboard" class="{{ Request::is('perizinan/dashboard') ? 'active' : '' }}">📂 Semua Perizinan</a></li>
            <li><a href="#">👥 Master Data Santri</a></li>
            <li><a href="#">🛏️ Master Data Kamar</a></li>
            <li><a href="#">📅 Master Kegiatan</a></li>
            <li><a href="#">⚙️ Manajemen User</a></li>

            <!-- ========================================== -->
            <!-- MENU KHUSUS ADMIN (Operasional)            -->
            <!-- ========================================== -->
            @elseif(auth()->user()->role == 'admin')
            <li><a href="/perizinan/dashboard-utama" class="{{ Request::is('perizinan/dashboard-utama') ? 'active' : '' }}">📊 Dashboard Admin</a></li>
            <li><a href="#">📋 Sesi Absensi Pondok</a></li>
            <li><a href="/perizinan/dashboard" class="{{ Request::is('perizinan/dashboard') ? 'active' : '' }}">📂 Kelola Perizinan</a></li>
            <li><a href="#">👥 Lihat Data Santri</a></li>

            <!-- ========================================== -->
            <!-- MENU KHUSUS SANTRI                         -->
            <!-- ========================================== -->
            @elseif(auth()->user()->role == 'santri')
            <li><a href="/santri/dashboard" class="{{ Request::is('santri/dashboard') ? 'active' : '' }}">🏠 Dashboard Saya</a></li>
            <li><a href="#">📋 Riwayat Absensi</a></li>
            <li><a href="#">📂 Status Perizinan</a></li>
            <li><a href="#">📅 Jadwal Kegiatan</a></li>
            @endif
            @endauth
         </ul>
      </ul>

      <div class="sidebar-footer">
         <a href="#" class="settings">⚙️ Settings</a>
         <form action="/logout" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 12px 15px; font-size: 0.95rem; font-weight: 500; border-radius: 8px; color: #ef4444;">
               🚪 Log out
            </button>
         </form>
      </div>
   </div>

   <!-- Main Area -->
   <div class="main-content">
      <!-- Header Sesuai Figma -->
      <div class="header">
         <!-- Pencarian -->
         <div class="header-search">
            <div class="search-box">
               <span>🔍</span>
               <input type="text" placeholder="Cari santri, kamar, atau laporan...">
            </div>
         </div>

         <!-- Profil & Notifikasi -->
         <div class="header-right">
            <span class="notification-icon">🔔</span>
            <div class="user-profile">
               <div class="user-info">
                  <span class="name">{{ auth()->user()->nama ?? auth()->user()->username }}</span>
                  <span class="role">{{ strtoupper(str_replace('_', ' ', auth()->user()->role)) }}</span>
               </div>
               <div class="user-avatar">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</div>
            </div>
         </div>
      </div>

      <!-- Konten Halaman -->
      <div class="container">
         @yield('content')
      </div>
   </div>

</body>

</html>