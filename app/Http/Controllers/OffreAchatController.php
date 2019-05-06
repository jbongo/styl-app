<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users\GuestController;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests\OffreAchatValidator;
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

class OffreAchatController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function make_directory($id, $bien_id)
    {
        $path = storage_path('app/public/'.$id);
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
        $path = storage_path('app/public/'.$id.'/offres_achat'.'/'.$bien_id);
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
    }

    public function asLetters($number) {
        $convert = explode('.', $number);
        $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
                         'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');
                          
        $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
                          60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');
                                          
        if (isset($convert[1]) && $convert[1] != '') {
          return self::asLetters($convert[0]).' et '.self::asLetters($convert[1]);
        }
        if ($number < 0) return 'moins '.self::asLetters(-$number);
        if ($number < 17) {
          return $num[17][$number];
        }
        elseif ($number < 20) {
          return 'dix-'.self::asLetters($number-10);
        }
        elseif ($number < 100) {
          if ($number%10 == 0) {
            return $num[100][$number];
          }
          elseif (substr($number, -1) == 1) {
            if( ((int)($number/10)*10)<70 ){
              return self::asLetters((int)($number/10)*10).'-et-un';
            }
            elseif ($number == 71) {
              return 'soixante-et-onze';
            }
            elseif ($number == 81) {
              return 'quatre-vingt-un';
            }
            elseif ($number == 91) {
              return 'quatre-vingt-onze';
            }
          }
          elseif ($number < 70) {
            return self::asLetters($number-$number%10).'-'.self::asLetters($number%10);
          }
          elseif ($number < 80) {
            return self::asLetters(60).'-'.self::asLetters($number%20);
          }
          else {
            return self::asLetters(80).'-'.self::asLetters($number%20);
          }
        }
        elseif ($number == 100) {
          return 'cent';
        }
        elseif ($number < 200) {
          return self::asLetters(100).' '.self::asLetters($number%100);
        }
        elseif ($number < 1000) {
          return self::asLetters((int)($number/100)).' '.self::asLetters(100).($number%100 > 0 ? ' '.self::asLetters($number%100): '');
        }
        elseif ($number == 1000){
          return 'mille';
        }
        elseif ($number < 2000) {
          return self::asLetters(1000).' '.self::asLetters($number%1000).' ';
        }
        elseif ($number < 1000000) {
          return self::asLetters((int)($number/1000)).' '.self::asLetters(1000).($number%1000 > 0 ? ' '.self::asLetters($number%1000): '');
        }
        elseif ($number == 1000000) {
          return 'millions';
        }
        elseif ($number < 2000000 && $number >= 1000000) {
          return 'un million'.' '.self::asLetters($number%1000000);;
        }
        elseif ($number < 2000000) {
            return self::asLetters(1000000).' '.self::asLetters($number%1000000);
          }
        elseif ($number < 1000000000) {
          return self::asLetters((int)($number/1000000)).' '.self::asLetters(1000000).($number%1000000 > 0 ? ' '.self::asLetters($number%1000000): '');
        }
      }
    
    /**
     * generer le pdf de l'offre d'achat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_acquereur(OffreAchatValidator $request)
    {
      switch ($request['acquereur_type']){
        case "personne_seule":
          return($request['mandant_aqs_id']);
          break;
        case "couple":
        return($request['mandant_aqc_id']);
          break;
        case "personne_morale":
          return($request['mandant_aqm_id']);
          break;
        case "groupe":
          return($request['mandant_aqg_id']);
          break ;
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_pdf(OffreAchat $offre, $acquereur, Biens $bien, Mandats $mandat)
    {
      $auth = Auth::user();
      $this->make_directory($auth->id, $bien->id);
      $dossier = DossierVente::findOrFail($mandat->id);
      if($mandat->role_mandant === "groupe")
        $mandant = Groupemandant::findOrFail($mandat->mandant_id);
      else
        $mandant = Mandant::findOrFail($mandat->mandant_id);
      $letter_offre = $this->asLetters($offre->montant_offre);
      $letter_commission = $this->asLetters($offre->montant_commission);
      $pict1 = "images/photos_bien/".$bien->photosbiens[0]->resized_name;
      $pict2 = "images/photos_bien/".$bien->photosbiens[1]->resized_name;
      $num = $bien->id."_".time();
      $name = "OFFRE"."_".$num.".pdf";
      $path = storage_path('app/public/'.$auth->id.'/'.'offres_achat'.'/'.$bien->id.'/'.$name);
      $timetamps = date('d-m-Y');
      $pdf = PDF::loadView('pdf.mandat.offre', compact('auth', 
                                            'offre', 
                                            'acquereur', 
                                            'bien', 
                                            'timetamps', 
                                            'mandat',
                                            'mandant',
                                            'dossier',
                                            'letter_offre',
                                            'letter_commission',
                                            'pict1',
                                            'pict2'
                                        )
                                    );
      $pdf->save($path);
      $ret = $auth->id.'/'.'offres_achat/'.$bien->id.'/'.$name;
      return $ret;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OffreAchatValidator $request, $bien, $mandat)
    {
        $offset = $request['duree_validite'];
        $end = date('Y-m-d', strtotime("+$offset days", strtotime($request['date_offre'])));
        if($request['acquereur_type'] === "groupe")
        {
          $acquereur = Groupeacquereur::findOrFail($this->get_acquereur($request));
          $verif = OffreAchat::where([['acquereur_type', 'App\Models\Groupeacquereur'], ['acquereur_id', $acquereur->id], ['status', 'active'], ])->get()->first();
          if ($verif !== NULL)
            return redirect()->back()->withErrors('Une offre active avec le meme acquéreur existe déja !');
        }
        else
        {
          $acquereur = Acquereur::findOrFail($this->get_acquereur($request));
          $verif = OffreAchat::where([['acquereur_type', 'App\Models\Acquereur'], ['acquereur_id', $acquereur->id], ['status', 'active'], ])->get()->first();
          if ($verif !== NULL)
            return redirect()->back()->withErrors('Une offre active avec le meme acquéreur existe déja !');
        }
        $offre = $acquereur->offreachat()->create([
            'biens_id'=> $bien,
            'mandats_id'=> $mandat,
            'acquereur_id'=> $acquereur->id,
            'status'=> "active",
            'montant_offre'=> $request['range_01'],
            'montant_commission'=> $request['range_02'],
            'charge_commission'=> $request['charge_commission'],
            'date_ajout'=> $request['date_offre'],
            'date_fin'=> $end,
            'conditions_suspensives'=> $request['conditions_suspensives'],
        ]);
        if (isset($request['vis']) && $request['vis'] === "on")
            $offre->visites_id = $request['visite_id'];
        $bien_i = Biens::findOrFail($bien);
        $mandat_i = Mandats::findOrFail($mandat);
        $offre->chemin_pdf = $this->create_pdf($offre, $acquereur, $bien_i, $mandat_i);
        $offre->update();
        $dossier = DossierVente::where('mandats_id', $mandat_i->id)->firstOrFail();
        $dossier->status = "offre";
        $dossier->update();
        return redirect()->back()->with('ok', __('L\'offre a été ajoutée et est visible pour le mandant'));
    }

    /**
     * creer le compte visiteur pour l'acquereur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_guest_acquereur(OffreAchat $offre)
    {
      if ($offre->acquereur_type === "App\Models\Acquereur"){
        $acquereur = Acquereur::findOrFail($offre->acquereur_id);
        if ($acquereur->type === "personne_morale")
          $email = $acquereur->email_morale;
        else
          $email = $acquereur->email;
      }
      else{
        $acquereur = Groupeacquereur::findOrFail($offre->acquereur_id);
        $email = $acquereur->email;
      }
      $role = "acquereur";
      $guest = new GuestController;
      $guest->mandant_to_guestuser($email, $offre->mandats_id, $role);
    }

    /**
     * accepter une offre d'achat par le mandant
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $offre = OffreAchat::findOrFail($id);
        $offre->status = "compromis";
        $offre->acceptation = 1;
        $offre->update();
        $reject = OffreAchat::where([['status', "active"], ['mandats_id', $offre->mandats_id],])->get()->all();
        foreach($reject as $one){
          $one->status = "refusée";
          $one->update();
        }
        $dossier = DossierVente::where('mandats_id', $offre->mandats_id)->firstOrFail();
        $dossier->status = "compromis";
        $dossier->acquereurs_type = $offre->acquereur_type;
        $dossier->acquereurs_id = $offre->acquereur_id;
        $dossier->update();
        $this->create_guest_acquereur($offre);
    }

    /**
     * Rejeter une offre d'achat par le mandant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $offre = OffreAchat::findOrFail($id);
        $offre->status = "refusée";
        $offre->update();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $offre = OffreAchat::findOrFail($id);
        return Storage::download('public/'.$offre->chemin_pdf);
    }
}
