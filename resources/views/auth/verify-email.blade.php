@extends('frontend.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Verifikasi Email Anda') }}</h2>
                <p class="text-gray-600 mt-2">{{ __('Sebelum melanjutkan, silakan periksa email Anda') }}</p>
            </div>

            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-gray-600">{{ Auth::user()->email }}</span>
                </div>
            </div>

            <div class="text-center">
                <form class="inline-block" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full bg-[#8B0000] hover:bg-[#660000] text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        <div class="flex items-center justify-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </div>
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Tidak menerima email?') }}
                    <a href="#" class="text-[#8B0000] hover:text-[#660000] font-semibold">
                        {{ __('Hubungi support') }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Informasi tambahan -->
    <div class="max-w-md mx-auto mt-6 text-center">
        <div class="bg-[#FFF5F5] rounded-lg p-4">
            <h3 class="text-sm font-semibold text-[#8B0000] mb-2">{{ __('Catatan Penting') }}</h3>
            <p class="text-sm text-[#8B0000]">
                {{ __('Link verifikasi akan kadaluarsa dalam 60 menit. Jika link kadaluarsa, silakan minta link baru dengan tombol di atas.') }}
            </p>
        </div>
    </div>
</div>

<!-- Script untuk auto-dismiss alert -->
@push('scripts')
<script>
    setTimeout(function() {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-in-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
</script>
@endpush
@endsection 