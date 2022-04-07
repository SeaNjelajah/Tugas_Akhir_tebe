<?php

use App\Models\tbl_kamar;
use App\Models\tbl_reservasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblRincianHubunganKamarReservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rincian_hubungan_kamar_reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(tbl_kamar::class)->constrained('tbl_kamar')->onUpdate('cascade');
            $table->foreignIdFor(tbl_reservasi::class)->constrained('tbl_reservasi')->onUpdate('cascade');
            $table->bigInteger('jumlah_kamar')->default(0);
            $table->bigInteger('subtotal')->default(0);
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_rincian_hubungan_kamar_reservasi');
    }
}
