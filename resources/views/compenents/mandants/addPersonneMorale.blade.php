<div class="card-body">
        @if (session('ok'))
       
        <div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                
                <strong> {{ session('ok') }}</strong>
        </div>
     @endif
                           
        <div class="form-validation">
            <form class="form-valide" action="{{ route('mandants.add') }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <input type="hidden" class="" value="personne_morale" name="type_mandant">

    
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
                                                    
                                                            <option value="" selected="selected">Non défini</option>
                                                            <option value="EURL">Entreprise unipersonnelle à responsabilité limitée</option>
                                                            <option value="EI">Entreprise individuelle</option>
                                                            <option value="SARL">Société à responsabilité limitée</option>
                                                            <option value="SA">Société anonyme</option>
                                                            <option value="SAS">Société par actions simplifiée</option>
                                                            <option value="SCI">Société civile immobilière</option>
                                                            <option value="SNC">Société en nom collectif</option>
                                                            <option value="EARL">Entreprise agricole à responsabilité limitée</option>
                                                            <option value="EIRL">Entreprise individuelle à responsabilité limitée (01.01.2010)</option>
                                                            <option value="GAEC">Groupement agricole d'exploitation en commun</option>
                                                            <option value="GEIE">Groupement européen d'intérêt économique</option>
                                                            <option value="GIE">Groupement d'intérêt économique</option>
                                                            <option value="SASU">Société par actions simplifiée unipersonnelle</option>
                                                            <option value="SC">Société civile</option>
                                                            <option value="SCA">Société en commandite par actions</option>
                                                            <option value="SCIC">Société coopérative d'intérêt collectif</option>
                                                            <option value="SCM">Société civile de moyens</option>
                                                            <option value="SCOP">Société coopérative ouvrière de production</option>
                                                            <option value="SCP">Société civile professionnelle</option>
                                                            <option value="SCS">Société en commandite simple</option>
                                                            <option value="SEL">Société d'exercice libéral</option>
                                                            <option value="SELAFA">Société d'exercice libéral à forme anonyme</option>
                                                            <option value="SELARL">Société d'exercice libéral à responsabilité limitée</option>
                                                            <option value="SELAS">Société d'exercice libéral par actions simplifiée</option>
                                                            <option value="SELCA">Société d'exercice libéral en commandite par actions</option>
                                                            <option value="SEM">Société d'économie mixte</option>
                                                            <option value="SEML">Société d'économie mixte locale</option>
                                                            <option value="SEP">Société en participation</option>
                                                            <option value="SICA">Société d'intérêt collectif agricole</option>
                                                        
                                                        
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
                                        <input type="text" class="form-control {{$errors->has('raison_sociale') ? 'is-invalid' : ''}}" value="{{old('raison_sociale_pm')}}" id="raison_sociale" name="raison_sociale_pm" placeholder="" required>
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
                                                <input type="text" class="form-control {{ $errors->has('telephone_fixe') ? ' is-invalid' : '' }}" value="{{old('telephone_fixe_pm')}}" id="telephone_fixe" name="telephone_fixe_pm" placeholder="Ex: 0600000000.." >
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
                                                <input type="text" class="form-control {{ $errors->has('telephone_mobile') ? ' is-invalid' : '' }}" value="{{old('telephone_mobile_pm')}}" id="telephone_mobile" name="telephone_mobile_pm" placeholder="Ex: 0600000000.." >
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
                                                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="val-email" value="{{old('email_pm')}}" name="email_pm" placeholder="Email.." required>
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
                                                <input type="text" class="form-control {{ $errors->has('adresse') ? ' is-invalid' : '' }}" value="{{old('adresse_pm')}}" id="adresse" name="adresse_pm" placeholder="N° et Rue.." >
                                            
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
                                            <input type="text" class="form-control {{ $errors->has('code_postal') ? ' is-invalid' : '' }}" value="{{old('code_postal_pm')}}" id="code_postal" name="code_postal_pm" placeholder="Ex: 75001.." >
                                                
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
                                                <input type="text" class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" value="{{old('ville_pm')}}" id="ville" name="ville_pm" placeholder="EX: Paris.." >
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
                                            <input type="text" class="form-control {{ $errors->has('pays') ? ' is-invalid' : '' }}" value="{{old('pays_pm')}}" id="pays" name="pays_pm" placeholder="Entez une lettre et choisissez.." >
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
                                        <input type="text" class="form-control {{ $errors->has('siret') ? ' is-invalid' : '' }}" value="{{old('siret_pm')}}" id="siret" name="siret_pm" placeholder="" >
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
                                            <select class="js-select2 form-control {{$errors->has('source_contact') ? 'is-invalid' : ''}}" id="source_contact" name="source_contact_pm" style="width: 100%;" data-placeholder="" >
                                            
                                                
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
                                        <textarea class="form-control" id="note" name="note_pm"  rows="5" placeholder="" >{{old('note_pm') ? old('note_pm') : ""}}</textarea>
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
                                        <select class="js-select2 form-control {{$errors->has('titre') ? 'is-invalid' : ''}}" id="titre" name="titre" style="width: 100%;" data-placeholder="" >
  
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
                                               
                                            @foreach($mandant_seuls as $mandant_seul)
                                            
                                                <option  value="{{$mandant_seul->id}}" data-tokens="{{$mandant_seul->nom}} {{$mandant_seul->prenom}}">{{$mandant_seul->civilite}}  {{$mandant_seul->nom}} {{$mandant_seul->prenom}}</option>
                                                
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
                            <tbody>
                          
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
               
                    
                        <input type="hidden" class="" value="personne_seule_nc" id="type_mandant" name="type_mandant_nc">
                
                        

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
                    
       {{--**************************** Fin ajout un nouveau contact *************************--}}
                    
     
        <br><br>
            <div class="row">
                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" id="ajouter" name="ajouterSeul" class="btn btn-lg btn-primary">Ajouter</button>
                    </div>
                </div>                        
            </div>   
                    
            </form>
        </div>
    </div>
    