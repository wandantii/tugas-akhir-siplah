<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJarak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jarak', function (Blueprint $table) {
            $table->increments('jarak_id');
            $table->integer('asal_kota')->nullable();
            $table->integer('asal_kecamatan')->nullable();
            $table->integer('tujuan_kota')->nullable();
            $table->integer('tujuan_kecamatan')->nullable();
            $table->decimal('jarak')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->primary('kecamatan_id');
            $table->foreign('asal_kota')->references('kota_id')->on('kota')->onDelete('cascade');
            $table->foreign('tujuan_kota')->references('kota_id')->on('kota')->onDelete('cascade');
            $table->foreign('asal_kecamatan')->references('kecamatan_id')->on('kecamatan')->onDelete('cascade');
            $table->foreign('tujuan_kecamatan')->references('kecamatan_id')->on('kecamatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jarak');
    }
}
