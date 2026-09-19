<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Customer profile.',
            'data' => $request->user()->load('customerProfile')->customerProfile,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'date_of_birth' => ['nullable', 'date'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'preferred_language' => ['nullable', 'string', 'max:10'],
            'emergency_contact_name' => ['nullable', 'string', 'max:150'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:30'],
        ]);

        $profile = $request->user()->customerProfile;
        $profile->update($data);

        return response()->json(['success' => true, 'message' => 'Profile updated.', 'data' => $profile->fresh()]);
    }
}
