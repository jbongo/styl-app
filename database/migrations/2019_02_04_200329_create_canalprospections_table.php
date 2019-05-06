<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanalprospectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canalprospections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_canal');
            $table->enum('type', ['canal_physique', 'canal_virtuel'])->default('canal_virtuel');
            $table->string('site_web')->nullable();
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
        Schema::dropIfExists('canalprospections');
    }
}
