<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
{
    try {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nomor_induk' => 'required|unique:users',
            'sekolah_id' => 'required|exists:sekolah,id',
            'jurusan' => 'required|string',
            'lokasi_magang_id' => 'required|exists:lokasi_magang,id',
            'role' => 'required|in:siswa,guru_pembimbing,pembimbing_magang',
            'foto_profil' => 'nullable|string', 
        ]);

        $fotoProfil = $validatedData['foto_profil'] ?? 'default.jpg';

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'nomor_induk' => $validatedData['nomor_induk'],
            'sekolah_id' => $validatedData['sekolah_id'],
            'jurusan' => $validatedData['jurusan'],
            'lokasi_magang_id' => $validatedData['lokasi_magang_id'],
            'role' => $validatedData['role'],
            'foto_profil' => $fotoProfil, 
        ]);

        $user->load('lokasi_magang', 'sekolah');

        return response()->json([
            'status' => true,
            'message' => 'User berhasil register',
            'data' => $user
        ], 201);

    } catch (\Exception $e) {
        Log::error('Register Error: ' . $e->getMessage());
        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}


    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nomor_induk' => 'required|string',
                'password' => 'required|string',
            ]);
    
            $user = User::where('nomor_induk', $validatedData['nomor_induk'])->first();
    
            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'Login Sukses',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }    

    public function logout(Request $request) {
    try {
        $user = $request->user();

        if ($user) {
            $currentAccessToken = $user->currentAccessToken();

                $currentAccessToken->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Logout berhasil.',
                ]);

            return response()->json([
                'status' => false,
                'message' => 'Token tidak ditemukan atau tidak terautentikasi.',
            ], 401);
        }
        return response()->json([
            'status' => false,
            'message' => 'Pengguna tidak ditemukan.',
        ], 401);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}
    
public function tokenExpired($token)
{

    $expiresAt = Carbon::parse($token->expires_at);

    return $expiresAt->isPast();
}



}
