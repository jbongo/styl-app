<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaireAssocieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaire_associes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notaire_id')->unsigned()->nullable();
            $table->enum('role', ['notaire', 'clerc']);
            $table->string('nom')->unique();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->foreign('notaire_id')->references('id')->on('notaires')->onDelete('cascade');
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
        Schema::dropIfExists('notaire_associes');
    }
}
