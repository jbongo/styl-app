<?php

use Illuminate\Database\Seeder;
use App\Models\Infosentreprise;

class InfosEntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Infosentreprise::create([
            "raison_sociale"=>"SARL",
            "nom_entreprise"=>"V4F",
            "adresse_siege_sociale"=>"115 Avenue de la Roquette – Zone Artisanale de Berret – 30200 BAGNOLS SUR CEZE",
            "nom_prenom_gerant"=>"Madame Christine OCCELLI",
            "capital"=>"3000",
            "siret"=>"800 738 478",
            "RCS"=>"Nîmes",
            "TVA"=>"Non rensegné",
            "numero_carte_professionnelle"=>"1312T14",
            "date_delivrance"=>"2014-06-12",
            "organisme_delivrant"=>"la préfecture du GARD ",
            "nom_garant"=>"GALIAN",
            "adresse_garant"=>"89, rue La Boétie – 75008 PARIS"
        ]);
    }
}
