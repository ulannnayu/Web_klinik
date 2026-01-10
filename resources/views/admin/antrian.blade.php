@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Antrian Poliklinik</h1>
            <p class="text-gray-500">Kelola antrian dan penugasan dokter.</p>
        </div>
        <div class="text-right">
             <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-md text-sm font-medium">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    <!-- Active Queues -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Daftar Antrian Menunggu Dokter
            </h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Antrian</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli Tujuan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi / Penugasan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($queues as $pasien)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-2xl font-bold text-gray-900">{{ $pasien->nomor_antrian }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $pasien->nama_pasien }}</div>
                        <div class="text-xs text-gray-500">NIK: {{ $pasien->nik }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $pasien->poli_tujuan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ ucfirst($pasien->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @if($pasien->status == 'menunggu')
                            <form action="{{ route('admin.call', $pasien->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs transition shadow-sm flex items-center">
                                    <i data-feather="mic" class="w-3 h-3 mr-1"></i> Panggil
                                </button>
                            </form>
                        @elseif($pasien->status == 'memanggil')
                            <div class="flex space-x-2">
                                <form action="{{ route('admin.confirm', $pasien->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-xs transition shadow-sm flex items-center">
                                        <i data-feather="log-in" class="w-3 h-3 mr-1"></i> Masuk
                                    </button>
                                </form>
                                <form action="{{ route('admin.skip', $pasien->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-xs transition shadow-sm flex items-center" onclick="return confirm('Lewati pasien ini?')">
                                        <i data-feather="skip-forward" class="w-3 h-3 mr-1"></i> Lewati
                                    </button>
                                </form>
                            </div>
                        @elseif($pasien->status == 'dilewati')
                            <form action="{{ route('admin.call', $pasien->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded text-xs transition shadow-sm flex items-center">
                                    <i data-feather="rotate-ccw" class="w-3 h-3 mr-1"></i> Panggil Lagi
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i data-feather="users" class="w-12 h-12 text-gray-300 mb-2"></i>
                            <p>Tidak ada pasien menunggu dokter.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
