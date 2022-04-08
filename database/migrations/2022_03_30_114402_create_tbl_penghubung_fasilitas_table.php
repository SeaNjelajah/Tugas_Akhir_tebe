<?php

use App\Models\tbl_fasilitas;
use App\Models\tbl_kamar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPenghubungFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penghubung_fasilitas', function (Blueprint $table) {
            $table->foreignIdFor(tbl_kamar::class)->constrained('tbl_kamar')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(tbl_fasilitas::class)->constrained('tbl_fasilitas')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_penghubung_fasilitas');
    }
}
