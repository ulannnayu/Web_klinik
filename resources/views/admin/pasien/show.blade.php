@extends('layouts.admin')

@section('title', 'Detail Pasien')

@section('content')
<div class="space-y-6">
    <!-- Header / Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.pasien') }}" class="text-gray-500 hover:text-gray-700">
            <i data-feather="arrow-left" class="w-6 h-6"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Detail Pasien</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Patient Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="flex flex-col items-center pb-6 border-b border-gray-100">
                    <div class="h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-3xl mb-4">
                        {{ substr($patient->nama, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 text-center">{{ $patient->nama }}</h2>
                    <span class="text-sm text-gray-500">{{ $patient->nik }}</span>
                    @if($patient->no_bpjs)
                        <span class="mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            BPJS: {{ $patient->no_bpjs }}
                        </span>
                    @else
                        <span class="mt-2 px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">
                            Non-BPJS
                        </span>
                    @endif
                </div>
                <div class="pt-6 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->alamat }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Terdaftar Sejak</label>
                        <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($patient->created_at)->translatedFormat('d F Y') }}</p>
                    </div>
                    <!-- Add more fields if available in database like Phone, DOB etc -->
                </div>
            </div>
        </div>

        <!-- Visit History -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-bold text-gray-900">Riwayat Kunjungan</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($visits as $visit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $visit->poli_tujuan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $visit->doctor_name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="line-clamp-2">{{ $visit->diagnosa ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($visit->status == 'selesai')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                    @elseif($visit->status == 'menunggu')
                                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Menunggu</span>
                                    @elseif($visit->status == 'dipanggil')
                                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Diperiksa</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($visit->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">
                                    Belum ada riwayat kunjungan.
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
