<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandantMandantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandant_mandant', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('mandant_id')->unsigned()->index();
            $table->integer('mandant_assoc_id')->unsigned()->index();
            $table->foreign('mandant_id')->references('id')->on('mandants')->onDelete('cascade');
            $table->foreign('mandant_assoc_id')->references('id')->on('mandants')->onDelete('cascade');
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
        Schema::dropIfExists('mandant_mandant');
    }
}
