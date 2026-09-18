<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengajuan Izin - Perizinan Pondok</title>
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
      min-height: 100vh;
      padding: 20px;
    }

    /* CARD FORM ALA REFERENSI BARU */
    .card {
      background: #ffffff;
      width: 100%;
      max-width: 520px;
      padding: 35px 40px;
      border-radius: 24px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
      animation: fadeIn 0.4s ease-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(15px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card h2 {
      font-size: 24px;
      font-weight: 700;
      color: #111827;
      margin-bottom: 25px;
      letter-spacing: -0.3px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-size: 13px;
      font-weight: 600;
      color: #374151;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="datetime-local"],
    textarea {
      width: 100%;
      padding: 12px 16px;
      box-sizing: border-box;
      border: 1px solid #e5e7eb;
      background-color: #f9fafb;
      border-radius: 12px;
      font-size: 14px;
      color: #111827;
      outline: none;
      transition: all 0.2s ease;
    }

    input[type="text"]:focus,
    input[type="datetime-local"]:focus,
    textarea:focus {
      border-color: #059669;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    textarea {
      resize: vertical;
    }

    /* TOMBOL AKSI */
    .btn-group {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-top: 25px;
    }

    .btn-ajukan {
      background-color: #059669;
      /* Hijau modern */
      color: white;
      border: none;
      padding: 14px 20px;
      border-radius: 12px;
      cursor: pointer;
      width: 100%;
      font-size: 15px;
      font-weight: 600;
      transition: all 0.2s ease;
      box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .btn-ajukan:hover {
      background-color: #047857;
      transform: translateY(-1px);
      box-shadow: 0 6px 15px rgba(5, 150, 105, 0.35);
    }

    .btn-batal {
      background-color: transparent;
      color: #6b7280;
      border: none;
      padding: 10px;
      border-radius: 12px;
      cursor: pointer;
      width: 100%;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      display: block;
      text-align: center;
      transition: color 0.2s ease;
    }

    .btn-batal:hover {
      color: #111827;
      background-color: #d6d7d8;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>

  <div class="card">
    <h2>Form Pengajuan Izin</h2>

    <form action="/perizinan/pengajuan" method="POST">
      @csrf

      <div class="input-group">
        <label for="santri_id">Nama Santri</label>
        <select name="santri_id" id="santri_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
          <option value="">-- Pilih Nama Santri --</option>
          @foreach($daftarSantri as $s)
          <option value="{{ $s->id }}">{{ $s->user->nama ?? 'Nama Tidak Ditemukan' }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Keperluan / Tujuan</label>
        <textarea name="keperluan" rows="3" required placeholder="Contoh: Pulang karena sakit..."></textarea>
      </div>

      <div class="form-group">
        <label>Waktu Berangkat</label>
        <input type="datetime-local" name="waktu_berangkat" required>
      </div>

      <div class="form-group">
        <label>Waktu Kembali</label>
        <input type="datetime-local" name="waktu_kembali" required>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn-ajukan">Ajukan Izin</button>
        <a href="/perizinan/dashboard" class="btn-batal">Batal</a>
      </div>
    </form>
  </div>

</body>

</html>