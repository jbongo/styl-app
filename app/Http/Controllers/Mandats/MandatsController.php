<?php

namespace App\Http\Controllers\Mandats;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\GuestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MandatValidator;
use PDF;
use App\Models\User;
use App\Models\Biens;
use App\Models\Mandant;
use App\Models\Mandats;
use App\Models\Acquereur;
use App\Models\Groupemandant;
use App\Models\Groupeacquereur;
use App\Models\DossierVente;
use App\Models\DossierRecherche;
use App\Models\OffreAchat;
use App\Models\Guestusers;
use App\Models\NotaireAssocie;
use App\Models\ParamsAffaire;
use App\Models\Passerelles;

class MandatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        if ($auth->role == 'admin' || $auth->role == 'personnel')
            $mandat = Mandats::where('archive', 0)->get()->all();
        else if ($auth->role == 'mandataire' || $auth->role == 'prospect_plus')
            $mandat = Mandats::where([['user_id', $auth->id],['archive', 0],])->get()->all();
        return view('mandats.index', compact('mandat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $biens = Biens::where([['user_id', $auth->id], ['archive', 0], ['mandat', 0],])->get()->all();
        $mandants = Mandant::where('user_id', '=',$auth->id)->get()->all();
        $groupemandants = Groupemandant::where('user_id', '=',$auth->id)->get()->all();
        $acquereur = Acquereur::where('user_id', '=',$auth->id)->get()->all();
        $groupeacquereur = Groupeacquereur::where('user_id', '=',$auth->id)->get()->all();
        return view('mandats.add', compact('auth', 'biens', 'mandants', 'groupemandants', 'acquereur', 'groupeacquereur'));
    }

    /**
     * Determiner l'id du mandant en fonction de l'objet du mandat et le type du mandant.
     *
     * @return \int id of the mandant
     */
    public function fetch_mandant(MandatValidator $request)
    {
        if ($request['objet'] === "mandat-vente"){
            switch ($request['role-mandant']){
                case "personne_seule":
                    return $request['mandant_s_id'];
                    break;
                case "couple":
                    return $request['mandant_c_id'];
                    break;
                case "personne_morale":
                    return $request['mandant_m_id'];
                    break;
                case "groupe":
                    return $request['mandant_g_id'];
                    break;
            }
        }
        else{
            switch ($request['role-mandant']){
                case "personne_seule":
                    return $request['mandant_aqs_id'];
                    break;
                case "couple":
                    return $request['mandant_aqc_id'];
                    break;
                case "personne_morale":
                    return $request['mandant_aqm_id'];
                    break;
                case "groupe":
                    return $request['mandant_aqg_id'];
                    break;
            }
        }
        return NULL;
    }

    /**
     * Definir le type du mandant pour creer le compte visiteur dans le cas de mandat de vente.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch_guestuser_vente(Mandats $mandat)
    {
        $role = "mandant";
        switch ($mandat->role_mandant){
            case "groupe":
                $tmp = Groupemandant::findOrFail($mandat->mandant_id);
                foreach($tmp->mandant_associe as $one)
                {
                    if ($one->status === "chef-groupe"){
                        $cible = Mandant::findOrFail($one->mandant_assoc_id);
                        break ;
                    }
                }
                if (!$cible || $cible == NULL)
                    abort(500);
                $guest = new GuestController;
                $guest->mandant_to_guestuser($cible->email, $mandat->id, $role);
                break;
            case "personne_morale":
                $tmp = Mandant::findOrFail($mandat->mandant_id);
                foreach($tmp->mandant_associe as $one)
                {
                    if ($one->titre_contact === "Gérant"){
                        $cible = Mandant::findOrFail($one->mandant_assoc_id);
                        break ;
                    }
                }
                if (!$cible || $cible == NULL)
                    abort(500);
                $guest = new GuestController;
                $guest->mandant_to_guestuser($cible->email, $mandat->id, $role);
                break;
            default:
                $cible = Mandant::findOrFail($mandat->mandant_id);
                $guest = new GuestController;
                $guest->mandant_to_guestuser($cible->email, $mandat->id, $role);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MandatValidator $request)
    {
        $auth = Auth::user();
        $mandat = Mandats::create([
            'objet'=> $request['objet'],
            'role_mandant'=> $request['role-mandant'],
            'type'=> $request['type'],
            'users_id'=>$auth->id,
            'mandant_id'=>$this->fetch_mandant($request),
            'numero'=> $request['numero'],
            'date_debut'=> $request['date_debut'],
            'date_fin'=> $request['date_fin'],
            'note'=> $request['describe'],
        ]);
        if($request['objet'] === "mandat-vente"){
            $mandat->biens_id = $request['bien_id'];
            $mandat->update();
            $num = $auth->id."_".time().'_'.$mandat->numero;
            $dossier = DossierVente::create([
                'mandats_id'=> $mandat->id,
                'numero'=>$num,
            ]);
            $bien = Biens::find($request['bien_id']);
            $bien->mandat = 1;
            $bien->update();
            $this->fetch_guestuser_vente($mandat);
        }
        else{
            $num = $auth->id."_".time().'_'.$mandat->numero;
            $dossier = DossierRecherche::create([
                'mandats_id'=> $mandat->id,
                'numero'=>$num,
            ]);
            //$this->fetch_guestuser_aqceureur($mandat);
        }
        return redirect()->route('mandat')->with('ok', __('Le mandat a été ajouté.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tet)
    {
      $id = Crypt::decrypt($tet);
      $auth = Auth::user();
      $params = ParamsAffaire::firstOrCreate([]);
      $listdoc = unserialize($params->list_documents);
      $mandat = Mandats::findOrFail($id);
      $bien = Biens::findOrFail($mandat->biens_id);
      $offre = OffreAchat::where('mandats_id', '=', $mandat->id)->get()->all();
      $acquereur = Acquereur::where('user_id', $auth->id)->get()->all();
      $notaire = NotaireAssocie::where([['notaire_id', '!=', NULL], ['archive', 0],])->get()->all();
      $passerelles = Passerelles::get()->all();
      $groupeacquereur = Groupeacquereur::where('user_id', $auth->id)->get()->all();
      $acheteur = NULL;
      if ($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre" && (!($mandat->dossiervente->status === "cloture" && $mandat->dossiervente->vente == 0)))
      {
          if ($mandat->dossiervente->acquereurs_type === "App\Models\Acquereur")
            $acheteur = Acquereur::findOrFail($mandat->dossiervente->acquereurs_id);
          else
            $acheteur = Groupeacquereur::findOrFail($mandat->dossiervente->acquereurs_id);
      }
      if($mandat->dossiervente->notaire_acq_id !== NULL)
        $notaireacq = NotaireAssocie::findOrFail($mandat->dossiervente->notaire_acq_id);
      if($mandat->dossiervente->notaire_mdn_id !== NULL)
        $notairemdn = NotaireAssocie::findOrFail($mandat->dossiervente->notaire_mdn_id);
      if ($mandat->groupemandant_id == NULL)
        $mandant = Mandant::findOrFail($mandat->mandant_id);
      else
        $mandant = Groupemandant::findOrFail($mandat->groupemandant_id);
      return view('mandats.show', compact('mandat','bien', 'params', 'listdoc','offre', 'mandant','acquereur', 'groupeacquereur', 'notaire', 'passerelles', 'notaireacq', 'notairemdn', 'acheteur'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prolongation(Request $request, $id)
    {
        $mandat = Mandats::where('id', '=', $id)->firstOrFail();
        $offset = $request['extend'];
        $tmp = date('Y-m-d', strtotime("+$offset months", strtotime($mandat->date_fin)));
        $mandat->date_fin = $tmp;
        $mandat->statut = "actif";
        $mandat->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel_mandat(Request $request, $id)
    {
        $mandat = Mandats::where('id', '=', $id)->firstOrFail();
        $mandat->annulation = 1;
        $mandat->archive = 1;
        $mandat->statut = "clos";
        $mandat->raison_annulation = $request['raison'];
        $mandat->note_annulation = $request['describe'];
        $mandat->update();
    }
}
