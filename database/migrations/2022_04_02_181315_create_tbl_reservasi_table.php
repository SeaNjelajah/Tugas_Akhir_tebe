<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_reservasi');
        Schema::create('tbl_reservasi', function (Blueprint $table) {

            $table->id();
            
            // $table->foreignId('id_kamar')->nullable()->constrained('tbl_kamar')->nullOnDelete()->cascadeOnUpdate();
            
            $table->string('qrcode');

            $table->string('nama_tamu');
            $table->string('email');
            $table->string('no_tlp');

            $table->bigInteger('jumlah_k')->default(0); // Kamar
            $table->bigInteger('jumlah_d')->default(0); // Dewasa
            $table->bigInteger('jumlah_a')->default(0); // Anak"

            $table->bigInteger('durasi'); //Durasi Hari

            $table->dateTime('check_in');
            $table->dateTime('check_out');

            $table->text('pesan_lain')->default('Tidak ada pesan lain-nya');

            $table->bigInteger('pembayaran')->default(0);

            $table->enum('status', ['Reservasi', 'Check In', 'Check Out', 'Dibatalkan'])->default('Reservasi');
            

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
        Schema::dropIfExists('tbl_reservasi');
    }
}
