<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private $poliDoctors = [
        'Umum' => 'Dr. Budi Santoso, Sp.PD',
        'Gigi' => 'Drg. Ahmad Dhani',
        'Anak' => 'Dr. Siti Aminah, Sp.A',
        'Penyakit Dalam' => 'Dr. Boyke, Sp.PD',
    ];

    public function index()
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $today = now()->today();

        // 1. Total Pasien Hari Ini (All visits created today)
        $totalVisits = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->count();

        // 2. Sedang Dirawat (Status: dipanggil)
        $confimedPatients = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->where('status', 'dipanggil')
            ->count();

        // 3. Antrian Menunggu (Status: menunggu or memanggil)
        $waitingPatients = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['menunggu', 'memanggil', 'menunggu_pembayaran'])
            ->count();

        // 4. Selesai (Status: selesai)
        $completedPatients = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->where('status', 'selesai')
            ->count();

        // Optional: Poly Distribution
        $poliStats = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->select('poli_tujuan', DB::raw('count(*) as total'))
            ->groupBy('poli_tujuan')
            ->get();

        return view('admin.dashboard', compact(
            'totalVisits', 
            'confimedPatients', 
            'waitingPatients', 
            'completedPatients',
            'poliStats'
        ));
    }

    public function pembayaran()
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $pendingPayments = DB::table('pasiens')
            ->where('status', 'menunggu_pembayaran')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.pembayaran', compact('pendingPayments'));
    }

    public function antrian()
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $today = now()->today();

        // Queues waiting for doctor assignment OR currently being called
        $queues = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['menunggu', 'memanggil', 'dilewati'])
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.antrian', compact('queues'));
    }

    public function dokter(Request $request)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $selectedPoli = $request->query('poli');
        
        // If no poli selected, we just return the view with null data to trigger the selection UI
        if (!$selectedPoli) {
             return view('admin.dokter', [
                'activePatients' => [], 
                'completedPatients' => [], 
                'selectedPoli' => null
            ]);
        }

        $today = now()->today();

        // Patients currently being examined
        $activePatients = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->where('status', 'dipanggil')
            ->where('poli_tujuan', $selectedPoli)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Patients completed today
        $completedPatients = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->where('status', 'selesai')
            ->where('poli_tujuan', $selectedPoli)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.dokter', compact('activePatients', 'completedPatients', 'selectedPoli'));
    }

    public function callPatient($id)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $patient = DB::table('pasiens')->where('id', $id)->first();
        if (!$patient) return redirect()->back()->with('error', 'Pasien tidak ditemukan');

        // Auto assign doctor
        $doctor = $this->poliDoctors[$patient->poli_tujuan] ?? 'Dokter Umum';

        DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'doctor_name' => $doctor,
                'status' => 'memanggil',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Memanggil pasien: ' . $patient->nama_pasien);
    }

    public function confirmPatient($id)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        // Move to Doctor's active list
        DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'status' => 'dipanggil',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Pasien masuk ke ruang periksa.');
    }

    public function skipPatient($id)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'status' => 'dilewati',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Pasien dilewati.');
    }

    public function verifyPayment($id)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $patient = DB::table('pasiens')->where('id', $id)->first();
        if (!$patient) return redirect()->back()->with('error', 'Data tidak ditemukan');

        // Generate Queue Number
        $today = now()->today();
        $kode_poli = substr($patient->poli_tujuan, 0, 1);
        
        // Count existing valid queues for this poli today
        $count = DB::table('pasiens')
            ->whereDate('created_at', $today)
            ->where('poli_tujuan', $patient->poli_tujuan)
            ->where('status', '!=', 'menunggu_pembayaran')
            ->count();
        
        $nomor_antrian = strtoupper($kode_poli).'-'.sprintf('%03d', $count + 1);

        DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'status' => 'menunggu',
                'status_pembayaran' => 'lunas',
                'nomor_antrian' => $nomor_antrian,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Pembayaran Terverifikasi! Antrian Diterbitkan: ' . $nomor_antrian);
    }

    public function storeExamination(Request $request, $id)
    {
        if (! session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            'resep_obat' => 'nullable|string',
            'catatan_dokter' => 'nullable|string',
            'tensi_darah' => 'nullable|string',
            'suhu_tubuh' => 'nullable|numeric',
            'berat_badan' => 'nullable|integer',
            'tinggi_badan' => 'nullable|integer',
        ]);

        DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'diagnosa' => $request->diagnosa,
                'tindakan' => $request->tindakan,
                'resep_obat' => $request->resep_obat,
                'catatan_dokter' => $request->catatan_dokter,
                'tensi_darah' => $request->tensi_darah,
                'suhu_tubuh' => $request->suhu_tubuh,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'status' => 'selesai',
                'updated_at' => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pemeriksaan Selesai. Data berhasil disimpan!');
    }
    public function listPasien(Request $request)
    {
        if (! session('admin_authenticated')) {
             return redirect()->route('admin.login');
        }

        $query = DB::table('patients');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_bpjs', 'like', "%{$search}%");
            });
        }

        $allPatients = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.pasien.index', compact('allPatients'));
    }


    public function showPasien($id)
    {
        if (! session('admin_authenticated')) {
             return redirect()->route('admin.login');
        }

        $patient = DB::table('patients')->where('id', $id)->first();
        if (!$patient) {
            return redirect()->route('admin.pasien')->with('error', 'Pasien tidak ditemukan');
        }

        // Fetch visit history based on NIK
        $visits = DB::table('pasiens')
            ->where('nik', $patient->nik)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pasien.show', compact('patient', 'visits'));
    }

    public function destroyPasien($id)
    {
        if (! session('admin_authenticated')) {
             return redirect()->route('admin.login');
        }

        DB::table('patients')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Pasien berhasil dihapus.');
    }

    public function showLoginForm()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['pin' => 'required|numeric']);

        // Default PIN for demonstration (matches typical seeders)
        $validPin = '123456'; 

        if ($request->pin === $validPin) {
            $request->session()->put('admin_authenticated', true);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Kembali!');
        }

        return redirect()->back()->with('error', 'PIN tidak valid.');
    }

    public function logout(Request $request) {
        $request->session()->forget('admin_authenticated');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }
}
