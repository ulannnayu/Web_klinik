<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientDashboardController extends Controller
{
    public function index()
    {
        if (! session('patient_id')) {
            return redirect()->route('landing');
        }

        // 1. Fetch Global Stats (Same as Landing Page)
        $today = now()->today();
        $totalPasien = DB::table('pasiens')->whereDate('created_at', $today)->count();
        $sedangDirawat = DB::table('pasiens')->whereDate('created_at', $today)->where('status', 'dipanggil')->count();
        $menunggu = DB::table('pasiens')->whereDate('created_at', $today)->where('status', 'menunggu')->count();

        // 2. Fetch User's Active Queue
        $myQueue = DB::table('pasiens')
            ->where('nik', session('patient_nik'))
            ->whereDate('created_at', $today)
            ->whereIn('status', ['menunggu', 'memanggil', 'dipanggil', 'menunggu_pembayaran']) // Include pending payment
            ->orderBy('id', 'desc')
            ->first();

        // 3. Calculate Queue Details (If active queue exists)
        $currentServing = null;
        $queueRemaining = 0;

        if ($myQueue) {
            // Who is currently being served in THIS poli?
            $currentServing = DB::table('pasiens')
                ->whereDate('created_at', $today)
                ->where('poli_tujuan', $myQueue->poli_tujuan)
                ->where('status', 'dipanggil')
                ->value('nomor_antrian'); // Get just the number

            // How many people are AHEAD of me in waiting list?
            // Logic: Same Poli, Status 'menunggu', Created BEFORE me (ID < My ID)
            $queueRemaining = DB::table('pasiens')
                ->whereDate('created_at', $today)
                ->where('poli_tujuan', $myQueue->poli_tujuan)
                ->where('status', 'menunggu')
                ->where('id', '<', $myQueue->id)
                ->count();
        }

        return view('patient.dashboard', compact('myQueue', 'totalPasien', 'sedangDirawat', 'menunggu', 'currentServing', 'queueRemaining'));
    }
    public function history()
    {
        if (! session('patient_id')) {
            return redirect()->route('landing');
        }

        $history = DB::table('pasiens')
            ->where('nik', session('patient_nik'))
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.history', compact('history'));
    }

    public function settings()
    {
        if (! session('patient_id')) {
            return redirect()->route('landing');
        }

        $patient = DB::table('patients')
            ->where('nik', session('patient_nik'))
            ->first();

        return view('patient.settings', compact('patient'));
    }

    public function updateSettings(Request $request)
    {
        if (! session('patient_id')) {
            return redirect()->route('landing');
        }

        // Only allow updating address and BPJS for now, NIK/Name are identifiers
        $request->validate([
            'alamat' => 'required|string',
            'no_bpjs' => 'nullable|numeric',
        ]);

        DB::table('patients')
            ->where('nik', session('patient_nik'))
            ->update([
                'alamat' => $request->alamat,
                'no_bpjs' => $request->no_bpjs,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
