@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6 bg-blue-600 text-white">
            <h2 class="text-2xl font-bold flex items-center">
                <i data-feather="user-plus" class="mr-2"></i> Pendaftaran Pasien Baru
            </h2>
            <p class="mt-1 text-blue-100">Silakan isi formulir di bawah ini untuk mengambil nomor antrian.</p>
        </div>
        
        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="credit-card" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="nik" id="nik" required maxlength="16" minlength="16" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border" placeholder="16 digit NIK">
                    </div>
                </div>

                <div>
                    <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="user" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_pasien" id="nama_pasien" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border" placeholder="Nama sesuai KTP">
                    </div>
                </div>

                <div>
                    <label for="alamat_detail" class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili (Jalan, RT/RW, Dusun)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-start pt-2 pointer-events-none">
                            <i data-feather="map-pin" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <textarea name="alamat_detail" id="alamat_detail" rows="2" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border" placeholder="Nama Jalan, RT/RW, No Rumah..."></textarea>
                    </div>
                </div>

                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan (Kab. Sumedang)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="map" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <select name="kecamatan" id="kecamatan" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border">
                            <option value="" disabled selected>Pilih Kecamatan...</option>
                            <option value="Buahdua">Buahdua</option>
                            <option value="Cibugel">Cibugel</option>
                            <option value="Cimalaka">Cimalaka</option>
                            <option value="Cimanggung">Cimanggung</option>
                            <option value="Cisarua">Cisarua</option>
                            <option value="Cisitu">Cisitu</option>
                            <option value="Conggeang">Conggeang</option>
                            <option value="Darmaraja">Darmaraja</option>
                            <option value="Ganeas">Ganeas</option>
                            <option value="Jatigede">Jatigede</option>
                            <option value="Jatinangor">Jatinangor</option>
                            <option value="Jatinunggal">Jatinunggal</option>
                            <option value="Pamulihan">Pamulihan</option>
                            <option value="Paseh">Paseh</option>
                            <option value="Rancakalong">Rancakalong</option>
                            <option value="Situraja">Situraja</option>
                            <option value="Sukasari">Sukasari</option>
                            <option value="Sumedang Selatan">Sumedang Selatan</option>
                            <option value="Sumedang Utara">Sumedang Utara</option>
                            <option value="Surian">Surian</option>
                            <option value="Tanjungkerta">Tanjungkerta</option>
                            <option value="Tanjungmedar">Tanjungmedar</option>
                            <option value="Tanjungsari">Tanjungsari</option>
                            <option value="Tomo">Tomo</option>
                            <option value="Ujungjaya">Ujungjaya</option>
                            <option value="Wado">Wado</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="no_bpjs" class="block text-sm font-medium text-gray-700 mb-1">Nomor BPJS (Opsional)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="monitor" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="no_bpjs" id="no_bpjs" maxlength="13" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border" placeholder="Kosongkan jika Pasien Umum">
                    </div>
                     <p class="mt-1 text-xs text-gray-500">*Jika diisi, pasien tidak perlu membayar pendaftaran.</p>
                </div>

                <div>
                    <label for="poli_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Poli Tujuan</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="activity" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <select name="poli_tujuan" id="poli_tujuan" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border">
                            <option value="" disabled selected>Pilih Poli...</option>
                            <option value="Umum">Poli Umum</option>
                            <option value="Gigi">Poli Gigi</option>
                            <option value="Anak">Poli Anak</option>
                            <option value="Penyakit Dalam">Poli Penyakit Dalam</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <i data-feather="check-circle" class="mr-2 -ml-1 h-5 w-5"></i>
                        Ambil Nomor Antrian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const nikInput = document.getElementById('nik');
    const namaInput = document.getElementById('nama_pasien');
    const alamatInput = document.getElementById('alamat_detail');
    const kecamatanInput = document.getElementById('kecamatan');

    const noBpjsInput = document.getElementById('no_bpjs');

    // Auto-fill from Session (Server-side to Client-side)
    @if(session('patient_id'))
        nikInput.value = "{{ session('patient_nik') }}";
        nikInput.setAttribute('readonly', true);
        nikInput.classList.add('bg-gray-100');
        
        namaInput.value = "{{ session('patient_name') }}";
        namaInput.setAttribute('readonly', true);
        namaInput.classList.add('bg-gray-100');
        
        // Fetch address & BPJS from our new API logic
        fetch(`{{ route('check.nik') }}?nik={{ session('patient_nik') }}`)
            .then(res => res.json())
            .then(data => {
                if(data.found) {
                    alamatInput.value = data.alamat_detail;
                    if(data.no_bpjs) {
                        noBpjsInput.value = data.no_bpjs;
                    }
                }
            });
    @endif

</script>
@endsection
