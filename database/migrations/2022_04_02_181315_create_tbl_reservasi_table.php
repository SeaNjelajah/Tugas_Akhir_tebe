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
        Schema::create('tbl_reservasi', function (Blueprint $table) {
            
            $table->id();
            $table->foreignIdFor('id_kamar')->nullable()->constrained('tbl_kamar')->nullOnDelete()->cascadeOnUpdate();
            
            $table->string('nama_tamu');
            $table->string('email');
            $table->string('no_tlp');

            $table->bigInteger('jumlah_k'); // Kamar
            $table->bigInteger('jumlah_d'); // Dewasa
            $table->bigInteger('jumlah_a'); // Anak"

            $table->bigIncrements('durasi'); //Durasi Hari
            $table->dateTime('check_in');
            $table->dateTime('check_out');

            $table->text('pesan_lain');

            $table->bigInteger('pembayaran')->default(0);

            $table->enum('status', ['Reservasi', 'Proses', 'Selesai', 'Dibatalkan'])->default('Reservasi');
            

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
