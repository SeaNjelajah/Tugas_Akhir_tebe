<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGambarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gambar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kamar')->constrained('tbl_kamar')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('gambar');
            $table->boolean("gambar_utama")->default(false);
            $table->timestamps();
        });

        // Schema::table('tbl_kamar', function (Blueprint $table) {
        //     $table->after('id', function ($table) {
        //         $table->foreignId('gambar_utama')->nullable()->constrained('tbl_gambar')->cascadeOnUpdate()->cascadeOnDelete();
        //     });
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gambar');
    }
}
