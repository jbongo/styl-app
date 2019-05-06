<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\FORMATIONS_Register;
use App\Mail\FORMATIONS_Unsubscribe;
use App\Mail\FORMATIONS_Cancel;
use App\Mail\FORMATIONS_Cancelnotif;
use App\Mail\FORMATIONS_Cancelme;
use App\Mail\FORMATIONS_ModifDate;
use App\Mail\FORMATIONS_ModifDateMe;
use App\Mail\FORMATIONS_ModifPlace;
use App\Mail\FORMATIONS_ModifPlaceMe;
use App\Mail\FORMATIONS_ModifDatePlace;
use App\Mail\FORMATIONS_ModifDatePlaceMe;
use App\Mail\FORMATIONS_Supprmodelme;
use App\Mail\FORMATIONS_Supprmodelnotif;
use Illuminate\Http\File as Fl;
use Illuminate\Http\Request;
use App\Models\Formations;
use App\Models\User;
use App\Models\FormationCategories;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Datetime;
use Datetimezone;
use Illuminate\Support\Facades\Auth;


class FormationController extends Controller
{
	// création de la string formation->duration qui permet une durée lisible et visuellement interpretable par les utilisateurs //
	public function show()
	{
	 setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
	 $formationcategories = FormationCategories::all();
	 $formations = Formations::where('is_archive', 0)->get();
	 foreach ($formations as $formation)
	 {
	 	$diff = date_diff(date_create($formation->starting_date), date_create($formation->end_date));
	 	 // $formation->diff variable pour le tri des durées sur le tableau //
	 	$formation->diff = $diff->h + $diff->d * 24;
	 	if ($formation->diff > 23)
	 	{
	 		if ($formation->diff % 24 < 5)
	 			if ($formation->diff < 48)
	 				$formation->duration = '1 jour 1/2';
	 			else
	 				$formation->duration = $diff->format("%a jours 1/2");
	 		else
	 		{
	 				$diff->d += 1;
	 			//	dd($diff->d);
	 				$formation->duration = $diff->d.' jours';
	 		}
	 	}
	 	else
	 		$formation->duration = $diff->format("%h heures");
	 }
	 return view('formation.apply', compact('formations', 'formationcategories'));
	}
	public function done()
	{
    	$path = storage_path('app/public/formationDL/');
    	if(!File::exists($path))
        	File::makeDirectory($path, 755, true, true);
    	$path = storage_path('app/public/formationDL/mandataire/');
    	if(!File::exists($path))
        	File::makeDirectory($path, 755, true, true);
    	$path = storage_path('app/public/formationDL/speaker/');
    	if(!File::exists($path))
        	File::makeDirectory($path, 755, true, true);
	 setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
	 $formationcategories = FormationCategories::all();
	 $formations = Formations::where('is_archive', 0)->get();
	 foreach ($formations as $formation)
	 {
	 	$diff = date_diff(date_create($formation->starting_date), date_create($formation->end_date));
	 	$formation->diff = $diff->h + $diff->d * 24;
	 	if ($diff->format("%a") != '0')
	 	{
	 		if ($diff->format("%h") != '0')
	 			$formation->duration = $diff->format("%a jours 1/2");
	 		else
	 			$formation->duration = $diff->format("%a jours");
	 	}
	 	else
	 		$formation->duration = $diff->format("%h heures");
	 }
	 return view('formation.done', compact('formations', 'formationcategories'));
	}
	public function delete($id)
	{
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
        {
		 	setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
		 	$users = User::all();
	        $formation = Formations::findOrFail($id);
	        $canceler = Auth::user();

	        // la fonction n' est pas adaptée a un envoie de mails en masse //
	        if ($formation->is_model)
	       		\Mail::to($canceler)->send(new FORMATIONS_Supprmodelme($formation, $canceler));
	       	else
	       		\Mail::to($canceler)->send(new FORMATIONS_Cancelme($formation, $canceler));
	        foreach ($users as $user)
	        	if ($user->role === 'admin')
	        	    if ($formation->is_model)
	        			\Mail::to($user)->send(new FORMATIONS_Supprmodelnotif($formation, $user, $canceler));
	        		else
	        			\Mail::to($user)->send(new FORMATIONS_Cancelnotif($formation, $user, $canceler));
	        foreach ($formation->users as $usr)
	        	\Mail::to($usr)->send(new FORMATIONS_Cancel($formation, $usr));
	        $formation->is_archive = 1;
	        $formation->update();
    	}
        return redirect('/formation/apply');
	}
	public function catdelete($id)
	{	
    	if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
    	{
        	$formationcategory = FormationCategories::findOrFail($id);
        	$formationcategory->delete();
        }
        return redirect('/formation/cat');
	}
	public function uncat($id)
	{
        $formation = Formations::findOrFail($id);
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
        {
        	$formation->category_id = 0;
        	$formation->update();
    	}
        return redirect('/formation/apply');
	}
	public function register($id)
	{
		if (Auth::user()->role === 'mandataire')
		{
			setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
			$usr = Auth::user();
			$auth = Auth::user()->id;
	        $formation = Formations::findOrFail($id);
	        $formation->nb_inscrits++;
		//	dd($auth);
	        $formation->users()->attach($auth);
	        $formation->update();
	        \Mail::to(Auth::user())->send(new FORMATIONS_Register($formation, $usr));
	    }
        return redirect('/formation/apply');
	}
	public function unsubscribe($id)
	{
		if (Auth::user()->role === 'mandataire')
		{
		setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
		$usr = Auth::user();
		$auth = Auth::user()->id;
        $formation = Formations::findOrFail($id);
        $formation->nb_inscrits--;
        $formation->users()->detach($auth);
        $formation->update();
        \Mail::to(Auth::user())->send(new FORMATIONS_Unsubscribe($formation, $usr));
    	}
        return redirect('/formation/apply');
	}
	public function model(Request $request)
	{
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
        {
		        $request->validate([
		            'titre' => 'required|string|max:255',
		        ]);
			$auth = Auth::user()->id;
			$formation = Formations::create([            
	        ]);
	        $formation->former_id = $auth;
	        $formation->titre = $request['titre'];
	        $formation->details = $request['details'];
	        $formation->type = $request['type'];
	        $formation->infocomp = $request['infocomp'];
	        $formation->option_ordi = $request['option_ordi'];
	        $formation->hierarchie = $request['hierarchie'];
	        $formation->presence = $request['presence'];
	        $formation->acquis = $request['acquis'];
	        $formation->advisable_time = $request['days'] * 24 + $request['hours'];
	        if ($request['parent'])
		        if ($request['catnom'])
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
		        else
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
	        $formation->update();
    	}
        return redirect('/formation/plan');
	}

	public function store(Request $request)
	{
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
        {
				$request->validate([
		            'starting_date'=>'required|date',
		            'end_date'=>'required|date',
		            'titre' => 'required|string|max:255',
		        ]);	
			$formation = Formations::create([            
	        ]);
	        $formation->titre = $request['titre'];
	        $starting_date = strtotime($request['starting_date'].' '.$request['starting_time']);
	        $formation->starting_date = date("Y-m-d H:i", $starting_date);
	        $end_date = strtotime($request['end_date'].' '.$request['end_time']);
	        $formation->end_date = date("Y-m-d H:i", $end_date); 
	        $formation->lieu = $request['lieu'];
	        $formation->postal = $request['postal'];
	        $formation->st = $request['st'];
	        $formation->nb_max = $request['nb_max'];
	        $formation->details = $request['details'];
	        $formation->type = $request['type'];
	        $formation->infocomp = $request['infocomp'];
	        $formation->option_ordi = $request['option_ordi'];
	        $formation->hierarchie = $request['hierarchie'];
	        $formation->presence = $request['presence'];
	        $formation->acquis = $request['acquis'];
	        $formation->is_model = 0;
	        if ($request['parent'])
		        if ($request['catnom'])
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
		        else
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
	        $formation->update();
    	}
        return redirect('/formation/apply');
	}

	public function storeplan(Request $request)
	{
		 setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
        {
			date_default_timezone_set("Europe/Paris");
			if (!($request['multiname']))
		        $request->validate([
		            'starting_date'=>'required|date',
		            'end_date'=>'required|date',
		            'titre' => 'required|string|max:255',
		        ]);
			$formation = Formations::create([            
	        ]);
			$auth = Auth::user()->id;
	        $formation->speaker_id = $auth;
	        $formation->titre = $request['titre'];
	        $starting_date = strtotime($request['starting_date'].' '.$request['starting_time']);
	        $formation->starting_date = date("Y-m-d H:i", $starting_date);
	        $end_date = strtotime($request['end_date'].' '.$request['end_time']);
	        $formation->end_date = date("Y-m-d H:i", $end_date); 
	        $formation->lieu = $request['lieu'];
	        $formation->postal = $request['postal'];
	        $formation->st = $request['st'];
	        $formation->nb_max = $request['nb_max'];
	        $formation->details = $request['details'];
	        $formation->type = $request['type'];
	        $formation->infocomp = $request['infocomp'];
	        $formation->option_ordi = $request['option_ordi'];
	        $formation->hierarchie = $request['hierarchie'];
	        $formation->presence = $request['presence'];
	        $formation->acquis = $request['acquis'];
	        $formation->advisable_time = $request['advisable_time'];
	        if ($request['multiname'])
	        {
		        $startdatearray = $request['startdatearray'];
		        $enddatearray = $request['enddatearray'];
		        $starttimearray = $request['starttimearray'];
		        $endtimearray = $request['endtimearray'];
	        	$request->validate([
		            'titre' => 'required|string|max:255',
		            'startdatearray' => 'required',
		            'starttimearray' => 'required',
		            'enddatearray' => 'required',
		            'endtimearray' => 'required',
		        ]);
	        	$formation->multiname = $request['multiname'];
	        	$formation->startdatearray = $startdatearray;
	        	$formation->starttimearray = $starttimearray;
	        	$formation->enddatearray = $enddatearray;
	        	$formation->endtimearray = $endtimearray;
	        //	dd($startdatearray);
	        	$arraydatestart = explode (',' , $startdatearray);
	        	$arraydateend = explode (',' , $enddatearray);
	        	$arraytimestart = explode (',' , $starttimearray);
	        	$arraytimeend = explode (',' , $endtimearray);
	        	$formation->starting_date = date('Y-m-d H:i' , ((strtotime($arraytimestart[0] . ':00') + date('Z')) % 86400 + strtotime($arraydatestart[0])));
	        	$formation->end_date = date('Y-m-d H:i' , ((strtotime(end($arraytimeend) . ':00') + date('Z')) % 86400 + strtotime(end($arraydateend))));
	        }
	        if ($request['defaultcatid'])
	        	$formation->category_id = $request['defaultcatid'];
	        if ($request['parent'])
		        if ($request['catnom'])
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
		        else
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
		    $formation->is_model = 0;
	        $formation->update();
	    }
	    return redirect('/formation/apply');
	}

	public function retrievestore(Request $request)
	{
		 setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
	    if (Auth::user()->role === 'admin')
	    {
			date_default_timezone_set("Europe/Paris");
			if (!($request['multiname']))
		        $request->validate([
		            'starting_date'=>'required|date',
		            'end_date'=>'required|date',
		            'titre' => 'required|string|max:255',
		        ]);
			$formation = Formations::create([            
	        ]);
	        $formation->titre = $request['titre'];
	        $starting_date = strtotime($request['starting_date'].' '.$request['starting_time']);
	        $formation->starting_date = date("Y-m-d H:i", $starting_date);
	        $end_date = strtotime($request['end_date'].' '.$request['end_time']);
	        $formation->end_date = date("Y-m-d H:i", $end_date); 
	        $formation->lieu = $request['lieu'];
	        $formation->postal = $request['postal'];
	        $formation->st = $request['st'];
	        $formation->nb_max = $request['nb_max'];
	        $formation->details = $request['details'];
	        $formation->type = $request['type'];
	        $formation->infocomp = $request['infocomp'];
	        $formation->option_ordi = $request['option_ordi'];
	        $formation->hierarchie = $request['hierarchie'];
	        $formation->presence = $request['presence'];
	        $formation->acquis = $request['acquis'];
	        $startdatearray = $request['startdatearray'];
	        $enddatearray = $request['enddatearray'];
	        $starttimearray = $request['starttimearray'];
	        $endtimearray = $request['endtimearray'];
	        if ($request['multiname'])
	        {
	        	$request->validate([
		            'titre' => 'required|string|max:255',
		            'startdatearray' => 'required',
		            'starttimearray' => 'required',
		            'enddatearray' => 'required',
		            'endtimearray' => 'required',
		        ]);
	        	$formation->multiname = $request['multiname'];
	        	$formation->startdatearray = $startdatearray;
	        	$formation->starttimearray = $starttimearray;
	        	$formation->enddatearray = $enddatearray;
	        	$formation->endtimearray = $endtimearray;
	        //	dd($startdatearray);
	        	$arraydatestart = explode (',' , $startdatearray);
	        	$arraydateend = explode (',' , $enddatearray);
	        	$arraytimestart = explode (',' , $starttimearray);
	        	$arraytimeend = explode (',' , $endtimearray);
	        	$formation->starting_date = date('Y-m-d H:i' , ((strtotime($arraytimestart[0] . ':00') + date('Z')) % 86400 + strtotime($arraydatestart[0])));
	        	$formation->end_date = date('Y-m-d H:i' , ((strtotime(end($arraytimeend) . ':00') + date('Z')) % 86400 + strtotime(end($arraydateend))));
	        }
	        $formation->is_model = 0;
	        $formation->is_archive = 0;
	        if ($request['defaultcatid'])
	        	$formation->category_id = $request['defaultcatid'];
	        if ($request['parent'])
		        if ($request['catnom'])
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
		        else
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
	        $formation->update();
	    }
        return redirect('/formation/apply');
	}

	public function catstore(Request $request)
	{
	    if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
	    {
		// dd ($request);
        $request->validate([
            'nom'=>'required|string|unique:formation_categories',
        ]);
	 	$formationcategories = FormationCategories::all();
		$cat = FormationCategories::create([            
        ]);
		$cat->nom = $request['nom'];
		$cat->parent = $request['parent'];
		if ($cat->parent)
		{
	        $request->validate([
	            'soustag'=>'required|string',
	            'soustag_color'=>'required|string',
	        ]);			
			foreach ($formationcategories as $parentcategory)
				if ($cat->parent == $parentcategory->nom)
				{
					$cat->tag = $parentcategory->tag;
					$cat->tag_color = $parentcategory->tag_color;
				}
		}
		else
		{
	        $request->validate([
	            'tag'=>'required|string|unique:formation_categories',
	            'tag_color'=>'required|string',
	        ]);	
			$cat->tag = strtoupper($request['tag']);
			$cat->tag_color = $request['tag_color'];
		}
		$cat->soustag = strtoupper($request['soustag']);
		$cat->soustag_color = $request['soustag_color'];
		$cat->maker_id = Auth::user()->id;
		if ($cat->nom)
        	$cat->update();
    	}
        return redirect('/formation/cat');
	}

	public function update(Request $request)
	{
	 		setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
	    if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
	    {
	        $request->validate([
	            'starting_date'=>'required|date',
	            'end_date'=>'required|date',
	            'titre' => 'required|string|max:255',
	        ]);	
	    $date = 0;
        $canceler = Auth::user();
        $formation = Formations::findOrFail($request['id']);
        $formation->titre = $request['titre'];
        $starting_date = strtotime($request['starting_date'].' '.$request['starting_time']);
        if ($starting_date != $formation->starting_date)
        {
    		if ($formation->lieu == $request['lieu'] && $formation->st == $request['st'])
    		{
		        foreach ($formation->users as $usr)
		        	\Mail::to($usr)->send(new FORMATIONS_ModifDate($formation, $usr));
       			\Mail::to($canceler)->send(new FORMATIONS_ModifDateMe($formation, $canceler));
    		}
        	$formation->starting_date = date("Y-m-d H:i", $starting_date);
        	$date = 1;
        }
        $end_date = strtotime($request['end_date'].' '.$request['end_time']);
        $formation->end_date = date("Y-m-d H:i", $end_date);
    	if ($formation->lieu != $request['lieu'] || $formation->st != $request['st'])
    	{
    		if ($date = 1)
    		{
		        foreach ($formation->users as $usr)
		        	\Mail::to($usr)->send(new FORMATIONS_ModifDatePlace($formation, $usr));
   				\Mail::to($canceler)->send(new FORMATIONS_ModifDatePlaceMe($formation, $canceler));
   			}
   			else
   			{
		        foreach ($formation->users as $usr)
		        	\Mail::to($usr)->send(new FORMATIONS_ModifPlace($formation, $usr));
   				\Mail::to($canceler)->send(new FORMATIONS_ModifPlaceMe($formation, $canceler));
   			}
	        $formation->lieu = $request['lieu'];
	        $formation->postal = $request['postal'];
	        $formation->st = $request['st'];
    	}
        $formation->nb_max = $request['nb_max'];
        $formation->details = $request['details'];
        $formation->type = $request['type'];
        $formation->infocomp = $request['infocomp'];
        $formation->option_ordi = $request['option_ordi'];
        $formation->hierarchie = $request['hierarchie'];
        $formation->presence = $request['presence'];
        $formation->acquis = $request['acquis'];
        if ($request['parent'])
	        if ($request['catnom'])
	        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
	        else
	        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
        $formation->update();
    	}
        return redirect('/formation/apply');
	}

	public function catupdate(Request $request)
	{
	    if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
	    {
	        $cat = FormationCategories::findOrFail($request['id']);
	        if ($request['nomedit'])
				$cat->nom = $request['nomedit'];
			if ($cat->parent)
			{
				$cat->parent = $request['parentedit'];
				$cat->soustag = strtoupper($request['soustagedit']);
			}
			else
			{
				$cat->tag = strtoupper($request['tagedit']);
			}
			$cat->update();
		}
        return redirect('formation/cat');
	}

	public function updateplan(Request $request)
	{
	    if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
	    {
		        $request->validate([
		            'titre' => 'required|string|max:255',
		        ]);	
	        $formation = Formations::findOrFail($request['id']);
	        $formation->titre = $request['titre'];       
	        $formation->lieu = $request['lieu'];
	        $formation->postal = $request['postal'];
	        $formation->st = $request['st'];
	        $formation->nb_max = $request['nb_max'];
	        $formation->details = $request['details'];
	        $formation->type = $request['type'];
	        $formation->infocomp = $request['infocomp'];
	        $formation->option_ordi = $request['option_ordi'];
	        $formation->hierarchie = $request['hierarchie'];
	        $formation->presence = $request['presence'];
	        $formation->acquis = $request['acquis'];
	        if ($request['parent'])
		        if ($request['catnom'])
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
		        else
		        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
	        $formation->update();
    	}
        return redirect('/formation/plan');
	}

	public function updatemodel(Request $request)
	{
	    if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
	    {
	        $request->validate([
	            'titre' => 'required|string|max:255',
	        ]);	
        $formation = Formations::findOrFail($request['id']);
        $formation->titre = $request['titre'];       
        $formation->details = $request['details'];
        $formation->type = $request['type'];
        $formation->infocomp = $request['infocomp'];
        $formation->option_ordi = $request['option_ordi'];
        $formation->hierarchie = $request['hierarchie'];
        $formation->presence = $request['presence'];
        $formation->acquis = $request['acquis'];
        if ($request['parent'])
	        if ($request['catnom'])
	        	$formation->category_id = FormationCategories::where('nom', '=', $request['catnom'])->firstOrfail()->id;
	        else
	        	$formation->category_id = FormationCategories::where('nom', '=', $request['parent'])->firstOrfail()->id;
        $formation->update();
    	}
        return redirect('/formation/plan');
	}

    public function download_pdf($id, $role)
    {
    	$zipper = new \Chumper\Zipper\Zipper;
    	if (Auth::user()->role === $role)
    	{
        	$formation = Formations::findOrFail($id);
    		if (Auth::user()->role === 'admin')
    		{
				$zipper->make(storage_path('app/public/zipper/admin.zip'))->add(array(storage_path('app/public/formationDL/speaker/'.$formation->id.'/'), storage_path('app/public/formationDL/mandataire/'.$formation->id.'/')))->close();
    			return Storage::download('public/zipper/admin.zip');
    		}
        	else if (Auth::user()->role === 'mandataire')
        	{
        		foreach ($formation->users as $mandataire)
        			if ($mandataire->id === Auth::user()->id)
        				return Storage::download('public/formationDL/mandataire/'.$formation->id.'/'.$formation->id.'_support_mandataire.pdf');
        	}
        	else if (Auth::user()->role === 'formateur')
        	{
				if ($formation->speaker_id === Auth::user()->id || $formation->former_id === Auth::user()->id)
				{
					$zipper->make(storage_path('app/public/zipper/formateur.zip'))->add(array(storage_path('app/public/formationDL/speaker/'.$formation->id.'/'), storage_path('app/public/formationDL/mandataire/'.$formation->id.'/')))->close();
        			return Storage::download('public/zipper/formateur.zip');
				}
        	}
         	else if (Auth::user()->role === 'intervenant')
        	{
				if ($formation->speaker_id === Auth::user()->id)
					{
						$zipper->make(storage_path('app/public/zipper/intervenant.zip'))->add(array(storage_path('app/public/formationDL/speaker/'.$formation->id.'/'), storage_path('app/public/formationDL/mandataire/'.$formation->id.'/')))->close();
	        			return Storage::download('public/zipper/intervenant.zip');
					}
        	}
        }
        abort(500);
    }

    public function plan()
    {
	 if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur' || Auth::user()->role === 'intervenant')
	 {
		 $formationcategories = FormationCategories::all();
		 $formations = Formations::where('is_archive', 0)->get();
		 foreach ($formations as $formation)
		 {
		 	$formation->hours = $formation->advisable_time % 24;
		 	$formation->days = floor($formation->advisable_time / 24);
		 	if ($formation->advisable_time > 23)
		 	{
		 		if ($formation->advisable_time % 24)
		 			$formation->duration = $formation->days.' jours 1/2';
		 		else
		 			$formation->duration = $formation->days.' jours';
		 	}
		 	else
		 		$formation->duration = $formation->advisable_time.' heures';
		 }
		 return view('formation.plan', compact('formations', 'formationcategories'));
	 }
	 abort(404);
    }

    public function documents()
    {
	 $formations = Formations::where('is_archive', 0)->get();
	 return view('formation.documents', compact('formations'));
    }

    public function cat()
    {
	 if (Auth::user()->role === 'admin' || Auth::user()->role === 'formateur')
	 {
	 	$formationcategories = FormationCategories::all();
	 	return view('formation.cat', compact('formationcategories'));
	 }
     abort(404);
    }

    public function index()
    {
	 $formationcategories = FormationCategories::all();
	 $formations = Formations::where('is_archive', 0)->get();
	 return view('formation.index', compact('formationcategories', 'formations'));
    }

    public function multi()
    {
    	$ids = Formations::pluck('id')->toArray();
    	$max = max($ids);
    	$i = 0;
    	$multitime = [];
    	$multiname = [];
    	while (++$i <= $max)
    	{
    		$multitime[$i - 1] = Formations::where('id', '=', $i)->value('advisable_time') ? Formations::where('id', '=', $i)->value('advisable_time') : 0;
    		$multiname[$i - 1] = Formations::where('id', '=', $i)->value('titre') ? Formations::where('id', '=', $i)->value('titre') : 0;
    	}
   		return (json_encode(array($multitime, $multiname)));
    }

    public function archives()
    {
	 if (Auth::user()->role === 'admin')
	 {
		setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8');
	 	$formation_archives = Formations::where('is_archive', 1)->get();
		$formationcategories = FormationCategories::all();
    	return view('formation.archives', compact('formation_archives', 'formationcategories'));
     }
     abort(404);
    }
    // récuperer une archive
    public function retrieve($id)
    {
	    if (Auth::user()->role === 'admin')
	    {
        $formation = Formations::findOrFail($id);
    	$formation->is_archive = 0;
    	$formation->is_model = 1;
    	$formation->update();
    	}
        return redirect('/formation/archives');
    }
    // récuperer une archive en mode formation multiple
    public function multiretrieve($id)
    {
        $formation_archive = Formations::findOrFail($id);
    	$multiname = explode (',' , $formation_archive->multiname);
    	$startdatearray = explode (',' , $formation_archive->startdatearray);
    	$enddatearray = explode (',' , $formation_archive->enddatearray);
    	$starttimearray = explode (',' , $formation_archive->starttimearray);
    	$endtimearray = explode (',' , $formation_archive->endtimearray);
   		return (json_encode(array($starttimearray, $endtimearray, $startdatearray, $enddatearray, $multiname)));
    }

    public function multireplan($id)
    {
        $formation = Formations::findOrFail($id);
    	$multiname = explode (',' , $formation->multiname);
    	$startdatearray = explode (',' , $formation->startdatearray);
    	$enddatearray = explode (',' , $formation->enddatearray);
    	$starttimearray = explode (',' , $formation->starttimearray);
    	$endtimearray = explode (',' , $formation->endtimearray);
   		return (json_encode(array($starttimearray, $endtimearray, $startdatearray, $enddatearray, $multiname)));
    }
}