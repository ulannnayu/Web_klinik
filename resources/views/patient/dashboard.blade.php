@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Header -->
        <div
            class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Halo, {{ session('patient_name') }}! 👋</h1>
                <p class="text-gray-500 mt-1">Nomor Rekam Medis / NIK: {{ session('patient_nik') }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-medium text-sm">
                    Pasien Terdaftar
                </span>
            </div>
        </div>

        <!-- Global Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-blue-600 font-medium">Total Pasien</h3>
                        <div class="text-4xl font-bold mt-2 text-gray-900">{{ $totalPasien }}</div>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-xl">
                        <i data-feather="users" class="w-8 h-8 text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-4 text-gray-500 text-sm">Terdaftar hari ini</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-green-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-green-600 font-medium">Sedang Dirawat</h3>
                        <div class="text-4xl font-bold mt-2 text-gray-900">{{ $sedangDirawat }}</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded-xl">
                        <i data-feather="activity" class="w-8 h-8 text-green-600"></i>
                    </div>
                </div>
                <div class="mt-4 text-gray-500 text-sm">Pasien sedang diperiksa</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-orange-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-600 font-medium">Antrian Menunggu</h3>
                        <div class="text-4xl font-bold mt-2 text-gray-900">{{ $menunggu }}</div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-xl">
                        <i data-feather="clock" class="w-8 h-8 text-orange-600"></i>
                    </div>
                </div>
                <div class="mt-4 text-gray-500 text-sm">Belum dipanggil</div>
            </div>
        </div>

        @if(isset($myQueue))

            @if($myQueue->status == 'memanggil')
                <div
                    class="mb-8 bg-gradient-to-r from-green-500 to-green-700 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold mb-2">Giliran Anda!</h2>
                            <p class="text-green-100 text-lg">Silakan segera masuk ke ruang pemeriksaan {{ $myQueue->poli_tujuan }}.
                            </p>
                            <div
                                class="mt-4 inline-flex items-center bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/30">
                                <i data-feather="bell" class="w-5 h-5 mr-2"></i>
                                <span class="font-bold">Nomor Antrian Anda Dipanggil</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-white/20 p-4 rounded-full mb-2">
                                <i data-feather="check-circle" class="w-12 h-12"></i>
                            </div>
                            <span class="font-bold text-lg">Poli {{ $myQueue->poli_tujuan }}</span>
                        </div>
                    </div>
                    <!-- Decoration -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                </div>
            @endif

            @if($myQueue->status == 'menunggu_pembayaran')
                <div
                    class="mb-8 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold mb-2">Menunggu Pembayaran</h2>
                            <p class="text-orange-100 text-lg">Silakan menuju Kasir/Resepsionis untuk pembayaran.</p>
                            <div
                                class="mt-4 inline-flex items-center bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/30">
                                <i data-feather="alert-circle" class="w-5 h-5 mr-2"></i>
                                <span class="font-bold">Antrian Belum Diterbitkan</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-white/20 p-4 rounded-full mb-2">
                                <i data-feather="dollar-sign" class="w-12 h-12"></i>
                            </div>
                            <span class="font-bold text-lg">Pasien Umum</span>
                        </div>
                    </div>
                    <!-- Decoration -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                </div>

            @else
                <div
                    class="mb-8 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold mb-2">Antrian Aktif Anda</h2>
                            <p class="text-blue-200 mb-4">Silakan menunggu nomor Anda dipanggil.</p>

                            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                                    <span class="block text-blue-200 text-xs uppercase tracking-wide">Status Antrian</span>
                                    <span class="block font-bold text-lg uppercase">{{ $myQueue->status }}</span>
                                </div>

                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                                    <span class="block text-blue-200 text-xs uppercase tracking-wide">Sedang Dilayani</span>
                                    <span class="block font-bold text-lg uppercase">{{ $currentServing ?? '-' }}</span>
                                </div>

                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                                    <span class="block text-blue-200 text-xs uppercase tracking-wide">Antrian di Depan Anda</span>
                                    <span class="block font-bold text-lg uppercase">{{ $queueRemaining }} Orang</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center mt-6 md:mt-0">
                            <span class="text-blue-200 text-sm font-medium uppercase tracking-wider mb-2">Nomor Antrian</span>
                            <div
                                class="text-6xl font-black tracking-tighter bg-white text-blue-800 px-8 py-4 rounded-2xl shadow-lg">
                                {{ $myQueue->nomor_antrian }}
                            </div>
                            <div class="mt-4 text-blue-100 font-medium bg-blue-700/50 px-4 py-1 rounded-full">
                                Poli {{ $myQueue->poli_tujuan }}
                            </div>
                        </div>
                    </div>

                    <!-- Decoration -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-purple-500 opacity-20 rounded-full blur-3xl">
                    </div>
                </div>
            @endif
        @endif

        <!-- Menu Grid -->
        <!-- Menu Grid -->
        <!-- Menu Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Menu 1: Ambil Antrian -->
            <a href="{{ route('pendaftaran.index') }}"
                class="group bg-blue-600 hover:bg-blue-700 rounded-2xl p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-feather="plus-circle" class="w-6 h-6 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Ambil Antrian</h3>
                <p class="text-blue-100 text-sm">Daftar antrian untuk pemeriksaan hari ini.</p>
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i data-feather="arrow-right" class="w-5 h-5 text-white"></i>
                </div>
            </a>

            <!-- Menu 2: Riwayat Kunjungan -->
            <a href="{{ route('patient.history') }}"
                class="group bg-purple-600 hover:bg-purple-700 rounded-2xl p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-feather="clock" class="w-6 h-6 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Riwayat Kunjungan</h3>
                <p class="text-purple-100 text-sm">Lihat histori pendaftaran dan pemeriksaan Anda.</p>
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i data-feather="arrow-right" class="w-5 h-5 text-white"></i>
                </div>
            </a>

            <!-- Menu 3: Pengaturan Akun -->
            <a href="{{ route('patient.settings') }}"
                class="group bg-gray-600 hover:bg-gray-700 rounded-2xl p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i data-feather="settings" class="w-6 h-6 text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Pengaturan Akun</h3>
                <p class="text-gray-100 text-sm">Ubah data diri dan informasi akun.</p>
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i data-feather="arrow-right" class="w-5 h-5 text-white"></i>
                </div>
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i data-feather="info" class="w-4 h-4 mr-2 text-blue-500"></i> Informasi Penting
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <i data-feather="check" class="w-4 h-4 mr-2 mt-0.5 text-green-500"></i>
                        Pastikan membawa KTP saat berkunjung.
                    </li>
                    <li class="flex items-start">
                        <i data-feather="check" class="w-4 h-4 mr-2 mt-0.5 text-green-500"></i>
                        Datang 15 menit sebelum estimasi panggilan.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection