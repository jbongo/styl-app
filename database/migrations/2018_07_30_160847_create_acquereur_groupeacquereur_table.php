<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquereurGroupeacquereurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquereur_groupeacquereur', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('acquereur_id')->unsigned()->index();
            $table->integer('groupe_acquereur_id')->unsigned()->index();
            $table->enum('status', ['chef-groupe', 'autre'])->default('chef-groupe');
            // $table->foreign('acquereur_id')->references('id')->on('acquereurs')->onDelete('cascade');
            // $table->foreign('groupe_acquereur_id')->references('id')->on('groupeacquereurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquereur_groupeacquereur');
    }
}
