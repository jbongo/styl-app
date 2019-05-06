<?php

namespace App\Http\Controllers\Notaires;

use Illuminate\Http\Request;
use App\Http\Requests\NotaireValidator;
use App\Http\Requests\NotaireAssocieValidator;
use App\Http\Controllers\Controller;
use App\Models\Notaire;
use App\Models\NotaireAssocie;

class NotaireController extends Controller
{
    
     /**
     * Desserializer les notaires depuis ajax.
     * @author Belkacem
     * @param string $var
     * @return array 
     */
    public function unserialize_notaire($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = urldecode(substr($el , strpos($el, "=") + 1, strlen($el)));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 4);
        return $chunk;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scp = Notaire::where('archive', '=', 0)->get();
        $not = NotaireAssocie::where('archive', '=', 0)->get();
        return view('notaires.index', compact('scp','not'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $not = Notaire::get()->all();
        return view('notaires.add', compact('not'));
    }

    /**
     * Store a newly created resource in storage.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function store(NotaireValidator $request)
    {
        $etude = Notaire::create([
            'role'=> $request['role'],
            'nom'=>$request['nom'],
            'email'=> $request['email'],
            'telephone'=>$request['telephone'],
            'code_postal'=>$request['code_postal'],
            'ville'=> $request['ville'],
            'adresse'=> $request['adresse'],
        ]);
        $list = $this->unserialize_notaire($request['assoc']);
        foreach($list as $one)
        {
            $obs = new NotaireAssocieValidator([ 
                'scp' => $etude->id,
                'role' => $one[0],
                'nom' => $one[1],
                'telephone' => $one[2],
                'email' => $one[3],
            ]);
            $this->store_associe($obs);
        }
        return $list;
    }

    /**
     * Store notaire associe to notaire_associes table.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function store_associe(NotaireAssocieValidator $request)
    {
        //dd($request);
        NotaireAssocie::create([
            'notaire_id' => $request['scp'],
            'role' => $request['role'],
            'nom' => $request['nom'],
            'telephone' => $request['telephone'],
            'email' => $request['email'],
        ]);
        return redirect()->route('notaire')->with('ok', __('Le notaire a été ajouté.'));
    }

    public function epur_data($etude, $role)
    {
        $tel = str_replace(".", "", $etude["telephone"]);
        if(strcasecmp($tel, "0000000000") != 0)
            $etude["telephone"] = $tel;
        else
            $etude["telephone"] = NULL;
        if($role == 1)
        {
            $addr = preg_replace('/\s+/', ' ', $etude["adresse"]);
            $etude["adresse"] = $addr;
            $role = substr($etude["nom"], 0, 3);
            if (strcasecmp($role, "SCP") == 0 || strcasecmp($role, "scp") == 0)
                $etude["role"] = "scp";
            else if(strcasecmp($role, "SEL") == 0 || strcasecmp($role, "sel") == 0)
                $etude["role"] = "sel";
            else
                $etude["role"] = "autre";
        }
        $tmp = stristr($etude["email"], '@');
        if ($tmp == false)
            $etude["email"] = NULL;
        return $etude;
    }

    public function json_import(Request $request)
    {
        $string = file_get_contents($request['fls']);
        $array = json_decode($string, true);
        array_pop($array);
        foreach($array as $one)
        {
            $etude = $this->epur_data($one["etude"], 1);
            $associe = array();
            foreach ($one["associes"] as $slice)
            {
                $tmp = $this->epur_data($slice["associe"], 0);
                array_push($associe, $tmp);
            }
            $append = Notaire::create([
                'role'=> $etude['role'],
                'nom'=>$etude['nom'],
                'email'=> $etude['email'],
                'telephone'=>$etude['telephone'],
                'code_postal'=>$etude['code_postal'],
                'ville'=> $etude['ville'],
                'adresse'=> $etude['adresse'],
            ]);
            foreach($associe as $one)
            {
                NotaireAssocie::create([
                    'notaire_id' => $append->id,
                    'role' => $one['role'],
                    'nom' => $one['nom'],
                    'telephone' => $one['telephone'],
                    'email' => $one['email'],
                ]);
            }
        }
        return redirect()->back()->with('ok', __('Toutes les entrées du fichier sont ajoutées.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $null = NotaireAssocie::where('notaire_id', '=', NULL)->get()->all(); 
        $etd = Notaire::where('id', '=', $id)->firstOrFail();
        $not = NotaireAssocie::where('notaire_id', '=', $id)->get()->all();
        return view('notaires.show', compact('etd', 'not', 'null'));
    }

    public function disassociate($id)
    {
        $notaire = NotaireAssocie::where('id', '=', $id)->firstOrFail();
        $notaire->notaire_id = NULL;
        $notaire->update();
        return redirect()->back()->with('ok', __('Le notaire a été dissocié'));
    }

    public function associate(Request $request, $id)
    {
        $notaire = NotaireAssocie::where('id', '=', $request["user"])->firstOrFail();
        $notaire->notaire_id = $id;
        $notaire->update();
        return redirect()->back()->with('ok', __('Le notaire a été associé à l\'étude'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_notaire($id)
    {
        $notaire = NotaireAssocie::where('id', '=', $id)->get()->first();
        return view('notaires.editnotaire', compact('notaire'));
    }

    public function update_notaire(NotaireAssocieValidator $request, $id)
    {
        $notaire = NotaireAssocie::where('id', '=', $id)->get()->first();
        $notaire->role = $request['role'];
        $notaire->nom = $request['nom'];
        $notaire->email = $request['email'];
        $notaire->telephone = $request['telephone'];
        $notaire->update();
        return redirect()->route('notaire')->with('ok', __('Les informations du notaire ont étaient modifiées.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_etude(NotaireValidator $request, $id)
    {
        $ret = Notaire::where('id', '=', $id)->firstOrFail();
        $ret->role = $request['role'];
        $ret->nom = $request['nom'];
        $ret->adresse = $request['adresse'];
        $ret->code_postal = $request['code_postal'];
        $ret->ville = $request['ville'];
        $ret->telephone = $request['telephone'];
        $ret->email = $request['email'];
        $ret->update();
        return redirect()->back()->with('ok', __('L\'étude a bien été modifiée'));
    }

    /**
     * Archive the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive_etude($id)
    {
        $etd = Notaire::where('id', '=', $id)->firstOrFail();
        $lst = NotaireAssocie::where('notaire_id', '=', $id)->get()->all();
        foreach($lst as $solo)
        {
            $solo->notaire_id = NULL;
            $solo->update();
        }
        $etd->archive = 1;
        $etd->update();
    }

    public function archive_notaire($id)
    {
        $notaire = NotaireAssocie::where('id', '=', $id)->firstOrFail();
        $notaire->archive = 1;
        $notaire->update();
    }
}
