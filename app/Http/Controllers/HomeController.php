<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = Auth::user();
        if($usr && $usr->role !== 'guest')
            return view('home');
        else if($usr && $usr->role === 'guest')
            return view('visiteurs.homevisiteurs');
    }
}
