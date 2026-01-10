@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(!$selectedPoli)
        <!-- POLY SELECTION SCREEN -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Pilih Poliklinik</h1>
            <p class="text-gray-500 mt-2">Silakan pilih poliklinik Anda untuk memulai pemeriksaan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $polis = [
                    ['name' => 'Umum', 'label' => 'Poli Umum', 'icon' => 'activity', 'color' => 'blue'],
                    ['name' => 'Gigi', 'label' => 'Poli Gigi', 'icon' => 'smile', 'color' => 'purple'],
                    ['name' => 'Anak', 'label' => 'Poli Anak', 'icon' => 'users', 'color' => 'yellow'],
                    ['name' => 'Penyakit Dalam', 'label' => 'Poli Penyakit Dalam', 'icon' => 'heart', 'color' => 'red'],
                ];
            @endphp

            @foreach($polis as $poli)
            <a href="{{ route('admin.dokter', ['poli' => $poli['name']]) }}" class="block group">
                <div class="bg-white hover:bg-{{ $poli['color'] }}-50 border border-gray-200 hover:border-{{ $poli['color'] }}-300 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-200 p-8 flex flex-col items-center justify-center h-48">
                    <div class="bg-{{ $poli['color'] }}-100 p-4 rounded-full mb-4 group-hover:scale-110 transition-transform">
                        <i data-feather="{{ $poli['icon'] }}" class="w-8 h-8 text-{{ $poli['color'] }}-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-{{ $poli['color'] }}-700">{{ $poli['label'] }}</h3>
                    <div class="mt-2 text-xs font-medium text-gray-500 flex items-center">
                        Masuk <i data-feather="arrow-right" class="w-3 h-3 ml-1"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    @else
        <!-- DOCTOR EXAM TABLE SCREEN -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pemeriksaan Poli {{ $selectedPoli }}</h1>
                <p class="text-gray-500">Daftar pasien yang sedang diperiksa.</p>
            </div>
            <a href="{{ route('admin.dokter') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg transition flex items-center shadow-sm">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Menu Poli
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-green-50">
                <h3 class="text-lg leading-6 font-medium text-green-900 flex items-center">
                    <i data-feather="activity" class="mr-2 w-5 h-5"></i> Sedang Dipanggil / Diperiksa
                </h3>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Antrian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($activePatients as $pasien)
                    <tr class="bg-green-50/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-xl font-bold text-gray-900">{{ $pasien->nomor_antrian }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                             <div class="text-sm font-medium text-gray-900">{{ $pasien->nama_pasien }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pasien->doctor_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openExamModal('{{ $pasien->id }}', '{{ route('admin.store_examination', $pasien->id) }}')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-xs transition flex items-center shadow-sm">
                                <i data-feather="clipboard" class="w-4 h-4 mr-2"></i> Input Hasil
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            Tidak ada pasien poli ini yang sedang diperiksa saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- History / Completed today -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Selesai Hari Ini
                </h3>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosa</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($completedPatients as $pasien)
                    <tr class="opacity-75">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $pasien->nama_pasien }}
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Selesai</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $pasien->doctor_name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 truncate max-w-xs">
                            {{ $pasien->diagnosa }}
                        </td>
                    </tr>
                    @empty
                     <tr>
                        <td colspan="3" class="px-6 py-6 text-center text-sm text-gray-500">
                            Belum ada data selesai untuk poli ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection

@push('modals')
<!-- Exam Modal (Reused) -->
<div id="examModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
            <form id="examForm" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4 flex items-center" id="modal-title">
                        <i data-feather="clipboard" class="text-blue-500 mr-2 w-5 h-5"></i> Input Hasil Pemeriksaan
                    </h3>

                    <!-- Vital Signs -->
                    <div class="grid grid-cols-2 gap-4 mb-4 bg-gray-50 p-3 rounded-lg border border-gray-200">
                        <div class="col-span-2 text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Tanda Vital</div>
                         <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Tensi Darah</label>
                            <input type="text" name="tensi_darah" class="shadow-sm border-gray-300 rounded-md w-full text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g 120/80">
                        </div>
                         <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Suhu Tubuh (°C)</label>
                            <input type="number" step="0.1" name="suhu_tubuh" class="shadow-sm border-gray-300 rounded-md w-full text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="36.5">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" class="shadow-sm border-gray-300 rounded-md w-full text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="60">
                        </div>
                         <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" class="shadow-sm border-gray-300 rounded-md w-full text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="170">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Diagnosa</label>
                        <textarea name="diagnosa" class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" required placeholder="Hasil diagnosa dokter..."></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tindakan</label>
                        <textarea name="tindakan" class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="2" placeholder="Tindakan yang dilakukan..."></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Resep Obat</label>
                        <textarea name="resep_obat" class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="Daftar obat..."></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Catatan Dokter</label>
                        <textarea name="catatan_dokter" class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>

                    <input type="hidden" name="id" id="patient_id">
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan & Selesai
                    </button>
                    <button type="button" onclick="closeExamModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@section('scripts')
<script>
    window.openExamModal = function(id, url) {
        document.getElementById('examForm').action = url;
        document.getElementById('patient_id').value = id;
        document.getElementById('examModal').classList.remove('hidden');
    }

    window.closeExamModal = function() {
        document.getElementById('examModal').classList.add('hidden');
    }
</script>
@endsection
