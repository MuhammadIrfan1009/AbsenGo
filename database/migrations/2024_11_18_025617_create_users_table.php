<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nomor_induk')->unique();
            $table->string('foto_profil')->nullable();
            $table->unsignedBigInteger('sekolah_id');
            $table->string('jurusan');
            $table->unsignedBigInteger('lokasi_magang_id');
            $table->enum('role', ['siswa', 'guru_pembimbing', 'pembimbing_magang'])->default('siswa');
            $table->rememberToken();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
