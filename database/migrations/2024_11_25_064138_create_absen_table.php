<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('lokasi_magang_id'); 
            $table->date('tanggal'); 
            $table->decimal('lat_masuk', 10, 7); 
            $table->decimal('lng_masuk', 10, 7); 
            $table->time('jam_masuk')->nullable(); 
            $table->decimal('lat_pulang', 10, 7)->nullable(); 
            $table->decimal('lng_pulang', 10, 7)->nullable(); 
            $table->time('jam_pulang')->nullable(); 
            $table->string('foto_masuk');
            $table->string('foto_pulang');  
            $table->tinyInteger('status')->default(1); 
            $table->text('keterangan')->nullable(); 
            $table->tinyInteger('jenis'); 
            $table->timestamps(); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lokasi_magang_id')->references('id')->on('lokasi_magang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
}
