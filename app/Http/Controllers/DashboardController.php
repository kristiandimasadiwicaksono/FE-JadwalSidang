<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk dashboard
        $totalDosen = Dosen::count();
        $jadwalBulanIni = 12;
        $totalMahasiswa = Mahasiswa::count();
        
        // Jadwal sidang terbaru
        $jadwalTerbaru = [
            [
                'mahasiswa' => 'Mahasiswa 1',
                'tanggal' => now()->addDays(1)->format('Y-m-d'),
            ],
            [
                'mahasiswa' => 'Mahasiswa 2',
                'tanggal' => now()->addDays(2)->format('Y-m-d'),
            ],
            [
                'mahasiswa' => 'Mahasiswa 3',
                'tanggal' => now()->addDays(3)->format('Y-m-d'),
            ],
        ];
        
        // Dosen aktif
        $dosenAktif = Dosen::orderBy('nama_dosen')->take(3)->get();
;
        
        return view('dashboard', compact('totalDosen', 'jadwalBulanIni', 'totalMahasiswa', 'jadwalTerbaru', 'dosenAktif'));
    }
}
