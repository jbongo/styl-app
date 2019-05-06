<?php
///////////////////////////////////////////////////
//Class: Gestion des contrats                    //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Contrats;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\File as Fl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\Commissions\DircommissionController;
use App\Http\Controllers\Commissions\Abonnement as Abonne;
use App\Http\Controllers\Commissions\ParrainageController;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ContractGenerated;
use Notification;
use PDF;
use App\Models\User;
use App\Models\Contrats;
use App\Models\Abonnement;
use App\Models\Avenants;
use App\Models\Parrainage;
use App\Models\Dircommission;
use App\Models\Infosentreprise;
use App\Models\Infospaliercommissions;
use App\Notifications\UserContratGenerate;
use App\Notifications\RsacCompleted;
use App\Notifications\Rsacvalidated;

class ContratController extends Controller
{
    /**
     * Création des dossiers de stockage pdf.
     *
     * @author: Belkacem
     * @param  int $id
     * @return /ContratController
     */

    public function create_path($dd)
    {
        $id = $dd;
        $path = storage_path('app/public/'.$id);
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
        $path = storage_path('app/public/'.$id.'/contrats');
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
        /*else
            abort(500);*/
        $path = storage_path('app/public/'.$id.'/documents_justificatifs');
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
        $path = storage_path('app/public/'.$id.'/contrats/avenants');
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
    }
    
    /**
     * Generation de l'avenant annexe 1.
     *
     * @author: Belkacem
     * @param  User,int $id
     * @return /ContratControllers
     */

    public function avenant_annexe1($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $contrat = Contrats::where('user_id', '=', $user->id)->get()->first();
        $society = Infosentreprise::get()->first();
        $dr_expert = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Expert'],])->get()->first();
        $bool_starter = $contrat->demarrage_starter;
        $num = $contrat->numero_contrat;
        $last_starter = NULL;
        $last_expert = NULL;
        if ($bool_starter == 1)
        {
            $dr_starter = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $palier_starter = $this->unserialize_dir($dr_starter->serialize_palier);
            if(count($palier_starter) > 0)
            {
                $tmp1 = count($palier_starter) - 1;
                $last_starter = $palier_starter[$tmp1];
                array_pop($palier_starter);
            }
        }
        $palier_expert = $this->unserialize_dir($dr_expert->serialize_palier);
        if(count($palier_expert) > 0)
        {
            $tmp2 = count($palier_expert) - 1;
            $last_expert = $palier_expert[$tmp2];
            array_pop($palier_expert);
        }
        $name = "AVENANT_ANNEX1".'_'.time()."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/avenants/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.avenants.avenant1', compact('user', 
                                           'bool_starter',
                                           'dr_starter', 
                                           'dr_expert',
                                           'palier_starter',
                                           'palier_expert',
                                           'last_starter',
                                           'last_expert', 
                                           'society', 
                                           'timetamps' 
                                           )
                                        );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/avenants/'.$name;
        Avenants::create([
            'contrat_id' => $contrat->id,
            'type' => "avenant_annexe1",
            'chemin_pdf' => $ret,
        ]);
    }

    /**
     * Generation de l'avenant annexe 2.
     *
     * @author: Belkacem
     * @param  Parrainage
     * @return /ContratControllers
     */

    public function avenant_annexe2(Parrainage $parrainage)
    {
        $user = User::where('id', '=', $parrainage->user_id)->get()->first();
        $contrat = Contrats::where('user_id', '=', $user->id)->get()->first();
        $society = Infosentreprise::get()->first();
        $num = $contrat->numero_contrat;
        $palier = $this->unserialize_parrainage($parrainage->serialize_annee_data);
        $last = $palier[count($palier) - 1];
        array_pop($palier);
        $all = Contrats::get()->all();
        $fileuls = array();
        foreach($all as $rs)
        {
            if ($rs->parrain_id == $user->id)
            {
                $tmp = User::where('id', '=', $rs->user_id)->get()->first();
                array_push($fileuls, $tmp);
            }
        }
        $name = "AVENANT_ANNEX2".'_'.time()."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/avenants/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.avenants.avenant2', compact('user', 
                                                    'palier',
                                                    'parrainage',
                                                    'last',
                                                    'society',
                                                    'timetamps',
                                                    'fileuls' 
                                                    )
                                                );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/avenants/'.$name;
        Avenants::create([
            'contrat_id' => $contrat->id,
            'type' => "avenant_annexe2",
            'chemin_pdf' => $ret,
        ]);
    }

    /**
     * Generation de l'avenant annexe 3.
     *
     * @author: Belkacem
     * @param  User,int $id
     * @return /ContratControllers
     */

    public function avenant_annexe3($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $contrat = Contrats::where('user_id', '=', $user->id)->get()->first();
        $society = Infosentreprise::get()->first();
        $dr_expert = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Expert'],])->get()->first();
        $abn_expert = Abonnement::where([['user_id', '=', $user->id],['pack_type', '=', 'Expert'],])->get()->first();
        $bool_starter = $contrat->demarrage_starter;
        $num = $contrat->numero_contrat;
        if ($bool_starter == 1)
        {
            $dr_starter = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $abn_starter = Abonnement::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
        }
        $name = "AVENANT_ANNEX3".'_'.time()."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/avenants/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.avenants.avenant3', compact('user', 
                                                'bool_starter',
                                                'dr_starter', 
                                                'abn_starter',
                                                'dr_expert',
                                                'abn_expert', 
                                                'society', 
                                                'timetamps' 
                                                )
                                            );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/avenants/'.$name;
        Avenants::create([
            'contrat_id' => $contrat->id,
            'type' => "avenant_annexe3",
            'chemin_pdf' => $ret,
        ]);
    }

    /**
     * Generation de l'avenant annexe 4.
     *
     * @author: Belkacem
     * @param  Infospaliercommissions,Infosentreprise,int $num, $contrat, $id
     * @return /ContratControllers
     */

    public function avenant_annexe4(Infospaliercommissions $bareme, Infosentreprise $society ,$num, $contrat, $id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $palier = $this->unserialize_bareme_honorraire($bareme->model_serialization);
        $first = $palier[0];
        array_shift($palier);
        $last = $palier[count($palier) - 1];
        array_pop($palier);
        $name = "AVENANT_ANNEX4".'_'.time()."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/avenants/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.avenants.avenant4', compact('user', 
                                                'palier',
                                                'first',
                                                'last',
                                                'society',
                                                'timetamps' 
                                                )
                                            );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/avenants/'.$name;
        Avenants::create([
            'contrat_id' => $contrat,
            'type' => "avenant_annexe4",
            'chemin_pdf' => $ret,
        ]);
    }

    /**
     * Deserialization des paliers de commissions directes.
     *
     * @author: Belkacem
     * @param  int $var
     * @return array $chunk
     */

    public function unserialize_dir($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        array_shift($chunk);
        return $chunk;
    }

    /**
     * Deserialization du barème d'honorraires.
     *
     * @author: Belkacem
     * @param  int $var
     * @return array $chunk
     */

    public function unserialize_bareme_honorraire($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        return $chunk;
    }

    /**
     * Deserialization des paliers du parrainage.
     *
     * @author: Belkacem
     * @param  int $var
     * @return array $chunk
     */

    public function unserialize_parrainage($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = substr($el , strpos($el, "=") + 1, strlen($el));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        return $chunk;
    }

    /**
     * Generation du contrat principal.
     *
     * @author: Belkacem
     * @param  User,int $parrainid, $num, $debut
     * @return /Chemin vers le fichier $ret
     */
    
    public function pdf_infos(User $user, $parrainid, $num, $debut)
    {
        if($parrainid != NULL)
            $parrain = User::where('id', '=', $parrainid)->get()->first();
        else
            $parrain = 0;
        $society = Infosentreprise::get()->first();
        $name = "CONTRAT"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.info', compact('user', 
                                            'parrain', 
                                            'society', 
                                            'debut', 
                                            'timetamps', 
                                            '$parrainid'
                                        )
                                    );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Generation de l'annexe 1 .
     *
     * @author: Belkacem
     * @param  User,int $parrainid, $num, $debut
     * @return /Chemin vers le fichier $ret
     */

    public function pdf_annex1(User $user, Dircommission $dr_expert, $bool_starter, $num)
    {
        $society = Infosentreprise::get()->first();
        $last_starter = NULL;
        $last_expert = NULL;
        if ($bool_starter == 1)
        {
            $dr_starter = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $palier_starter = $this->unserialize_dir($dr_starter->serialize_palier);
            if(count($palier_starter) > 0)
            {
                $tmp1 = count($palier_starter) - 1;
                $last_starter = $palier_starter[$tmp1];
                array_pop($palier_starter);
            }
        }
        $palier_expert = $this->unserialize_dir($dr_expert->serialize_palier);
        if(count($palier_expert) > 0)
        {
            $tmp2 = count($palier_expert) - 1;
            $last_expert = $palier_expert[$tmp2];
            array_pop($palier_expert);
        }
        $name = "ANNEX1"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.annex1', compact('user', 
                                           'bool_starter',
                                           'dr_starter', 
                                           'dr_expert',
                                           'palier_starter',
                                           'palier_expert',
                                           'last_starter',
                                           'last_expert', 
                                           'society', 
                                           'timetamps' 
                                           )
                                        );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Generation de l'annexe 2 .
     *
     * @author: Belkacem
     * @param  User,Parrainage,int, $num
     * @return /Chemin vers le fichier $ret
     */

    public function pdf_annex2(User $user, Parrainage $parrainage, $num)
    {
        $society = Infosentreprise::get()->first();
        $palier = $this->unserialize_parrainage($parrainage->serialize_annee_data);
        $last = $palier[count($palier) - 1];
        array_pop($palier);
        $name = "ANNEX2"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.annex2', compact('user', 
                                                'palier',
                                                'parrainage',
                                                'last',
                                                'society',
                                                'timetamps' 
                                                )
                                            );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Generation de l'annexe 3 .
     *
     * @author: Belkacem
     * @param  User,Dircommission,Abonnement,int $bool_starter, $refund, $duration, forfait, $num
     * @return /Chemin vers le fichier $ret
     */

    public function pdf_annex3(User $user, Dircommission $dr_expert, Abonnement $abn_expert, $bool_starter, $refund, $duration, $forfait, $num)
    {
        $society = Infosentreprise::get()->first();
        if ($bool_starter == 1)
        {
            $dr_starter = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $abn_starter = Abonnement::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
        }
        $name = "ANNEX3"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.annex3', compact('user', 
                                                'bool_starter',
                                                'refund',
                                                'duration',
                                                'forfait',
                                                'dr_starter', 
                                                'abn_starter',
                                                'dr_expert',
                                                'abn_expert', 
                                                'society', 
                                                'timetamps' 
                                                )
                                            );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Generation de l'annexe 4 .
     *
     * @author: Belkacem
     * @param  User,int $num
     * @return /Chemin vers le fichier $ret
     */

    public function pdf_annex4(User $user, $num)
    {
        $society = Infosentreprise::get()->first();
        $bareme = Infospaliercommissions::get()->first();
        $palier = $this->unserialize_bareme_honorraire($bareme->model_serialization);
        $first = $palier[0];
        array_shift($palier);
        $last = $palier[count($palier) - 1];
        array_pop($palier);
        $name = "ANNEX4"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.annex4', compact('user', 
                                                'palier',
                                                'first',
                                                'last',
                                                'society',
                                                'forfait', 
                                                'timetamps' 
                                                )
                                            );
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Generation de l'annexe 5 .
     *
     * @author: Belkacem
     * @param  User,int $num
     * @return /Chemin vers le fichier $ret
     */

    public function pdf_annex5(User $user, $num)
    {
        $society = Infosentreprise::get()->first();
        $name = "ANNEX5"."_".$num.".pdf";
        $path = storage_path('app/public/'.$user->id.'/'.'contrats/'.$name);
        $timetamps = date('d-m-Y');
        $pdf = PDF::loadView('pdf.annex5', compact('user', 'society','timetamps'));
        $pdf->save($path);
        $ret = $user->id.'/'.'contrats/'.$name;
        return $ret;
    }

    /**
     * Display a listing of the resource.
     * @author: Belkacem.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrat = Contrats::get()->all();
        $user = User::all()->where('contract_generate', '=', 1);
        $inactif = User::where([['role', '=', 'prospect'],
                                ['contract_generate', '=', 0], 
                                ['profile_complete', '=', 1],
                                ])->get()->all();
        return view('contrats.index', compact('contrat', 'user', 'inactif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($crypt)
    {
        $id = Crypt::decryptString($crypt);
        $now = User::find($id);
        if(!$now)
            abort(500);
        $parrainage = Parrainage::all()->where('user_id','=', NULL);
        $direct = Dircommission::all()->where('user_id','=', NULL);
        $ab = Abonnement::all()->where('user_id','=', NULL);
        $usr = User::whereIn('role', ['mandataire','prospect_plus'])
                            ->where([['contract_generate', '=', 1], 
                            ['profile_complete', '=', 1],
                            ['id', '!=', $id],
                        ])->get()->all();
        return view('contrats.add', compact('parrainage', 'direct', 'ab', 'usr', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request,int $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $usr)
    {
        $user = User::where('id', '=', $usr)->get()->first();
        $this->create_path($user->id);
        //creer toutes les commissions de rémunération pour le mandataire//
        $dr_starter = Dircommission::where('id', '=', $request['starter'])->get()->first();
        $abn_starter = Abonnement::where('id', '=', $request['starter-price'])->get()->first();
        $dr_expert = Dircommission::where('id', '=', $request['expert'])->get()->first();
        $abn_expert = Abonnement::where('id', '=', $request['expert-price'])->get()->first();
        $parr = Parrainage::where('id', '=', $request['parrainage-plan'])->get()->first();
        $dir = new DircommissionController;        
        $abn = new Abonne;
        $par = new ParrainageController;
        if($request['bool-starter'] == "on")
        {
            if ($abn_starter == NULL || $dr_starter == NULL)
                abort(500);
            $abn->store_for_user($abn_starter, $user);
            $dir->store_for_user($dr_starter, $user);
        }
        if ($abn_expert == NULL || $dr_expert == NULL || $parr == NULL)
            abort(500);
        $abn->store_for_user($abn_expert, $user);
        $dir->store_for_user($dr_expert, $user);
        $par->store_for_user($parr, $user);
        if($request['bool-starter'] == "on")
        {
            $pack_starter = Dircommission::where([['user_id', '=', $usr],['pack_type', '=', 'Starter'],])->get()->first();
            $abonnement_starter = Abonnement::where([['user_id', '=', $usr],['pack_type', '=', 'Starter'],])->get()->first();
        }
        $pack_expert = Dircommission::where([['user_id', '=', $usr],['pack_type', '=', 'Expert'],])->get()->first();
        $abonnement_expert = Abonnement::where([['user_id', '=', $usr],['pack_type', '=', 'Expert'],])->get()->first();
        $parrainage = Parrainage::where('user_id', '=', $usr)->get()->first();
        $parrain = ($request['parrain'] == "on") ? 1 : 0;
        $parrainid = ($request['parrain'] == "on") ? $request['parr-id'] : NULL;
        $refund = ($request['refund'] == "on") ? 1 : 0;
        $duration = ($request['refund'] == "on") ? $request['refund-duration'] : NULL;
        $bool_starter = ($request['bool-starter'] == "on") ? 1 : 0;
        $pkg_starter = ($request['bool-starter'] == "on") ? $pack_starter->id : NULL;
        $abn_starter = ($request['bool-starter'] == "on") ? $abonnement_starter->id : NULL;
        $num = $usr."_".time();
        $contrat = $this->pdf_infos($user, $parrainid, $num, $request['date-debut']);
        $annex1 = $this->pdf_annex1($user, $pack_expert, $bool_starter, $num);
        $annex2 = $this->pdf_annex2($user, $parrainage, $num);
        $annex3 = $this->pdf_annex3($user, $dr_expert, $abn_expert, $bool_starter, $refund, $duration, $request['forfait'], $num);
        $annex4 = $this->pdf_annex4($user, $num);
        $newbie = Contrats::create([
            'user_id' =>$usr,
            'demarrage_starter' => $bool_starter,
            'id_starter' => $pkg_starter,
            'id_expert' => $pack_expert->id,
            'id_abonnement_starter' => $abn_starter,
            'id_abonnement_expert' => $abonnement_expert->id,
            'id_parrainage' => $parrainage->id,
            'numero_contrat' =>$num,
            'forfait_entree' =>$request['forfait'],
            'forfait_remboursable' => $refund,
            'premiere_vente_pour_remboursement' => $duration,
            'parrain' =>$parrain,
            'parrain_id' =>$parrainid,
            'date_entree' =>$request['date-entree'],
            'date_debut_activitee' =>$request['date-debut'],
            'chemin_pdf_infos' => $contrat,
            'chemin_pdf_annex1' => $annex1,
            'chemin_pdf_annex2' => $annex2,
            'chemin_pdf_annex3' => $annex3,
            'chemin_pdf_annex4' => $annex4,
        ]);
        $user->contract_generate = 1;
        $user->role = 'prospect_plus';
        $user->update();
        if($parrain == 1)
        {
            if($parrainid != NULL)
            {
                $avenant = Parrainage::where('user_id', '=', $parrainid)->get()->first();
                $this->avenant_annexe2($avenant);
            }
            else
            {
                $newbie->parrain = 0;
                $newbie->update();
            }
        }
        $complete = new ContractGenerated($user);
        Notification::send($user, new UserContratGenerate($user));
        Mail::to($user)->send($complete);
        $invoice = new FacturationController;
        $invoice->forfait_entree($user, $request['forfait']);
        return redirect()->route('contrat.index')->with('ok', __('Le contrat a été généré, le mandataire est informé par email.'));
    }

    /**
     * Display the specified resource.
     * @author: Belkacem.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrat = Contrats::where('id', '=', $id)->get()->first();
        $user = User::where('id', '=', $contrat->user_id)->get()->first();
        $society = Infosentreprise::get()->first();
        $bareme = Infospaliercommissions::get()->first();
        $timetamps = $contrat->created_at->format('d.m.Y');
        $dr_expert = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Expert'],])->get()->first();
        $abn_expert = Abonnement::where([['user_id', '=', $user->id],['pack_type', '=', 'Expert'],])->get()->first();
        $palier_expert = $this->unserialize_dir($dr_expert->serialize_palier);
        $all = Contrats::get()->all();
        $fileuls = array();
        foreach($all as $rs)
        {
            if ($user->id == $rs->parrain_id)
            {
                $tmp = User::where('id', '=', $rs->user_id)->get()->first();
                array_push($fileuls, $tmp);
            }
        }
        if(count($palier_expert) > 0)
        {
            $tmp2 = count($palier_expert) - 1;
            $last_expert = $palier_expert[$tmp2];
            array_pop($palier_expert);
        }
        $bool_starter = $contrat->demarrage_starter;
        if($bool_starter == 1)
        {
            $dr_starter = Dircommission::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $abn_starter = Abonnement::where([['user_id', '=', $user->id],['pack_type', '=', 'Starter'],])->get()->first();
            $palier_starter = $this->unserialize_dir($dr_starter->serialize_palier);
            if(count($palier_starter) > 0)
            {
                $tmp1 = count($palier_starter) - 1;
                $last_starter = $palier_starter[$tmp1];
                array_pop($palier_starter);
            }
        }
        $parrainage = Parrainage::where('user_id', '=', $user->id)->get()->first();
        $palier = $this->unserialize_parrainage($parrainage->serialize_annee_data);
        $last = $palier[count($palier) - 1];
        array_pop($palier);
        $parrain = User::where('id', '=', $contrat->parrain_id)->get()->first();
        $debut = $contrat->date_debut_activitee;
        /*annexe 4 data*/
        $palier_bareme = $this->unserialize_bareme_honorraire($bareme->model_serialization);
        $first_bareme = $palier_bareme[0];
        array_shift($palier_bareme);
        $last_bareme = $palier_bareme[count($palier_bareme) - 1];
        array_pop($palier_bareme);
        /*annex 4 end*/
        return view('compenents.contrats.render.modal', compact('contrat', 
                                                            'user',
                                                            'parrain',
                                                            'society',
                                                            'debut', 
                                                            'timetamps', 
                                                            '$parrainid', 
                                                            'parrainage', 
                                                            'palier', 
                                                            'last',
                                                            'dr_starter',
                                                            'abn_starter',
                                                            'bool_starter',
                                                            'dr_expert',
                                                            'palier_starter',
                                                            'palier_expert',
                                                            'last_starter',
                                                            'last_expert', 
                                                            'abn_expert',
                                                            'first_bareme',
                                                            'last_bareme',
                                                            'fileuls',
                                                            'palier_bareme'
                                                        )
                                                    );
    }

    /**
     * Listing des avenants.
     *
     * @author: Belkacem
     * @param  Contrats $id
     * @return Response
     */
    public function show_avenants($id)
    {
        $contrat = Contrats::where('id', '=', $id)->get()->first();
        $user = User::where('id', '=', $contrat->user_id)->get()->first();
        $list = Avenants::where('contrat_id', '=', $contrat->id)->get()->all();
        return view('contrats.avenants', compact('contrat', 'user', 'list'));
    }

    /**
     * Ajout RSAC Pour generer l'annexe 5.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request  $request
     * @param  int $id
     * @author: Belkacem.
     * @return \Illuminate\Http\Response
     */
    public function update_user_annex5(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $contrat = Contrats::where('user_id', '=', $user->id)->get()->first();
        $user->numero_carte_pro = $request['val-rsac'];
        $user->nom_organisme_delivrant_carte_pro = $request['val-gref'];
        $user->date_delivrance_carte_pro = $request['val-date'];
        $user->nom_organisme_assurance = $request['val-care'];
        $user->numero_assurance = $request['val-num'];
        $name1 = 'RSAC_'.$user->id.'_'.time().'.'.$request['file1']->getClientOriginalExtension();
        $name2 = 'ASSURANCE_'.$user->id.'_'.time().'.'.$request['file1']->getClientOriginalExtension();
        $path = 'public/'.$user->id.'/'.'documents_justificatifs/';
        $request['file1']->storeAs($path, $name1);
        $request['file2']->storeAs($path, $name2);
        $user->carte_pro = $user->id.'/'.'documents_justificatifs/'.$name1;
        $user->attestation_assurance_responsabilite_civile = $user->id.'/'.'documents_justificatifs/'.$name2;
        $user->bool_annex_5 = 1;
        $user->update();
        $contrat->update();
        $auser = User::where('role','admin')->get();
        Notification::send($auser, new RsacCompleted($user));
        return back()->with('ok', __("Vos informations RSAC ont été modifiées"));
    }

    /**
     * Téléchargement du contrat .
     *
     * @author: Belkacem
     * @param  int $id
     * @param  int $doc
     * @return Storage download
     */
    public function download_contrat($id, $doc)
    {
        $contrat = Contrats::where('id', '=', $id)->get()->first();
        switch($doc)
        {
            case 0:
                return Storage::download('public/'.$contrat->chemin_pdf_infos);
                break;
            case 1:
                return Storage::download('public/'.$contrat->chemin_pdf_annex1);
                break;
            case 2:
                return Storage::download('public/'.$contrat->chemin_pdf_annex2);
                break;
            case 3:
                return Storage::download('public/'.$contrat->chemin_pdf_annex3);
                break;
            case 4:
                return Storage::download('public/'.$contrat->chemin_pdf_annex4);
                break;
            case 5:
                return Storage::download('public/'.$contrat->chemin_pdf_annex5);
                break;
            default:
                abort(500);
        }
    }

    public function user_download_contrat($id, $doc)
    {
        $contrat = Contrats::where('user_id', '=', $id)->get()->first();
        return $this->download_contrat($contrat->id, $doc);
    }

    /**
     * Téléchargement des avenants .
     *
     * @author: Belkacem
     * @param  int $id
     * @return Storage downloads
     */
    public function download_avenant($id)
    {
        $avenant = Avenants::where('id', '=', $id)->get()->first();
        if ($avenant == NULL)
            abort(404);
        return Storage::download('public/'.$avenant->chemin_pdf);
    }

    /**
     * Archive le contrat.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $contrat = Contrats::where('id', '=', $id)->get()->first();
        $contrat->archive = 1;
        $contrat->update();
    }

    public function validation_rsac($id)
    {
        $contrat = Contrats::where('id', '=', $id)->get()->first();
        $user = User::where('id', '=', $contrat->user_id)->get()->first();
        $contrat->verif_rsac = 1;
        $user->role = "mandataire";
        $contrat->chemin_pdf_annex5 = $this->pdf_annex5($user, $contrat->numero_contrat);
        $contrat->update();
        $user->update();
        Notification::send($user, new Rsacvalidated($user));
        return redirect()->route('contrat.index')->with('ok', __('Les informations d\'immatriculation ont étaient validée le mandataire est désormais actif et l\'annexe 5 est générée.'));
    }
}
