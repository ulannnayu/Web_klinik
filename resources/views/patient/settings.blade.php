@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pb-12">
    <!-- Header -->
    <div class="bg-blue-600 pb-24 pt-12">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between text-white">
                <div>
                    <h1 class="text-3xl font-bold">Pengaturan Akun</h1>
                    <p class="mt-2 text-blue-100">Kelola informasi data diri dan alamat Anda.</p>
                </div>
                <a href="{{ route('patient.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg backdrop-blur-sm transition flex items-center">
                    <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 -mt-16">
        <div class="max-w-2xl mx-auto">
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <form action="{{ route('patient.settings.update') }}" method="POST" class="p-8">
                    @csrf
                    
                    <!-- Identity Section (Read Only) -->
                    <div class="mb-8 border-b border-gray-100 pb-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i data-feather="user" class="w-5 h-5 mr-2 text-blue-500"></i> Identitas Utama
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">NIK</label>
                                <input type="text" value="{{ $patient->nik }}" class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" readonly disabled>
                                <p class="mt-1 text-xs text-gray-400">NIK tidak dapat diubah.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                                <input type="text" value="{{ $patient->nama }}" class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" readonly disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Editable Section -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i data-feather="edit-3" class="w-5 h-5 mr-2 text-blue-500"></i> Informasi Kontak & BPJS
                        </h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" rows="3" class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" required>{{ $patient->alamat }}</textarea>
                            </div>

                            <div>
                                <label for="no_bpjs" class="block text-sm font-medium text-gray-700 mb-1">Nomor BPJS (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="credit-card" class="h-4 w-4 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="no_bpjs" id="no_bpjs" value="{{ $patient->no_bpjs }}" class="pl-10 w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" placeholder="Masukkan Nomor BPJS jika ada">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition flex items-center">
                            <i data-feather="save" class="w-4 h-4 mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
