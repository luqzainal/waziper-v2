<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Papan Pemuka') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>

                    <div class="mb-4">
                        <p class="font-semibold">Status Langganan:</p>
                        @if ($activeSubscription && $activeSubscription->plan)
                            <p>Pelan Semasa: <span class="font-bold">{{ $activeSubscription->plan->name }}</span></p>
                            <p>Had Peranti: <span class="font-bold">{{ $activeSubscription->plan->device_limit }}</span></p>
                            <p>Tamat Tempoh: <span class="font-bold">{{ $activeSubscription->expires_at->format('d M Y') }}</span></p>
                        @else
                            <p>Anda tidak mempunyai pelan langganan aktif.</p>
                            {{-- Anda boleh tambah butang/link untuk melanggan di sini --}}
                            {{-- <a href="{{ route('plans.index') }}" class="text-blue-600 hover:underline">Lihat Pelan</a> --}}
                        @endif
                    </div>

                    <div>
                        <p class="font-semibold">Status Peranti:</p>
                        <p>Jumlah Peranti Digunakan: <span class="font-bold">{{ $deviceCount }}</span> / {{ $activeSubscription ? $activeSubscription->plan->device_limit : 'N/A' }}</p>
                        {{-- Anda boleh tambah butang/link untuk mengurus peranti --}}
                        {{-- <a href="{{ route('devices.index') }}" class="text-blue-600 hover:underline">Urus Peranti</a> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
