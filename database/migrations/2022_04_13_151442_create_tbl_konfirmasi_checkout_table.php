<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKonfirmasiCheckoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_konfirmasi_checkout', function (Blueprint $table) {
            $table->foreignId('id_reservasi')->constrained('tbl_reservasi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_konfirmasi_checkout');
    }
}
