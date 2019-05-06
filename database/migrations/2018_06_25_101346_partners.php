<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Partners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('type')->default('Non renseigné');
            $table->string('civilite')->default('Non renseigné');
            $table->string('nom')->default('Non renseigné');
            $table->string('prenom')->default('Non renseigné');
            $table->string('email')->unique();
            $table->string('telephone')->default('Non renseigné');
            $table->string('adresse')->default('Non renseigné');
            $table->string('complement_adresse')->default('Non renseigné');
            $table->integer('code_postal')->default(0);
            $table->string('ville')->default('Non renseigné');
            $table->string('pays')->default('Non renseigné');
            $table->boolean('stylimmo')->default(0);
            $table->boolean('archive')->default(0);
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
        Schema::dropIfExists('partners');
    }
}
