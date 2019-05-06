<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(0);
            $table->text('titre')->nullable();
            $table->enum('type', ['visio','salle'])->default('visio');
            $table->enum('hierarchie', ['necessaire','complementaire'])->default('complementaire');
            $table->timestamp('starting_date')->default('1970-01-01 02:00:00');
            $table->timestamp('end_date')->default('1970-01-01 02:00:00');
            $table->string('lieu')->nullable();
            $table->integer('postal')->nullable()->default(0);
            $table->string('st')->nullable();
            $table->integer('nb_max')->default(1);
            $table->integer('nb_inscrits')->default(0);
            $table->text('details')->nullable();
            $table->text('infocomp')->nullable();
            $table->boolean('option_ordi')->default(0);
            $table->integer('prix')->default(0);
            $table->boolean('presence')->default(0);
            $table->boolean('acquis')->default(0);
            $table->boolean('is_model')->default(1);
            $table->integer('advisable_time')->default(0)->nullable();
            $table->text('multiname')->nullable();
            $table->text('startdatearray')->nullable();
            $table->text('enddatearray')->nullable();
            $table->text('starttimearray')->nullable();
            $table->text('endtimearray')->nullable();
            $table->integer('former_id')->nullable();
            $table->integer('speaker_id')->nullable();
            $table->boolean('is_archive')->default(0);

//            $table->foreign('category_id')->references('id')->on('formation_categories');
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
        Schema::dropIfExists('formations');
    }
}
