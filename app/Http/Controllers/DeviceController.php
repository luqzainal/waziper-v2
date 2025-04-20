<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Auth::user()->devices()->get();
        return response()->json($devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => [
                'required',
                'string',
                Rule::unique('devices', 'device_id'),
            ],
            'status' => ['sometimes', 'string', Rule::in(['connected', 'disconnected', 'error'])],
        ]);

        $device = Auth::user()->devices()->create([
            'device_id' => $validated['device_id'],
            'status' => $validated['status'] ?? 'disconnected', // Default status
        ]);

        return response()->json($device, 201);
    }

    /**
     * Display the specified resource.
     * Note: Typically you'd have a show method, but skipping as per request.
     */
    // public function show(Device $device)
    // {
    //     // Authorization check could be added here if needed
    //     return response()->json($device);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        // Pastikan pengguna yang disahkan memiliki peranti ini
        if ($device->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(['connected', 'disconnected', 'error'])],
            // Anda mungkin mahu membenarkan kemas kini device_id juga, tetapi perlu berhati-hati dengan keunikan
            // 'device_id' => ['sometimes', 'string', Rule::unique('devices', 'device_id')->ignore($device->id)],
        ]);

        $device->update($validated);

        return response()->json($device);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        // Pastikan pengguna yang disahkan memiliki peranti ini
        if ($device->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $device->delete();

        return response()->json(null, 204);
    }
}
