<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->increments('profil_id');
            $table->integer('user_id')->nullable();
            $table->string('tentang')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kota_id')->nullable();
            $table->integer('kode_pos')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->primary('profil_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('kecamatan_id')->on('kecamatan')->onDelete('cascade');
            $table->foreign('kota_id')->references('kota_id')->on('kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil');
    }
}
