<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDircommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dircommissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('pack_type')->default('Non renseigné');
            $table->string('nom')->default('Non renseigné');
            $table->float('pourcentage_depart', 4, 1)->default(0.0);
            $table->boolean('palier')->default(0);
            $table->text('serialize_palier');
            $table->integer('duration_starter')->unsigned()->default(0);
            $table->integer('duration_gratuitee')->unsigned()->default(0);
            $table->integer('minimum_vente')->unsigned()->default(0);
            $table->integer('minimum_fileuls')->unsigned()->default(0);
            $table->integer('minimum_chiffre_affaire')->unsigned()->default(0);
            $table->float('sub_pourcentage', 4, 1)->default(0.0);
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
        Schema::dropIfExists('dircommissions');
    }
}
