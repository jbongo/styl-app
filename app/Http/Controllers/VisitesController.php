<?php

namespace App\Http\Controllers;

use App\Models\Biens;
use App\Models\Visites;
use App\Models\Mandats;

use Illuminate\Http\Request;
use App\Http\Requests\VisiteValidator;

class VisitesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisiteValidator $request, $id)
    {
        $visite = Visites::create([
            "biens_id" => $id,
            "nom_visiteur" => $request['nom_visiteur'],
            "adresse"=> $request['adresse'],
            "code_postal"=> $request['code_postal'],
            "ville"=> $request['ville'],
            "date_visite" => $request['date_visite'],
            "commentaires" => $request['commentaire'],
        ]);
        if (isset($request['call']) && $request['call'] === "on")
        {
            $visite->appels_id = $request['appels_id'];
            $visite->update();
        }
        return redirect()->back()->with('ok', __('La visite a été ajoutée et est visible pour le mandant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visite = Visites::findOrFail($id);
        $visite->delete();
        return redirect()->back()->with('ok', __('La visite a été supprimée'));
    }
}
