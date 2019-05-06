<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(InfosEntrepriseSeeder::class);
         $this->call(InfosPalierCommissionseeder::class);
         $this->call(AbonnementSeeder::class);
         $this->call(ParrainageSeeder::class);
         $this->call(DircommissionSeeder::class);
        $this->call(BiensTableSeeder::class);
        $this->call(PasserellesTableSeeder::class);
        $this->call(FormationsSeeder::class);
        $this->call(FormationCategoriesSeeder::class);
    }
}