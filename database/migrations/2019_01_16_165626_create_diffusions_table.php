<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiffusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diffusions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bien_id');
            $table->integer('passerelle_id');
            $table->integer('annonce_id');
            $table->date('date');
            $table->boolean('bien_diffuse')->default(false);
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
        Schema::dropIfExists('diffusions');
    }
}
