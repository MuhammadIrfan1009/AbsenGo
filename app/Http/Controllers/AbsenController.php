<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'lokasi_magang_id' => 'required|exists:lokasi_magang,id',
                'tanggal' => 'required|date',
                'lat_masuk' => 'required|numeric',
                'lng_masuk' => 'required|numeric',
                'lat_pulang' => 'nullable|numeric',
                'lng_pulang' => 'nullable|numeric',
                'foto_masuk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_pulang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'nullable|integer|in:0,1',
                'keterangan' => 'nullable|string',
            ]);

            // Handle 'foto_masuk' file upload
            if ($request->hasFile('foto_masuk')) {
                $fotoMasukPath = $request->file('foto_masuk')->store('foto', 'public');
                $validatedData['foto_masuk'] = $fotoMasukPath;
            } else {
                $validatedData['foto_masuk'] = null; 
            }

            // Handle 'foto_pulang' file upload
            if ($request->hasFile('foto_pulang')) {
                $fotoPulangPath = $request->file('foto_pulang')->store('foto', 'public');
                $validatedData['foto_pulang'] = $fotoPulangPath;
            } else {
                $validatedData['foto_pulang'] = null; 
            }

            $validatedData['tanggal'] = now()->toDateString();
            $currentTime = now()->toTimeString();

            $absen = Absen::where('user_id', $validatedData['user_id'])
                ->where('tanggal', $validatedData['tanggal'])
                ->first();
            
            if ($absen) {
                $validatedData['jenis'] = 2;
                $validatedData['jam_pulang'] = $currentTime;
                $absen->update($validatedData);
                $message = 'Data absen pulang berhasil diperbarui.';
            } else {
                $validatedData['jenis'] = 1;
                $validatedData['jam_masuk'] = $currentTime;
                $absen = Absen::create($validatedData);
                $message = 'Data absen masuk berhasil ditambahkan.';
            }

            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => $absen,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    
    public function getUserAbsences(Request $request)
    {
        try {
            $user = $request->user();


            $month = $request->input('month');
            $year = $request->input('year');

            $date = Carbon::createFromDate($year,$month);
            $min = $date->firstOfMonth()->toDateString();
            $max = $date->lastOfMonth()->toDateString();

            $absen = Absen::where('user_id', $user->id)
            ->whereBetween('tanggal', [$min, $max])
            ->get();

            $totalAbsen = $absen->count();

            return response()->json([
                'status' => true,
                'total_absen' => $totalAbsen,
                'data' => $absen,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
