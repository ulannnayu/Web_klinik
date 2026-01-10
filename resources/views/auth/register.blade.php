@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center py-12">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Pendaftaran Akun Pasien</h2>
            <p class="text-gray-500 text-sm">Silakan isi data diri Anda dengan benar.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('patient.register.submit') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i data-feather="credit-card" class="w-5 h-5"></i>
                    </span>
                    <input type="text" name="nik" required maxlength="16" minlength="16" inputmode="numeric" class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="16 digit NIK">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i data-feather="user" class="w-5 h-5"></i>
                    </span>
                    <input type="text" name="nama" required class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Sesuai KTP">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Jalan, RT/RW, Dusun, Desa, Kecamatan..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. BPJS (Opsional)</label>
                <input type="text" name="no_bpjs" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Jika ada">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-500">Sudah punya akun?</p>
            <a href="{{ route('landing') }}" class="text-blue-600 font-semibold hover:underline">Masuk disini</a>
        </div>
    </div>
</div>
@endsection
