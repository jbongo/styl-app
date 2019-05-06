<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquereurAcquereurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquereur_acquereur', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('acquereur_id')->unsigned()->index();
            $table->integer('acquereur_assoc_id')->unsigned()->index();
            //$table->foreign('acquereur_id')->references('id')->on('acquereurs')->onDelete('cascade');
            //$table->foreign('acquereur_assoc_id')->references('id')->on('acquereurs')->onDelete('cascade');
            $table->string('titre_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquereur_acquereur');
    }
}
