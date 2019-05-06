<?php

use Illuminate\Database\Seeder;
use App\Models\Abonnement;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Abonnement::create([
            "pack_type" => "Starter",
            "nom" => "pack1",
            "tarif" => 35,
            "nombre_annonces" => 15
        ]);

        Abonnement::create([
            "pack_type" => "Starter",
            "nom" => "pack2",
            "tarif" => 45,
            "nombre_annonces" => 20
        ]);

        Abonnement::create([
            "pack_type" => "Expert",
            "nom" => "pack3",
            "tarif" => 85,
            "nombre_annonces" => 15
        ]);

        Abonnement::create([
            "pack_type" => "Expert",
            "nom" => "pack4",
            "tarif" => 75,
            "nombre_annonces" => 15
        ]);
    }
}
