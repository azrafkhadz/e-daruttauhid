@extends('layouts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
   <h2 style="font-size: 20px; color: #111827; font-weight: 600;">Daftar Pengajuan Izin Santri</h2>
   <a href="/perizinan/pengajuan" style="background: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px;">Ajukan Izin</a>
</div>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 25px;">

   <!-- Card 1: Total Pengajuan -->
   <div style="background: white; padding: 20px 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05); position: relative;">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
         <span style="font-size: 12px; font-weight: 600; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Total Pengajuan</span>
         <div style="width: 32px; height: 32px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #059669;">
            <i class="fa-solid fa-file-lines" style="font-size: 14px;"></i>
         </div>
      </div>
      <h3 style="font-size: 28px; font-weight: 700; color: #111827;">{{ \App\Models\Izin::count() }}</h3>
   </div>

   <!-- Card 2: Menunggu Persetujuan -->
   <div style="background: white; padding: 20px 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05); position: relative;">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
         <span style="font-size: 12px; font-weight: 600; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Menunggu Persetujuan</span>
         <div style="width: 32px; height: 32px; background: #fffbeb; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #d97706;">
            <i class="fa-solid fa-clock" style="font-size: 14px;"></i>
         </div>
      </div>
      <h3 style="font-size: 28px; font-weight: 700; color: #d97706;">{{ \App\Models\Izin::where('status', 'menunggu')->count() }}</h3>
   </div>

   <!-- Card 3: Disetujui -->
   <div style="background: white; padding: 20px 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05); position: relative;">
      <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
         <span style="font-size: 12px; font-weight: 600; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase;">Disetujui</span>
         <div style="width: 32px; height: 32px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #059669;">
            <i class="fa-solid fa-circle-check" style="font-size: 14px;"></i>
         </div>
      </div>
      <h3 style="font-size: 28px; font-weight: 700; color: #059669;">{{ \App\Models\Izin::where('status', 'boleh')->count() }}</h3>
   </div>

</div>

<div style="background: white; border-radius: 8px; border: 1px solid #e5e7eb; overflow: hidden;">
   <table class="tabel-izin" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
      <thead>
         <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb; color: #6b7280;">
            <th style="padding: 12px 16px;">Nama Santri</th>
            <th style="padding: 12px 16px;">Keperluan</th>
            <th style="padding: 12px 16px;">Berangkat</th>
            <th style="padding: 12px 16px;">Kembali</th>
            <th style="padding: 12px 16px;">Status Izin</th>
            <th style="padding: 12px 16px;">Status Kembali</th> <!-- Kolom Baru -->
            <th style="padding: 12px 16px;">Konfirmasi</th>
            <th style="padding: 12px 16px;">Aksi</th>
         </tr>
      </thead>
      <tbody>
         @foreach($dataIzin as $izin)
         <tr style="border-bottom: 1px solid #f3f4f6;">
            <td style="padding: 12px 16px; font-weight: 500; color: #111827;">{{ $izin->santri->user->nama ?? 'tidak diketahui' }}</td>
            <td style="padding: 12px 16px; color: #4b5563;">{{ $izin->keperluan }}</td>
            <td style="padding: 12px 16px; color: #4b5563;">{{ $izin->waktu_berangkat }}</td>
            <td style="padding: 12px 16px; color: #4b5563;">{{ $izin->waktu_kembali }}</td>

            <!-- Kolom Status Persetujuan -->
            <td style="padding: 12px 16px;">
               @if($izin->status == 'boleh')
               <span style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Disetujui</span>
               @elseif($izin->status == 'tidak')
               <span style="background: #fee2e2; color: #b91c1c; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Ditolak</span>
               @else
               <span style="background: #fef9c3; color: #a16207; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Menunggu</span>
               @endif
            </td>

            <!-- Kolom Baru: Status Kembali -->
            <td style="padding: 12px 16px;">
               @if($izin->status == 'tidak')
               <span style="color: #6b7280; font-style: italic;">Tidak Berlaku</span>
               @else
               @if($izin->status == 'menunggu')
               <span style="color: #6b7280; font-style: italic;">Belum Dikonfirmasi</span>
               @else
               @if($izin->status_kembali == 'tepat waktu')
               <span style="color: #15803d; font-weight: 600;">Tepat Waktu</span>
               @elseif($izin->status_kembali == 'telat')
               <span style="color: #b91c1c; font-weight: 600;">Telat</span>
               @else
               <span style="color: #6b7280; font-style: italic;">Belum Kembali</span>
               @endif
               @endif
               @endif
            </td>

            <!-- Kolom Konfirmasi -->
            <td style="padding: 12px 16px; display: flex; gap: 8px; align-items: center;">
               @if($izin->status == 'tidak')
               <span style="color: #9ca3af; font-size: 12px; font-style: italic; background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">Aksi Dinonaktifkan</span>
               @else
               @if($izin->status == 'menunggu')
               <span style="color: #6b7280; font-style: italic;">Belum Dikonfirmasi</span>
               @else
               @if($izin->status_kembali == 'belum kembali' || $izin->status_kembali == null)
               <form action="/perizinan/konfirmasi/{{ $izin->id }}" method="POST" style="margin: 0;">
                  @csrf
                  <button type="submit" style="background: #16a34a; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer;">Konfirmasi Kembali</button>
               </form>
               @else
               <span style="color: #16a34a; font-size: 13px; font-weight: 500;"><i class="fa-solid fa-check"></i> Selesai</span>
               @endif
               @endif
               @endif

            </td>
            <!-- Kolom Aksi Edit -->
            <td style="padding: 12px 16px; gap: 8px; align-items: center;">
               @if ($izin->status == "tidak")
               <span style=" color: #9ca3af; font-size: 12px; font-style: italic; background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">Edit Dinonaktifkan</span>
               @else
               @if($izin->status == 'menunggu')
               <span style="color: #6b7280; font-style: italic;">Belum Dikonfirmasi</span>
               @else
               <a href="/perizinan/izin/edit/{{ $izin->id }}" style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: 500;">Edit</a>
               @endif
               @endif
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection