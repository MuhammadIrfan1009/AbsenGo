<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserData(Request $request)
    {

        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'nomor_induk' => $user->nomor_induk,
                'name' => $user->name,
                'foto_profil' => $user->foto_profil,
                'email' => $user->email,
                'role' => $user->role,
                'sekolah' => $user->sekolah->name,
                'lokasi_magang' => $user->lokasi_magang,
                
            ],
        ], 200);
    }
}

