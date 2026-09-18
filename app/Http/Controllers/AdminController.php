<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Santri;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung statistik ringkas untuk ditampilkan di dashboard
        $totalSantri = Santri::count();
        $izinMenunggu = Izin::where('status', 'menunggu')->count();
        $izinAktif = Izin::where('status', 'boleh')->where('status_kembali', 'belum kembali')->count();

        return view('admin.dashboard', compact('totalSantri', 'izinMenunggu', 'izinAktif'));
    }
}
