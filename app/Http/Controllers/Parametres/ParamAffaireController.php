<?php

namespace App\Http\Controllers\Parametres;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ParamsAffaire;

class ParamAffaireController extends Controller
{

    public function dropdoc($id)
    {
        $params = ParamsAffaire::firstOrCreate([]);
        $stack = unserialize($params->list_documents);
        //dd($stack);
        if ($id == 0)
            array_shift($stack);
        else 
            array_splice($stack, $id, $id);
        $params->list_documents = serialize($stack);
        $params->update();
        return redirect()->back()->with('ok', __('Document supprimé !'));
    }

    public function index()
    {
        $params = ParamsAffaire::firstOrCreate([]);
        $stack = unserialize($params->list_documents);
        return view('parametres.index', compact('params', 'stack'));
    }

    public function construct_array($var)
    {
        $palier = explode("&", $var);
        $array = array();
        foreach($palier as $el)
        {
            $tmp = urldecode(substr($el , strpos($el, "=") + 1, strlen($el)));
            array_push($array, $tmp);
        }
        $chunk = array_chunk($array, 2);
        return $chunk;
    }

    public function is_in_tab($old, $el)
    {
        foreach($old as $fob)
        {
            if (strcmp(strtoupper($fob[0]), strtoupper($el[0])) === 0 && strcmp($fob[1], $el[1]) === 0)
                return 1;
        }
        return 0;
    }

    public function merge_doc($old, $new)
    {
        $ret = $old;
        foreach($new as $one)
        {
            if($this->is_in_tab($old, $one) === 0)
                array_push($ret, $one);
        }
        return $ret;
    }

    public function store_doc(Request $request)
    {
        $params = ParamsAffaire::firstOrCreate([]);
        $array = unserialize($params->list_documents);
        if ($params->list_documents == NULL)
            $params->list_documents = serialize($this->construct_array($request['list_doc']));
        else{
            $merge = $this->merge_doc($array, $this->construct_array($request['list_doc']));
            $params->list_documents = serialize($merge);
        }
        $params->update();
    }

    public function store_params(Request $request)
    {
        $params = ParamsAffaire::firstOrCreate([]);
        $params->pourcentage_partenaire = $request['percent_partner'];
        $params->max_offre = $request['max_offre'];
        if (isset($request['notif_mdn']) && $request['notif_mdn'] === "on")
            $params->notif_mandant = 1;
        else
            $params->notif_mandant = 0;
        if (isset($request['notif_acq']) && $request['notif_acq'] === "on")
            $params->notif_acquereur = 1;
        else
            $params->notif_acquereur = 0;
        if (isset($request['archive_bn']) && $request['archive_bn'] === "on")
            $params->archive_bien = 1;
        else
            $params->archive_bien = 0;
        if (isset($request['archive_mdn']) && $request['archive_mdn'] === "on")
            $params->archive_mandant = 1;
        else
            $params->archive_mandant = 0;
        if (isset($request['archive_acq']) && $request['archive_acq'] === "on")
            $params->archive_acquereur = 1;
        else
            $params->archive_acquereur = 0;
        $params->max_jour_notaire = $request['max_notaire'];
        $params->update();
        return redirect()->back()->with('ok', __('Paramètres sauvegardés !'));
    }
}
