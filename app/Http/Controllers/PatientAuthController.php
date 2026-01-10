<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|string',
        ]);

        $patient = Patient::where('nik', $request->nik)
            ->where('nama', $request->nama) // Simple auth: Exact match NIK & Name
            ->first();

        if ($patient) {
            session(['patient_id' => $patient->id]);
            session(['patient_name' => $patient->nama]);
            session(['patient_nik' => $patient->nik]);
            
            return redirect()->route('patient.dashboard');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan. Silakan daftar jika belum punya akun.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik',
            'nama' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_bpjs' => 'nullable|string',
        ]);

        $patient = Patient::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_bpjs' => $request->no_bpjs,
        ]);

        // Auto login after register
        session(['patient_id' => $patient->id]);
        session(['patient_name' => $patient->nama]);
        session(['patient_nik' => $patient->nik]);

        return redirect()->route('patient.dashboard')->with('success', 'Pendaftaran Akun Berhasil!');
    }

    public function logout()
    {
        session()->forget(['patient_id', 'patient_name', 'patient_nik']);
        return redirect()->route('landing');
    }
}
