<?php
///////////////////////////////////////////////////
//Class: Commissions directes mandataires        //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Contrats\ContratController;
use App\Models\Dircommission;
use Illuminate\Http\Request;
use App\Models\User;

class DircommissionController
{
    /**
     * Créer un model de rémuneration directe pour mandataire.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_for_user(Dircommission $direct, User $user)
    {
        $name = $user->nom."_".$user->prenom."_".$direct->pack_type;
        Dircommission::create([
            'user_id' =>$user->id,
            'pack_type' => $direct->pack_type,
            'nom' => $name,
            'pourcentage_depart' =>$direct->pourcentage_depart,
            'palier' => $direct->palier,
            'serialize_palier' => $direct->serialize_palier,
            'duration_starter' => $direct->duration_starter,
            'duration_gratuitee' => $direct->duration_gratuitee,
            'minimum_vente' => $direct->minimum_vente,
            'minimum_fileuls' => $direct->minimum_fileuls,
            'minimum_chiffre_affaire' => $direct->minimum_chiffre_affaire,
            'sub_pourcentage' => $direct->sub_pourcentage,
        ]);
    }

    /**
     * Créer un model de rémuneration directe.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tmp = ($request['checkpalier'] == "on") ? 1 : 0;
        Dircommission::create([ 
            'pack_type' => $request['plantype'],
            'nom' => $request['planname'],
            'pourcentage_depart' =>$request['range01'],
            'palier' => $tmp,
            'serialize_palier' => $request['palierdata'],
            'duration_starter' => $request['maxstarter'],
            'duration_gratuitee' => $request['freeduration'],
            'minimum_vente' => $request['minsales'],
            'minimum_fileuls' => $request['minfilleul'],
            'minimum_chiffre_affaire' => $request['minexpchaffaire'],
            'sub_pourcentage' => $request['subpercentexper'],
        ]);
        return back()->with('ok',__("ajouté"));
    }

    /**
     * Display the specified resource.
     * @author Belkacem
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function show($direct)
    {
        $elem = Dircommission::where('id', '=', $direct)->get()->first();
        return json_encode($elem);
    } 

    /**
     * Show the form for editing the specified resource.
     * @author Belkacem
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function edit($direct)

    {
        $model = Dircommission::where('id', '=', $direct)->get()->first();
        return view('commissions.directedit', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @author Belkacem
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function edit_user_starter($direct)

    {
        $model = Dircommission::where('id', '=', $direct)->get()->first();
        return view('contrats.editstarter', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @author Belkacem
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function edit_user_expert($direct)

    {
        $model = Dircommission::where('id', '=', $direct)->get()->first();
        return view('contrats.editexpert', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function update_user_starter(Request $request, $direct)
    {
        $tmp = ($request['checkpalier'] == "on") ? 1 : 0;
        $tmp2 = ($request['resetpalier'] == "on") ? 1 : 0;
        $toupdate = Dircommission::where('id', '=', $direct)->get()->first();
        if($tmp2 == 1)
        {
            $toupdate->palier = $tmp;
            $toupdate->serialize_palier = $request['palierdata'];
            $toupdate->pourcentage_depart =$request['range01'];
        }
        $toupdate->duration_starter = $request['maxstarter'];
        $toupdate->duration_gratuitee = $request['freeduration'];
        $toupdate->update();
        $avenant = new ContratController;
        $avenant->avenant_annexe1($toupdate->user_id);
        $avenant->avenant_annexe3($toupdate->user_id);
        return back()->with('ok',__("modifié"));
    }

    /**
     * Update the specified resource in storage.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function update_user_expert(Request $request, $direct)
    {
        $tmp = ($request['checkpalier'] == "on") ? 1 : 0;
        $tmp2 = ($request['resetpalier'] == "on") ? 1 : 0;
        $toupdate = Dircommission::where('id', '=', $direct)->get()->first();
        if($tmp2 == 1)
        {
            $toupdate->palier = $tmp;
            $toupdate->serialize_palier = $request['palierdata'];
            $toupdate->pourcentage_depart =$request['range01'];
        }
        $toupdate->duration_gratuitee = $request['freeduration'];
        $toupdate->minimum_vente = $request['minsales'];
        $toupdate->minimum_fileuls = $request['minfilleul'];
        $toupdate->minimum_chiffre_affaire = $request['minexpchaffaire'];
        $toupdate->sub_pourcentage = $request['subpercentexper'];
        $toupdate->update();
        $avenant = new ContratController;
        $avenant->avenant_annexe1($toupdate->user_id);
        $avenant->avenant_annexe3($toupdate->user_id);
        return back()->with('ok',__("modifié"));
    }

    /**
     * Update the specified resource in storage.
     * @author Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $direct)
    {
        $tmp = ($request['checkpalier'] == "on") ? 1 : 0;
        $tmp2 = ($request['resetpalier'] == "on") ? 1 : 0;
        $toupdate = Dircommission::where('id', '=', $direct)->get()->first();
        $toupdate->pack_type = $request['plantype'];
        $toupdate->nom = $request['planname'];
        if($tmp2 == 1)
        {
            $toupdate->palier = $tmp;
            $toupdate->serialize_palier = $request['palierdata'];
            $toupdate->pourcentage_depart =$request['range01'];
        }
        $toupdate->duration_starter = $request['maxstarter'];
        $toupdate->duration_gratuitee = $request['freeduration'];
        $toupdate->minimum_vente = $request['minsales'];
        $toupdate->minimum_fileuls = $request['minfilleul'];
        $toupdate->minimum_chiffre_affaire = $request['minexpchaffaire'];
        $toupdate->sub_pourcentage = $request['subpercentexper'];
        $toupdate->update();
        return back()->with('ok',__("modifié"));
    }

    /**
     * Remove the specified resource from storage.
     * @author Belkacem
     * @param  \App\Models\Dircommission  $dircommission
     * @return \Illuminate\Http\Response
     */
    public function destroy($direct)
    {
         $todestroy = Dircommission::where('id', '=', $direct)->get()->first();
         $todestroy->delete();
    }
}
