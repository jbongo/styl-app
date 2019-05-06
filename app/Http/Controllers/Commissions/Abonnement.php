<?php
///////////////////////////////////////////////////
//Class: Abonnements des mandataires             //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Commissions;

use App\Http\Controllers\Contrats\ContratController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Abonnement as Abonne;

class Abonnement extends Controller
{
    /**
     * Ajouter l'abonnement du mandataire à partir du model choisi.
     *
     * @author: Belkacem
     * @param  Abonne,User
     * @return /ContratControllers
     */
    public function store_for_user(Abonne $abn, User $user)
    {
        $name = $user->nom."_".$user->prenom."_".$abn->pack_type;
        Abonne::create([
            'user_id' => $user->id, 
            'pack_type' => $abn->pack_type,
            'nom' => $name,
            'tarif' => $abn->tarif,
            'nombre_annonces' => $abn->nombre_annonces,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @author: Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Abonne::create([ 
            'pack_type' => $request['pack'],
            'nom' => $request['plan-name'],
            'tarif' => $request['price'],
            'nombre_annonces' => $request['annonces'],
        ]);
        return redirect()->route('commissions')->with('ok', __('L\'abonnement '.$request['plan-name'].' a bien été enregistré'));
   
   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @author: Belkacem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abn = Abonne::where('id', '=', $id)->get()->first();
        return view('commissions.abonnementedit', compact('abn'));
    }

    /**
     * Formulaire de modification de l'abonnement.
     *
     * @author: Belkacem
     * @param  int $id
     * @return Response
     */

    public function edit_for_user($id)
    {
        $abn = Abonne::where('id', '=', $id)->get()->first();
        return view('contrats.editabonnement', compact('abn'));
    }

    /**
     * Update the specified resource in storage.
     * @author: Belkacem
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toupdate = Abonne::where('id', '=', $id)->get()->first();
        $toupdate->pack_type = $request['pack'];
        $toupdate->nom = $request['plan-name'];
        $toupdate->tarif = $request['price'];
        $toupdate->nombre_annonces = $request['annonces'];
        $toupdate->update();
        return redirect()->route('commissions')->with('ok', __('L\'abonnement '.$request['plan-name'].' a bien été modifié'));
    }

    /**
     * Modification d'abonnement d'utilisatreur et generation d'un avenant.
     *
     * @author: Belkacem
     * @param  Request,int $id
     * @return Response et generation d'un avenant au contrat
     */

    public function update_for_user(Request $request, $id)
    {
        $toupdate = Abonne::where('id', '=', $id)->get()->first();
        $toupdate->tarif = $request['price'];
        $toupdate->nombre_annonces = $request['annonces'];
        $toupdate->update();
        $avenant = new ContratController;
        $avenant->avenant_annexe3($toupdate->user_id);
        return redirect()->route('contrat.index')->with('ok', __('L\'abonnement '.$request['plan-name'].' a bien été modifié, un avenant est généré'));
    }

    /**
     * Remove the specified resource from storage.
     * @author Belkacem
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todestroy = Abonne::where('id', '=', $id)->get()->first();
        $todestroy->delete();
    }
}
