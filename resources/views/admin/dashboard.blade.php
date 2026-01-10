@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Utama</h1>
            <p class="text-sm text-gray-500">Ringkasan aktivitas klinik hari ini, {{ now()->isoFormat('D MMMM Y') }}</p>
        </div>
        <div class="text-sm bg-white border px-4 py-2 rounded-lg shadow-sm">
            <span class="text-gray-500">Update Terakhir:</span> <span class="font-semibold text-gray-900">{{ now()->format('H:i') }}</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Visits -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Kunjungan</p>
                    <h3 class="text-3xl font-bold">{{ $totalVisits }}</h3>
                </div>
                <div class="bg-white/20 p-2 rounded-lg">
                    <i data-feather="users" class="w-6 h-6 text-white"></i>
                </div>
            </div>
            <div class="mt-4 text-xs text-blue-100 flex items-center">
                <i data-feather="calendar" class="w-3 h-3 mr-1"></i> Hari Ini
            </div>
        </div>

        <!-- Waiting -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Sedang Menunggu</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $waitingPatients }}</h3>
                </div>
                <div class="bg-orange-100 p-2 rounded-lg">
                    <i data-feather="clock" class="w-6 h-6 text-orange-600"></i>
                </div>
            </div>
            <div class="mt-4 text-xs text-orange-600 font-medium">
                Termasuk Pembayaran
            </div>
        </div>

        <!-- Serving -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Sedang Diperiksa</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $confimedPatients }}</h3>
                </div>
                <div class="bg-purple-100 p-2 rounded-lg">
                    <i data-feather="activity" class="w-6 h-6 text-purple-600"></i>
                </div>
            </div>
             <div class="mt-4 text-xs text-gray-400">
                Dokter Active
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Selesai</p>
                    <h3 class="text-3xl font-bold text-green-600">{{ $completedPatients }}</h3>
                </div>
                <div class="bg-green-100 p-2 rounded-lg">
                    <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                </div>
            </div>
             <div class="mt-4 text-xs text-gray-400">
                Pasien Pulang
            </div>
        </div>
    </div>

    <!-- Charts / Detail Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Poly Distribution -->
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6 lg:col-span-3">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Poliklinik</h3>
            <div class="space-y-4">
                @foreach($poliStats as $stat)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-gray-700">Poli {{ $stat->poli_tujuan }}</span>
                        <span class="text-gray-900">{{ $stat->total }} Pasien</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($totalVisits > 0) ? ($stat->total / $totalVisits * 100) : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
                @if($poliStats->isEmpty())
                    <p class="text-gray-500 text-sm text-center py-4">Belum ada data kunjungan hari ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
