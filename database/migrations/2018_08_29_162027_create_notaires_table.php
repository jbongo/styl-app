<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaires', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('role', ['scp', 'sel','autre']);
            $table->string('nom')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->string('code_postal');
            $table->string('ville');
            $table->string('adresse');
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
        Schema::dropIfExists('notaires');
    }
}
