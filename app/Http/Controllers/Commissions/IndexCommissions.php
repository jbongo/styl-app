<?php
///////////////////////////////////////////////////
//Class: Listing pour module des commissions     //
//Auteur: Belkacem                               //
///////////////////////////////////////////////////

namespace App\Http\Controllers\Commissions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dircommission;
use App\Models\Parrainage;
use App\Models\Abonnement;

class IndexCommissions
{
    /**
     * Display a listing of the resource.
     * @author Belkacem
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parrainage = Parrainage::all()->where('user_id','=', NULL);
        $direct = Dircommission::all()->where('user_id','=', NULL);
        $ab = Abonnement::all()->where('user_id','=', NULL);
        return view('commissions.index', compact('parrainage','direct','ab'));
    }
}
