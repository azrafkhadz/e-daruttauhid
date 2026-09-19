<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Santri; // <-- Tambahkan ini
use Illuminate\Support\Facades\Http;

class IzinController extends Controller
{
   public function index()
   {
      // Pengecekan otomatis telat
      \App\Models\Izin::where('status_kembali', 'belum kembali')
         ->where('waktu_kembali', '<', now())
         ->update(['status_kembali' => 'telat']);

      \App\Models\Izin::whereNull('status_kembali')
         ->where('waktu_kembali', '<', now())
         ->update(['status_kembali' => 'telat']);

      $izinAktif = Izin::with('santri.user')
         ->where('status', '!=', 'tidak') // Sembunyikan yang ditolak
         ->where(function ($query) {
            $query->whereNull('status_kembali')
               ->orWhere('status_kembali', 'belum kembali')
               ->orWhere('status_kembali', 'telat');
         })
         ->orderBy('created_at', 'desc')
         ->get();

      return view('admin.perizinan.perizinan_dashboard', ['dataIzin' => $izinAktif]);
   }

   public function history()
   {
      $semuaIzin = Izin::with('santri.user')->orderBy('created_at', 'desc')->get();

      return view('admin.perizinan.riwayat_izin', ['dataIzin' => $semuaIzin]);
   }

   // Fungsi baru untuk menampilkan form pengajuan dengan pilihan nama santri
   public function create()
   {
      $daftarSantri = Santri::with('user')->where('status', 'aktif')->get();
      return view('admin.perizinan.format_izin', compact('daftarSantri'));
   }

   public function simpanData(Request $request)
   {
      // Simpan menggunakan santri_id
      $izinBaru = new Izin();
      $izinBaru->santri_id = $request->santri_id;
      $izinBaru->keperluan = $request->keperluan;
      $izinBaru->waktu_berangkat = $request->waktu_berangkat;
      $izinBaru->waktu_kembali = $request->waktu_kembali;
      $izinBaru->status = 'menunggu';
      $izinBaru->save();

      // Ambil data santri untuk pesan Telegram
      $santri = Santri::with('user')->find($request->santri_id);
      $namaSantri = $santri->user->nama ?? 'Santri Tidak Diketahui';

      $pesan = "📋 *SURAT PENGAJUAN PERIZINAN SANTRI*\n";
      $pesan .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";
      $pesan .= "Kepada Yth.\n";
      $pesan .= "*Shohibul Bait / Pengurus Pondok*\n\n";
      $pesan .= "👤 *Nama Santri* : " . $namaSantri . "\n";
      $pesan .= "📝 *Keperluan*  : " . $izinBaru->keperluan . "\n";
      $pesan .= "🛫 *Berangkat*  : " . $izinBaru->waktu_berangkat . "\n";
      $pesan .= "🛬 *Kembali*    : " . $izinBaru->waktu_kembali . "\n\n";
      $pesan .= "━━━━━━━━━━━━━━━━━━━━━━\n";

      $tombol = [
         'inline_keyboard' => [
            [
               ['text' => '✅ Izinkan', 'callback_data' => 'izinkan_' . $izinBaru->id],
               ['text' => '❌ Tolak', 'callback_data' => 'tolak_' . $izinBaru->id]
            ]
         ]
      ];

      $token = env('TELEGRAM_BOT_TOKEN');
      $chatId = env('TELEGRAM_CHAT_ID');

      Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
         'chat_id' => $chatId,
         'text' => $pesan,
         'parse_mode' => 'Markdown',
         'reply_markup' => json_encode($tombol)
      ]);

      return view('admin.perizinan.sukses');
   }

   public function webhook(Request $request)
   {
      $update = $request->all();
      $token = env('TELEGRAM_BOT_TOKEN');
      $idGrupGerbang = env('TELEGRAM_GROUP_GERBANG');

      if (isset($update['callback_query'])) {
         $callbackQuery = $update['callback_query'];
         $chatIdSB = $callbackQuery['message']['chat']['id'];
         $data = $callbackQuery['data'];
         $messageId = $callbackQuery['message']['message_id'];

         $parts = explode('_', $data);
         $action = $parts[0];
         $izinId = $parts[1] ?? null;

         if ($izinId) {
            $izin = \App\Models\Izin::with('santri.user')->find($izinId);

            if ($izin) {
               $namaSantri = $izin->santri->user->nama ?? 'Santri';

               if ($izin->status !== 'menunggu') {
                  \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                     'callback_query_id' => $callbackQuery['id'],
                     'text' => '⚠️ Keputusan sudah final dan tidak bisa diubah lagi!',
                     'show_alert' => true
                  ]);
                  return response('OK', 200);
               }

               if ($action === 'izinkan') {
                  $izin->status = 'boleh';
                  $izin->save();

                  $this->kirimPesanTelegram($chatIdSB, "✅ Izin untuk ananda *$namaSantri* telah disetujui.");

                  $qrData = "IZIN-" . $izin->id;
                  $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($qrData);
                  $captionGerbang = "🔔 *IZIN BARU DISETUJUI*\n\nNama: *$namaSantri*\nKeperluan: {$izin->keperluan}\nBerangkat: {$izin->waktu_berangkat}\nBatas Kembali: {$izin->waktu_kembali}\n\n*Tanda Bukti Izin!*.";

                  if ($idGrupGerbang) {
                     $this->kirimFotoTelegram($idGrupGerbang, $qrUrl, $captionGerbang);
                  }
               } elseif ($action === 'tolak') {
                  $izin->status = 'tidak';
                  $izin->save();
                  $this->kirimPesanTelegram($chatIdSB, "❌ Izin untuk ananda *$namaSantri* telah ditolak.");
               }

               \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$token}/editMessageReplyMarkup", [
                  'chat_id' => $chatIdSB,
                  'message_id' => $messageId,
                  'reply_markup' => json_encode(['inline_keyboard' => []]) // Mengosongkan tombol
               ]);
            }
         }

         \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
            'callback_query_id' => $callbackQuery['id']
         ]);
      }

      return response('OK', 200);
   }

   // ==============================================================
   // FUNGSI BANTUAN TELEGRAM
   // ==============================================================
   private function kirimPesanTelegram($chatId, $text)
   {
      $token = env('TELEGRAM_BOT_TOKEN');
      $response = \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
         'chat_id' => $chatId,
         'text' => $text,
         'parse_mode' => 'Markdown'
      ]);
      // Catat respons dari Telegram ke log
      ("Respons Pesan ($chatId): " . $response->body());
   }

   private function kirimFotoTelegram($chatId, $photoUrl, $caption)
   {
      $token = env('TELEGRAM_BOT_TOKEN');
      $response = \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$token}/sendPhoto", [
         'chat_id' => $chatId,
         'photo' => $photoUrl,
         'caption' => $caption,
         'parse_mode' => 'Markdown'
      ]);
      ("Respons Foto ($chatId): " . $response->body());
   }
   public function konfirmasiKembali($id)
   {
      $izin = Izin::find($id);

      if ($izin) {
         $waktuSekarang = now();
         $izin->waktu_aktual_kembali = $waktuSekarang;

         if ($waktuSekarang > $izin->waktu_kembali) {
            $izin->status_kembali = 'telat';
         } else {
            $izin->status_kembali = 'tepat waktu';
         }

         $izin->save();
      }

      return redirect('/perizinan/dashboard');
   }
   public function edit($id)
   {
      // Ambil data izin berdasarkan ID beserta relasi santrinya
      $izin = Izin::with('santri.user')->find($id);

      // Ambil daftar seluruh santri aktif untuk pilihan dropdown
      $daftarSantri = Santri::with('user')->where('status', 'aktif')->get();

      return view('admin.perizinan.edit_izin', compact('izin', 'daftarSantri'));
   }

   public function update(Request $request, $id)
   {
      $izin = Izin::find($id);

      if ($izin) {
         $izin->santri_id = $request->santri_id;
         $izin->keperluan = $request->keperluan;
         $izin->waktu_berangkat = $request->waktu_berangkat;
         $izin->waktu_kembali = $request->waktu_kembali;

         // Berikan pengaman jika status dari request kosong, gunakan status lama
         $izin->status = $request->status ?? $izin->status;

         if ($request->has('status_kembali')) {
            $izin->status_kembali = $request->status_kembali;
         }

         $izin->save();
      }

      return redirect('/perizinan/dashboard');
   }
}
