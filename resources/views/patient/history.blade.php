@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pb-12">
    <!-- Header -->
    <div class="bg-blue-600 pb-24 pt-12">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between text-white">
                <div>
                    <h1 class="text-3xl font-bold">Riwayat Kunjungan</h1>
                    <p class="mt-2 text-blue-100">Daftar pemeriksaan kesehatan Anda sebelumnya.</p>
                </div>
                <a href="{{ route('patient.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg backdrop-blur-sm transition flex items-center">
                    <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 -mt-16">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6">
                <!-- Wrapper for responsive table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosa & Catatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail & Tanda Vital</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($history as $visit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($visit->created_at)->format('d M Y') }}
                                    <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($visit->created_at)->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $visit->poli_tujuan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="max-w-xs truncate" title="{{ $visit->diagnosa }}">
                                        {{ $visit->diagnosa ?: '-' }}
                                    </div>
                                    @if($visit->catatan_dokter)
                                        <div class="mt-1 text-xs text-gray-500 italic border-l-2 border-gray-300 pl-2">
                                            "{{ Str::limit($visit->catatan_dokter, 40) }}"
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                     <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs mb-2 bg-gray-50 p-2 rounded">
                                        <div><span class="font-semibold">TD:</span> {{ $visit->tensi_darah ?? '-' }}</div>
                                        <div><span class="font-semibold">Suhu:</span> {{ $visit->suhu_tubuh ? $visit->suhu_tubuh.'°C' : '-' }}</div>
                                        <div><span class="font-semibold">BB:</span> {{ $visit->berat_badan ? $visit->berat_badan.'kg' : '-' }}</div>
                                        <div><span class="font-semibold">TB:</span> {{ $visit->tinggi_badan ? $visit->tinggi_badan.'cm' : '-' }}</div>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        @if($visit->tindakan)
                                        <div class="flex items-start text-xs">
                                            <span class="font-bold mr-1">Tindakan:</span> {{ Str::limit($visit->tindakan, 30) }}
                                        </div>
                                        @endif
                                        @if($visit->resep_obat)
                                        <div class="flex items-start text-xs text-green-600">
                                            <span class="font-bold mr-1">Obat:</span> {{ Str::limit($visit->resep_obat, 30) }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $visit->doctor_name ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i data-feather="calendar" class="w-10 h-10 mb-3 text-gray-300"></i>
                                        <p>Belum ada riwayat kunjungan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
