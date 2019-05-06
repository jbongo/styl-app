<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuivirecrutementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suivirecrutements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leads_id')->unsigned();
            $table->enum('role', ['appel', 'rencontre', 'email', 'autre'])->default('autre');
            $table->boolean('confirmation')->nullable();
            $table->date('date');
            $table->string('heure');
            $table->text('commentaires')->nullable();
            $table->timestamps();
            $table->foreign('leads_id')->references('id')->on('leads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suivirecrutements');
    }
}
