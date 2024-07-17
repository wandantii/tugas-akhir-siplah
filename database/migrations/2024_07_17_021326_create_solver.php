<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solver', function (Blueprint $table) {
            $table->increments('solver_id');
            $table->string('user_id')->nullable();
            $table->string('profil_id')->nullable();
            $table->string('c1')->nullable();
            $table->string('c2')->nullable();
            $table->string('c3')->nullable();
            $table->string('c4')->nullable();
            $table->string('type_c1')->nullable();
            $table->string('type_c2')->nullable();
            $table->string('type_c3')->nullable();
            $table->string('type_c4')->nullable();
            $table->string('best')->nullable();
            $table->string('worst')->nullable();
            $table->string('best_to_c1')->nullable();
            $table->string('best_to_c2')->nullable();
            $table->string('best_to_c3')->nullable();
            $table->string('best_to_c4')->nullable();
            $table->string('c1_to_worst')->nullable();
            $table->string('c2_to_worst')->nullable();
            $table->string('c3_to_worst')->nullable();
            $table->string('c4_to_worst')->nullable();
            $table->string('weight_c1')->nullable();
            $table->string('weight_c2')->nullable();
            $table->string('weight_c3')->nullable();
            $table->string('weight_c4')->nullable();
            $table->string('ksi')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->primary('solver_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('profil_id')->references('profil_id')->on('profil')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solver');
    }
}
