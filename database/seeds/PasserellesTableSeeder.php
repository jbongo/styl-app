<?php

use Illuminate\Database\Seeder;

class PasserellesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('passerelles')->delete();
        
        \DB::table('passerelles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'Avec abonnement',
                'nom' => 'leboncoin',
                'reference' => 'leboncoin',
                'logo' => '5921dc3e7ff8009391b5389b9cd0a7012f63ff81Jt.png',
                'site' => 'http://leboncoin.fr',
                'contact' => 'acquereur@gmail.com',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-21 11:56:37',
                'updated_at' => '2018-11-21 11:56:37',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'Avec abonnement',
                'nom' => 'Logic Immo',
                'reference' => 'logicimmo',
                'logo' => '1ee489e4db7789e7c03b09fc5c643f46f35b6793Zw.png',
                'site' => 'http://annonceur.comd',
                'contact' => 'acquereur@gmail.com',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-21 11:57:00',
                'updated_at' => '2018-11-21 11:57:00',
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'Sans abonnement',
                'nom' => 'Bien Ici',
                'reference' => 'bienici',
                'logo' => 'b619608ebcf6a6e1bba4d9476f6c27a0da679a47hb.png',
                'site' => 'http://annonceur.comy',
                'contact' => 'ss',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-21 11:57:19',
                'updated_at' => '2018-11-21 11:57:19',
            ),
            3 => 
            array (
                'id' => 4,
                'type' => 'Institutionnelle et partenaire',
                'nom' => 'acquereur',
                'reference' => 'acquereur',
                'logo' => '67808c7b3d3b8145ff5bacb54bd4018918c14a10S9.png',
                'site' => 'http://annonceur.comdz',
                'contact' => 'acquereur@gmail.com',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-21 11:57:49',
                'updated_at' => '2018-11-21 16:54:44',
            ),
            4 => 
            array (
                'id' => 5,
                'type' => 'Sans abonnement',
                'nom' => 'Paru Vendu',
                'reference' => 'paruvendu',
                'logo' => 'd05a6ef16b37a5bdbc14c9635bf1f3ef82740b2dbS.png',
                'site' => 'http://annonceur.comcrvftr',
                'contact' => 'acquereur@gmail.com',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-21 11:58:23',
                'updated_at' => '2018-11-21 11:58:39',
            ),
            5 => 
            array (
                'id' => 6,
                'type' => 'Avec abonnement',
                'nom' => 'Green Acres',
                'reference' => 'greeacres',
                'logo' => '8e9471bdd2c00524d6af2fc7863da3c864da8904jk.png',
                'site' => 'http://leboncoinici.fr',
                'contact' => 'ss',
                'statut' => '1',
                'texte_fin_annonce' => NULL,
                'created_at' => '2018-11-22 11:11:04',
                'updated_at' => '2018-11-22 11:11:04',
            ),
        ));
        
        
    }
}