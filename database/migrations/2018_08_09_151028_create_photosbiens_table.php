<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosbiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photosbiens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('biens_id')->unsigned();
            $table->integer('annonce_id')->nullable();
            $table->boolean('is_annonce')->default(false);
            $table->string('visibilite');
            $table->text('filename');
            $table->text('resized_name');
            $table->text('original_name');
            $table->integer('image_position');
            $table->timestamps();
            //$table->foreign('bien_id')->references('id')->on('biens')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photosbiens');
    }
}
