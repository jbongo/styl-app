<div class="card-body">
        @if (session('ok'))
       
        <div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                
                <strong> {{ session('ok') }}</strong>
        </div>
     @endif
                           
        <div class="form-validation">
            <form class="form-valide" id="formgroupe" action="{{ route('acquereurs.add') }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <input type="hidden" class="" value="succession_personne" name="type_acquereur">
   
            <br>
            <br>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-info media-left media-middle">
                                    <i class="ti-info-alt f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-info m-r-10">@lang('Ajouter les membres') </h4>
                                    
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
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="nom_groupe">@lang('Nom du groupe ( ou succession)') <span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                    <input type="text" class="form-control" value="{{old('nom_groupe')}}" id="nom_groupe" name="nom_groupe" placeholder="Nom du groupe.." >
                    <br>
                    <div class="alert alert-warning " id="nom_groupe_error">
                        <strong>@lang('Le champ Nom du groupe est obligatoire')</strong> 
                    </div>
                    <div class="alert alert-warning " id="nomgroupe_existe_error">
                        <strong>@lang('cet nom existe déja')</strong> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                                    
                    
                    <div class="col-md-6 col-lg-6">
                            
    
                        <fieldset>
                    

                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="membre_succession">@lang('Selectionner un membre') </label>
                                    <div class="col-lg-8">

                                        <select class="selectpicker col-lg-6" id="membre_succession" name="membre_succession" data-live-search="true" data-style="btn-warning" >
                                               
                                            @foreach($acquereur_seuls as $acquereur_seul)
                                            
                                                <option  value="{{$acquereur_seul->id}}" mail="{{$acquereur_seul->email}}" data-tokens="{{$acquereur_seul->nom}} {{$acquereur_seul->prenom}}">{{$acquereur_seul->civilite}}  {{$acquereur_seul->nom}} {{$acquereur_seul->prenom}}</option>
                                                
                                            @endforeach
                                                
                                        </select>

                                        @if ($errors->has('membre_succession'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('membre_succession')}}</strong> 
                                            </div>
                                        @endif
                                        <a id="add_membre"  class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Ajouter')</a>       
                                    </div>

                            </div>

                          
                                 
                            <div class="form-group row" id="liste_membre">
                                             <!-- table -->
                          
            <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit !important;">
                        <table   class=" table student-data-table  m-t-20 "  style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('Nom du membre')</th>                                        
                                    <th>@lang('Email du membre')</th>

                                  
                                </tr>
                            </thead>
                            <tbody id="membre">
                          
                          </tbody>
                        </table>
                    </div>
                </div>
            <!-- end table --> 
            <br><br>
                

        
                </div>
            </fieldset>

                    </div>
                       
                    <fieldset>
                         
                      @lang('Ou')      <a id="add_new_contact_succession" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Ajouter un nouveau membre')</a>

                    </fieldset>
    
        </div>

         {{-- ******************   Ajouter un nouveau contact  ********************* --}}
        <div class="row" id="add_contact_form_succession">
               
                    
                        <input type="hidden" class="" value="personne_seule_succession" id="type_acquereur" name="type_acquereur_succession">
                
                        

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
                                                            <label class="col-lg-4 col-form-label" for="civilite_succession">@lang('Civilité') <span class="text-danger">*</span></label>
                                                            <div class="col-lg-6">
                                                                <select class="js-select2 form-control {{$errors->has('civilite_succession') ? 'is-invalid' : ''}}" id="civilite_succession" name="civilite_succession" style="width: 100%;" data-placeholder="Choose one.." required>
                                                                
                                                                    
                                                                    <option value="M.">@lang('M.') </option>
                                                                    <option value="Mme">@lang('Mme.') </option>
                                                                    <option value="Mlle">@lang('Mlle.') </option>
                                                                    
                                                                </select>

                                                            </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="nom">Nom <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                    <input type="text" class="form-control" value="{{old('nom')}}" id="nom_succession" name="nom_succession" placeholder="Nom.." >
                                                    <br>
                                                    <div class="alert alert-warning " id="nom_error_succession">
                                                        <strong>@lang('Le champ Nom est obligatoire')</strong> 
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="prenom_succession">Prénom </label>
                                                        <div class="col-lg-6">
                                                        <input type="text"  class="form-control " value="{{old('prenom_succession')}}" id="prenom_succession" name="prenom_succession" placeholder="Prénom.." >
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="adresse_succession">Adresse </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control" value="{{old('adresse_succession')}}" id="adresse_succession" name="adresse_succession" placeholder="N° et Rue.." >

                                                        </div>
                                                </div>
                        
                                                                
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="code_postal_succession">Code postal </label>
                                                        <div class="col-lg-6">
                                                        <input type="text" class="form-control " value="{{old('code_postal_succession')}}" id="code_postal_succession" name="code_postal_succession" placeholder="Ex: 75001.." >
                                                            
                                                            @if ($errors->has('code_postal_succession'))
                                                                <br>
                                                                <div class="alert alert-warning ">
                                                                    <strong>{{$errors->first('code_postal_succession')}}</strong> 
                                                                </div>
                                                            @endif 
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="ville_succession">Ville </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control " value="{{old('ville_succession')}}" id="ville_succession" name="ville_succession" placeholder="EX: Paris.." >
                                                       
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="pays_succession">Pays </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control " value="{{old('pays_succession')}}" id="pays_succession" name="pays_succession" placeholder="Entez une lettre et choisissez.." >
                                                    
                                                    </div>
                                                </div>
                                                
                
                                                          
                                                                                                
                
                                            </fieldset>
                            </div>
                
                        
                            
                            <div class="col-md-6 col-lg-6">
                
                                    <fieldset>   
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="email_succession">Email <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="email_succession" value="{{old('email_succession')}}" name="email_succession" placeholder="Email.." >
                                                    <br>
                                                        <div class="alert alert-warning " id="email_error_succession">
                                                            <strong>@lang('Le champ Email est obligatoire')</strong> 
                                                        </div>
                                                        <div class="alert alert-warning " id="email_existe_error_succession">
                                                                <strong>@lang('cet email existe déja')</strong> 
                                                        </div>
                                                        
                                                </div>
                                                    
                                            </div>
                                            
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="telephone_mobile_succession">Téléphone mobile </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" value="{{old('telephone_mobile_succession')}}" id="telephone_mobile_succession" name="telephone_mobile_succession" placeholder="Ex: 0600000000.." >
                                                      
                                                    
                                                    </div>
                                            </div>
                
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="telephone_fixe_succession">Téléphone fixe </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control {{ $errors->has('telephone_fixe_succession') ? ' is-invalid' : '' }}" value="{{old('telephone_fixe_succession')}}" id="telephone_fixe_succession" name="telephone_fixe_succession" placeholder="Ex: 0600000000.." >
                                                   
                                                    </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="source_contact_succession">@lang('Source du Contact') </label>
                                                    <div class="col-lg-6">
                                                        <select class="js-select2 form-control "  id="source_contact_succession" name="source_contact_succession" style="width: 100%;" data-placeholder="" >
                                                        
                                                            
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
                                    <a  id="btn_ajouter_le_contact_succession"  name="ajouterSeul" class="btn  btn-default">@lang('Ajouter le contact')</a>
                                </div>
                            </div>                        
                        </div>   

        </div>
                    
       {{--**************************** Fin ajout un nouveau contact *************************--}}
                    
            </div>
        <br><br>
            <div class="row">
                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" id="ajouter_membre" name="ajouterSeul" class="btn btn-lg btn-primary">Ajouter</button>
                    </div>
                </div>                        
            </div>   
                    
            </form>
        </div>
    </div>
    