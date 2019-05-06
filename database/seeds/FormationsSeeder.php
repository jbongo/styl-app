<?php

use Illuminate\Database\Seeder;
use App\Models\Formations;

class FormationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Formations::create([
        	"titre" => "cursus formation numérique - 1 - formation débutants réseaux sociaux",
        	"type" => "salle",
        	"starting_date" => "2018-10-25 12:00:00",
        	"end_date" => "2018-10-25 15:00:00",
        	"nb_max" => "30",
        	"lieu" => "Bagnols-sur-cèze",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "30200",
            "is_model" => "0",
            "category_id" => "2",
        ]);
        Formations::create([
        	"titre" => "cursus formation numérique - 2 - formation avancée réseaux sociaux",
        	"type" => "salle",
        	"starting_date" => "2018-12-05 09:00:00",
        	"end_date" => "2018-12-08 18:30:00",
        	"nb_max" => "10",
        	"lieu" => "Bagnols-sur-cèze",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "30200",
            "is_model" => "0",
            "category_id" => "2",
        ]);
        Formations::create([
        	"titre" => "cursus formation numérique - 3 - formation growth hacking",
        	"type" => "salle",
        	"starting_date" => "2018-12-07 09:00:00",
        	"end_date" => "2018-12-07 16:30:00",
        	"nb_max" => "15",
        	"lieu" => "Lyon",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "69002",
            "is_model" => "0",
            "category_id" => "4",
        ]);
        Formations::create([
        	"titre" => "cursus formation numérique - 4 - formation big data",
        	"type" => "visio",
        	"starting_date" => "2018-12-09 14:00:00",
        	"end_date" => "2018-12-11 18:00:00",
            "nb_max" => "65",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "is_model" => "0",
            "category_id" => "4",
        ]);
        Formations::create([
        	"titre" => "cursus formation numérique - 5 - formation instagram",
        	"type" => "salle",
        	"starting_date" => "2018-12-17 14:00:00",
        	"end_date" => "2018-12-17 16:30:00",
        	"nb_max" => "10",
        	"lieu" => "Bagnols-sur-cèze",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "30200",
            "is_model" => "0",
            "category_id" => "2",
        ]);
        Formations::create([
            "titre" => "cursus formation numérique - 6 - formation professionelle publicité sur internet ",
            "type" => "salle",
            "starting_date" => "2018-12-06 08:00:00",
            "end_date" => "2018-12-13 16:30:00",
            "nb_max" => "10",
            "lieu" => "Marseille",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "13001",
            "option_ordi" => "1",
            "is_model" => "0",
            "category_id" => "4",
        ]);
        Formations::create([
            "titre" => "cursus formation numérique - 7 - formation Facebook ",
            "type" => "salle",
            "starting_date" => "2019-01-15 13:30:00",
            "end_date" => "2019-01-16 16:30:00",
            "nb_max" => "10",
            "lieu" => "Marseille",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "hierarchie" => "necessaire",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "13001",
            "is_model" => "0",
            "category_id" => "3",
        ]);
        Formations::create([
            "titre" => "cursus formation numérique - 8 - formation visibilité digitale",
            "type" => "salle",
            "starting_date" => "2019-01-15 13:30:00",
            "end_date" => "2019-01-21 16:30:00",
            "nb_max" => "20",
            "lieu" => "Marseille",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "hierarchie" => "necessaire",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "13001",
            "is_model" => "0",
            "category_id" => "4",
        ]);
        Formations::create([
            "titre" => "cursus formation numérique - X",
            "type" => "salle",
            "nb_max" => "20",
            "lieu" => "Marseille",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "hierarchie" => "necessaire",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "13001",
            "is_model" => "1",
            "category_id" => "0",
            "advisable_time" => "7",
        ]);
        Formations::create([
            "titre" => "cursus formation sociale - X",
            "type" => "salle",
            "nb_max" => "5",
            "lieu" => "Bagnols-sur-cèze",
            "st" => "115 avenue de la roquette",
            "details" => "Les Palinuridae forment une famille de crustacés décapodes, tous comestibles, plus connus sous le nom de langoustes, même si en France le terme langouste désigne plus particulièrement la Langouste rouge. Ce sont des animaux de belle taille (plusieurs dizaines de centimètres à l'âge adulte) caractérisés par un corps allongé, de longues antennes épineuses et des pinces très atrophiées. Comestibles, les langoustes sont pêchées pour leur chair savoureuse qui en fait un mets de choix et un enjeu économique pour de nombreuses régions côtières. On trouve des langoustes dans toutes les mers tropicales et tempérées, généralement sur les fonds rocheux où elles peuvent trouver des abris, mais les prélèvements excessifs ont souvent provoqué leur raréfaction dans de nombreuses régions.",
            "hierarchie" => "necessaire",
            "infocomp" => 'Supernovae are more energetic than novae. In Latin, nova means "new", referring astronomically to what appears to be a temporary new bright star. Adding the prefix "super-" distinguishes supernovae from ordinary novae, which are far less luminous. The word supernova was coined by Walter Baade and Fritz Zwicky in 1931.',
            "postal" => "30200",
            "option_ordi" => "1",
            "is_model" => "1",
            "category_id" => "0",
            "advisable_time" => "3",
        ]);
    }
}
