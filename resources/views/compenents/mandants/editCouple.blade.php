<div class="card-body">
                           
        <div class="form-validation">
        <form class="form-valide" action="{{ route('mandants.update',$mandant->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" class="" value="couple" name="type_mandant">
    
    
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
            <div class="col-md-5" style="background:#aedeee;">
                @lang('Partenaire 1')
            </div>
            <div class="col-md-5 col-md-offset-1" style="background-color:#aedeee">
                    <div class="col-md-6" >
                            @lang('Partenaire 2')
                    </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                    <fieldset> 
                            <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="civilite1">@lang('Civilité') <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="js-select2 form-control {{$errors->has('civilite1') ? 'is-invalid' : ''}}" id="civilite1" name="civilite1" style="width: 100%;" data-placeholder="Choose one.." required>
                                                
                                                   @if(isset($mandant->civilite))
                                                    <option value="{{$mandant->civilite}}">{{$mandant->civilite}}</option>
                                                   @endif
                                                    <option value="Mr">@lang('M.') </option>
                                                    <option value="Mme">@lang('Mme.') </option>
                                                    <option value="Mlle">@lang('Mlle.') </option>
                                                   
                                                </select>
                                                @if ($errors->has('civilite1'))
                                                    <br>
                                                    <div class="alert alert-warning ">
                                                        <strong>{{$errors->first('civilite1')}}</strong> 
                                                    </div>
                                                 @endif
                                                
                                            </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nom1">Nom <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                    <input type="text" class="form-control {{$errors->has('nom1') ? 'is-invalid' : ''}}" value="{{old('nom1') ? old('nom1') : $mandant->nom }}" id="nom1" name="nom1" placeholder="Nom.." required>
                                        @if ($errors->has('nom1'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('nom1')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="prenom1">Prénom </label>
                                        <div class="col-lg-6">
                                        <input type="text"  class="form-control {{ $errors->has('prenom1') ? ' is-invalid' : '' }}" value="{{old('prenom1') ? old('prenom1') : $mandant->prenom}}" id="prenom1" name="prenom1" placeholder="Prénom.." >
                                        @if ($errors->has('prenom1'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('prenom')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="categorie1">@lang('Catégorie') </label>
                                        <div class="col-lg-6">
                                        <input type="text"  class="form-control {{ $errors->has('categorie1') ? ' is-invalid' : '' }}" value="{{old('categorie1') ? old('categorie1') : $mandant->categorie }}" id="categorie1" name="categorie1" placeholder="VIP ect." >
                                        @if ($errors->has('categorie1'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('categorie1')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="email1">Email <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control {{ $errors->has('email1') ? ' is-invalid' : '' }}" id="email1" value="{{old('email1') ? old('email1') : $mandant->email}}" name="email1" placeholder="Email.." required>
                                            @if ($errors->has('email1'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('email1')}}</strong> 
                                            </div>
                                            @endif
                                        </div>
                                          
                                    </div>
                                    
                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="telephone_fixe1">Téléphone fixe </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control " value="{{old('telephone_fixe1') ? old('telephone_fixe1') : $mandant->telephone_fixe}}" id="telephone_fixe1" name="telephone_fixe1" placeholder="Ex: 0600000000.." >
                                            @if ($errors->has('telephone_fixe1'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('telephone_fixe1')}}</strong> 
                                                </div>
                                            @endif     
                                            
                                            </div>
                                    </div>
    
                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="telephone_mobile1">Téléphone mobile </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" value="{{old('telephone_mobile1') ? old('telephone_mobile1') : $mandant->telephone_mobile}}" id="telephone_mobile1" name="telephone_mobile1" placeholder="Ex: 0600000000.." >
                                            @if ($errors->has('telephone_mobile1'))
                                                <br>
                                                <div class="alert alert-warning ">
                                                    <strong>{{$errors->first('telephone_mobile1')}}</strong> 
                                                </div>
                                            @endif     
                                            
                                            </div>
                                    </div>
    
                                                                              
    
                            </fieldset>
    
    
            </div>
    
        
            
            <div class="col-md-6 col-lg-6">
    
                    <fieldset>   
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="civilite2">@lang('Civilité') <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="js-select2 form-control {{$errors->has('civilite2') ? 'is-invalid' : ''}}" id="civilite2" name="civilite2" style="width: 100%;" data-placeholder="Choose one.." required>
                                        
                                            @if(isset($mandant->civilite_partenaire))
                                                <option value="{{$mandant->civilite_partenaire}}">{{$mandant->civilite_partenaire}}</option>
                                            @endif
                                            <option value="Mr">@lang('M.') </option>
                                            <option value="Mme">@lang('Mme.') </option>
                                            <option value="Mlle">@lang('Mlle.') </option>
                                           
                                        </select>
                                        @if ($errors->has('civilite2'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('civilite2')}}</strong> 
                                            </div>
                                         @endif
                                        
                                    </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nom2">Nom <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <input type="text" class="form-control " value="{{old('nom2') ? old('nom2') : $mandant->nom_partenaire}}" id="nom2" name="nom2" placeholder="Nom.." required>
                                @if ($errors->has('nom2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('nom2')}}</strong> 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="prenom2">Prénom </label>
                                <div class="col-lg-6">
                                <input type="text"  class="form-control" value="{{old('prenom2') ? old('prenom2') : $mandant->prenom_partenaire}}" id="prenom2" name="prenom2" placeholder="Prénom.." >
                                @if ($errors->has('prenom2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('prenom2')}}</strong> 
                                    </div>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="telephone_fixe2">Téléphone fixe </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control " value="{{old('telephone_fixe2')? old('telephone_fixe2') : $mandant->telephone_fixe_partenaire}}" id="telephone_fixe2" name="telephone_fixe2" placeholder="Ex: 0600000000.." >
                                @if ($errors->has('telephone_fixe2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('telephone_fixe2')}}</strong> 
                                    </div>
                                @endif     
                                
                                </div>
                        </div>
    
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="telephone_mobile2">Téléphone mobile </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" value="{{old('telephone_mobile2') ? old('telephone_mobile2') : $mandant->telephone_mobile_partenaire}}" id="telephone_mobile2" name="telephone_mobile2" placeholder="Ex: 0600000000.." >
                                @if ($errors->has('telephone_mobile2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('telephone_mobile2')}}</strong> 
                                    </div>
                                @endif     
                                
                                </div>
                        </div>
                       
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="email2">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="email2" value="{{old('email2')  ? old('email2') : $mandant->email_partenaire}}" name="email2" placeholder="Email.." required>
                                    @if ($errors->has('email2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('email2')}}</strong> 
                                    </div>
                                    @endif
                                </div>
                                  
                            </div>
                            
                    </fieldset>   
    
            </div>
        </div>
    
        <div class="row">
                <div class="col-md-6 col-lg-12">
    
                    <fieldset>   
    
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="source_contact">@lang('Source du contact') </label>
                                    <div class="col-lg-6">
                                        <select class="js-select2 form-control {{$errors->has('source_contact') ? 'is-invalid' : ''}}" id="source_contact" name="source_contact" style="width: 100%;" data-placeholder="" >
                                        
                                            @if(isset($mandant->source_contact))
                                                <option value="{{$mandant->source_contact}}">{{$mandant->source_contact}}</option>
                                            @endif
                                            <option value="Recommandation / bouche à oreille">@lang('Recommandation / bouche à oreille') </option>
                                            <option value="Vitrine / Agence / Passage">@lang('Vitrine / Agence / Passage') </option>
                                            <option value="Presse papier">@lang('Presse papier') </option>
                                            <option value="Portails internet">@lang('Portails internet') </option>
                                            <option value="Autre">@lang('Autre') </option>
                                            
                                        </select>
                                        @if ($errors->has('source_contact'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('source_contact')}}</strong> 
                                            </div>
                                            @endif
                                            
                                    </div>
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
                                <h4 class="color-warning m-r-10">@lang('Informations complémentaires (utiles pour générer des documents et des statistiques)') </h4>
                                
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
                                <label class="col-lg-4 col-form-label" for="adresse1">Adresse </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control " value="{{old('adresse1') ? old('adresse1') : $mandant->adresse}}" id="adresse1" name="adresse1" placeholder="N° et Rue.." >
                                
                                    @if ($errors->has('adresse1'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('adresse1')}}</strong> 
                                        </div>
                                    @endif   
                                </div>
                        </div>
    
                                        
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="code_postal1">Code postal </label>
                                <div class="col-lg-6">
                                <input type="text" class="form-control " value="{{old('code_postal1') ? old('code_postal1') : $mandant->code_postal}}" id="code_postal1" name="code_postal1" placeholder="Ex: 75001.." >
                                   
                                    @if ($errors->has('code_postal1'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('code_postal1')}}</strong> 
                                        </div>
                                    @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="ville1">Ville </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" value="{{old('ville1') ? old('ville1') : $mandant->ville}}" id="ville1" name="ville1" placeholder="EX: Paris.." >
                                @if ($errors->has('ville1'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('ville1')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="pays1">Pays </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control " value="{{old('pays1') ? old('pays1') : $mandant->pays}}" id="pays1" name="pays1" placeholder="Entez une lettre et choisissez.." >
                            @if ($errors->has('pays1'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('pays1')}}</strong> 
                                </div>
                            @endif 
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="date_naissance1">@lang('Date de naissance')</label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" value="{{old('date_naissance1') ? old('date_naissance1') : $mandant->date_naissance }}" id="date_naissance1" name="date_naissance1"  >
                                @if ($errors->has('date_naissance1'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('date_naissance1')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="lieu_naissance1">Lieu de naissance </label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control " value="{{old('lieu_naissance1') ? old('lieu_naissance1') : $mandant->lieu_naissance }}" id="lieu_naissance1" name="lieu_naissance1" placeholder="EX: Paris.." >
                                @if ($errors->has('lieu_naissance1'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('lieu_naissance1')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
    
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="langue1">@lang('Langue') </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control " value="{{old('langue1') ? old('langue1') : $mandant->langue }}" id="langue1" name="langue1" placeholder="EX: Français.." >
                                @if ($errors->has('langue1'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('langue1')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-lg-4 col-form-label" for="note1">@lang('Note') </label>
                                <div class="col-lg-6">
                                   <textarea class="form-control" id="note1" name="note1"  rows="3" placeholder="" >{{old('note1') ? old('note1') : $mandant->note}}</textarea>
                                   <span class="help-block">
                                   <small></small>
                                   </span>
                                </div>
                                @if($errors->has('note1'))
                                    <br>
                                    <br><br>
                                        <div class="alert alert-warning">
                                            <strong>{{$errors->first('note1')}}</strong> 
                                        </div> 
                                    <hr> 
                                 @endif
                        </div>
                        
    
    
                    </fieldset>
    
    
                </div>
                
                
                <div class="col-md-6 col-lg-6">
    
                    <fieldset>
    
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="adresse2">Adresse </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{old('adresse2')  ? old('adresse2') : $mandant->adresse_partenaire }}" id="adresse2" name="adresse2" placeholder="N° et Rue.." >
                                    
                                        @if ($errors->has('adresse2'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('adresse2')}}</strong> 
                                            </div>
                                        @endif   
                                    </div>
                            </div>
    
                                            
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="code_postal2">Code postal</label>
                                    <div class="col-lg-6">
                                    <input type="text" class="form-control " value="{{old('code_postal2')  ? old('code_postal2') : $mandant->code_postal_partenaire}}" id="code_postal2" name="code_postal2" placeholder="Ex: 75001.." >
                                       
                                        @if ($errors->has('code_postal2'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('code_postal2')}}</strong> 
                                            </div>
                                        @endif 
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="ville2">Ville </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{old('ville2')  ? old('ville2') : $mandant->ville_partenaire}}" id="ville2" name="ville2" placeholder="EX: Paris.." >
                                    @if ($errors->has('ville2'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('ville2')}}</strong> 
                                        </div>
                                    @endif 
                            </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="pays2">Pays </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control " value="{{old('pays2') ? old('pays2') : $mandant->pays_partenaire }}" id="pays2" name="pays2" placeholder="Entez une lettre et choisissez.." >
                                @if ($errors->has('pays2'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('pays2')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="date_naissance2">@lang('Date de naissance')</label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control " value="{{old('date_naissance2') ? old('date_naissance2') : $mandant->date_naissance_partenaire}}" id="date_naissance2" name="date_naissance2"  >
                                    @if ($errors->has('date_naissance2'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('date_naissance2')}}</strong> 
                                        </div>
                                    @endif 
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="lieu_naissance2">Lieu de naissance </label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" value="{{old('lieu_naissance2')  ? old('lieu_naissance2') : $mandant->lieu_naissance_partenaire}}" id="lieu_naissance2" name="lieu_naissance2" placeholder="EX: Paris.." >
                                    @if ($errors->has('lieu_naissance2'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('lieu_naissance2')}}</strong> 
                                        </div>
                                    @endif 
                                    </div>
                            </div>
    
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="langue2">@lang('Langue') </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{old('langue2')  ? old('langue2') : $mandant->langue_partenaire}}" id="langue2" name="langue2" placeholder="" >
                                    @if ($errors->has('langue2'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('langue2')}}</strong> 
                                        </div>
                                    @endif 
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 col-form-label" for="note2">@lang('Note') </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" id="note2" name="note2"  rows="3" placeholder="" >{{old('note2') ? old('note2') : $mandant->note_partenaire}}</textarea>
                                    <span class="help-block">
                                    <small></small>
                                    </span>
                                </div>
                                @if($errors->has('note2'))
                                    <br>
                                    <br><br>
                                        <div class="alert alert-warning">
                                            <strong>{{$errors->first('note2')}}</strong> 
                                        </div> 
                                    <hr> 
                                    @endif
                            </div>
    
                                                        
                    </fieldset>
    
                </div>
                
                
                
        </div>
    
            
       
    
    
        <div class="row">
            <div class="form-group row">
                <div class="col-lg-8 ml-auto">
                    <button type="submit" name="addCouple" class="btn btn-primary">Ajouter</button>
                </div>
            </div>                        
        </div>   
                
            </form>
        </div>
    </div>
    