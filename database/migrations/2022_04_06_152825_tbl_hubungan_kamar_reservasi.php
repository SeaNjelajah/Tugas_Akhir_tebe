<?php

use App\Models\tbl_kamar;
use App\Models\tbl_reservasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHubunganKamarReservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('tbl_hubungan_kamar_reservasi', function (Blueprint $table) {
            $table->foreignIdFor(tbl_kamar::class);
            $table->foreignIdFor(tbl_reservasi::class);
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hubungan_kamar_reservasi');
    }
}
