<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDeviceLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Jika tiada user, teruskan (mungkin dilindungi oleh middleware 'auth' lain)
        if (!$user) {
            return $next($request);
        }

        // Dapatkan langganan aktif pengguna (anda mungkin perlu memuatkan relasi plan)
        $activeSubscription = $user->activeSubscription(); // Menggunakan kaedah dari model User

        if (!$activeSubscription || !$activeSubscription->plan) {
            // Jika tiada langganan aktif atau tiada plan, kembalikan ralat
            // Anda boleh tentukan mesej/status kod yang sesuai
            // Untuk kesederhanaan, kita anggap pengguna perlu langganan untuk menambah peranti
            return response()->json(['message' => 'No active subscription found or plan missing.'], 403);
        }

        $deviceLimit = $activeSubscription->plan->device_limit;
        $currentDeviceCount = $user->devices()->count(); // Pastikan User model ada relasi devices()

        if ($currentDeviceCount >= $deviceLimit) {
            // Jika jumlah peranti semasa >= had, kembalikan ralat
            return response()->json(['message' => 'Device limit reached. Upgrade your plan to add more devices.'], 403);
        }

        // Jika had belum dicapai, benarkan request diteruskan
        return $next($request);
    }
}
