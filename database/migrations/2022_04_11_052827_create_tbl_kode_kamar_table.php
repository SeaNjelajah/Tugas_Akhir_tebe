<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKodeKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_kode_kamar');
        Schema::create('tbl_kode_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kamar')->constrained('tbl_kamar')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_reservasi')->nullable()->constrained('tbl_reservasi');
            $table->string('kode_kamar');
            $table->boolean('terisi')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kode_kamar');
    }
}
