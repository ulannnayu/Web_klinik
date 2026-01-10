<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLINIQ - Layanan Kesehatan Digital Terpercaya</title>
    
    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hero-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass-effect border-b border-gray-100/50 shadow-sm" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i data-feather="activity" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl text-gray-900 tracking-tight leading-none">KLINIQ</h1>
                        <span class="text-xs text-blue-600 font-medium tracking-wide">SMART HEALTHCARE</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#jadwal" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Jadwal Dokter</a>
                    <a href="#layanan" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Layanan</a>
                    <a href="#kontak" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Kontak</a>
                </div>

                <!-- Action Button -->
                <div class="hidden md:flex items-center gap-3">
                    @if(session('admin_authenticated'))
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-full hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                            Dashboard Admin
                        </a>
                    @elseif(session('patient_id'))
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-gray-600 hidden lg:block">Halo, {{ Str::limit(session('patient_name'), 10) }}</span>
                            <a href="{{ route('patient.dashboard') }}" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                Dashboard Pasien
                            </a>
                        </div>
                    @else
                        <a href="{{ route('admin.login') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900">
                            Admin Login
                        </a>
                        <a href="{{ route('patient.register') }}" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Daftar Sekarang
                        </a>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <i data-feather="menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-32 pb-20 lg:pt-40 lg:pb-32 hero-pattern relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
                
                <!-- Left Content: Text & Stats -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="space-y-4">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-sm font-bold tracking-wide border border-blue-100">
                            ✨ Sistem Antrian KLINIQ v2.0
                        </span>
                        <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight">
                            Sehat Lebih Dekat <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Bersama KLINIQ</span>
                        </h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                            Layanan kesehatan modern yang mengutamakan kenyamanan dan kecepatan. Daftar antrian tanpa ribet, pantau dari mana saja.
                        </p>
                    </div>

                    <!-- Stats Widgets (Soft UI) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:pr-10">
                        <!-- Stat 1 -->
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-4 mb-2">
                                <div class="p-2 bg-yellow-50 text-yellow-600 rounded-lg">
                                    <i data-feather="clock" class="w-5 h-5"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Menunggu</span>
                            </div>
                            <p class="text-3xl font-bold text-gray-900">{{ $menunggu }}</p>
                            <div class="mt-2 w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-yellow-400 h-1.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-4 mb-2">
                                <div class="p-2 bg-green-50 text-green-600 rounded-lg">
                                    <i data-feather="activity" class="w-5 h-5"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Dirawat</span>
                            </div>
                            <p class="text-3xl font-bold text-gray-900">{{ $sedangDirawat }}</p>
                            <div class="mt-2 w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-4 mb-2">
                                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                    <i data-feather="users" class="w-5 h-5"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Hari Ini</span>
                            </div>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalPasien }}</p>
                            <div class="mt-2 text-xs text-gray-400 text-right">Updated just now</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Login Card -->
                <div class="lg:col-span-5 relative">
                    <!-- Decor Blobs -->
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/50 p-8 relative">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900">Masuk ke Portal Pasien</h3>
                            <p class="text-gray-500 mt-2 text-sm">Akses riwayat medis dan nomor antrian Anda.</p>
                        </div>

                        @if(session('error'))
                            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm flex items-center">
                                <i data-feather="alert-circle" class="w-4 h-4 mr-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('patient.login') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700">Nomor Induk Kependudukan (NIK)</label>
                                <div class="relative">
                                    <input type="text" name="nik" required class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-gray-800 font-medium placeholder-gray-400" placeholder="Contoh: 3201234567890001">
                                    <i data-feather="credit-card" class="absolute left-3.5 top-3.5 w-5 h-5 text-gray-400"></i>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <div class="relative">
                                    <input type="text" name="nama" required class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-gray-800 font-medium placeholder-gray-400" placeholder="Sesuai yang tertera di KTP">
                                    <i data-feather="user" class="absolute left-3.5 top-3.5 w-5 h-5 text-gray-400"></i>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3.5 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-[1.02] shadow-lg shadow-blue-500/30 flex justify-center items-center group">
                                Masuk Sekarang 
                                <i data-feather="arrow-right" class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </form>

                        <div class="mt-8 text-center pt-6 border-t border-gray-100">
                            <p class="text-sm text-gray-500">Belum pernah berobat di sini?</p>
                            <a href="{{ route('patient.register') }}" class="inline-block mt-2 text-blue-600 font-bold hover:text-blue-700 hover:underline">
                                Daftar Pasien Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Features Section -->
    <section id="layanan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Layanan Unggulan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Mengapa Memilih Kami?</h2>
                <p class="text-gray-500 mt-4">Kami berkomitmen memberikan pelayanan medis terbaik dengan dukungan teknologi dan tenaga ahli profesional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-feather="activity" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Dokter Spesialis Ahli</h3>
                    <p class="text-gray-500 leading-relaxed">Ditangani oleh tim dokter spesialis berpengalaman di bidangnya dengan sertifikasi resmi.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <i data-feather="smartphone" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Antrian Digital 24/7</h3>
                    <p class="text-gray-500 leading-relaxed">Daftar dan pantau nomor antrian Anda dari rumah melalui smartphone tanpa perlu menunggu lama.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i data-feather="shield" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fasilitas Modern</h3>
                    <p class="text-gray-500 leading-relaxed">Dilengkapi peralatan medis terkini dan ruang rawat inap yang nyaman sesuai standar kesehatan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Schedule -->
    <section id="jadwal" class="py-20 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Jadwal Praktik Dokter</h2>
                    <p class="text-gray-500 mt-2">Temui dokter spesialis kami sesuai jadwal yang tersedia.</p>
                </div>
                <a href="#" class="hidden md:flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                    Lihat Semua <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($dokter as $doc)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 group overflow-hidden border border-gray-100">
                    <div class="h-32 bg-gray-100 relative group-hover:bg-blue-50 transition-colors">
                        <img src="{{ $doc['foto'] }}" alt="{{ $doc['nama'] }}" class="absolute bottom-[-40px] left-1/2 transform -translate-x-1/2 w-24 h-24 rounded-full border-4 border-white object-cover shadow-md">
                    </div>
                    <div class="pt-14 pb-8 px-6 text-center">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $doc['nama'] }}</h3>
                        <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold uppercase rounded-full tracking-wider mb-4">{{ $doc['spesialis'] }}</span>
                        
                        <div class="flex items-center justify-center gap-2 text-gray-500 text-sm bg-gray-50 py-3 rounded-xl group-hover:bg-white group-hover:shadow-inner transition-all">
                            <i data-feather="calendar" class="w-4 h-4 text-gray-400"></i>
                            <span class="font-medium">{{ $doc['jadwal'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <i data-feather="activity" class="text-blue-400 w-8 h-8"></i>
                        <span class="text-2xl font-bold">KLINIQ</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Memberikan pelayanan kesehatan terbaik dengan hati dan teknologi terkini untuk keluarga Anda.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-feather="facebook" class="w-5 h-5"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-feather="instagram" class="w-5 h-5"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i data-feather="twitter" class="w-5 h-5"></i></a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Tautan Cepat</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#beranda" class="hover:text-blue-400 transition">Beranda</a></li>
                        <li><a href="#jadwal" class="hover:text-blue-400 transition">Jadwal Dokter</a></li>
                        <li><a href="#layanan" class="hover:text-blue-400 transition">Layanan</a></li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-blue-400 transition">Login Staff</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-lg font-bold mb-6">Hubungi Kami</h4>
                    <div class="space-y-4 text-gray-400">
                        <div class="flex items-start gap-4">
                            <i data-feather="map-pin" class="w-5 h-5 text-blue-400 mt-1"></i>
                            <span>Jl. Angkrek No. 123, Sumedang Utara<br>Sumedang, 34545</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i data-feather="phone" class="w-5 h-5 text-blue-400"></i>
                            <span>(021) 555-0123 / Emergency: 118</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i data-feather="mail" class="w-5 h-5 text-blue-400"></i>
                            <span>info@kliniq.com</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} KLINIQ. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>
