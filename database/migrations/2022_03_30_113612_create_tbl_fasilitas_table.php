<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('fasilitas');
            $table->timestamps();
        });

        DB::table('tbl_fasilitas')->insert([
            [
                'fasilitas' => "Wifi",
            ],
            [
                "fasilitas" => "Makan Gratis"
            ],
            [
                "fasilitas" => "Tempat Tidur"
            ]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_fasilitas');
    }
}
