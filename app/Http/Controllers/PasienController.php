<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        return view('pendaftaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'alamat_detail' => 'required|string',
            'kecamatan' => 'required|string',
            'poli_tujuan' => 'required|string',
        ]);

        // Check if BPJS is provided
        $isBpjs = !empty($request->no_bpjs);
        $tipe_pasien = $isBpjs ? 'bpjs' : 'umum';
        $status_awal = $isBpjs ? 'menunggu' : 'menunggu_pembayaran';
        
        $kode_poli = substr($request->poli_tujuan, 0, 1);
        $today = Carbon::today();

        // Count for Queue Number
        // Only count valid queues (those who have paid or are BPJS)
        // If Umum, we don't assign number yet.
        $nomor_antrian = null;

        if ($isBpjs) {
            $count = DB::table('pasiens')
                ->whereDate('created_at', $today)
                ->where('poli_tujuan', $request->poli_tujuan)
                ->where('status', '!=', 'menunggu_pembayaran') // Only count active queues
                ->count();
            
            $nomor_antrian = strtoupper($kode_poli).'-'.sprintf('%03d', $count + 1);
        }

        $alamat_lengkap = $request->alamat_detail.', Kec. '.$request->kecamatan.', Sumedang';

        DB::table('pasiens')->insert([
            'nama_pasien' => $request->nama_pasien,
            'nik' => $request->nik,
            'alamat' => $alamat_lengkap,
            'no_bpjs' => $request->no_bpjs,
            'poli_tujuan' => $request->poli_tujuan,
            'tipe_pasien' => $tipe_pasien,
            'nomor_antrian' => $nomor_antrian, 
            'status' => $status_awal,
            'status_pembayaran' => $isBpjs ? 'lunas' : 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (session('patient_id')) {
            $msg = $isBpjs 
                ? 'Pendaftaran Berhasil! Nomor Antrian Anda: '.$nomor_antrian 
                : 'Pendaftaran Berhasil! Silakan menuju Kasir untuk pembayaran.';
            return redirect()->route('patient.dashboard')->with('success', $msg);
        }

        return redirect()->route('queue.show')->with('success', 'Pendaftaran Berhasil!');
    }


    public function showQueue()
    {
        $antrian = DB::table('pasiens')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->get();

        $current = DB::table('pasiens')
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'dipanggil')
            ->first();

        return view('antrian', compact('antrian', 'current'));
    }

    public function checkNik(Request $request)
    {
        $request->validate(['nik' => 'required|numeric|digits:16']);

        // Check in Patients table (Registered Accounts)
        $patient = DB::table('patients')->where('nik', $request->nik)->first();
        if ($patient) {
            return response()->json([
                'found' => true,
                'nama' => $patient->nama,
                'alamat_detail' => $patient->alamat,
                'kecamatan' => '', 
                'no_bpjs' => $patient->no_bpjs ?? ''
            ]);
        }

        // Fallback or just return not found
        return response()->json(['found' => false]);
    }
}
