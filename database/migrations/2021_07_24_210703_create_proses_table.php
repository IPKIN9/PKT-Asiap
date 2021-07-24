<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses', function (Blueprint $table) {
            $table->id();
            $table->string('no_resi')->unique();
            $table->foreignId('pengirim_id')
                ->constrained('pengirim')
                ->onDelete('cascade');
            $table->foreignId('asal_id')
                ->constrained('lokasi')
                ->onDelete('cascade');
            $table->foreignId('tujuan_id')
                ->constrained('lokasi')
                ->onDelete('cascade');
            $table->string('no_hp');
            $table->string('ket');
            $table->foreignId('supir_id')
                ->constrained('supir')
                ->onDelete('cascade');
            $table->foreignId('mobil_id')
                ->constrained('mobil')
                ->onDelete('cascade');
            $table->string('penerima');
            $table->string('hp');
            $table->string('alamat');
            $table->foreignId('status_id')
                ->constrained('status_pengiriman')
                ->onDelete('cascade');
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
        Schema::dropIfExists('proses');
    }
}
