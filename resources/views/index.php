@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center py-12 md:py-0">
    <div class="text-center mb-8 md:mb-12 px-4">
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
            Selamat Datang di <span class="text-blue-600">RS Sehat Selalu</span>
        </h1>
        <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
            Sistem pendaftaran dan antrian modern untuk pelayanan kesehatan yang lebih baik. Silakan pilih akses masuk Anda di bawah ini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 w-full max-w-4xl px-4">
        <!-- Patient Card -->
        <a href="{{ route('pendaftaran.index') }}" class="group relative bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i data-feather="user" class="w-32 h-32 text-blue-600"></i>
            </div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-6 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <i data-feather="user" class="w-10 h-10"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Login Pasien</h2>
                <p class="text-gray-500 mb-6">Untuk pendaftaran pasian baru, cek antrian, dan status pemeriksaan.</p>
                <div class="text-blue-600 font-semibold flex items-center group-hover:translate-x-1 transition-transform">
                    Masuk Sekarang <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                </div>
            </div>
        </a>

        <!-- Admin Card -->
        <a href="{{ route('admin.dashboard') }}" class="group relative bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i data-feather="shield" class="w-32 h-32 text-purple-600"></i>
            </div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-6 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <i data-feather="command" class="w-10 h-10"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Login Admin</h2>
                <p class="text-gray-500 mb-6">Khusus staff dan dokter untuk mengelola antrian dan penugasan pasien.</p>
                <div class="text-purple-600 font-semibold flex items-center group-hover:translate-x-1 transition-transform">
                    Kelola Sistem <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Footer Note -->
    <div class="mt-16 text-center text-gray-400 text-sm">
        <p>&copy; {{ date('Y') }} Rumah Sakit Sehat Selalu. Sistem Antrian Digital.
            (Protoype)</p>
    </div>
</div>
@endsection
