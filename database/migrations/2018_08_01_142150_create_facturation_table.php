<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->enum('role', ['Commission_vente', 'Fournisseur'])->default('Fournisseur')->nullable();
            $table->string('nom')->nullable();
            $table->string('adresse')->nullable();
            $table->string('zip')->nullable();
            $table->string('ville')->nullable();
            $table->string('email')->nullable();
            $table->boolean('paiement')->default(0);
            $table->string('mode')->nullable();
            $table->date('date_paiement')->nullable();
            $table->float('montant_ht', 10, 2)->default(0.00);
            $table->float('montant_ttc', 10, 2)->default(0.00);
            $table->string('chemin_pdf')->nullable();
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
        Schema::dropIfExists('facturations');
    }
}
