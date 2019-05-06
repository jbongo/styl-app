<?php

namespace App\Http\Controllers;

use App\Models\Biens;
use App\Models\Appels;
use App\Models\Mandats;

use Illuminate\Http\Request;
use App\Http\Requests\AppelValidator;

class AppelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppelValidator $request, $id)
    {
        $appel = Appels::create([
            "biens_id" => $id,
            "source" => $request['source'],
            "nom_appelant" => $request['nom_appelant'],
            "code_postal"=> $request['code_postal'],
            "date" => $request['date_appel'],
            "commentaires" => $request['commentaires'],
        ]);
        if ($request['source'] === 'passerelle')
        {
            $appel->passerelles_id = $request['passerelles_id'];
            $appel->update();
        }
        return redirect()->back()->with('ok', __('L\'appel a été ajouté !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visite = Appels::findOrFail($id);
        $visite->delete();
        return redirect()->back()->with('ok', __('L\'appel a été supprimé !'));
    }
}
