<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik Pasien
        $totalPasien = Pasien::count();
        $sedangDirawat = Pasien::where('status', 'dipanggil')->count();
        $menunggu = Pasien::where('status', 'menunggu')->count();

        // 2. Data Dokter & Jadwal (Hardcoded)
        $dokter = [
            [
                'nama' => 'dr. Budi Santoso, Sp.PD',
                'spesialis' => 'Penyakit Dalam',
                'jadwal' => 'Senin - Rabu (09:00 - 14:00)',
                'foto' => 'https://ui-avatars.com/api/?name=Dr+Budi&background=0D8ABC&color=fff'
            ],
            [
                'nama' => 'dr. Siti Aminah, Sp.A',
                'spesialis' => 'Anak',
                'jadwal' => 'Selasa - Jumat (10:00 - 15:00)',
                'foto' => 'https://ui-avatars.com/api/?name=Dr+Siti&background=0D8ABC&color=fff'
            ],
            [
                'nama' => 'dr. Andi Wijaya, Sp.KG',
                'spesialis' => 'Gigi',
                'jadwal' => 'Senin - Jumat (08:00 - 12:00)',
                'foto' => 'https://ui-avatars.com/api/?name=Dr+Andi&background=0D8ABC&color=fff'
            ],
            [
                'nama' => 'dr. Rina Kurnia, MM',
                'spesialis' => 'Umum',
                'jadwal' => 'Setiap Hari (08:00 - 20:00)',
                'foto' => 'https://ui-avatars.com/api/?name=Dr+Rina&background=0D8ABC&color=fff'
            ],
        ];

        return view('index', compact('totalPasien', 'sedangDirawat', 'menunggu', 'dokter'));
    }
}
