<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian - KLINIQ</title>
    
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
<body class="bg-gray-50 text-gray-800 antialiased">
    
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('landing') }}" class="flex-shrink-0 flex items-center gap-3">
                        <div class="bg-blue-600 text-white p-2 rounded-lg">
                            <i data-feather="activity" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg text-gray-900 tracking-tight leading-none">KLINIQ</h1>
                            <span class="text-[10px] text-blue-600 font-medium tracking-wide block">SMART HEALTHCARE</span>
                        </div>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('patient_id'))
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> {{ Str::limit(session('patient_name'), 15) }}
                        </div>
                        <form action="{{ route('patient.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 transition ml-4">
                                Logout
                            </button>
                        </form>
                    @elseif(session('admin_authenticated'))
                        <span class="text-sm font-medium text-gray-600">Admin Mode</span>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 transition pl-4">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}" class="text-sm font-semibold text-gray-500 hover:text-blue-600 transition flex items-center">
                            <i data-feather="lock" class="w-4 h-4 mr-1"></i> Login Admin
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} KLINIQ.
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
    @yield('scripts')
</body>
</html>
