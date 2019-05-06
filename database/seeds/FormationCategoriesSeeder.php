<?php

use Illuminate\Database\Seeder;
use App\Models\FormationCategories;

class FormationCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormationCategories::create([
            "nom" => "test",
            "tag" => "TST",
            "tag_color" => "dark"
        ]);
    }
}
