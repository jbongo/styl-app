<?php

namespace App\Http\Controllers\Guests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GestionAffaireController extends Controller
{
    public function index()
    {
        return view('visiteurs.affaire');
    }
}
