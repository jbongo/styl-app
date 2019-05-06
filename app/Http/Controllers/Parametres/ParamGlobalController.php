<?php

namespace App\Http\Controllers\Parametres;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdresseFrance;
use App\Models\Infospaliercommissions;

class ParamGlobalController extends Controller
{
    public function parse_addr_file(Request $request){
        $string = file_get_contents($request['fls']);
        $array = json_decode($string, true);
        //$ret = array_chunk($array, 10000);
        /*foreach($ret as $array){
            foreach($array as $bob){
                $tet = $bob['coordonnees_gps'];
                $newbie = AdresseFrance::create([
                    'departement' => substr($bob['Code_postal'], 0, 2),
                    'code_commune' =>$bob['Code_commune_INSEE'],
                    'nom_commune' =>$bob['Nom_commune'],
                    'code_postal' =>$bob['Code_postal'],
                    'longitude' =>substr($tet, 0, strpos($tet, ",")),
                    'latitude' =>substr($tet, strpos($tet, ",") + 1, strlen($tet)),
                ]);
            }
        }*/
        $update = Infospaliercommissions::get()->first();
        //dd($update);
        $update->model_serialization = serialize($array);
        $update->update();
        dd('ok');
    }
}
