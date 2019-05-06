<?php

use Illuminate\Database\Seeder;
use App\Models\Parrainage;

class ParrainageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parrainage::create([
            "nom" => "vince²",
            "forfait_100percent" => 250,
            'pourcentage_annee1'=> 5,
            "nombre_annee" => 4,
            "serialize_annee_data" => "year1=1&min-percent1=2.5&max-percent1=5&chiffre1=27500&year2=2&min-percent2=2.5&max-percent2=5&chiffre2=27500&year3=3&min-percent3=2.5&max-percent3=5&chiffre3=27500&year4=4&min-percent4=2.5"
        ]);

        Parrainage::create([
            "nom" => "boulbi",
            "forfait_100percent" => 250,
            'pourcentage_annee1'=> 5,
            "nombre_annee" => 4,
            "serialize_annee_data" => "year1=1&min-percent1=2.5&max-percent1=5&chiffre1=27500&year2=2&min-percent2=2.5&max-percent2=5&chiffre2=27500&year3=3&min-percent3=2.5&max-percent3=5&chiffre3=27500&year4=4&min-percent4=2.5"
        ]);

        Parrainage::create([
            "nom" => "packman",
            "forfait_100percent" => 250,
            'pourcentage_annee1'=> 5,
            "nombre_annee" => 4,
            "serialize_annee_data" => "year1=1&min-percent1=2.5&max-percent1=5&chiffre1=27500&year2=2&min-percent2=2.5&max-percent2=5&chiffre2=27500&year3=3&min-percent3=2.5&max-percent3=5&chiffre3=27500&year4=4&min-percent4=2.5"
        ]);

        Parrainage::create([
            "nom" => "neymar",
            "forfait_100percent" => 250,
            'pourcentage_annee1'=> 5,
            "nombre_annee" => 4,
            "serialize_annee_data" => "year1=1&min-percent1=2.5&max-percent1=5&chiffre1=27500&year2=2&min-percent2=2.5&max-percent2=5&chiffre2=27500&year3=3&min-percent3=2.5&max-percent3=5&chiffre3=27500&year4=4&min-percent4=2.5"
        ]);
    }
}
