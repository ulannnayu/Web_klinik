<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Dummy User
        User::factory()->create([
            'name' => 'Admin Staff',
            'email' => 'admin@hospital.com',
            'password' => bcrypt('password'),
        ]);

        // Dummy Data Pasiens
        $pasiens = [
            [
                'nama_pasien' => 'Budi Santoso',
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'poli_tujuan' => 'Poli Umum',
                'nomor_antrian' => 'A-001',
                'status' => 'menunggu',
            ],
            [
                'nama_pasien' => 'Siti Aminah',
                'nik' => '6543210987654321',
                'alamat' => 'Jl. Sudirman No. 5, Bandung',
                'poli_tujuan' => 'Poli Gigi',
                'nomor_antrian' => 'B-001',
                'status' => 'dipanggil',
            ],
            [
                'nama_pasien' => 'Andi Wijaya',
                'nik' => '1122334455667788',
                'alamat' => 'Jl. Gatot Subroto No. 88, Surabaya',
                'poli_tujuan' => 'Poli Anak',
                'nomor_antrian' => 'C-001',
                'status' => 'selesai',
            ],
            [
                'nama_pasien' => 'Dewi Lestari',
                'nik' => '9988776655443322',
                'alamat' => 'Jl. Pahlawan No. 45, Semarang',
                'poli_tujuan' => 'Poli Umum',
                'nomor_antrian' => 'A-002',
                'status' => 'menunggu',
            ],
            [
                'nama_pasien' => 'Rizky Ramadhan',
                'nik' => '3344556677889900',
                'alamat' => 'Jl. Diponegoro No. 12, Yogyakarta',
                'poli_tujuan' => 'Poli Gigi',
                'nomor_antrian' => 'B-002',
                'status' => 'menunggu',
            ],
        ];

        foreach ($pasiens as $data) {
            Pasien::create($data);
        }
    }
}
