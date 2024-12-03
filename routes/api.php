<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    Route::get('/login', function () {
        return response()->json(["status"=>false, 'message' => 'Token tidak ditemukan atau tidak terautentikasi.'], 404);
    })->name('login');
    Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUserData']);
    Route::post('/absen', [AbsenController::class, 'storeOrUpdate']);
    Route::middleware('auth:sanctum')->get('/absen', [AbsenController::class, 'getUserAbsences']);
});




Route::get('/tes', function(){
    return response()->json(["status"=>true,"message"=>"api worked!!"], 200);
});
