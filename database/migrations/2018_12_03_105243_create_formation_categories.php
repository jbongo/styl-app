<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nom')->nullable();
            $table->text('parent')->nullable();
            $table->text('tag')->nullable();
            $table->text('tag_color')->nullable();
            $table->text('soustag')->nullable();
            $table->text('soustag_color')->nullable();
            $table->integer('maker_id')->nullable();
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
        Schema::dropIfExists('formation_categories');
    }
}
