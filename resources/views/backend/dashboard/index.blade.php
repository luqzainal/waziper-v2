@extends('layouts.app')

@section('content')
<div class="py-8 px-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div class="mb-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
                {{ session('info') }}
            </div>
        @endif

        {{-- Header --}}
        <h1 class="text-3xl font-extrabold mb-6 text-gray-800">Waziper AI Chatbot Dashboard</h1>

        {{-- Dashboard Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            


            {{-- QR Connect --}}
            <a href="{{ route('whatsapp.qr') }}" class="card-link">
                <div class="card">
                    <div class="skeleton-loading"></div>
                    <h2>Scan QR Code</h2>
                    <p>Connect your WhatsApp account</p>
                </div>
            </a>

            {{-- Bulk Sender --}}
            <a href="{{ route('bulk.sender') }}" class="card-link">
                <div class="card">
                    <div class="skeleton-loading"></div>
                    <h2>Bulk Message Sender</h2>
                    <p>Send mass messages to contacts</p>
                </div>
            </a>

            {{-- Contact Manager --}}
            <a href="{{ route('contact.manager') }}" class="card-link">
                <div class="card">
                    <div class="skeleton-loading"></div>
                    <h2>Contact Manager</h2>
                    <p>Manage and group your contacts</p>
                </div>
            </a>

            {{-- Media Manager --}}
            <a href="{{ route('media.manager') }}" class="card-link">
                <div class="card">
                    <div class="skeleton-loading"></div>
                    <h2>Media Manager</h2>
                    <p>Upload and manage media files</p>
                </div>
            </a>

            {{-- Plan Manager --}}
            <a href="{{ route('plan.manager') }}" class="card-link">
                <div class="card">
                    <div class="skeleton-loading"></div>
                    <h2>Plan Manager</h2>
                    <p>Manage user subscriptions</p>
                </div>
            </a>

        </div>
    </div>
</div>

{{-- Tailwind Extra Styling --}}
<style>
    .card {
        @apply bg-white shadow-md rounded-2xl p-6 relative overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl;
    }
    .card h2 {
        @apply text-xl font-bold mb-2 text-gray-800;
    }
    .card p {
        @apply text-gray-600;
    }
    .skeleton-loading {
        @apply absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse;
    }
    .card-link {
        @apply block;
    }
</style>
@endsection
