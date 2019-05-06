<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandantGroupemandantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandant_groupemandant', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('mandant_id')->unsigned()->index();
            $table->integer('groupe_mandant_id')->unsigned()->index();
            $table->enum('status', ['chef-groupe', 'autre'])->default('chef-groupe');
            $table->foreign('mandant_id')->references('id')->on('mandants')->onDelete('cascade');
            $table->foreign('groupe_mandant_id')->references('id')->on('groupemandants')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mandant_groupemandant');
    }
}
