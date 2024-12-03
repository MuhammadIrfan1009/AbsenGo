<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFotoColumnsNullableInAbsenTable extends Migration
{
    public function up()
    {
        Schema::table('absen', function (Blueprint $table) {
            $table->string('foto_masuk')->nullable()->change();
            $table->string('foto_pulang')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('absen', function (Blueprint $table) {
            $table->string('foto_masuk')->nullable(false)->change();
            $table->string('foto_pulang')->nullable(false)->change();
        });
    }
}

