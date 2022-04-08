<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tbl_keranjang', function (Blueprint $table) {
            $table->id();
            $table->string('id_cart');
            $table->foreignId('id_kamar')->constrained('tbl_kamar')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('jumlah');
            $table->bigInteger('subtotal');
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
        Schema::dropIfExists('tbl_keranjang');
    }
}
