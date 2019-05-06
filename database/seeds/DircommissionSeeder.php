<?php

use Illuminate\Database\Seeder;
use App\Models\Dircommission;

class DircommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dircommission::create([
            "pack_type" => "Starter",
            "nom" => "noob",
            "pourcentage_depart" => 86.3,
            "palier" => 1,
            "serialize_palier" => "level1=1&percent1=0&min1=0&max1=50000&level2=2&percent2=5&min2=50001&max2=70000&level3=3&percent3=3.7&min3=70001&max3=90000",
            "duration_starter" => 7,
            "duration_gratuitee" => 4,
            "minimum_vente" => 4,
            "minimum_fileuls" => 4,
            "minimum_chiffre_affaire" => 27000,
            "sub_pourcentage" => 10.0
        ]);

        Dircommission::create([
            "pack_type" => "Expert",
            "nom" => "pro",
            "pourcentage_depart" => 86.3,
            "palier" => 1,
            "serialize_palier" => "level1=1&percent1=0&min1=0&max1=50000&level2=2&percent2=5&min2=50001&max2=70000&level3=3&percent3=3.7&min3=70001&max3=90000",
            "duration_starter" => 0,
            "duration_gratuitee" => 4,
            "minimum_vente" => 4,
            "minimum_fileuls" => 4,
            "minimum_chiffre_affaire" => 27000,
            "sub_pourcentage" => 10.0
        ]);
        Dircommission::create([
            "pack_type" => "Starter",
            "nom" => "bambi²",
            "pourcentage_depart" => 86.3,
            "palier" => 1,
            "serialize_palier" => "level1=1&percent1=0&min1=0&max1=50000&level2=2&percent2=5&min2=50001&max2=70000&level3=3&percent3=3.7&min3=70001&max3=90000",
            "duration_starter" => 7,
            "duration_gratuitee" => 4,
            "minimum_vente" => 4,
            "minimum_fileuls" => 4,
            "minimum_chiffre_affaire" => 27000,
            "sub_pourcentage" => 10.0
        ]);
        Dircommission::create([
            "pack_type" => "Expert",
            "nom" => "veteran²",
            "pourcentage_depart" => 86.3,
            "palier" => 1,
            "serialize_palier" => "level1=1&percent1=0&min1=0&max1=50000&level2=2&percent2=5&min2=50001&max2=70000&level3=3&percent3=3.7&min3=70001&max3=90000",
            "duration_starter" => 0,
            "duration_gratuitee" => 4,
            "minimum_vente" => 4,
            "minimum_fileuls" => 4,
            "minimum_chiffre_affaire" => 27000,
            "sub_pourcentage" => 10.0
        ]);
    }
}
