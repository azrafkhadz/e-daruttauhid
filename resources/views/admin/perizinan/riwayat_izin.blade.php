@extends ('layouts')

@section ('content')

<div style="display:flex; justify-content:space-between; margin-bottom:20px;">
   <h2 style="font-size: 20px; color: #111827; font-weight: 600;">Riwayat Izin</h2>
   <a href="/perizinan/dashboard" class="btn">Kembali</a>
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
            <th style="padding: 12px 16px;">Status Kembali</th>
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