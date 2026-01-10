@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Status Antrian Pasien</h1>
    <p class="text-gray-500">Pantau status antrian Anda secara real-time.</p>
</div>

<!-- Info Antrian Saat Ini -->
@if(session('success'))
<div class="max-w-2xl mx-auto bg-green-50 border border-green-200 rounded-lg p-6 mb-10 text-center shadow-sm">
    <h3 class="text-lg font-medium text-green-800">Pendaftaran Berhasil!</h3>
    <p class="mt-2 text-green-600">Nomor antrian Anda adalah:</p>
    <div class="mt-4 text-5xl font-extrabold text-green-700 tracking-wider">
        {{ str_replace('Pendaftaran Berhasil! Nomor Antrian Anda: ', '', session('success')) }}
    </div>
    <p class="mt-4 text-sm text-green-600">Silakan menunggu panggilan petugas.</p>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Kolom Kiri: Antrian Dipanggil -->
    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-yellow-500">
        <h3 class="text-lg font-semibold text-gray-700 flex items-center justify-center mb-6">
            <i data-feather="volume-2" class="mr-2 text-yellow-500"></i> Sedang Dipanggil
        </h3>
        
        @if($current)
            <div class="text-center py-8">
                <span class="block text-sm text-gray-400 uppercase tracking-widest">Nomor Antrian</span>
                <span class="block text-6xl font-black text-gray-900 mt-2">{{ $current->nomor_antrian }}</span>
                <span class="block text-xl text-blue-600 mt-4 font-medium">{{ $current->nama_pasien }}</span>
                <span class="inline-block mt-3 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                    {{ $current->poli_tujuan }}
                </span>
            </div>
        @else
            <div class="text-center py-10 text-gray-400">
                <i data-feather="coffee" class="h-12 w-12 mx-auto mb-3 opacity-50"></i>
                <p>Belum ada antrian yang dipanggil.</p>
            </div>
        @endif
    </div>

    <!-- Kolom Kanan: Daftar Antrian -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-semibold text-gray-700">Daftar Antrian Hari Ini</h3>
            <span class="text-xs font-medium bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ count($antrian) }} Pasien</span>
        </div>
        
        <ul class="divide-y divide-gray-100 max-h-[400px] overflow-y-auto">
            @forelse($antrian as $pasien)
                <li class="p-4 hover:bg-gray-50 flex justify-between items-center transition duration-150">
                    <div>
                        <span class="font-bold text-gray-900 block">{{ $pasien->nomor_antrian }}</span>
                        <span class="text-sm text-gray-500">{{ $pasien->nama_pasien }}</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-xs font-semibold text-gray-500">{{ $pasien->poli_tujuan }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                            {{ $pasien->status === 'menunggu' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $pasien->status === 'dipanggil' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $pasien->status === 'selesai' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst($pasien->status) }}
                        </span>
                    </div>
                </li>
            @empty
                <li class="p-8 text-center text-gray-500">
                    Belum ada antrian hari ini.
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
