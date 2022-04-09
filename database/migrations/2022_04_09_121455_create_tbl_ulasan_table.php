<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUlasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ulasan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_kamar')->nullable()->constrained('tbl_kamar')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('nama');

            $table->string('email');

            $table->text('review');
            
            $table->integer('nilai');

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
        Schema::dropIfExists('tbl_ulasan');
    }
}
