@extends('layouts')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #e5e7eb; max-width: 600px; margin: 0 auto;">
   <h2 style="font-size: 20px; color: #111827; font-weight: 600; margin-bottom: 20px;">Edit Data Pulang</h2>

   <form action="/perizinan/izin/update/{{ $izin->id }}" method="POST">
      @csrf

      <div class="input-group">
         <label for="santri_id">Nama Santri</label>
         <select name="santri_id" id="santri_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="">-- Pilih Nama Santri --</option>
            @foreach($daftarSantri as $s)
            <option value="{{ $s->id }}" {{ $izin->santri_id == $s->id ? 'selected' : '' }}>
               {{ $s->user->nama ?? 'Nama Tidak Ditemukan' }}
            </option>
            @endforeach
         </select>
      </div>

      <div style="margin-bottom: 15px;">
         <label style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Keperluan</label>
         <input type="text" name="keperluan" value="{{ $izin->keperluan }}" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;" required>
      </div>

      <div style="margin-bottom: 15px;">
         <label style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Berangkat</label>
         <input type="datetime-local" name="waktu_berangkat" value="{{ $izin->waktu_berangkat }}" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;" required>
      </div>

      <div style="margin-bottom: 15px;">
         <label style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Kembali (Rencana)</label>
         <input type="datetime-local" name="waktu_kembali" value="{{ $izin->waktu_kembali }}" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;" required>
      </div>

      <div style="margin-bottom: 15px;">
         <label for="status_kembali" style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Status Kembali</label>
         <select class="form-select" id="status_kembali" name="status_kembali" style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;">
            <option value="belum kembali" {{ (isset($izin) && $izin->status_kembali == 'belum kembali') ? 'selected' : '' }}>Belum Kembali</option>
            <option value="tepat waktu" {{ (isset($izin) && $izin->status_kembali == 'tepat waktu') ? 'selected' : '' }}>Tepat Waktu</option>
            <option value="telat" {{ (isset($izin) && $izin->status_kembali == 'telat') ? 'selected' : '' }}>Telat</option>
         </select>
      </div>

      <div style="display: flex; gap: 10px;">
         <button type="submit" style="background: #2563eb; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">Simpan Perubahan</button>
         <a href="/perizinan/dashboard" style="background: #6b7280; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: 500;">Batal</a>
      </div>
   </form>
</div>
@endsection