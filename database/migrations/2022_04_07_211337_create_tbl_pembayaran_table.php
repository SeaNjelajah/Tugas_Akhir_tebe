<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reservasi')->constrained('tbl_reservasi')->cascadeOnUpdate();
            $table->bigInteger('pembayaran');
            $table->timestamp('pada_tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
}
