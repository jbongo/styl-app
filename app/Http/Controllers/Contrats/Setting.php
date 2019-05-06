<?php
///////////////////////////////////////////////////
//Class: Parametres des contrats                 //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Contrats;

use App\Http\Controllers\Contrats\ContratController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contrats;
use App\Models\Infospaliercommissions;
use App\Models\Infosentreprise;

class Setting
{
    public function index()
    {
        $pln = Infospaliercommissions::get()->first();
        $ret2 = Infosentreprise::get()->first();
        $palier = explode("&", $pln->model_serialization);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        $last = $chunk[$pln->nombre_palier - 1];
        array_pop($chunk);
        return view('contrats.setting', compact('pln', 'chunk', 'last', 'ret2'));
    }

    public function update_info_commissions(Request $request)
    {
        $society = Infosentreprise::get()->first();
        $update = Infospaliercommissions::get()->first();
        $update->nombre_palier = $request['nbpalier'];
        $update->model_serialization = $request['palierdata'];
        $update->update();
        $all = Contrats::get()->all();
        $avenant = new ContratController;
        foreach($all as $rs)
            $avenant->avenant_annexe4($update, $society, $rs->numero_contrat, $rs->id,$rs->user_id);
        return back()->with('ok',__("Honorraires modifié, un avenant est généré pour chaque contrat"));
    }

    public function update_info_entreprise(Request $request)
    {
        $update = Infosentreprise::get()->first();
        $update->raison_sociale = $request['raison'];
        $update->nom_entreprise = $request['nom'];
        $update->adresse_siege_sociale = $request['adresse-siege'];
        $update->nom_prenom_gerant = $request['nom-gerant'];
        $update->capital = $request['capital'];
        $update->siret = $request['siret'];
        $update->RCS = $request['rcs'];
        $update->TVA = $request['tva'];
        $update->numero_carte_professionnelle = $request['num-carte'];
        $update->date_delivrance = $request['date-delivrance'];
        $update->organisme_delivrant = $request['organisme'];
        $update->nom_garant = $request['garant'];
        $update->adresse_garant = $request['adresse-garant'];
        $update->update();
        return redirect()->route('contrat.setting')->with('ok', __('Les informations de l\'entreprise ont bien étaient modifiées'));;
    }
}
