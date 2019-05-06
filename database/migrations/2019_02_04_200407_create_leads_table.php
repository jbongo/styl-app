<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('canalprospection_id')->unsigned()->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('adresse')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('ville')->nullable();
            $table->boolean('professionnel')->default(0);
            $table->boolean('pro_immo')->default(0);
            $table->boolean('contact_etabli')->default(0);
            $table->boolean('qualification')->default(0);
            $table->enum('type_immo', ['agence','mandataire', 'autre'])->default('autre');
            $table->timestamps();
            $table->foreign('canalprospection_id')->references('id')->on('canalprospections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
