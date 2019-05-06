<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParrainagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parrainages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('nom')->default('Non renseigné');
            $table->integer('forfait_100percent')->unsigned()->default(0);
            $table->float('pourcentage_annee1', 4, 1)->default(0.0);
            $table->integer('nombre_annee')->unsigned()->default(0);
            $table->text('serialize_annee_data');
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
        Schema::dropIfExists('parrainages');
    }
}
