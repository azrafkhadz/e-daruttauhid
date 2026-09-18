<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
         height: 100vh;
         align-items: center;
         justify-content: center;
      }

      .login-container {
         display: flex;
         width: 900px;
         max-width: 95%;
         height: 540px;
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
         width: 55px;
         height: 55px;
         background: #10b981;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.5rem;
         margin-bottom: 20px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
         padding: 12px 16px;
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         font-size: 0.9rem;
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

      .form-options a:hover {
         text-decoration: underline;
      }

      .btn-login {
         width: 100%;
         background-color: #059669;
         color: white;
         padding: 12px;
         border: none;
         border-radius: 8px;
         font-size: 0.95rem;
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
         padding: 10px;
         border-radius: 6px;
         font-size: 0.85rem;
         margin-bottom: 20px;
         text-align: center;
         border: 1px solid #fecaca;
      }
   </style>
</head>

<body>

   <div class="login-container">
      <div class="login-banner">
         <div class="banner-top">
            <div class="logo"></div>
            <h1>SELAMAT DATANG!</h1>
            <h3>Di Sistem Digital Pondok Darut Tauhid</h3>
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
               <input type="text" name="username" id="username" placeholder="Masukkan username..." required value="{{ old('username') }}">
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
            Butuh bantuan? Hubungi Administrator Sistem.
         </div>
      </div>
   </div>

</body>

</html>