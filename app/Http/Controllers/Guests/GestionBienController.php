<?php

namespace App\Http\Controllers\Guests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

class GestionBienController extends Controller
{
    public function index()
    {
        $guest = Auth::user();
        if ($guest->role === "chercheur")
            abort(404);
        $mandat = Mandats::findOrFail($guest->mandat_id);
        $bien = Biens::findOrFail($mandat->biens_id);
        $offre = OffreAchat::where('mandats_id', '=', $mandat->id)->get()->all();
        $pict = "images/photos_bien/".$bien->photosbiens[0]->resized_name;
        return view('visiteurs.bien', compact('bien', 'pict', 'offre'));
    }
}
