<?php

namespace App\Http\Controllers\Guests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File as Fl;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

class GestionDocumentController extends Controller
{
    public function index() 
    {
        $guest = Auth::user();
        if ($guest->role === "chercheur")
            abort(404);
        $mandat = Mandats::findOrFail($guest->mandat_id);
        $mdn_doc = unserialize($mandat->dossiervente->serialize_doc_mandant);
        $bn_doc = unserialize($mandat->dossiervente->serialize_doc_bien);
        $acq_doc = unserialize($mandat->dossiervente->serialize_doc_acquereur);
        return view('visiteurs.document', compact('mandat', 'mdn_doc', 'bn_doc', 'acq_doc'));
    }

    public function make_directory($id, $dossier)
    {
        $path = storage_path('app/public/'.$id);
        if(!File::exists($path))
            File::makeDirectory($path, 0777, true);
        $path = storage_path('app/public/'.$id.'/suivi_affaire'.'/'.$dossier);
        if(!File::exists($path))
            File::makeDirectory($path, 0777, true);
        return 'app/public/'.$id.'/suivi_affaire'.'/'.$dossier;
    }

    public function make_directory_mandant($path)
    {
        $tmp = storage_path($path.'/documents_mandant');
        if(!File::exists($tmp))
            File::makeDirectory($tmp, 0755, true);
        return $path.'/documents_mandant';
    }

    public function make_directory_acquereur($path)
    {
        $tmp = storage_path($path.'/documents_acquereur');
        if(!File::exists($tmp))
            File::makeDirectory($tmp, 0755, true);
        return $path.'/documents_acquereur';
    }

    public function make_directory_bien($path)
    {
        $tmp = storage_path($path.'/documents_bien');
        if(!File::exists($tmp))
            File::makeDirectory($tmp, 0755, true);
        return $path.'/documents_bien';
    }

    public function store_in_tab($string, $request, $key, $path)
    {
        $ret = unserialize($string);
        $elem = $ret[$key];
        $date = date('d-m-Y');
        $name = strtoupper($elem[0]).'_'.time().'.'.$request['file-doc']->getClientOriginalExtension();
        $request['file-doc']->storeAs($path.'/', $name);
        $elem[1] = $date;
        $elem[3] = $path.'/'.$name;
        $elem[2] = "en traitement";
        $ret[$key] = $elem;
        return $ret;
    }

    public function store(Request $request, $key)
    {
        $guest = Auth::user();
        $mandat = Mandats::findOrFail($guest->mandat_id);
        $dossier = DossierVente::findOrFail($mandat->dossiervente->id);
        $tmp = $this->make_directory($mandat->users_id, $dossier->id);
        if ($guest->role === 'mandant'){
            $path = $this->make_directory_mandant($tmp);
            $string = $dossier->serialize_doc_mandant;
            $ret = $this->store_in_tab($string, $request, $key, $path);
            $dossier->serialize_doc_mandant = serialize($ret);
        }
        if ($guest->role === 'acquereur'){
            $path = $this->make_directory_acquereur($tmp);
            $string = $dossier->serialize_doc_acquereur;
            $ret = $this->store_in_tab($string, $request, $key, $path);
            $dossier->serialize_doc_acquereur = serialize($ret);
        }
        $dossier->update();
        return redirect()->back()->with('ok', __('Le document a été ajouté, il sera soumis au traitement.'));
    }

    public function store_doc_bien(Request $request, $key)
    {
        $guest = Auth::user();
        $mandat = Mandats::findOrFail($guest->mandat_id);
        $dossier = DossierVente::findOrFail($mandat->dossiervente->id);
        $tmp = $this->make_directory($mandat->users_id, $dossier->id);
        $path = $this->make_directory_bien($tmp);
        $string = $dossier->serialize_doc_bien;
        $ret = $this->store_in_tab($string, $request, $key, $path);
        $dossier->serialize_doc_bien = serialize($ret);
        $dossier->update();
        return redirect()->back()->with('ok', __('Le document a été ajouté, il sera soumis au traitement.'));
    }
}
