<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_kamar', function (Blueprint $table) {
            $table->id();
            

            $table->string('nama');        
            $table->bigInteger('harga');
            $table->integer('ukuran');
            $table->text('deskripsi');
            $table->bigInteger('jumlah_kamar');
            $table->enum('status', ['Tersedia', 'Penuh', 'Tidak Tersedia'])->default('Tidak Tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kamar');
    }
}
