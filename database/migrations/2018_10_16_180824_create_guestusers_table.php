<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->enum('role', ['acquereur', 'mandant', 'chercheur']);
            $table->string('email_original');
            $table->integer('mandat_id');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('guestusers');
    }
}
