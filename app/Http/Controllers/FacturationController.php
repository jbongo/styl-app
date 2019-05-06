<?php
///////////////////////////////////////////////////
//Class: Facturation                             //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File as Fl;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\FactureEmmise;
use Notification;
use PDF;
use Auth;
use App\Models\User;
use App\Models\Factureproduct;
use App\Models\Infosentreprise;
use App\Models\Facturation;
use App\Models\Partners;

class FacturationController extends Controller
{

    /**
     * Créer le dossier des factures s'il n'existe pas.
     * @author Belkacem
     */
    public function make_directory()
    {
        $path = storage_path('app/public/'.'factures');
        if(!File::exists($path))
            File::makeDirectory($path, 0755, true);
    }

    public function mail_to_user($nom, $path, $mail)
    {
        $file = storage_path('app/public/'.$path);
        $ok = new FactureEmmise($nom, $file, $mail);
        Mail::to($mail)->send($ok);
    }

    /**
     * Créer le pdf de la facture pour mandataire du reseau.
     * @author Belkacem
     * @param Facturation $fact
     * @param bool $mail
     * @return string $path_to_pdf
     */
    public function pdf_user(Facturation $tet, $bob)
    {
        $token = 0;
        $user = User::where('id', '=', $tet->user_id)->get()->first();
        $nom = $user->civilite.' '.$user->nom.' '.$user->prenom;
        $tet->nom = $nom;
        $tet->adresse = $user->adresse;
        $tet->zip = $user->code_postal;
        $tet->ville = $user->ville;
        $tet->email = $user->email;
        $tet->update();
        $prod = Factureproduct::where('facture_id', '=', $tet->id)->get()->all();
        $name = "FACTURE_".$tet->id.'_'.time().".pdf";
        $path = storage_path('app/public/factures/'.$name);
        $time = date('d-m-Y');
        $pdf = PDF::loadView('pdf.facture.client', compact('token', 'nom','tet','user','prod','time'));
        $pdf->save($path);
        $ret = 'factures/'.$name;
        if ($bob == 1)
            $this->mail_to_user($nom, $ret, $user->email);
        return $ret;
    }

    /**
     * Créer le pdf de la facture pour contact partenaire.
     * @author Belkacem
     * @param Facturation $fact
     * @param bool $mail
     * @return string $path_to_pdf
     */
    public function pdf_partner(Facturation $tet, $bob)
    {
        $token = 0;
        $user = Partners::where('id', '=', $tet->user_id)->get()->first();
        $nom = $user->nom.' '.$user->prenom;
        $tet->nom = $nom;
        $tet->adresse = $user->adresse;
        $tet->zip = $user->code_postal;
        $tet->ville = $user->ville;
        $tet->email = $user->email;
        $tet->update();
        $prod = Factureproduct::where('facture_id', '=', $tet->id)->get()->all();
        $name = "FACTURE_".$tet->id.'_'.time().".pdf";
        $path = storage_path('app/public/factures/'.$name);
        $time = date('d-m-Y');
        $pdf = PDF::loadView('pdf.facture.client', compact('token', 'nom','tet','user','prod','time'));
        $pdf->save($path);
        $ret = 'factures/'.$name;
        if ($bob == 1)
            $this->mail_to_user($nom, $ret, $user->email);
        return $ret;
    }

    /**
     * Créer le pdf de la facture pour entité externe.
     * @author Belkacem
     * @param Facturation $fact
     * @param bool $mail
     * @return string $path_to_pdf
     */
    public function pdf_other(Facturation $tet, $bob, $nom, $addr, $zip, $ville, $email)
    {
        $token = 1;
        $prod = Factureproduct::where('facture_id', '=', $tet->id)->get()->all();
        $name = "FACTURE_".$tet->id.'_'.time().".pdf";
        $path = storage_path('app/public/factures/'.$name);
        $time = date('d-m-Y');
        $pdf = PDF::loadView('pdf.facture.client', compact('token','tet','nom', 'addr', 'zip', 'ville', 'email','prod','time'));
        $pdf->save($path);
        $ret = 'factures/'.$name;
        if ($bob == 1)
            $this->mail_to_user($nom, $ret, $email);
        return $ret;
    }

    public function pdf_avoir(Facturation $tet, Facturation $new, $msg, $bob)
    {
        $prod = Factureproduct::where('facture_id', '=', $tet->id)->get()->all();
        $name = "FACTURE_AVOIR_".$tet->id.'_'.time().".pdf";
        $path = storage_path('app/public/factures/'.$name);
        $time = date('d-m-Y');
        $pdf = PDF::loadView('pdf.facture.avoir', compact('tet','new', 'prod','time','msg'));
        $pdf->save($path);
        $ret = 'factures/'.$name;
        if ($bob == 1)
            $this->mail_to_user($tet->nom, $ret, $tet->email);
        return $ret;
    }
    /**
     * Desserializer les produit envoyés en ajax.
     * @author Belkacem
     * @param string $var
     * @return array 
     */
    public function unserialize_products($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = urldecode(substr($el , strpos($el, "=") + 1, strlen($el)));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 3);
        return $chunk;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fact = Facturation::get()->all();
        $user = User::get()->all();
        return view('factures.index', compact('user', 'fact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $user = User::whereIn('role', ['mandataire', 'prospect_plus'])->get()->all();
        $partner = Partners::where('user_id', '=', $id)->get()->all();
        return view ('factures.add', compact('user', 'partner'));
    }

    /**
     * Store a newly created from facture/add resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['dest'] == "Agent Stylimmo")
        {
            if ($request['user'] == NULL)
                abort(404);
            $id = $request['user'];
        }
        else if($request['dest'] == "Contact partenaire")
        {
            if ($request['partner'] == NULL)
                abort(404);
            $id = $request['partner'];
        }
        else if($request['dest'] == "Autre")
            $id = NULL;
        $sum_ht = 0;
        $this->make_directory();
        $chunk = $this->unserialize_products($request['produit']);
        foreach($chunk as $one)
            $sum_ht += ($one[0] * $one[2]);
        $sum_ttc = $sum_ht * (1 + (/*tva*/20 / 100));
        $tet = Facturation::create([
            'user_id'=> $id,
            'role'=>"Fournisseur",
            'paiement'=> 0,
            'montant_ht'=>$sum_ht,
            'montant_ttc'=>$sum_ttc,
        ]);
        $bob = ($request['mail'] == "on") ? 1 : 0;
        foreach($chunk as $one)
        {
            Factureproduct::create([
                'facture_id' => $tet->id,
                'quantite' => $one[0],
                'description' =>$one[1],
                'prix_unitaire_ht' => $one[2],
            ]);
        }
        if ($request['dest'] == "Agent Stylimmo")
            $tet->chemin_pdf = $this->pdf_user($tet, $bob);
        else if ($request['dest'] == "Contact partenaire")
        {
            $tet->chemin_pdf = $this->pdf_partner($tet, $bob);
            $tet->user_id = NULL;
        }
        else if ($request['dest'] == "Autre")
        {
            $tet->chemin_pdf = $this->pdf_other($tet,
                                            $bob, 
                                            $request['name'],
                                            $request['addr'],
                                            $request['zip'],
                                            $request['ville'],
                                            $request['email']
                                        );
            $tet->nom = $request['name'];
            $tet->adresse = $request['addr'];
            $tet->zip = $request['zip'];
            $tet->ville = $request['ville'];
            $tet->email = $request['email'];
        }
        $tet->update();
    }


    public function forfait_entree(User $user, $forfait)
    {
        $this->make_directory();
        $tet = Facturation::create([
            'user_id'=> $user->id,
            'role'=>"Fournisseur",
            'paiement'=> 0,
            'montant_ht'=>$forfait,
            'montant_ttc'=>$forfait * (1 + (/*tva*/20 / 100)),
        ]);

        Factureproduct::create([
            'facture_id' => $tet->id,
            'quantite' => 1,
            'description' => "Forfait d'entrée mandataire",
            'prix_unitaire_ht' => $forfait,
        ]);

        $tet->chemin_pdf = $this->pdf_user($tet, 1);
        $tet->update();
    }

    /**
     * Get the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $fact = Facturation::where('id', '=', $id)->get()->first();
        return Storage::download('public/'.$fact->chemin_pdf);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tet = Facturation::where('id', '=', $id)->get()->first();
        return view('factures.edit', compact('tet'));
    }

    public function avoir(Request $request, $id)
    {
        $tet = Facturation::where('id', '=', $id)->get()->first();
        $avr = Facturation::create([
            'user_id'=> $tet->id,
            'role'=>NULL,
            'paiement'=> 0,
            'montant_ht'=>$request['val'] / (1 + (20/100)),
            'montant_ttc'=>$request['val'],
            'nom' =>$tet->nom,
            'adresse'=>$tet->adresse,
            'zip'=>$tet->zip,
            'ville'=>$tet->ville,
            'email'=>$tet->email,
        ]);
        $bob = ($request['bool-mail'] == "on")?1:0;
        $avr->chemin_pdf = $this->pdf_avoir($tet, $avr, $request['describe'], $bob);
        $avr->update();
        return redirect()->route('facture')->with('ok', __('La facture d\'avoir a été créée.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pending(Request $request, $id)
    {
        $fact = Facturation::where('id', '=', $id)->get()->first();
        $fact->paiement = 1;
        $fact->mode = $request['method'];
        $fact->date_paiement = $request['date'];
        $fact->update();
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
