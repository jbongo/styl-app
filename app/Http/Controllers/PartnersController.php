<?php
///////////////////////////////////////////////////
//Class: Contacts et partenaires                 //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partners;
use App\Models\User;
use Auth;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fromnetworkindex()
    {
        $data = \DB::table('users')->get()->where('role', 'mandataire');
        //dd($data);
        return view('partners.addfromnetwork', compact('data'));
    }

    public function fromnetwork(Request $data, $user)
    {
        $data = \DB::table('users')->where('id', $user)->first();
        //dd($data);
        Partners::create([
            'user_id' => Auth::id(),
            'type' => $data->role,
            'civilite' => $data->civilite,
            'nom' => $data->nom,
            'prenom' => $data->prenom,
            'email' => $data->email,
            'telephone' => $data->telephone,
            'adresse' => $data->adresse,
            'complement_adresse' => $data->complement_adresse,
            'code_postal' => $data->code_postal,
            'ville' => $data->ville,
            'pays' => $data->pays,
        ]);
        return redirect()->route('partners')->with('ok', __('Le contact '.$data->nom.'  a bien été enregistré'));
    }
    public function index()
    {
        $partners = Partners::all();
        return view('partners.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        // 
        // dd(Auth::id());
        Partners::create([ 
            'user_id' => Auth::id(),
            'type' => $data['val-select'],
            'civilite' => $data['val-civilite'],
            'nom' => $data['val-lastname'],
            'prenom' => $data['val-firstname'],
            'email' => $data['email'],
            'telephone' => $data['val-phone'],
            'adresse' => $data['val-adress'],
            'complement_adresse' => ($data['val-compl_adress'] != null) ? $data['val-compl_adress'] : "Non renseigné" ,
            'code_postal' => $data['val-zip'],
            'ville' => $data['val-town'],
            'pays' => $data['val-country'],
        ]);

           return redirect()->route('partners')->with('ok', __('Le contact '.$data['val-lastname'].'  a bien été enregistré'));
   
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partners $partner)
    {
        $partner = Partners::find($partner->id);
        // dd($partner);
        return view('partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partners $partner)
    {
        // dd($request);
        $partner->nom = $request->input('val-lastname');
        $partner->prenom = $request->input('val-firstname');
        $partner->email = $request->input('email');
        $partner->type = $request->input('val-select');
        $partner->civilite = $request->input('val-civilite');
        $partner->adresse = $request->input('val-adress');
        $partner->complement_adresse = $request->input('val-compl_adress');
        $partner->code_postal = $request->input('val-zip');
        $partner->ville = $request->input('val-town');
        $partner->pays = $request->input('val-country');
        $partner->telephone = $request->input('val-phone');

        $partner->update();

        return redirect()->route('partners')->with('ok', __('Le contact a bien été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
