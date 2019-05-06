<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactureproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factureproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facture_id')->unsigned();
            $table->integer('quantite')->unsigned();
            $table->string('description');
            $table->integer('prix_unitaire_ht')->unsigned();
            $table->foreign('facture_id')->references('id')->on('facturations')->onDelete('cascade');
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
        Schema::dropIfExists('factureproducts');
    }
}
