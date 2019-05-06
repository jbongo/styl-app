<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/invoice', function(){
    return view('pdf.facture.fournisseur');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('/');
Route::get('/home', 'HomeController@index')
    ->name('home');

Route::middleware('notguestrestriction')->group(function ()
{
    /*/////////////guestusers routes not auth//////////////////*/
    Route::prefix('guestusers')->group(function ()
    {
        Route::get('/homevisiteurs', 'GuestUsersController@index')
            ->name('guestusers.home');
        Route::get('/guest/login', 'GuestsAuth\LoginController@showLoginForm')
            ->name('guestusers.login');
        Route::post('/guest/login', 'GuestsAuth\LoginController@login')
            ->name('guestusers.login.submit');
        Route::post('/guest/logout', 'GuestsAuth\LoginController@logout')
            ->name('guestusers.logout');
        Route::get('/guest/password/reset', 'GuestsAuth\ForgotPasswordController@showLinkRequestForm')
            ->name('guestusers.password.request');
        Route::post('/guest/password/email', 'GuestsAuth\ForgotPasswordController@sendResetLinkEmail')
            ->name('guestusers.password.email');
    });
    /*/////////////guestusers routes not auth end//////////////////*/
    
    /*/////////////guestusers routes auth//////////////////*/
    Route::prefix('guestusers')->middleware('auth:guestusers')->group(function ()
    {
        Route::name('guest.bien.index')->get('/bien/index', 'Guests\GestionBienController@index');
        Route::name('guest.affaire.index')->get('/affaire/index', 'Guests\GestionAffaireController@index');
        Route::name('guest.document.index')->get('/document/index', 'Guests\GestionDocumentController@index');
        Route::name('offre.accept')
            ->get('offreachat/accept/{id}', 'OffreAchatController@accept');
        Route::name('offre.reject')
            ->get('offreachat/reject/{id}', 'OffreAchatController@reject');
        Route::name('guest.offre.download')
            ->get('offreachat/download/{id}', 'OffreAchatController@download');
        
        ///////////////////////envoyer les documents////////////////////
        Route::name('guest.document.post')
            ->post('documents/post/{key}', 'Guests\GestionDocumentController@store');
        Route::name('guest.documentbien.post')
            ->post('documentsbien/post/{key}', 'Guests\GestionDocumentController@store_doc_bien');
        ///////////////////////envoyer les documents////////////////////
    });
    /*/////////////guestusers routes auth end//////////////////*/
});

// TESTS

  /************************************************************/
 /*    ROUTES POUR LA GESTION DES UTLISATEURS   //JP         */
/* **********************************************************                                                                 */
Route::middleware('auth')->group(function(){
  // profile d'un utilisateur
  Route::name('user.profile')->get('profile','Users\UsersController@profile');
  
    // modifier la photo de profile
    Route::name('user.photoProfile')->post('photo_profile','Users\UsersController@photoProfile');

    
    // Infos complemetaire mandataire, 
    Route::name('user.infoscompl')->get('infos_complementaire','Users\UsersController@infosComplementaires');
    Route::name('user.infoscompl')->post('infos_complementaire/{user}','Users\UsersController@addInfosComplementaires');
    /*avenant contrat*/ 
        
    /*avenant*/ 

    // Listes des notifications

    Route::name('notif.list')->get('list_notifs','Notifications\notifController@index');

    // Supprimer une notification

    Route::name('notif.delete')->get('notif/{notif}/delete','Notifications\notifController@delete');


    
    /************************************************************/
   /*             MODULE MANDANTS     //JP                     */
  /* **********************************************************/
        // Liste des mandants
        Route::name('mandants.index')->get('mandants','MandantController@index');    
        // formulaire d'ajout des mandants
        Route::name('mandant.add')->get('mandants/add','MandantController@create');
        // Ajout des mandant
        Route::name('mandants.add')->post('mandants','MandantController@store');
        // Details d'un mandant
        Route::name('mandant.show')->get('mandants/show/{mandant}', 'MandantController@show');
        // Affichage du formulaire de modification d'un mandant
        Route::name('mandants.edit')->get('mandants/{mandant}/edit','MandantController@edit');
        // Suppression d'un mandant
        Route::name('mandants.delete')->post('mandants/{mandant}/delete','MandantController@delete');
        // Modification d'un mandant
        Route::name('mandants.update')->post('mandants/{mandant}','MandantController@update');
        // Details d'un mandant
        Route::name('mandant.show')->get('mandant/show/{mandant}', 'MandantController@show');       
        // Dissocier un contact d'un mandant morale        
        Route::name('mandants.dissocier')->post('mandants/{mandant_morale}/{associe_id}/dissocier','MandantController@dissocier');
        
    //## supprimer un Goupe de mandants
         Route::name('groupemandant.delete')->post('groupemandant/{groupe}/delete','MandantController@deleteGroupe');
         // Modification d'un groupe de mandants
         Route::name('groupemandant.update')->post('groupemandant/{groupe}','MandantController@updateGroupe');
         // Affichage du formulaire de modification de mandants
         Route::name('groupemandant.edit')->get('groupemandant/{groupe}/edit','MandantController@editGroupe');
         // Retirer un membre d'un groupe de mandants       
         Route::name('mandants.retirer')->post('mandants/{groupe}/{membre_id}/retirer','MandantController@retirerMembre');
         // Details d'un groupe de mandants
         Route::name('groupemandant.show')->get('groupemandant/show/{groupe}', 'MandantController@showGroupe');
 



    /************************************************************/
   /*             MODULE ACQUEREURS     //JP                   */
  /* **********************************************************/ 
        // Liste des acquereurs
        Route::name('acquereurs.index')->get('acquereurs','AcquereurController@index');

        // affichage du formulaire d'ajout des acquereurs
        Route::name('acquereurs.add')->get('acquereurs/add','AcquereurController@create');
        // Ajout des acquereurs
        Route::name('acquereurs.add')->post('acquereurs/add','AcquereurController@store');
        // Suppression d'un acquereur
        Route::name('acquereurs.delete')->post('acquereurs/{acquereur}/delete','AcquereurController@delete');
        
        // Affichage du formulaire de modification d'un acquereur
        Route::name('acquereurs.edit')->get('acquereurs/{acquereur}/edit','AcquereurController@edit');

        // Modification d'un acquereur
        Route::name('acquereurs.update')->post('acquereurs/{acquereur}','AcquereurController@update');

        // Details d'un acquereur
        Route::name('acquereur.show')->get('acquereur/show/{acquereur}', 'AcquereurController@show');

        // Dissocier un contact d'un acquereur morale        
        Route::name('acquereurs.dissocier')->post('acquereurs/{acquereur_morale}/{associe_id}/dissocier','AcquereurController@dissocier');
        
        //## supprimer un Goupe d'acquereurs
        Route::name('groupeacquereur.delete')->post('groupeacquereur/{groupe}/delete','AcquereurController@deleteGroupe');
        // Modification d'un groupe d'acquereurs
        Route::name('groupeacquereur.update')->post('groupeacquereur/{groupe}','AcquereurController@updateGroupe');
        // Affichage du formulaire de modification d'un groupe acquereurs
        Route::name('groupeacquereur.edit')->get('groupeacquereur/{groupe}/edit','AcquereurController@editGroupe');
        // Retirer un membre d'un groupe d'acquereur       
        Route::name('acquereurs.retirer')->post('acquereurs/{groupe}/{membre_id}/retirer','AcquereurController@retirerMembre');
        // Details d'un groupe d'acquereurs
        Route::name('groupeacquereur.show')->get('groupeacquereur/show/{groupe}', 'AcquereurController@showGroupe');
        // Télechargement d'un document
        Route::name('acquereur.getDocument')->get('acquereur/document/{acquereur}','AcquereurController@getDocument');

        
    /************************************************************/
   /*             MODULE BIENS  //JP                           */
  /* **********************************************************/

        Route::name('bien.add')->get('bien/add','BienController@create');    
        Route::name('bien.store')->post('bien/store','BienController@store');    
        Route::name('bien.update')->post('bien/update/{bien}','BienController@update');    
        Route::name('bien.index')->get('bien/index','BienController@index');    
        Route::name('bien.show')->get('bien/show/{id}','BienController@show');    
        
        Route::get('/images-create/{bien_id}', 'BienController@uploadPhoto')->name('uptof');
        Route::post('/images-save/{visibilite}/{bien_id}', 'BienController@savePhoto')->name('savetof');
        //############ Les biens
        Route::name('bien.add')
            ->get('bien/add', 'BienController@create');
        Route::name('bien.store')
            ->post('bien/store', 'BienController@store');
        Route::name('bien.index')
            ->get('bien/index', 'BienController@index');
        Route::name('bien.show')
            ->get('bien/show/{id}', 'BienController@show');

        Route::get('/images-create/{bien_id}', 'BienController@uploadPhoto')
            ->name('uptof');
        Route::post('/images-save/{visibilite}/{bien_id}', 'BienController@savePhoto')
            ->name('savetof');
        Route::post('/images-delete', 'BienController@destroyPhoto');
        Route::get('/images-show', 'BienController@indexPhoto')->name('indextof');
        Route::get('/photo-delete/{id}', 'BienController@deletePhoto')->name('photoDelete');

        //Modifer les positions des photos du bien
        Route::post('/images-update', 'BienController@updatePhoto');
        // Télechargement d'une photo du bien
        Route::name('bien.getPhoto')->get('bien/photo/{photoBien}','BienController@getPhoto');
        // Impression des fiches du  bien
        Route::get('/imprime-fiche/{bien}/{typefiche}/{action}', 'BienController@impressionFiche')->name('imprimeFiche');
        //Obtenir la liste des passerelles d'un bien
        Route::get('/get-passerelles/{bien_id}', 'BienController@getPasserelles')->name('getPasserelles');

                
        // Route::get('/test', 'ExportController@exportLogicImmo')->name('test');


    /************************************************************/
   /*             MODULE PASSERELLES     //JP                  */
  /* **********************************************************/

      // Liste des Passerelles
    Route::name('passerelle.index')->get('passerelles','PasserelleController@index');
    //Formulaire d'ajout d'une passerelle
    Route::name('passerelle.add')->get('passerelles/add','PasserelleController@create');
    // Ajouter une passerelle
    Route::name('passerelle.add')->post('passerelles/add','PasserelleController@store');
    // Obtenir une passerelle
    Route::name('passerelle.get')->get('passerelle/{id}','PasserelleController@getPasserelle');
    // Supprimer une passerelle
    Route::name('passerelle.delete')->post('passerelle/delete/{passerelle}','PasserelleController@delete');
    // Formulaire de modification d'une passerelle
    Route::name('passerelle.edit')->get('passerelle/edit/{passerelle}','PasserelleController@edit');
    //Modification d'une passerelle
    Route::name('passerelle.update')->post('passerelle/update/{passerelle}','PasserelleController@update');
    //Modifier le statut d'une passerelle
    Route::name('passerelle.statut')->get('passerelle/statut/{passerelle}/{statut}','PasserelleController@statut');
    // Ascocier ou discocier des passerelles à un bien
    Route::name('passerelle.bien')->post('passerelle/attach/{bien}','PasserelleController@attach_passerelle_bien');
    
    
  /************************************************************/
 /*             MODULE DE DIFFUSION     //JP                 */
/* **********************************************************/

 //////########  Partie Diffusion automatique   ########/////////
    
    Route::name('diffusion_auto.index')->get('diffusion/auto/','DiffusionController@index_auto');
    Route::name('diffusion_auto.diffuser')->get('diffusion/auto/diffuser','DiffusionController@diffuser_auto');     
      
 //////*************  Fin Partie Diffusion automatique   *************/////////


 //////########  Partie Diffusion programmée   ########/////////
    
    Route::name('diffusion_prog.index')->get('diffusion/prog/','DiffusionProgController@index_prog');
    //Diffuser
    Route::name('diffusion_prog.diffuser')->post('diffusion/prog/diffuser','DiffusionProgController@diffuser_prog');
    // Afficher page création de diffusions
    Route::name('diffusion_prog.add')->get('diffusion/prog/create/{bien_id}','DiffusionProgController@create');
    //Affiche la page sur laquelle on choisit les date de diffusion et les annonces
    Route::name('diffusion_prog.date_annonce')->get('diffusion/prog/date_annonce/{passerelles}/{bien_id}','DiffusionProgController@date_annonce');
    //Affiche la liste de toutes les diffusions programmées d'un bien 
    Route::name('diffusion_prog.show')->get('diffusion/prog/show/{type}/{bien_id}','DiffusionProgController@listeDiffusion');
    // Supprimer une diffusions
    Route::name('diffusion_prog.delete')->post('diffusion/prog/delete/{diffusion}','DiffusionProgController@delete');

      
 //////**********  Fin Partie Diffusion automatique   **********/////////



 /*************************************************************/
 /*             MODULE DES ANNONCES       //JP               */
/* **********************************************************/

// Afficher la page d'ajout d'annonce
Route::name('annonce.create')->get('annonce/create/{bien_id}','AnnonceController@create');

// Ajouter une nouvelle annonce
Route::name('annonce.add')->post('annonce/add/','AnnonceController@store');

// Formulaire d'ajout de photos
Route::name('annonce.add_photo')->get('annonce/add/photos/{bien_id}/{annonce_id}','AnnonceController@uploadPhoto');

// Formulaire d'édition d'une annonce
Route::name('annonce.edit')->get('annonce/edit/{annonce_id}','AnnonceController@edit');

// Modifier une annonce
Route::name('annonce.update')->post('annonce/update/{annonce}','AnnonceController@update');

// Ajouter les photos de  l'annonce
Route::name('annonce.store_photo')->post('annonce/store/photos/{bien_id}/{annonce_id}','AnnonceController@storePhotos');

// Liste des annonces d'un bien
Route::name('annonce.index')->get('annonce/bien/{bien_id}','AnnonceController@index');



 
    ////////////belka////////////////
    Route::get('partners/add', function () {
        return view('partners.add');
    });
    Route::name('partners.add')->post('partners/add', 'PartnersController@store');
    Route::name('partners')->get('partners','PartnersController@index');
    //Route::name('partner.destroy')->delete('users/{user}','PartnerController@destroy');
    Route::name('partners.edit')->get('partners/{partner}/edit','PartnersController@edit');
    Route::name('partners.update')->post('partners/{partner}','PartnersController@update');
    /*Route::name('partner.show')->get('users/{user}','PartnerController@show');*/

    // Diffusion des biens  :romain: //
    Route::get('export/diffuse', function () {
        return view('export.diffuse');
    });
    Route::name('export.diffuse')->get('export/diffuse', 'ExportController@diffuse');
    Route::get('export/create', function () {
        return view('export.create');
    });
    Route::name('export.create')->get('export/create', 'ExportController@create');
    Route::get('export/which', function () {
        return view('export.export_which');
    });

    // Formation : romain

    Route::get('formation/', function () {
        return redirect('/formation/index');
    });
    Route::get('formation/portal', function () {
        return redirect('/formation/apply');
    });
    Route::get('formation/apply', function () {
        return view('formation.apply');
    });
    Route::get('formation/done', function () {
        return view('formation.done');
    });
    Route::get('formation/planification', function () {
        return redirect('/formation/plan');
    });
    Route::get('formation/plan', function () {
        return view('formation.plan');
    });
    Route::get('formation/doc', function () {
        return redirect('/formation/documents');
    });
    Route::get('formation/documents', function () {
        return view('formation.documents');
    });
    Route::get('formation/categories', function () {
        return redirect('/formation/cat');
    });
    Route::get('formation/cat', function () {
        return view('formation.cat');
    });
    Route::get('formation/index', function () {
        return view('formation.index');
    });
    Route::get('formation/archive', function () {
        return redirect('/formation/archives');
    });
    Route::get('formation/archives', function () {
        return view('formation.archives');
    });

    Route::name('formation.index')->get('formation/index', 'FormationController@index');
    Route::name('formation.cat')->get('formation/cat', 'FormationController@cat');
    Route::name('formation.plan')->get('formation/plan', 'FormationController@plan');
    Route::name('formation.apply')->get('formation/apply', 'FormationController@show');
    Route::name('formation.done')->get('formation/done', 'FormationController@done');
    Route::name('formation.documents')->get('formation/documents', 'FormationController@documents');
    Route::name('formation.delete')->get('formation/delete/{id}', 'FormationController@delete');
    Route::name('formation.store')->post('formation/create', 'FormationController@store');
    Route::name('formation.storeplan')->post('formation/create/storeplan', 'FormationController@storeplan');
    Route::name('formation.retrievestore')->post('formation/create/retrievestore', 'FormationController@retrievestore');
    Route::name('formation.model')->post('formation/model', 'FormationController@model');
    Route::name('formation.update')->post('formation/update', 'FormationController@update');
    Route::name('storage.formationDL')->get('formation/storage/formationDL/{id}/{role}', 'FormationController@download_pdf');
    Route::name('formation.upload')->post('formation/upload', 'FormationController@upload');
    Route::name('formation.catstore')->post('formation/cat/store', 'FormationController@catstore');
    Route::name('formation.catdelete')->get('formation/category/delete/{id}', 'FormationController@catdelete');
    Route::name('formation.register')->get('formation/register/{id}', 'FormationController@register');
    Route::name('formation.unsubscribe')->get('formation/unsubscribe/{id}', 'FormationController@unsubscribe');
    Route::name('formation.updateplan')->post('formation/update/plan', 'FormationController@updateplan');
    Route::name('formation.updatemodel')->post('formation/update/model', 'FormationController@updatemodel');
    Route::name('formation.catupdate')->post('formation/cat/update', 'FormationController@catupdate');
    Route::name('formation.uncat')->get('formation/uncat/{id}', 'FormationController@uncat');
    Route::name('formation.multi')->get('formation/plan/multi', 'FormationController@multi');
    Route::name('formation.archives')->get('formation/archives', 'FormationController@archives');
    Route::name('formation.retrieve')->get('formation/retrieve/{id}', 'FormationController@retrieve');
    Route::name('formation.multiretrieve')->get('formation/multiretrieve/{id}', 'FormationController@multiretrieve');
    Route::name('formation.multireplan')->get('formation/multireplan/{id}', 'FormationController@multireplan');



    /************************************************************/
   /*            ROUTES MODULE COMMISSIONS                     */
  /* **********************************************************/         



        Route::name('bien.getPhoto')
            ->get('bien/photo/{photoBien}', 'BienController@getPhoto');

        Route::get('/test', 'BienController@test')
            ->name('test');

        ////////////belka////////////////
        Route::get('partners/add', function ()
        {
            return view('partners.add');
        });
        Route::name('partners.add')
            ->post('partners/add', 'PartnersController@store');
        Route::name('partners')
            ->get('partners', 'PartnersController@index');
        //Route::name('partner.destroy')->delete('users/{user}','PartnerController@destroy');
        Route::name('partners.edit')
            ->get('partners/{partner}/edit', 'PartnersController@edit');
        Route::name('partners.update')
            ->post('partners/{partner}', 'PartnersController@update');
        /*Route::name('partner.show')->get('users/{user}','PartnerController@show');*/

        /************************************************************/
        /*            ROUTES MODULE COMMISSIONS                     */
        /* **********************************************************/

        /*rémunérationj directe */
        Route::get('commissions/direct', function () {
            return view('commissions.direct');
        })->name('direct');
        Route::name('direct.add')->post('commissions/direct/add', 'Commissions\DircommissionController@store');
        Route::name('direct.edit')->get('commissions/direct/edit/{direct}', 'Commissions\DircommissionController@edit');
        Route::name('direct.update')->post('commissions/direct/update/{direct}', 'Commissions\DircommissionController@update');
        Route::name('direct.delete')->put('commissions/direct/delete/{direct}', 'Commissions\DircommissionController@destroy');
        Route::name('direct.show')->get('commissions/direct/show/{direct}', 'Commissions\DircommissionController@show');
        /*pour generer des avenants*/
            Route::name('contrat.starter.edit')->get('commissions/direct/contract/starter/edit/{direct}', 'Commissions\DircommissionController@edit_user_starter');
            Route::name('contrat.expert.edit')->get('commissions/direct/contract/expert/edit/{direct}', 'Commissions\DircommissionController@edit_user_expert');
            Route::name('contrat.starter.update')->post('commissions/direct/contract/starter/update/{direct}', 'Commissions\DircommissionController@update_user_starter');
            Route::name('contrat.expert.update')->post('commissions/direct/contract/expert/update/{direct}', 'Commissions\DircommissionController@update_user_expert');
        /*avenant fin*/ 
        /*rémunération directe*/ 

        /*abonnement */
        Route::get('commissions/abonnement', function () {
            return view('commissions.abonnement');
        })->name('abonnement');

        Route::name('abonnement.add')->post('commissions/abonnement/add', 'Commissions\Abonnement@store');
        Route::name('abonnement.delete')->put('commissions/abonnement/delete/{abn}', 'Commissions\Abonnement@destroy');
        Route::name('abonnement.edit')->get('commissions/abonnement/edit/{abn}', 'Commissions\Abonnement@edit');
        Route::name('abonnement.update')->post('commissions/abonnement/update/{abn}', 'Commissions\Abonnement@update');
        /*generer des avenants*/
            Route::name('abonnement.contrat.edit')->get('commissions/abonnement/contrat/edit/{abn}', 'Commissions\Abonnement@edit_for_user');
            Route::name('abonnement.contrat.update')->post('commissions/abonnement/contrat/update/{abn}', 'Commissions\Abonnement@update_for_user');
        /*avenants fin*/ 
        /*abonnement */

        /*commissions dashboard*/
        Route::name('commissions')->get('commissions', 'Commissions\IndexCommissions@index');
        /*commissions dashboard*/ 

        /*parrainage*/ 
        Route::get('commissions/parrainage', function () {
            return view('commissions.parrainage');
        })->name('parrainage');
        Route::name('parrainage.add')->post('commissions/parrainage/add', 'Commissions\ParrainageController@store');
        Route::name('parrainage.delete')->put('commissions/parrainage/delete/{pln}', 'Commissions\ParrainageController@destroy');
        Route::name('parrainage.edit')->get('commissions/parrainage/edit/{pln}', 'Commissions\ParrainageController@edit');
        Route::name('parrainage.update')->post('commissions/parrainage/update/{pln}', 'Commissions\ParrainageController@update');
        Route::name('parrainage.show')->get('commissions/parrainage/show/{pln}', 'Commissions\ParrainageController@show');
        /*avenant contrats*/
            Route::name('parrainage.contrat.edit')->get('commissions/parrainage/contrat/edit/{pln}', 'Commissions\ParrainageController@edit_for_user');
            Route::name('parrainage.contrat.update')->post('commissions/parrainage/contrat/update/{pln}', 'Commissions\ParrainageController@update_for_user');
        /*avenant fin*/ 
        /*parrainage*/

        /************************************************************/
        /*            ROUTES MODULE CONTRATS                        */
        /* **********************************************************/
        Route::name('contrat.setting')
            ->get('contrats/setting', 'Contrats\Setting@index');
        Route::name('contrat.settingentreprise')
            ->post('contrats/setting/infosentreprise', 'Contrats\Setting@update_info_entreprise');
        Route::name('contrat.settingcommission')
            ->post('contrats/setting/commissions', 'Contrats\Setting@update_info_commissions');
        Route::name('contrat.index')
            ->get('contrats', 'Contrats\ContratController@index');
        Route::name('contrat.add')
            ->get('contrats/add/{id}', 'Contrats\ContratController@create');
        Route::name('contrat.store')
            ->post('contrats/store/{id}', 'Contrats\ContratController@store');
        Route::name('contrat.show')
            ->get('contrat/show/{id}', 'Contrats\ContratController@show');
        Route::name('contrat.user.edit')
            ->get('user/contrat/edit/{id}', 'Users\UsersController@avenant_edit');
        Route::name('contrat.user.update')
            ->post('user/contrat/update/{id}', 'Users\UsersController@avenant_update');
        Route::name('contrat.avenants')
            ->get('contrat/avenants/{id}', 'Contrats\ContratController@show_avenants');
        Route::name('contrat.getannex5')->get('contrat/annex5', function ()
        {
            return view('contrats.annex5');
        });
        Route::name('contrat.annex5')
            ->post('contrat/annex5/{id}', 'Contrats\ContratController@update_user_annex5');
        Route::name('contrat.download')
            ->get('download/{id}/{doc}', 'Contrats\ContratController@download_contrat');
        Route::name('avenant.download')
            ->get('avenant/get/{id}', 'Contrats\ContratController@download_avenant');
        Route::name('contrat.user.download')
            ->get('user/download/{id}/{doc}', 'Contrats\ContratController@user_download_contrat');
        Route::name('contrat.validation')
            ->get('contract/admin/validation/{id}', 'Contrats\ContratController@validation_rsac');

        Route::name('partners.fromnetwork')
            ->get('partners/fromnetwork', 'PartnersController@fromnetworkindex');
        Route::name('partners.addfromnetwork')
            ->post('partners/addfromnetwork/{single}', 'PartnersController@fromnetwork');
        /////////////////merge belka///////////////////////////////
        ///////////////Facturation/////////////////
        Route::name('facture.add')
            ->get('facture/add', 'FacturationController@create');
        Route::name('facture.store')
            ->post('facture/store', 'FacturationController@store');
        Route::name('facture')
            ->get('facture/index', 'FacturationController@index');
        Route::name('facture.download')
            ->get('facture/download/{id}', 'FacturationController@download');
        Route::name('facture.paid')
            ->put('facture/pending/{id}', 'FacturationController@pending');
        Route::name('facture.edit')
            ->get('facture/edit/{id}', 'FacturationController@edit');
        Route::name('facture.update')
            ->post('facture/avoir/{id}', 'FacturationController@avoir');
        ///////////////Facturation/////////////////
        ///////////////Notaires/////////////////
        Route::name('notaire')
            ->get('notaire/index', 'Notaires\NotaireController@index');
        Route::name('notaire.add')
            ->get('notaire/add', 'Notaires\NotaireController@create');
        Route::name('notaire.store')
            ->post('notaire/store', 'Notaires\NotaireController@store');
        Route::name('notaire.show')
            ->get('notaire/show/{id}', 'Notaires\NotaireController@show');
        Route::name('notaire.edit')
            ->get('notaire/edit/{id}', 'Notaires\NotaireController@edit_notaire');
        Route::name('notaire.update')
            ->post('notaire/update/{id}', 'Notaires\NotaireController@update_notaire');
        Route::name('notaire.archive')
            ->put('notaire/archive/{id}', 'Notaires\NotaireController@archive');
        Route::name('notaire.cut')
            ->get('notaire/cut/{id}', 'Notaires\NotaireController@disassociate');
        Route::name('notaireassocie.store')
            ->post('notaire/associe/store', 'Notaires\NotaireController@store_associe');
        Route::name('notaire.import')
            ->post('notaire/import', 'Notaires\NotaireController@json_import');
        Route::name('notaire.associate')
            ->post('notaire/associate/{id}', 'Notaires\NotaireController@associate');
        Route::name('notaire.archivesolo')
            ->get('notaire/archive/{id}', 'Notaires\NotaireController@archive_notaire');
        Route::name('notaire.archiveetude')
            ->get('notaire/archive/etude/{id}', 'Notaires\NotaireController@archive_etude');
        Route::name('notaire.updateetude')
            ->post('notaire/update/etude/{id}', 'Notaires\NotaireController@update_etude');
        ///////////////Notaires/////////////////

        ///////////////Mandats//////////////////
        Route::name('mandat')
            ->get('mandat/index', 'Mandats\MandatsController@index');
        Route::name('mandat.add')
            ->get('mandat/add', 'Mandats\MandatsController@create');
        Route::name('mandat.cancel')
            ->post('mandat/cancel/{id}', 'Mandats\MandatsController@cancel_mandat');
        Route::name('mandat.store')
            ->post('mandat/store', 'Mandats\MandatsController@store');
        Route::name('mandat.extend')
            ->post('mandat/extend/{id}', 'Mandats\MandatsController@prolongation');
        Route::name('mandat.show')
            ->get('mandat/show/{id}', 'Mandats\MandatsController@show');
        ///////////////Mandats///////////////////

        ///////////////Appels///////////
        Route::name('appels.add')
            ->post('appel/add/{id}', 'AppelController@store');
        Route::name('appels.destroy')
            ->get('appel/destroy/{id}', 'AppelController@destroy');
        ///////////////Appels///////////

        ///////////////Visites du bien///////////
        Route::name('visites.add')
            ->post('visite/add/{id}', 'VisitesController@store');
        Route::name('visites.destroy')
            ->get('visite/destroy/{id}', 'VisitesController@destroy');
        ///////////////Visites du bien///////////

        //////////////Offres achat///////////////
        Route::name('offre.add')
            ->post('offreachat/add/{bien}/{mandat}', 'OffreAchatController@store');
        Route::name('offre.download')
            ->get('offreachat/download/{id}', 'OffreAchatController@download');
        //////////////Offres achat///////////////

        //////////////parametres gestion affaire uniquement admin///////////////
        Route::name('params.affaire.index')
            ->get('affaire/parametres/index', 'Parametres\ParamAffaireController@index');
        Route::name('params.affaire.removedoc')
            ->get('affaire/parametres/documents/drop/{id}', 'Parametres\ParamAffaireController@dropdoc');
        Route::name('params.affaire.doc')
            ->post('affaire/parametres/documents/store', 'Parametres\ParamAffaireController@store_doc');
        Route::name('params.affaire.other')
            ->post('affaire/parametres/other/store', 'Parametres\ParamAffaireController@store_params');
        //////////////parametres gestion affaire fin///////////////

        //////////////definir les documents///////////////
        Route::name('affaire.docmdn.store')
            ->post('affaire/documents/mandant/store/{dossier}', 'DossierVenteController@store_doc_mandant');
        Route::name('affaire.docbn.store')
            ->post('affaire/documents/bien/store/{dossier}', 'DossierVenteController@store_doc_bien');
        Route::name('affaire.docacq.store')
            ->post('affaire/documents/acquereur/store/{dossier}', 'DossierVenteController@store_doc_acquereur');
        //////////////definir les documents///////////////

        //////////////accepter et rejeter par le mandataire//////////////////
        Route::name('affaire.doc.accept')
            ->get('affaire/documents/accept/{dossier}/{key}/{role}', 'DossierVenteController@accept_doc');
        Route::name('affaire.doc.reject')
            ->get('affaire/documents/reject/{dossier}/{key}/{role}', 'DossierVenteController@reject_doc');
        //////////////accepter et rejeter par le mandataire//////////////////

        //////////////associer les notaires du mandant et de l'acquéreur//////////////////
        Route::name('dossier.notairemdn')
            ->post('dossier/notairemdn/store/{dossier}', 'DossierVenteController@notaire_mandant');
        Route::name('dossier.notaireacq')
            ->post('dossier/notaireacq/store/{dossier}', 'DossierVenteController@notaire_acquereur');
        //////////////associer les notaires du mandant et de l'acquéreur//////////////////

        //////////////rendez-vous compromis et acte//////////////////
        Route::name('rdv.compromis')
            ->post('dossier/rdv/compromis/store/{dossier}', 'DossierVenteController@rdv_compromis');
        Route::name('rdv.acte')
            ->post('dossier/rdv/acte/store/{dossier}', 'DossierVenteController@rdv_acte');
        Route::name('rdv.compromis.confirm')
            ->get('dossier/rdv/compromis/confirm/{dossier}', 'DossierVenteController@confirm_compromis');
        Route::name('rdv.acte.confirm')
            ->get('dossier/rdv/acte/confirm/{dossier}', 'DossierVenteController@confirm_acte');
        Route::name('rdv.compromis.reject')
            ->get('dossier/rdv/compromis/reject/{dossier}', 'DossierVenteController@reject_compromis');
        Route::name('rdv.acte.reject')
            ->get('dossier/rdv/acte/reject/{dossier}', 'DossierVenteController@reject_acte');
        //////////////rendez-vous compromis et acte//////////////////

        //////////////facture stylimmo//////////////////
        Route::name('acte.facture.make')
            ->get('dossier/rdv/acte/facture/generer/{dossier}', 'DossierVenteController@facture_stylimmo');
        //////////////facture stylimmo//////////////////

        //////////////recrutement et qualification des leads//////////////////
        Route::name('lead.index')
            ->get('recrutements/lead/index', 'RecrutementController@index');
        Route::name('lead.add')
            ->post('recrutements/lead/add', 'RecrutementController@store_lead');
        Route::name('lead.show')
            ->get('recrutements/lead/show/{id}', 'RecrutementController@show_lead');
        Route::name('lead.update')
            ->post('recrutements/lead/update/{id}', 'RecrutementController@update_lead');
        Route::name('lead.delete')
            ->get('recrutements/lead/delete/{id}', 'RecrutementController@destroy_lead');
        Route::name('canal.add')
            ->post('recrutements/canal/add', 'RecrutementController@store_canal');
        Route::name('canal.show')
            ->get('recrutements/canal/show/{id}', 'RecrutementController@show_canal');
        Route::name('suivi.add')
            ->post('recrutements/suiviprospect/add', 'RecrutementController@store_suivi');
        Route::name('suivi.validate')
            ->get('recrutements/suiviprospect/task/validate/{action}/{id}', 'RecrutementController@confirm_suivi');
        Route::name('lead.validate')
            ->get('recrutements/lead/recrute/validate/{id}', 'RecrutementController@hire');
        //////////////recrutement et qualification des leads//////////////////
        
    });

Route::middleware('admin')->group(function(){
    
    Route::get('users/add', function () {
        return view('users.add');
    });

    // ajout d'un utilisateur
    Route::name('users.add')->post('users/add', 'Users\UsersController@store');

    // Liste des utilisateurs
    Route::name('users')->get('users','Users\UsersController@index');

    // Suppression d'un utilisateur users/{user} user represente le parmètre de destroy
    // Route::name('user.destroy')->delete('users/{user}','Users\UsersController@destroy');

    
    
    // page de Modification d'un utilisateur
    Route::name('user.edit')->get('users/{user}/edit','Users\UsersController@edit');
    
    // Modification d'un utilisateur
    Route::name('user.update')->put('users/{user}','Users\UsersController@update');
  
    // Détails d'un utilisateur
    Route::name('user.show')->get('users/{user}','Users\UsersController@show');

    
    // Archiver un utilisateur ou restaurer un utlisateur arch = 1 ou 0 
    Route::name('user.archive')->put('users/{user}/archive/{arch}','Users\UsersController@archive');
    // Liste des utilisateurs archivés
    Route::name('users.archive')->get('users_archives','Users\UsersController@archiveListe');

    // paramètre des utlisateurs
    Route::name('users.params')->get('users_parametres','Users\UsersController@parametres');
// });

    Route::name('users.roleUpdate')->get('role_update/{id}','Users\UsersController@getRoleUpdate');
    Route::name('users.roleUpdate')->patch('role_update/{user}','Users\UsersController@setRoleUpdate');


    // envoi de mail à l'utilisateur pour completer son profil
    Route::name('user.sendmailProfil')->get('sendmailProfil/{user}','Users\UsersController@sendmailProfil');

    //téléchargement des documents de l'utilisateur
    Route::name('user.getDocument')->get('getDocument/{user}/{type_document}','Users\UsersController@getDocument');
    
    });

  /************************************************************/
 /*    FIN GESTION UTILISATEURS                              */
/* **********************************************************/  
