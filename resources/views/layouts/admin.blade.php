<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - KLINIQ</title>
    
    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-gray-200 px-4">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <div class="bg-blue-600 text-white p-2 rounded-lg">
                    <i data-feather="activity" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg text-gray-900 tracking-tight leading-none">KLINIQ</h1>
                    <span class="text-[10px] text-blue-600 font-medium tracking-wide block">SMART HEALTHCARE</span>
                </div>
            </a>
        </div>
        
        <div class="flex-1 overflow-y-auto py-4">
            <nav class="space-y-1 px-2">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-feather="home" class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.pembayaran') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.pembayaran') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-feather="credit-card" class="mr-3 h-5 w-5 {{ request()->routeIs('admin.pembayaran') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Kasir (Pembayaran)
                </a>

                <a href="{{ route('admin.antrian') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.antrian') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-feather="list" class="mr-3 h-5 w-5 {{ request()->routeIs('admin.antrian') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Antrian Poliklinik
                </a>

                <a href="{{ route('admin.dokter') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.dokter') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-feather="activity" class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dokter') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Pemeriksaan Dokter
                </a>

                <a href="{{ route('admin.pasien') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.pasien') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i data-feather="users" class="mr-3 h-5 w-5 {{ request()->routeIs('admin.pasien') ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                    Data Pasien
                </a>
            </nav>
        </div>

        <div class="border-t border-gray-200 p-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <span class="inline-block h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <i data-feather="user"></i>
                    </span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700">Admin Staff</p>
                    <p class="text-xs text-gray-500">View Profile</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile view header -->
    <div class="md:hidden flex flex-col flex-1 h-screen">
        <div class="h-16 flex items-center justify-between bg-white border-b border-gray-200 px-4">
             <a href="{{ route('landing') }}" class="flex items-center gap-2">
                <div class="bg-blue-600 text-white p-1.5 rounded-lg">
                    <i data-feather="activity" class="w-4 h-4"></i>
                </div>
                <div>
                    <span class="font-bold text-lg text-gray-900 leading-none block">KLINIQ</span>
                </div>
            </a>
            <!-- Mobile menu button can act as logout for simplicity or valid sidebar toggle in future -->
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-500 hover:text-red-600">
                    <i data-feather="log-out"></i>
                </button>
            </form>
        </div>
        
        <!-- Bottom Navigation for Mobile -->
        <div class="flex-1 overflow-y-auto p-4">
            @yield('content')
        </div>

         <div class="bg-white border-t border-gray-200 flex justify-around p-2">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i data-feather="home"></i>
                    <span class="text-xs mt-1">Dash</span>
                </a>
                <a href="{{ route('admin.pembayaran') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('admin.pembayaran') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i data-feather="dollar-sign"></i>
                    <span class="text-xs mt-1">Kasir</span>
                </a>
                <a href="{{ route('admin.antrian') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('admin.antrian') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i data-feather="list"></i>
                    <span class="text-xs mt-1">Antrian</span>
                </a>
                <a href="{{ route('admin.dokter') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('admin.dokter') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i data-feather="activity"></i>
                    <span class="text-xs mt-1">Dokter</span>
                </a>
                <a href="{{ route('admin.pasien') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('admin.pasien') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i data-feather="users"></i>
                    <span class="text-xs mt-1">Pasien</span>
                </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto hidden md:block bg-gray-50 p-8">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
        @endif

        @yield('content')
    </main>

    @stack('modals')

    <script>
        feather.replace();
    </script>
    @yield('scripts')
</body>
</html>
