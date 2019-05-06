<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File ;
use Illuminate\Http\File as Fl;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RdviValidator;
use Notification;
use PDF;
use App\Http\Controllers\FacturationController;
use App\Models\User;
use App\Models\Biens;
use App\Models\Mandant;
use App\Models\Groupemandant;
use App\Models\Mandats;
use App\Models\Acquereur;
use App\Models\Groupeacquereur;
use App\Models\DossierVente;
use App\Models\OffreAchat;
use App\Models\Guestusers;
use App\Models\ParamsAffaire;
use App\Models\NotaireAssocie;
use App\Models\Facturation;

class DossierVenteController extends Controller
{
    /**
     * calculer le pourcentage d'avancement des documents.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_percent($tab)
    {
        $all = count($tab);
        $ok = 0;
        foreach ($tab as $one)
        {
            if ($one[2] === "validé")
                $ok += 1;
        }
        $ret = intval(($ok / $all) * 100);
        return ($ret);
    }

    /**
     * Générer la facture stylimmo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function facture_stylimmo($id)
    {
        $dossier = DossierVente::findOrFail($id);
        $mandat = Mandats::where('id', $dossier->mandats_id)->firstOrFail();
        $offre = OffreAchat::where([['mandats_id', $mandat->id], ['status', "compromis"],])->firstOrFail();
        if ($mandat->role_mandant === "groupe")
            $mandant = Groupemandant::findOrFail($mandat->mandant_id);
        else
            $mandant = Mandant::findOrFail($mandat->mandant_id);
        if ($dossier->notaire_acte === "mandant")
            $notaire = NotaireAssocie::findOrFail($dossier->notaire_mdn_id);
        else
            $notaire = NotaireAssocie::findOrFail($dossier->notaire_acq_id);
        $init = new FacturationController;
        $init->make_directory();
        $facture = Facturation::create([
            'user_id'=> NULL,
            'role'=>"Commission_vente",
            'paiement'=> 0,
            'montant_ht'=>round($offre->montant_commission / (1 + (20 / 100)), 2),
            'montant_ttc'=>$offre->montant_commission,
        ]);
        if($offre->charge_commission === "mandant")
            $user = $mandant;
        else
            $user = $offre->acquereur;
        $name = "FACTURE_".$facture->id.'_'.time().".pdf";
        $path = storage_path('app/public/factures/'.$name);
        $time = date('d-m-Y');
        $auth = Auth::user();
        $pdf = PDF::loadView('pdf.facture.commission', compact('user', 'auth','time','facture', 'notaire', 'mandat', 'mandant', 'offre'));
        $pdf->save($path);
        $facture->chemin_pdf = 'factures/'.$name;
        $dossier->pdf_facture_stylimmo = 'factures/'.$name;
        $dossier->factures_id = $facture->id;
        $facture->update();
        $dossier->update();
        return redirect()->back()->with('ok', __('La facture a été générée !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notaire_mandant(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->notaire_mdn_id = $request['notaire_mdn'];
        if ($dossier->status === "compromis" || $dossier->status === "compromis_signe")
        {
            $dossier->rendez_vous_compromis = NULL;
            $dossier->heure_compromis = NULL;
            $dossier->adresse_compromis = NULL;
        }
        if ($dossier->status === "acte_signe")
        {
            $dossier->rendez_vous_acte = NULL;
            $dossier->heure_acte = NULL;
            $dossier->adresse_acte = NULL;
        }
        $dossier->update();
        return redirect()->back()->with('ok', __('Le notaire a été associé au mandant !'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notaire_acquereur(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->notaire_acq_id = $request['notaire_acq'];
        if ($dossier->status === "compromis" || $dossier->status === "compromis_signe")
        {
            $dossier->rendez_vous_compromis = NULL;
            $dossier->heure_compromis = NULL;
            $dossier->adresse_compromis = NULL;
        }
        if ($dossier->status === "acte_signe")
        {
            $dossier->rendez_vous_acte = NULL;
            $dossier->heure_acte = NULL;
            $dossier->adresse_acte = NULL;
        }
        $dossier->update();
        return redirect()->back()->with('ok', __('Le notaire a été associé à l\'acquéreur !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rdv_compromis(RdviValidator $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        if($request['notaire'] === "notaire_mdn")
            $dossier->notaire_compromis = "mandant";
        else
            $dossier->notaire_compromis = "acquereur";
        $dossier->adresse_compromis = $request['adresse'].' '.$request['code_postal'].' '.$request['ville'] ;
        $dossier->rendez_vous_compromis = $request['date_rdv'];
        $dossier->heure_compromis = $request['heure_rdv'];
        $dossier->status = "compromis_signe";
        $dossier->update();
        return redirect()->back()->with('ok', __('Le rendez-vous du compromis a été fixé !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rdv_acte(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        if($request['notaire'] === "notaire_mdn")
            $dossier->notaire_acte = "mandant";
        else
            $dossier->notaire_acte = "acquereur";
        $dossier->adresse_acte = $request['adresse'].' '.$request['code_postal'].' '.$request['ville'] ;
        $dossier->rendez_vous_acte = $request['date_rdv'];
        $dossier->heure_acte = $request['heure_rdv'];
        $dossier->update();
        return redirect()->back()->with('ok', __('Le rendez-vous de l\'acte a été fixé !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm_compromis($id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->compromis = 1;
        $dossier->status = "acte_signe";
        $dossier->update();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm_acte($id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->vente = 1;
        $dossier->status = "cloture";
        $dossier->update();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject_compromis($id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->rendez_vous_compromis = NULL;
        $dossier->heure_compromis = NULL;
        $dossier->adresse_compromis = NULL;
        $dossier->update();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject_acte($id)
    {
        $dossier = DossierVente::findOrFail($id);
        $dossier->rendez_vous_acte = NULL;
        $dossier->heure_acte = NULL;
        $dossier->adresse_acte = NULL;
        $dossier->update();
    }

    public function construct_map($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tab = array(4);
            $tab[0] = urldecode(substr($el , 0, strpos($el, "=")));
            $tab[1] = NULL;
            $tab[2] = "non ajouté";
            $tab[3] = NULL;
            array_push($array, $tab);
        }
        return $array;
    }

    public function store_doc_mandant(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        $ret = $this->construct_map($request['doc_mdn']);
        if($dossier->serialize_doc_mandant == NULL)
        {
            $dossier->dossier_mandant = $this->get_percent($ret);
            $dossier->serialize_doc_mandant = serialize($ret);
        }
        else{
            $tmp = unserialize($dossier->serialize_doc_mandant);
            $merge = array_merge($tmp, $ret);
            $dossier->dossier_mandant = $this->get_percent($merge);
            $dossier->serialize_doc_mandant = serialize($merge);
        }
        $dossier->update();
    }

    public function store_doc_bien(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        $ret = $this->construct_map($request['doc_bn']);
        if($dossier->serialize_doc_bien == NULL)
        {
            $dossier->dossier_bien = $this->get_percent($ret);
            $dossier->serialize_doc_bien = serialize($ret);
        }
        else{
            $tmp = unserialize($dossier->serialize_doc_bien);
            $merge = array_merge($tmp, $ret);
            $dossier->dossier_bien = $this->get_percent($merge);
            $dossier->serialize_doc_bien = serialize($merge);
        }
        $dossier->update();
    }

    public function store_doc_acquereur(Request $request, $id)
    {
        $dossier = DossierVente::findOrFail($id);
        $ret = $this->construct_map($request['doc_acq']);
        if($dossier->serialize_doc_acquereur == NULL)
        {
            $dossier->dossier_acquereur = $this->get_percent($ret);
            $dossier->serialize_doc_acquereur = serialize($ret);
        }
        else{
            $tmp = unserialize($dossier->serialize_doc_acquereur);
            $merge = array_merge($tmp, $ret);
            $dossier->dossier_acquereur = $this->get_percent($merge);
            $dossier->serialize_doc_acquereur = serialize($merge);
        }
        $dossier->update();
    }

    public function remove_doc($id, $key, $role)
    {
        $dossier = DossierVente::findOrFail($id);
        if ($role === "mdn")
        {

        }
        if ($role === "acq"){

        }

        if ($role === "bn")
        {

        }
        $dossier->update();
    }

    public function stream_doc($id, $key, $role)
    {
        $dossier = DossierVente::findOrFail($id);
        if ($role === "mdn")
        {

        }
        if ($role === "acq"){

        }

        if ($role === "bn")
        {
            
        }
    }

    public function action_in_tab($string, $key, $action)
    {
        $tab = unserialize($string);
        $tmp = $tab[$key];
        $tmp[2] = $action;
        if ($action === "rejeté"){
            //delete file from tab
        }
        $tab[$key] = $tmp;
        return serialize($tab);
    } 

    public function accept_doc($id, $key, $role)
    {
        $dossier = DossierVente::findOrFail($id);
        $action = "validé";
        if ($role === "mdn")
        {
            $tmp = $this->action_in_tab($dossier->serialize_doc_mandant, $key, $action);
            $dossier->serialize_doc_mandant = $tmp;
            $dossier->dossier_mandant = $this->get_percent(unserialize($tmp));
        }
        if ($role === "acq")
        {
            $tmp = $this->action_in_tab($dossier->serialize_doc_acquereur, $key, $action);
            $dossier->serialize_doc_acquereur = $tmp;
            $dossier->dossier_acquereur = $this->get_percent(unserialize($tmp));
        }
        if ($role === "bn")
        {
            $tmp = $this->action_in_tab($dossier->serialize_doc_bien, $key, $action);
            $dossier->serialize_doc_bien = $tmp;
            $dossier->dossier_bien = $this->get_percent(unserialize($tmp));
        }
        $dossier->update();
    }

    public function reject_doc($id, $key, $role)
    {
        $dossier = DossierVente::findOrFail($id);
        $action = "rejeté";
        if ($role === "mdn")
            $dossier->serialize_doc_mandant = $this->action_in_tab($dossier->serialize_doc_mandant, $key, $action);
        if ($role === "acq")
            $dossier->serialize_doc_acquereur = $this->action_in_tab($dossier->serialize_doc_acquereur, $key, $action);
        if ($role === "bn")
            $dossier->serialize_doc_bien = $this->action_in_tab($dossier->serialize_doc_bien, $key, $action);
        $dossier->update();
    }
}
