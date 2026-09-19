<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CustomerProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            ...$data,
            'uuid' => (string) Str::uuid(),
            'status' => 'active',
        ]);

        $user->roles()->attach(Role::where('slug', 'customer')->firstOrFail()->id);
        CustomerProfile::create([
            'user_id' => $user->id,
            'preferred_language' => 'en',
            'country' => 'Kenya',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully.',
            'data' => ['user' => $user->load('roles')],
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['Invalid credentials.']]);
        }

        if ($user->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'This account is not active.'], 403);
        }

        $user->forceFill(['last_login_at' => now()])->save();

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => ['token' => $user->createToken('travel-web')->plainTextToken, 'user' => $user->load('roles')],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();
        return response()->json(['success' => true, 'message' => 'Logged out successfully.', 'data' => null]);
    }

    public function me(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Authenticated user.', 'data' => $request->user()->load('roles', 'customerProfile')]);
    }
}
