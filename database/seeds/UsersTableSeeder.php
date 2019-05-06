<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = User::create([
            "nom" => "admin",
            "prenom" => "admin",
            "civilite" => "M.",
            "email" => "admin@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "admin"
        ]);

        $test = User::create([
            "nom" => "admin",
            "prenom" => "Amele",
            "civilite" => "Mme.",
            "email" => "amele@stylimmo.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue carnot",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "30200",
            "ville" => "Avignon",
            "pays" => "France",
            "telephone" => "0600000000",
            "role" => "admin"
        ]);

        User::create([
            "nom" => "test",
            "prenom" => "test",
            "civilite" => "M.",
            "email" => "test@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "personnel"

        ]);

        User::create([
            "nom" => "Grene",
            "prenom" => "sarah",
            "civilite" => "Mme",
            "email" => "sarah@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"

        ]);

        User::create([
            "nom" => "Thomas",
            "prenom" => "Dublin",
            "civilite" => "M.",
            "email" => "dublin@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"

        ]);
        User::create([
            "nom" => "eveline",
            "prenom" => "Marta",
            "civilite" => "Mme",
            "email" => "eveline@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"

        ]);User::create([
            "nom" => "Jean",
            "prenom" => "Dupont",
            "civilite" => "M.",
            "email" => "dupont@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "admin"

        ]);

        User::create([
            "nom" => "Ives",
            "prenom" => "rene",
            "civilite" => "M.",
            "email" => "rene@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"

        ]);

        User::create([
            "nom" => "Ake",
            "prenom" => "claudine",
            "civilite" => "Mme",
            "email" => "claudine@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "personnel"

        ]);

        User::create([
            "nom" => "Gone",
            "prenom" => "richard",
            "civilite" => "M.",
            "email" => "richard@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "admin"

        ]);

        User::create([
            "nom" => "berthe",
            "prenom" => "salomon",
            "civilite" => "M.",
            "email" => "salomon@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"

        ]);

        User::create([
            "nom" => "admin1",
            "prenom" => "admin",
            "civilite" => "M.",
            "email" => "admin1@gmail.com",
            "password" => bcrypt('admin'),
            "adresse" => "7 rue des champs",
            "complement_adresse" => "rez de chaussée",
            "code_postal" => "75002",
            "ville" => "Paris",
            "pays" => "France",
            "telephone" => "0689585658",
            "role" => "prospect"
        ]);

        
    }
}
