<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'building_type' => 'required',
            'user_type' => 'required',
            'email' => 'required',
            'password' => 'required',
            'secret_key' => 'required',
        ]);

        $credentials = $request->only('email', 'password', 'secret_key');

        $guard = $this->getGuard($request->building_type, $request->user_type);

        if (!$guard) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid building type or user type.',
            ], 400);
        }

        if (!Auth::guard($guard)->attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        $user = Auth::guard($guard)->user();

        // Generate a static token without using Sanctum
        $token = base64_encode(hash('sha256', $user->id . now() . 'static_secret_key', true));

        \App\Models\TokenApi::create([
            'token' => $token,
            'current_session_tocken' => Str::random(40),
            'user_id' => $user->id,
            'user_type' => $request->building_type . '_' . $request->user_type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Login successful.',
            'token' => $token,
            'user_data' => $user,
            'building_type' => $request->building_type,
            'building_id' => $request->building_type === 'school' ? $user->added_by : ($user->building_id ?? null),
        ], 200);
    }
    private function getGuard($buildingType, $userType)
    {
        $guards = [
            'building_security' => 'buildingSecutityadmin',
            'building_tenant' => 'buildingtenant',
            'school_security' => 'schoolsecurity',
        ];

        $key = strtolower($buildingType . '_' . $userType);

        return $guards[$key] ?? null;
    }
    public function logout(Request $request)
    {
        Auth::logout();

        session()->flush();

        session()->regenerate();

        return response()->json(['status' => true, 'message' => 'User logged out successfully']);
    }
}
