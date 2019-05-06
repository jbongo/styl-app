<?php
///////////////////////////////////////////////////
//Class: Commissions de parrainage               //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Contrats\ContratController;
use App\Models\Parrainage;
use Illuminate\Http\Request;
use App\Models\User;

class ParrainageController
{
    /**
     * Créer un model de parrainage pour le mandataire.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_for_user(Parrainage $par, User $user)
    {
        $name = $user->nom."_".$user->prenom."_"."Parrainage";
        Parrainage::create([
            'user_id' =>$user->id, 
            'nom' => $name,
            'forfait_100percent' =>$par->forfait_100percent,
            'pourcentage_annee1'=> $par->pourcentage_annee1,
            'nombre_annee' => $par->nombre_annee,
            'serialize_annee_data' => $par->serialize_annee_data,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Parrainage::create([ 
            'nom' => $request['planname'],
            'forfait_100percent' =>$request['maxforfait'],
            'pourcentage_annee1'=> $request['annee1'],
            'nombre_annee' => $request['nbyears'],
            'serialize_annee_data' => $request['palierdata'],
        ]);
        return back()->with('ok',__("ajouté"));
    }

    /**
     * Display the specified resource.
     * @author Belkacem
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function show($pln)
    {
        $elem = Parrainage::where('id', '=', $pln)->get()->first();
        return json_encode($elem);
    }

    /**
     * Show the form for editing the specified resource.
     * @author Belkacem
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pln = Parrainage::where('id', '=', $id)->get()->first();
        $palier = explode("&", $pln->serialize_annee_data);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        $last = $chunk[$pln->nombre_annee - 1];
        array_pop($chunk);
        return view('commissions.parrainageedit', compact('pln', 'chunk', 'last'));
    }

    /**
     * modifier le plan de parrainage d'un mandataire.
     * @author Belkacem
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function edit_for_user($id)
    {
        $pln = Parrainage::where('id', '=', $id)->get()->first();
        $palier = explode("&", $pln->serialize_annee_data);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        $last = $chunk[$pln->nombre_annee - 1];
        array_pop($chunk);
        return view('contrats.editparrainage', compact('pln', 'chunk', 'last'));
    }

    /**
     * Update the specified resource in storage.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toupdate = Parrainage::where('id', '=', $id)->get()->first();
        $toupdate->nom = $request['planname'];
        $toupdate->forfait_100percent = $request['maxforfait'];
        $toupdate->pourcentage_annee1 = $request['annee1'];
        $toupdate->nombre_annee = $request['nbyears'];
        $toupdate->serialize_annee_data = $request['palierdata'];
        $toupdate->update();
        return back()->with('ok',__("modifié"));
    }

    /**
     * mise à jour du model de parrainage et generation d'un avenant.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function update_for_user(Request $request, $id)
    {
        $toupdate = Parrainage::where('id', '=', $id)->get()->first();
        $toupdate->forfait_100percent = $request['maxforfait'];
        $toupdate->pourcentage_annee1 = $request['annee1'];
        $toupdate->nombre_annee = $request['nbyears'];
        $toupdate->serialize_annee_data = $request['palierdata'];
        $toupdate->update();
        $avenant = new ContratController;
        $avenant->avenant_annexe2($toupdate);
        return back()->with('ok',__("modifié"));
    }

    /**
     * Remove the specified resource from storage.
     * @author Belkacem
     * @param  \App\Models\Parrainage  $parrainage
     * @return \Illuminate\Http\Response
     */
    public function destroy($pln)
    {
        $todestroy = Parrainage::where('id', '=', $pln)->get()->first();
        $todestroy->delete();
    }
}
