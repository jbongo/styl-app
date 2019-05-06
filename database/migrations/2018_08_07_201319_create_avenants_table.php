<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrat_id')->unsigned();
            $table->enum('type', ['avenant_annexe1','avenant_annexe2','avenant_annexe3','avenant_annexe4']);
            $table->boolean('signature')->default(0);
            $table->string('chemin_pdf');
            $table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade');
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
        Schema::dropIfExists('avenants');
    }
}
