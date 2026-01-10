@extends('layouts.admin')

@section('title', 'Data Pasien')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Data Pasien Terdaftar</h1>
            <p class="text-sm text-gray-500">Kelola data seluruh pasien yang memiliki akun.</p>
        </div>
        <div>
            <!-- Search -->
            <form method="GET" action="{{ route('admin.pasien') }}" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK / Nama..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                <i data-feather="search" class="absolute left-3 top-2.5 h-4 w-4 text-gray-400"></i>
            </form>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK / BPJS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Daftar</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($allPatients as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0">
                                {{ substr($p->nama, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $p->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $p->email ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $p->nik }}</div>
                        @if($p->no_bpjs)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                BPJS: {{ $p->no_bpjs }}
                            </span>
                        @else
                             <span class="text-xs text-gray-400">Non-BPJS</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 line-clamp-2 max-w-xs">{{ $p->alamat }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                             <a href="{{ route('admin.pasien.show', $p->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded text-xs font-medium transition-colors">Detail</a>
                             <form action="{{ route('admin.pasien.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini? Data yang dihapus tidak dapat dikembalikan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-100 hover:bg-red-200 px-3 py-1 rounded text-xs font-medium transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        <i data-feather="inbox" class="mx-auto h-12 w-12 text-gray-300 mb-3"></i>
                        <p>Belum ada data pasien terdaftar.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($allPatients->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
             {{ $allPatients->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
