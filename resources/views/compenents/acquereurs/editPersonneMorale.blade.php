<div class="card-body">
        @if (session('ok'))
       
        <div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                
                <strong> {{ session('ok') }}</strong>
        </div>
     @endif
                           
        <div class="form-validation">
            <form class="form-valide" action="{{ route('acquereurs.update',$acquereur->id) }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <input type="hidden" class="" value="personne_morale" name="type_acquereur">

    
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-info media-left media-middle">
                                    <i class="ti-info-alt f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Informations principales') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
                
            <div class="row">
                <div class="col-md-6 col-lg-6">
                        <fieldset> 
                                <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="forme_juridique">@lang('Forme juridique') <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="js-select2 form-control" id="forme_juridique" name="forme_juridique_pm" style="width: 100%;" data-placeholder="Choose one.." required>
                                                    
                                                        @if(isset($acquereur->forme_juridique))
                                                            <option value="{{$acquereur->forme_juridique}}" >{{$acquereur->forme_juridique}}</option>

                                                        @endif
                                                            <option value="" >Non défini</option>
                                                            <option value="Entreprise unipersonnelle à responsabilité limitée">Entreprise unipersonnelle à responsabilité limitée</option>
                                                            <option value="Entreprise individuelle">Entreprise individuelle</option>
                                                            <option value="Société à responsabilité limitée">Société à responsabilité limitée</option>
                                                            <option value="Société anonyme">Société anonyme</option>
                                                            <option value="Société par actions simplifiée">Société par actions simplifiée</option>
                                                            <option value="Société civile immobilière">Société civile immobilière</option>
                                                            <option value="Société en nom collectif">Société en nom collectif</option>
                                                            <option value="Entreprise agricole à responsabilité limitée">Entreprise agricole à responsabilité limitée</option>
                                                            <option value="Entreprise individuelle à responsabilité limitée">Entreprise individuelle à responsabilité limitée (01.01.2010)</option>
                                                            <option value="Groupement agricole d'exploitation en commun">Groupement agricole d'exploitation en commun</option>
                                                            <option value="Groupement européen d'intérêt économique">Groupement européen d'intérêt économique</option>
                                                            <option value="Groupement d'intérêt économique">Groupement d'intérêt économique</option>
                                                            <option value="Société par actions simplifiée unipersonnelle">Société par actions simplifiée unipersonnelle</option>
                                                            <option value="Société civile">Société civile</option>
                                                            <option value="Société en commandite par actions">Société en commandite par actions</option>
                                                            <option value="Société coopérative d'intérêt collectif">Société coopérative d'intérêt collectif</option>
                                                            <option value="Société civile de moyens">Société civile de moyens</option>
                                                            <option value="Société coopérative ouvrière de production">Société coopérative ouvrière de production</option>
                                                            <option value="Société civile professionnelle">Société civile professionnelle</option>
                                                            <option value="Société en commandite simple">Société en commandite simple</option>
                                                            <option value="Société d'exercice libéral">Société d'exercice libéral</option>
                                                            <option value="Société d'exercice libéral à forme anonyme">Société d'exercice libéral à forme anonyme</option>
                                                            <option value="Société d'exercice libéral à responsabilité limitée">Société d'exercice libéral à responsabilité limitée</option>
                                                            <option value="SELAS">Société d'exercice libéral par actions simplifiée</option>
                                                            <option value="Société d'exercice libéral par actions simplifiée">Société d'exercice libéral en commandite par actions</option>
                                                            <option value="Société d'économie mixte">Société d'économie mixte</option>
                                                            <option value="Société d'économie mixte locale">Société d'économie mixte locale</option>
                                                            <option value="Société en participation">Société en participation</option>
                                                            <option value="Société d'intérêt collectif agricole">Société d'intérêt collectif agricole</option>
                                                        
                                                        
                                                    </select>
                                                    @if ($errors->has('forme_juridique_pm'))
                                                        <br>
                                                        <div class="alert alert-warning ">
                                                            <strong>{{$errors->first('forme_juridique_pm')}}</strong> 
                                                        </div>
                                                        @endif
                                                    
                                                </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="raison_sociale">@lang('Raison sociale') <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{old('raison_sociale_pm') ? old('raison_sociale_pm') : $acquereur->raison_sociale }}" id="raison_sociale" name="raison_sociale_pm" placeholder="" required>
                                            @if ($errors->has('raison_sociale_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('raison_sociale_pm')}}</strong> 
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="telephone_fixe">@lang('Téléphone fixe') </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="{{old('telephone_fixe_pm')  ? old('telephone_fixe_pm') : $acquereur->telephone_fixe}}" id="telephone_fixe" name="telephone_fixe_pm" placeholder="Ex: 0600000000.." >
                                            @if ($errors->has('telephone_fixe_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('telephone_fixe_pm')}}</strong> 
                                                </div>
                                            @endif     
                                            
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="telephone_mobile">@lang('Téléphone mobile') </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="{{old('telephone_mobile_pm')  ? old('telephone_mobile_pm') : $acquereur->telephone_mobile}}" id="telephone_mobile" name="telephone_mobile_pm" placeholder="Ex: 0600000000.." >
                                            @if ($errors->has('telephone_mobile_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('telephone_mobile_pm')}}</strong> 
                                                </div>
                                            @endif     
                                            
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control " id="val-email" value="{{old('email_pm')  ? old('email_pm') : $acquereur->email}}" name="email_pm" placeholder="Email.." required>
                                                @if ($errors->has('email_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('email_pm')}}</strong> 
                                                </div>
                                                @endif
                                            </div>
                                                
                                    </div>

                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="adresse">Adresse </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control " value="{{old('adresse_pm')  ? old('adresse_pm') : $acquereur->adresse}}" id="adresse" name="adresse_pm" placeholder="N° et Rue.." >
                                            
                                                @if ($errors->has('adresse_pm'))
                                                    <br>
                                                    <div class="alert alert-warning ">
                                                        <strong>{{$errors->first('adresse_pm')}}</strong> 
                                                    </div>
                                                @endif   
                                            </div>
                                    </div>
            
                                                    
                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="code_postal">Code postal </label>
                                            <div class="col-lg-6">
                                            <input type="text" class="form-control" value="{{old('code_postal_pm')  ? old('code_postal_pm') : $acquereur->code_postal}}" id="code_postal" name="code_postal_pm" placeholder="Ex: 75001.." >
                                                
                                                @if ($errors->has('code_postal_pm'))
                                                    <br>
                                                    <div class="alert alert-warning ">
                                                        <strong>{{$errors->first('code_postal_pm')}}</strong> 
                                                    </div>
                                                @endif 
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="ville">Ville </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control " value="{{old('ville_pm')  ? old('ville_pm') : $acquereur->ville}}" id="ville" name="ville_pm" placeholder="EX: Paris.." >
                                            @if ($errors->has('ville_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('ville_pm')}}</strong> 
                                                </div>
                                            @endif 
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="pays">Pays </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control " value="{{old('pays_pm')  ? old('pays_pm') : $acquereur->pays}}" id="pays" name="pays_pm" placeholder="Entez une lettre et choisissez.." >
                                        @if ($errors->has('pays_pm'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('pays_pm')}}</strong> 
                                            </div>
                                        @endif 
                                        </div>
                                    </div>

                                   


                                </fieldset>
                </div>
    
            
                
                <div class="col-md-6 col-lg-6">
    
                        <fieldset>   
    
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="">@lang('Siret') </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="{{old('siret_pm')  ? old('siret_pm') : $acquereur->siret}}" id="siret" name="siret_pm" placeholder="" >
                                    @if ($errors->has('siret_pm'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('siret_pm')}}</strong> 
                                        </div>
                                    @endif 
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="source_contact">@lang('Source du contact') </label>
                                        <div class="col-lg-6">
                                            <select class="js-select2 form-control " id="source_contact" name="source_contact_pm" style="width: 100%;" data-placeholder="" >
                                            
                                                @if(isset($acquereur->source_contact))
                                                <option value="{{$acquereur->source_contact}}" >{{$acquereur->source_contact}}</option>

                                                @endif
                                                <option value="Recommandation / bouche à oreille">@lang('Recommandation / bouche à oreille') </option>
                                                <option value="Vitrine / Agence / Passage">@lang('Vitrine / Agence / Passage') </option>
                                                <option value="Presse papier">@lang('Presse papier') </option>
                                                <option value="Portails internet">@lang('Portails internet') </option>
                                                <option value="Autre">@lang('Autre') </option>
                                                
                                            </select>
                                            @if ($errors->has('source_contact_pm'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('source_contact_pm')}}</strong> 
                                                </div>
                                            @endif
                                                    
                                        </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="">@lang('Note') </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="note" name="note_pm"  rows="5" placeholder="" >{{old('note_pm') ? old('note_pm') : $acquereur->note}}</textarea>
                                        <span class="help-block">
                                        <small></small>
                                        </span>
                                    </div>
                                    @if($errors->has('note_pm'))
                                        <br>
                                        <br><br>
                                            <div class="alert alert-warning">
                                                <strong>{{$errors->first('note_pm')}}</strong> 
                                            </div> 
                                        <hr> 
                                        @endif
                                 </div>
                                
                        </fieldset>   
    
                </div>
            </div>
    
            <br>
            <br>
            <a id="btn_div_associer_contact" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Associer un contact')</a>
            <a id="btn_div_liste_contact" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5"><i class="ti-close"></i>@lang('Liste des associés')</a>
            
            <div id="div_associer_contact">

            
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-success media-left media-middle">
                                    <i class="ti-info-alt f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Associer un contact existant') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
            <div class="row">
                                    
                    
                    <div class="col-md-6 col-lg-6">
    
                        <fieldset>

                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="titre">@lang('Titre du contact') </label>
                                    <div class="col-lg-6">
                                        <select class="js-select2 form-control " id="titre" name="titre" style="width: 100%;" data-placeholder="" >
  
                                            <option value="">@lang('Aucun') </option>
                                            <option value="Directeur">@lang('Directeur') </option>
                                            <option value="Gérant">@lang('Gérant') </option>
                                            <option value="Associé">@lang('Associé') </option>
                                            
                                        </select>
                                                
                                    </div>
                            </div>
                    

                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="contact_associe">@lang('Contact') </label>
                                    <div class="col-lg-8">

                                        <select class="selectpicker col-lg-6" id="contact_associe" name="contact_associe" data-live-search="true" data-style="btn-warning" >
                                               
                                            @foreach($acquereur_non_associe as $acquereur_seul)
                                                <option  value="{{$acquereur_seul->id}}" data-tokens="{{$acquereur_seul->nom}} {{$acquereur_seul->prenom}}">{{$acquereur_seul->civilite}}  {{$acquereur_seul->nom}} {{$acquereur_seul->prenom}}</option>
                                                
                                            @endforeach
                                                
                                        </select>

                                        @if ($errors->has('contact_associe'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('contact_associe')}}</strong> 
                                            </div>
                                        @endif
                                        <a id="assoc"  class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Associer')</a>       
                                    </div>

                            </div>

                          
                                 
                            <div class="form-group row" id="liste_assoc">
                                             <!-- table -->
                          
            <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit !important;">
                        <table   class=" table student-data-table  m-t-20 "  style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('Titre du contact')</th>                                        
                                    <th>@lang('Nom du contact')</th>

                                  
                                </tr>
                            </thead>
                            <tbody id="tbodi">
                          
                          </tbody>
                        </table>
                    </div>
                </div>
            <!-- end table --> 
            <br><br>
                <div class="form-group">
                        <label class="col-sm-4 control-label" for="document_justificatif">@lang('Document justificatif')</label>
                       
                        <div class="col-sm-6" id="document_justificatif">
                         
                           <input class="form-control" id="document_justificatif"  name="document_justificatif" type="file" >
                           <span class="help-block">
                           <small>(Fichier: pdf, jpeg, png).</small>
                           </span>
                        
                        </div>

                        @if($errors->has('document_justificatif'))
                            <br>
                            <br><br>
                                <div class="alert alert-warning">
                                    <strong>{{$errors->first('document_justificatif')}}</strong> 
                                </div> 
                            <hr> 
                         @endif
                        
                </div>

                 
                            </div>
                        </fieldset>
    
                    </div>
                       
                    <fieldset>
                         
                      @lang('Ou')      <a id="add_new_contact" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Ajouter un nouveau contact')</a>

                    </fieldset>
    
        </div>

         {{-- ******************   Ajouter un nouveau contact  ********************* --}}
        <div class="row" id="add_contact_form">
               
                    
                        <input type="hidden" class="" value="personne_seule_nc" id="type_acquereur" name="type_acquereur_nc">
                
                        

                        <div class="row">
                                <div class="col-lg-8">
                                    <div class="card p-0">
                                        <div class="media">
                                            <div class="p-5 bg-default media-left media-middle">
                                                <i class="ti-info-alt f-s-28 color-white"></i>
                                            </div>
                                            <div class="p-10 media-body">
                                                <h4 class="color-warning m-r-10">@lang('Ajouter un nouveau contact') </h4>
                                                
                                                <div class="progress progress-sm m-t-10 m-b-0">
                                                    <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br>
                            
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                    <fieldset> 
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="titre_nc">@lang('Titre du contact') </label>
                                                    <div class="col-lg-6">
                                                        <select class="js-select2 form-control {{$errors->has('titre_nc') ? 'is-invalid' : ''}}" id="titre_nc" name="titre_nc" style="width: 100%;" data-placeholder="" >
                    
                                                            <option value="">@lang('Aucun') </option>
                                                            <option value="Directeur">@lang('Directeur') </option>
                                                            <option value="Gérant">@lang('Gérant') </option>
                                                            <option value="Associé">@lang('Associé') </option>
                                                            
                                                        </select>
                                                                
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label" for="civilite_nc">@lang('Civilité') <span class="text-danger">*</span></label>
                                                            <div class="col-lg-6">
                                                                <select class="js-select2 form-control {{$errors->has('civilite_nc') ? 'is-invalid' : ''}}" id="civilite_nc" name="civilite_nc" style="width: 100%;" data-placeholder="Choose one.." required>
                                                                
                                                                    
                                                                    <option value="Mr">@lang('M.') </option>
                                                                    <option value="Mme">@lang('Mlle.') </option>
                                                                    <option value="Mlle">@lang('Mlle.') </option>
                                                                    
                                                                </select>

                                                            </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="nom">Nom <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                    <input type="text" class="form-control" value="{{old('nom')}}" id="nom_nc" name="nom_nc" placeholder="Nom.." >
                                                    <br>
                                                    <div class="alert alert-warning " id="nom_error">
                                                        <strong>@lang('Le champ Nom est obligatoire')</strong> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="prenom_nc">Prénom </label>
                                                        <div class="col-lg-6">
                                                        <input type="text"  class="form-control " value="{{old('prenom_nc')}}" id="prenom_nc" name="prenom_nc" placeholder="Prénom.." >
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="adresse_nc">Adresse </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control" value="{{old('adresse_nc')}}" id="adresse_nc" name="adresse_nc" placeholder="N° et Rue.." >

                                                        </div>
                                                </div>
                        
                                                                
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="code_postal_nc">Code postal </label>
                                                        <div class="col-lg-6">
                                                        <input type="text" class="form-control " value="{{old('code_postal_nc')}}" id="code_postal_nc" name="code_postal_nc" placeholder="Ex: 75001.." >
                                                            
                                                            @if ($errors->has('code_postal_nc'))
                                                                <br>
                                                                <div class="alert alert-warning ">
                                                                    <strong>{{$errors->first('code_postal_nc')}}</strong> 
                                                                </div>
                                                            @endif 
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="ville_nc">Ville </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control " value="{{old('ville_nc')}}" id="ville_nc" name="ville_nc" placeholder="EX: Paris.." >
                                                       
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="pays_nc">Pays </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " value="{{old('pays_nc')}}" id="pays_nc" name="pays_nc" placeholder="Entez une lettre et choisissez.." >
                                                    
                                                    </div>
                                                </div>
                                                
                
                                                          
                                                                                                
                
                                            </fieldset>
                            </div>
                
                        
                            
                            <div class="col-md-6 col-lg-6">
                
                                    <fieldset>   
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="email_nc">Email <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control {{ $errors->has('email_nc') ? ' is-invalid' : '' }}" id="email_nc" value="{{old('email_nc')}}" name="email_nc" placeholder="Email.." >
                                                    <br>
                                                        <div class="alert alert-warning " id="email_error">
                                                            <strong>@lang('Le champ Email est obligatoire')</strong> 
                                                        </div>
                                                        <div class="alert alert-warning " id="email_existe_error">
                                                                <strong>@lang('cet email existe déja')</strong> 
                                                        </div>
                                                        
                                                </div>
                                                    
                                            </div>
                                            
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="telephone_mobile_nc">Téléphone mobile </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control {{ $errors->has('telephone_mobile_nc') ? ' is-invalid' : '' }}" value="{{old('telephone_mobile_nc')}}" id="telephone_mobile_nc" name="telephone_mobile_nc" placeholder="Ex: 0600000000.." >
                                                      
                                                    
                                                    </div>
                                            </div>
                
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="telephone_fixe_nc">Téléphone fixe </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control {{ $errors->has('telephone_fixe_nc') ? ' is-invalid' : '' }}" value="{{old('telephone_fixe_nc')}}" id="telephone_fixe_nc" name="telephone_fixe_nc" placeholder="Ex: 0600000000.." >
                                                   
                                                    </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="source_contact_nc">@lang('Source du Contact') </label>
                                                    <div class="col-lg-6">
                                                        <select class="js-select2 form-control "  id="source_contact_nc" name="source_contact_nc" style="width: 100%;" data-placeholder="" >
                                                        
                                                            
                                                            <option value="Recommandation / bouche à oreille">@lang('Recommandation / bouche à oreille') </option>
                                                            <option value="Vitrine / Agence / Passage">@lang('Vitrine / Agence / Passage') </option>
                                                            <option value="Presse papier">@lang('Presse papier') </option>
                                                            <option value="Portails internet">@lang('Portails internet') </option>
                                                            <option value="Autre">@lang('Autre') </option>
                                                            
                                                        </select>
                                                       
                                                            
                                                </div>
                                            </div>
                
                                            
                                        </fieldset>   
                
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <a  id="btn_ajouter_le_contact"  name="ajouterSeul" class="btn  btn-default">@lang('Ajouter le contact')</a>
                                    </div>
                                </div>                        
                            </div>   
                    </div>

                    
                        
                                
                    
                  

        </div>
        {{-- End div_contact_associer --}}

        <div id="div_liste_contact">

                <br>
                <br>
                {{-- table2 --}}
                <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-0">
                                <div class="media">
                                    <div class="p-5 bg-success media-left media-middle">
                                        <i class="ti-link  f-s-28 color-white"></i>
                                    </div>
                                    <div class="p-10 media-body">
                                        <h4 class="color-warning m-r-10">@lang('Les contacts associés') </h4>
                                        
                                        <div class="progress progress-sm m-t-10 m-b-0">
                                            <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <br>
                    <div class="card-body">
                            <div class="table-responsive" style="overflow-x: inherit !important;">
                                <table  id="example" class=" table student-data-table  m-t-20 "  style="width:70%">
                                    <thead>
                                        <tr>
                                            <th>@lang('Civilité')</th>                                        
                                            <th>@lang('Nom')</th>                                        
                                            <th>@lang('Email')</th>
                                            <th>@lang('titre du contact')</th>                                        

                                            <th>@lang('Dissocier')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($acquereur->acquereurs_associe as $associe)
                                        <tr>
                                            <td>
                                            {{$associe->civilite}}
                                            </td>
                                            <td>
                                            {{$associe->nom}} {{$associe->prenom}}
                                            </td>                                        
                                            <td>
                                            {{$associe->email}} 
                                            </td>
    
                                            <td>
                                            @if(isset($associe->pivot->titre_contact))
                                            {{$associe->pivot->titre_contact}}
                                            @else
                                             Aucun
                                            @endif
                                            </td>
                                                                                   
                            
                                            <td>
                                                <span><a  href="{{route('acquereurs.dissocier',[$acquereur->id, $associe->id])}}" class="dissocier" data-toggle="tooltip" title="@lang('Dissocier ') {{ $associe->nom }}"><i class="btn ti-close  color-danger"></i> </a></span>
                                            </td>
                                        </tr>
                                @endforeach
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- end table2 -->
        </div>
                    
       {{--**************************** Fin ajout un nouveau contact *************************--}}
                    
            </div>
        <br><br>
            <div class="row">
                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" id="ajouter" name="ajouterSeul" class="btn btn-lg btn-warning">@lang('Modifier')</button>
                    </div>
                </div>                        
            </div>   
                    
            </form>
        </div>
    </div>
    