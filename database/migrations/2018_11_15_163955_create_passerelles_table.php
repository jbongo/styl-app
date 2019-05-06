<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasserellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passerelles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('nom');
            $table->string('reference');
            $table->string('logo');
            $table->string('site');
            $table->string('contact')->nullable();
            $table->string('statut');
            $table->string('texte_fin_annonce')->nullable();
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
        Schema::dropIfExists('passerelles');
    }
}
