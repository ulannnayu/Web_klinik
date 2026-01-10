@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex flex-col justify-center items-center px-4 md:px-0">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-gray-100 p-6 md:p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 text-purple-600">
                <i data-feather="lock" class="w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Akses Admin KLINIQ</h2>
            <p class="text-gray-500 text-sm mt-1">Masukkan PIN keamanan untuk melanjutkan.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-700 p-3 rounded-md text-sm mb-6 text-center border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="pin" class="sr-only">PIN Keamanan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-feather="key" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input type="password" name="pin" id="pin" required maxlength="6" inputmode="numeric" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm text-center tracking-widest text-lg" 
                        placeholder="• • • • • •">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150">
                    Masuk Dashboard
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('landing') }}" class="text-sm text-gray-500 hover:text-gray-900 flex items-center justify-center">
                <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i> Kembali ke Depan
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pinInput = document.getElementById('pin');
        const form = pinInput.closest('form');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Focus input automatically
        pinInput.focus();

        pinInput.addEventListener('input', function(e) {
            // Remove non-numeric characters just in case
            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value.length === 6) {
                // Visual feedback
                this.blur();
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memeriksa...';
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Submit form
                form.submit();
            }
        });
    });
</script>
@endsection
