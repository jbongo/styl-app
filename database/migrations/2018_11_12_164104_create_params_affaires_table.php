<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParamsAffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('params_affaires', function (Blueprint $table) {
            $table->increments('id');
            $table->text('list_documents')->nullable();
            $table->double('pourcentage_partenaire')->nullable();
            $table->integer('max_offre')->nullable();
            $table->boolean('notif_mandant')->default(0);
            $table->boolean('notif_acquereur')->default(0);
            $table->boolean('archive_bien')->default(0);
            $table->boolean('archive_mandant')->default(0);
            $table->boolean('archive_acquereur')->default(0);
            $table->integer('max_jour_notaire')->nullable();
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
        Schema::dropIfExists('params_affaires');
    }
}
