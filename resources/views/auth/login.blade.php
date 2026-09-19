<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <!-- Viewport ini sangat penting untuk tampilan HP -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <title>Login - e-Daruttauhid</title>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <style>
      * {
         box-sizing: border-box;
         margin: 0;
         padding: 0;
         font-family: 'Inter', sans-serif;
      }

      body {
         background-color: #f1f5f9;
         display: flex;
         min-height: 100vh;
         align-items: center;
         justify-content: center;
         padding: 20px;
         /* Memberi ruang di layar HP */
      }

      .login-container {
         display: flex;
         width: 900px;
         max-width: 100%;
         min-height: 540px;
         /* Diubah jadi min-height agar fleksibel */
         background: white;
         border-radius: 20px;
         box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
         overflow: hidden;
         border: 1px solid #e2e8f0;
      }

      .login-banner {
         flex: 1;
         background-color: #022c22;
         color: white;
         padding: 40px;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
      }

      .banner-top .logo {
         width: 100%;
         display: flex;
         flex-direction: column;
         align-items: center;
         font-size: 1.5rem;
         margin-bottom: 20px;
         gap: 10px;
      }

      .selamat {
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      .banner-top h1 {
         font-size: 1.8rem;
         font-weight: 700;
         margin-bottom: 8px;
         letter-spacing: 0.5px;
      }

      .banner-top h3 {
         font-size: 1rem;
         color: #34d399;
         font-weight: 600;
         margin-bottom: 15px;
      }

      .banner-top p {
         font-size: 0.85rem;
         color: #cbd5e1;
         line-height: 1.5;
         margin-bottom: 25px;
      }

      .feature-list {
         display: flex;
         flex-direction: column;
         gap: 10px;
         font-size: 0.85rem;
         color: #e2e8f0;
      }

      .feature-item {
         display: flex;
         align-items: center;
         gap: 10px;
      }

      .banner-footer {
         font-size: 0.75rem;
         color: #94a3b8;
         margin-top: 30px;
      }

      .login-form-side {
         flex: 1;
         padding: 50px 40px;
         display: flex;
         flex-direction: column;
         justify-content: center;
      }

      .form-header {
         margin-bottom: 30px;
      }

      .form-header h2 {
         font-size: 1.6rem;
         font-weight: 700;
         color: #0f172a;
         margin-bottom: 6px;
      }

      .form-header p {
         font-size: 0.85rem;
         color: #64748b;
      }

      .input-group {
         margin-bottom: 20px;
      }

      .input-group label {
         display: block;
         font-size: 0.75rem;
         font-weight: 700;
         color: #475569;
         margin-bottom: 6px;
         letter-spacing: 0.5px;
      }

      .input-group input {
         width: 100%;
         padding: 14px 16px;
         /* Diperbesar sedikit agar mudah di-tap jari */
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         font-size: 0.95rem;
         /* Ukuran font input disesuaikan untuk HP */
         outline: none;
         transition: 0.2s;
         background-color: #f8fafc;
      }

      .input-group input:focus {
         border-color: #10b981;
         background-color: white;
         box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
      }

      .form-options {
         display: flex;
         justify-content: space-between;
         align-items: center;
         font-size: 0.85rem;
         margin-bottom: 25px;
      }

      .form-options label {
         display: flex;
         align-items: center;
         gap: 6px;
         color: #64748b;
         cursor: pointer;
      }

      .form-options a {
         color: #059669;
         text-decoration: none;
         font-weight: 500;
      }

      .btn-login {
         width: 100%;
         background-color: #059669;
         color: white;
         padding: 14px;
         /* Tombol lebih besar untuk layar sentuh */
         border: none;
         border-radius: 8px;
         font-size: 1rem;
         font-weight: 600;
         cursor: pointer;
         transition: 0.2s;
      }

      .btn-login:hover {
         background-color: #047857;
      }

      .form-footer-help {
         text-align: center;
         margin-top: 25px;
         font-size: 0.8rem;
         color: #64748b;
      }

      .error-msg {
         background-color: #fef2f2;
         color: #dc2626;
         padding: 12px;
         border-radius: 6px;
         font-size: 0.85rem;
         margin-bottom: 20px;
         text-align: center;
         border: 1px solid #fecaca;
      }

      /* =========================================
         MEDIA QUERY UNTUK LAYAR HP (RESPONSIVE)
         ========================================= */
      @media (max-width: 768px) {
         .login-container {
            flex-direction: column;
            /* Mengubah susunan menjadi atas-bawah */
            border-radius: 15px;
         }

         .login-banner {
            padding: 30px 20px;
         }

         .banner-top h1 {
            font-size: 1.5rem;
         }

         .banner-top p {
            font-size: 0.8rem;
            margin-bottom: 20px;
         }

         .login-form-side {
            padding: 30px 20px;
         }

         .form-header h2 {
            font-size: 1.4rem;
         }

         .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
         }

         .form-options a {
            align-self: flex-start;
         }
      }
   </style>
</head>

<body>

   <div class="login-container">
      <!-- Bagian Banner Kiri / Atas di HP -->
      <div class="login-banner">
         <div class="banner-top">
            <div class="logo">
               <img src="{{ secure_asset('Logo Amandemen fix.png') }}" alt="logo" height="80px" width="80px">
               <div class="selamat">
                  <h1>SELAMAT DATANG!</h1>
                  <h3>Di Sistem Digital Pondok Darut Tauhid</h3>
               </div>
            </div>
            <p>Sistem digital untuk memantau kehadiran dan perizinan santri secara terintegrasi dan transparan.</p>

            <div class="feature-list">
               <div class="feature-item"><span>✔️</span> Pemantauan Kehadiran Real-time</div>
               <div class="feature-item"><span>✔️</span> Monitoring Perizinan Santri</div>
               <div class="feature-item"><span>✔️</span> Akses Berdasarkan Role</div>
            </div>
         </div>

         <div class="banner-footer">
            © 2026 e-Daruttauhid. All rights reserved.
         </div>
      </div>

      <!-- Bagian Form Kanan / Bawah di HP -->
      <div class="login-form-side">
         <div class="form-header">
            <h2>Login Akses</h2>
            <p>Silakan masuk menggunakan Akun Anda.</p>
         </div>

         @if($errors->any())
         <div class="error-msg">
            {{ $errors->first() }}
         </div>
         @endif

         <form action="/login" method="POST">
            @csrf
            <div class="input-group">
               <label for="username">USERNAME</label>
               <!-- Ditambahkan autocapitalize="none" agar keyboard HP tidak kapital otomatis -->
               <input type="text" name="username" id="username" placeholder="Masukkan username..." required value="{{ old('username') }}" autocomplete="off" autocapitalize="none">
            </div>

            <div class="input-group">
               <label for="password">PASSWORD</label>
               <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <div class="form-options">
               <label><input type="checkbox" name="remember"> Ingat saya</label>
               <a href="#">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-login">Masuk ke Sistem</button>
         </form>

         <div class="form-footer-help">
            <span>
               Butuh bantuan? Hubungi Administrator Sistem.
            </span>
         </div>
      </div>

</body>

</html>