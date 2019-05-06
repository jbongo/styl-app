<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users\UsersController;

use App\Http\Requests\LeadValidator;
use App\Http\Requests\SuiviRecrutementValidator;

use App\Models\User;
use App\Models\Leads;
use App\Models\Suivirecrutement;
use App\Models\Canalprospection;

class RecrutementController extends Controller
{

    public function radar()
    {
        $ret = array([0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0]);
        //pro immo
        $offset1 = Canalprospection::where('type', 'canal_virtuel')->get();
        $offset2 = Canalprospection::where('type', 'canal_physique')->get();
        foreach($offset1 as $one){
            $ret[0][0] += $one->leads->where('contact_etabli', 1)->count();
            $ret[1][0] += $one->leads->where('qualification', 1)->count();
            $ret[2][0] += $one->leads->where('professionnel', 1)->count();
            $ret[3][0] += $one->leads->where('pro_immo', 1)->count();
            foreach ($one->leads as $rot){
                $ret[4][0] += $rot->suivirecrutements()->where('role', "appel")->count();
                $ret[5][0] += $rot->suivirecrutements()->where('role', "email")->count();
                $ret[6][0] += $rot->suivirecrutements()->where('role', "rencontre")->count();
            }
        }
        foreach($offset2 as $one){
            $ret[0][1] += $one->leads->where('contact_etabli', 1)->count();
            $ret[1][1] += $one->leads->where('qualification', 1)->count();
            $ret[2][1] += $one->leads->where('professionnel', 1)->count();
            $ret[3][1] += $one->leads->where('pro_immo', 1)->count();
            foreach ($one->leads as $rot){
                $ret[4][1] += $rot->suivirecrutements()->where('role', "appel")->count();
                $ret[5][1] += $rot->suivirecrutements()->where('role', "email")->count();
                $ret[6][1] += $rot->suivirecrutements()->where('role', "rencontre")->count();
            }
        }
        return($ret);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $leads = Leads::all();
        $canal = Canalprospection::all();
        $today = Suivirecrutement::where('date', $date)->orderBy('heure', 'ASC')->get()->all();
        $calendar = Suivirecrutement::whereYear('date', date('Y'))->get();
        $prospects = array();
        $cannaux = array();
        $radar = $this->radar();
        for ($i=1; $i<=12; $i++){
            $bin = array(0, 0, 0, 0, 0, 0);
            $bin1 = array(0, 0);
            $bin[0] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)->count();
            $bin[1] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('contact_etabli', 0)->count();
            $bin[2] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('contact_etabli', 1)->count();
            $bin[3] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('qualification', 1)->count();
            $bin[4] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('professionnel', 1)->count();
            $bin[5] = Leads::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('pro_immo', 1)->count();
            $bin1[0] = Canalprospection::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->where('type', "canal_virtuel")->count();
            $bin1[1] = Canalprospection::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $i)
                ->where('type', "canal_physique")->count();
            array_push($prospects, $bin);
            array_push($cannaux, $bin1);
        }
        return view('recrutement.index', compact('leads', 'canal', 'today', 'radar', 'prospects', 'cannaux', 'calendar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_lead(leadValidator $request)
    {
        $lead = Leads::create([
            'canalprospection_id'=> $request['canal'],
            'nom'=> $request['nom'],
            'prenom'=>$request['prenom'],
            'telephone'=>$request['telephone'],
            'email'=>$request['email'],
            'adresse'=>$request['adresse'],
            'code_postal'=>$request['code_postal'],
            'ville'=>$request['ville'],
        ]);
        if ($request['b_pro'] && $request['b_pro'] === "on")
        {
            $lead->professionnel = 1;
            if ($request['b_pro_immo'] && $request['b_pro_immo'] === "on")
            {
                $lead->pro_immo = 1;
                $lead->type_immo = $request['type_immo'];
            }
            $lead->update();
        }
        return redirect()->back()->with('ok', __('La fiche contact a été ajoutée !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_canal(Request $request)
    {
        $canal = Canalprospection::create([
            'nom_canal'=> $request['nom_canal'],
            'type'=> $request['type'],
            'site_web'=> $request['site_web'],
        ]);
        return redirect()->back()->with('ok', __('Le canal a été ajoutée !'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_suivi(SuiviRecrutementValidator $request)
    {
        $action = Suivirecrutement::create([
            'leads_id'=> $request['lead_id'],
            'role'=> $request['role'],
            'date'=> $request['date'],
            'heure'=> $request['heure'],
            'commentaires'=> $request['commentaires'],
        ]);
        return redirect()->back()->with('ok', __('L\'activité a été planifiée!'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_canal(Request $request, $id)
    {
        $canal = Canalprospection::findOrFail($id);
        $canal->nom_canal = $request['nom_canal'];
        $canal->type = $request['type'];
        $canal->site_web = $request['site_web'];
        $canal->update();
        return redirect()->back()->with('ok', __('Le canal a été mis à jour !'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_lead(leadValidator $request, $id)
    {
        $lead = Leads::findOrFail($id);
        $lead->nom = $request['nom'];
        $lead->prenom = $request['prenom'];
        $lead->email = $request['email'];
        $lead->telephone = $request['telephone'];
        $lead->adresse = $request['adresse'];
        $lead->code_postal = $request['code_postal'];
        $lead->ville = $request['ville'];
        if ($request['b_pro'] && $request['b_pro'] === "on")
        {
            $lead->professionnel = 1;
            if ($request['b_pro_immo'] && $request['b_pro_immo'] === "on")
            {
                $lead->pro_immo = 1;
                $lead->type_immo = $request['type_immo'];
            }
            else
                $lead->pro_immo = 0;
        }
        else{
            $lead->professionnel = 0;
            $lead->pro_immo = 0;
        }
        $lead->update();
        return redirect()->back()->with('ok', __('Le prospect a été mis à jour !'));
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm_suivi($action, $id)
    {
        $suivi = Suivirecrutement::findOrFail($id);
        $lead = Leads::findOrFail($suivi->leads_id);
        if ($action == 1)
            $suivi->confirmation = 1;
        else
            $suivi->confirmation = 0;
        $lead->contact_etabli = 1;
        $lead->update();
        $suivi->update();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hire($id)
    {
        $lead = Leads::findOrFail($id);
        $lead->qualification = 1;
        $lead->update();
        $tet = str_random(8);
        $newuser = User::create([ 
            'nom' => $lead->nom,
            'prenom' => $lead->prenom,
            'civilite' => "NULL",
            'email' => $lead->email,
            'password' => bcrypt($tet),
            'password_temporaire' => $tet,
            'adresse' => $lead->adresse,
            'code_postal' => $lead->code_postal,
            'ville' => $lead->ville,
            'pays' => "NULL",
            'telephone' => $lead->telephone,
            'role' => "prospect"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_lead($id)
    {
        $lead = Leads::findOrFail($id);
        $array = array();
        $array[0] = $lead->suivirecrutements()->where('role', 'appel')->count();
        $array[1] = $lead->suivirecrutements()->where('role', 'email')->count();
        $array[2] = $lead->suivirecrutements()->where('role', 'rencontre')->count();
        $collection = Suivirecrutement::where('leads_id', $lead->id)->orderBy('date', 'ASC')->get();
        return view('recrutement.showlead', compact('lead', 'array', 'collection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_canal($id)
    {
        $canal = Canalprospection::findOrFail($id);
        $array = array(0, 0, 0, 0, 0);
        foreach($canal->leads as $one)
        {
            $array[0] += $one->suivirecrutements()->where('role', 'appel')->count();
            $array[1] += $one->suivirecrutements()->where('role', 'email')->count();
            $array[2] += $one->suivirecrutements()->where('role', 'rencontre')->count();
            if ($one->professionnel === 1)
                $array[3] += 1;
            if ($one->qualification === 1)
                $array[4] += 1; 
        }
        $line_c = array();
        for ($i=1 ; $i<=12 ; $i++)
        {
            $tmp = array(0, 0, 0);
            if ($i < 10)
                $tmp[0] = date('Y').'-'.'0'.$i;
            else
                $tmp[0] = date('Y').'-'.$i;
            $tmp[1] += $canal->leads()->whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
            $tmp[2] += Leads::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
            array_push($line_c, $tmp);
        }
        return view('recrutement.showcanal', compact('canal', 'array', 'line_c'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_lead($id)
    {
        $lead = Leads::findOrFail($id);
        foreach($lead->suivirecrutements as $one)
            $one->delete();
        $lead->delete();
    }
}
