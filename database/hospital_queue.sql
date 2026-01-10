CREATE TABLE `pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_pasien` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `poli_tujuan` varchar(50) NOT NULL,
  `nomor_antrian` varchar(20) NOT NULL,
  `status` enum('menunggu','dipanggil','selesai') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
