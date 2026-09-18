<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pengajuan Berhasil - Perizinan Pondok</title>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
      * {
         box-sizing: border-box;
         margin: 0;
         padding: 0;
         font-family: 'Inter', sans-serif;
      }

      body {
         background-color: #f4f6f9;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         overflow: hidden;
      }

      /* KARTU POPUP UTAMA */
      .success-card {
         background: white;
         /* Nuansa gelap elegan ala referensi */
         width: 420px;
         padding: 45px 35px;
         border-radius: 20px;
         box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
         text-align: center;
         color: #ffffff;
         position: relative;
         animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
      }

      @keyframes slideUp {
         from {
            opacity: 0;
            transform: translateY(30px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      /* ANIMASI IKON CENTANG */
      .icon-container {
         width: 75px;
         height: 75px;
         background: #059669;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 0 auto 25px auto;
         /* Menggabungkan animasi muncul (popIn) dilanjutkan animasi berdenyut (pulseGlow) */
         animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.2s both,
            pulseGlow 2s infinite ease-in-out 0.8s;
      }

      @keyframes popIn {
         0% {
            transform: scale(0);
            opacity: 0;
         }

         70% {
            transform: scale(1.1);
         }

         100% {
            transform: scale(1);
            opacity: 1;
         }
      }

      @keyframes pulseGlow {
         0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.4);
         }

         50% {
            transform: scale(1.06);
            box-shadow: 0 0 0 14px rgba(5, 150, 105, 0);
         }

         100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
         }
      }

      .icon-container i {
         font-size: 36px;
         color: #ffffff;
      }

      /* TEKS */
      .success-title {
         font-size: 22px;
         font-weight: 700;
         color: #059669;
         margin-bottom: 10px;
         letter-spacing: 0.3px;
      }

      .success-desc {
         font-size: 14px;
         color: #94a3b8;
         line-height: 1.5;
         margin-bottom: 30px;
      }

      .success-desc strong {
         color: #059669;
         font-weight: 600;
      }

      /* TOMBOL KEMBALI */
      .btn-dashboard {
         display: inline-block;
         background: #059669;
         color: white;
         width: 100%;
         padding: 12px 20px;
         border-radius: 10px;
         text-decoration: none;
         font-size: 14px;
         font-weight: 600;
         transition: all 0.2s ease;
         box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
      }

      .btn-dashboard:hover {
         background: #047857;
         transform: translateY(-2px);
         box-shadow: 0 6px 15px rgba(5, 150, 105, 0.4);
      }
   </style>
</head>

<body>

   <div class="success-card">
      <div class="icon-container">
         <i class="fa-solid fa-check"></i>
      </div>

      <h2 class="success-title">Pengajuan Terkirim!</h2>
      <p class="success-desc">Silahkan menunggu persetujuan dari <strong>Shohibul Bait</strong>.</p>

      <a href="/perizinan/dashboard" class="btn-dashboard">Kembali ke Dashboard</a>
   </div>

</body>

</html>