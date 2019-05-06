<div class="card-body">
        @if (session('ok'))
       
        <div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                
                <strong> {{ session('ok') }}</strong>
        </div>
     @endif
                           
    <div class="form-validation">
        <form class="form-valide" action="{{ route('acquereurs.add') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" class="" value="personne_seule" name="type_acquereur">

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
                                            <label class="col-lg-4 col-form-label" for="val-select">@lang('Civilité') <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="js-select2 form-control {{$errors->has('civilite') ? 'is-invalid' : ''}}" id="val-select" name="civilite" style="width: 100%;" data-placeholder="Choose one.." required>
                                                
                                                    
                                                    <option value="M.">@lang('M.') </option>
                                                    <option value="Mme">@lang('Mme.') </option>
                                                    <option value="Mlle">@lang('Mlle.') </option>
                                                    
                                                </select>
                                                @if ($errors->has('civilite'))
                                                    <br>
                                                    <div class="alert alert-warning ">
                                                        <strong>{{$errors->first('civilite')}}</strong> 
                                                    </div>
                                                    @endif
                                                
                                            </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nom">Nom <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                    <input type="text" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{old('nom')}}" id="nom" name="nom" placeholder="Nom.." required>
                                        @if ($errors->has('nom'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('nom')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="prenom">Prénom </label>
                                        <div class="col-lg-6">
                                        <input type="text"  class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{old('prenom')}}" id="prenom" name="prenom" placeholder="Prénom.." >
                                        @if ($errors->has('prenom'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('prenom')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="categorie">@lang('Catégorie') </label>
                                        <div class="col-lg-6">
                                        <input type="text"  class="form-control {{ $errors->has('categorie') ? ' is-invalid' : '' }}" value="{{old('categorie')}}" id="categorie" name="categorie" placeholder="VIP ect." >
                                        @if ($errors->has('categorie'))
                                            <br>
                                            <div class="alert alert-warning ">
                                                <strong>{{$errors->first('categorie')}}</strong> 
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                                                                

                            </fieldset>
            </div>

        
            
            <div class="col-md-6 col-lg-6">

                    <fieldset>   
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="val-email" value="{{old('email')}}" name="email" placeholder="Email.." required>
                                    @if ($errors->has('email'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('email')}}</strong> 
                                    </div>
                                    @endif
                                </div>
                                    
                            </div>
                            
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="telephone_mobile">Téléphone mobile </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control {{ $errors->has('telephone_mobile') ? ' is-invalid' : '' }}" value="{{old('telephone_mobile')}}" id="telephone_mobile" name="telephone_mobile" placeholder="Ex: 0600000000.." >
                                    @if ($errors->has('telephone_mobile'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('telephone_mobile')}}</strong> 
                                        </div>
                                    @endif     
                                    
                                    </div>
                            </div>

                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="telephone_fixe">Téléphone fixe </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control {{ $errors->has('telephone_fixe') ? ' is-invalid' : '' }}" value="{{old('telephone_fixe')}}" id="telephone_fixe" name="telephone_fixe" placeholder="Ex: 0600000000.." >
                                    @if ($errors->has('telephone_fixe'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('telephone_fixe')}}</strong> 
                                        </div>
                                    @endif     
                                    
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="source_contact">@lang('Source du contact') </label>
                                    <div class="col-lg-6">
                                        <select class="js-select2 form-control {{$errors->has('source_contact') ? 'is-invalid' : ''}}" id="source_contact" name="source_contact" style="width: 100%;" data-placeholder="" >
                                        
                                            
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
                                <label class="col-lg-4 col-form-label" for="adresse">Adresse </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control {{ $errors->has('adresse') ? ' is-invalid' : '' }}" value="{{old('adresse')}}" id="adresse" name="adresse" placeholder="N° et Rue.." >
                                
                                    @if ($errors->has('adresse'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('adresse')}}</strong> 
                                        </div>
                                    @endif   
                                </div>
                        </div>

                                        
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="code_postal">Code postal </label>
                                <div class="col-lg-6">
                                <input type="text" class="form-control {{ $errors->has('code_postal') ? ' is-invalid' : '' }}" value="{{old('code_postal')}}" id="code_postal" name="code_postal" placeholder="Ex: 75001.." >
                                    
                                    @if ($errors->has('code_postal'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('code_postal')}}</strong> 
                                        </div>
                                    @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="ville">Ville </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control {{ $errors->has('ville') ? ' is-invalid' : '' }}" value="{{old('ville')}}" id="ville" name="ville" placeholder="EX: Paris.." >
                                @if ($errors->has('ville'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('ville')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="pays">Pays </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control {{ $errors->has('pays') ? ' is-invalid' : '' }}" value="{{old('pays')}}" id="pays" name="pays" placeholder="Entez une lettre et choisissez.." >
                            @if ($errors->has('pays'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('pays')}}</strong> 
                                </div>
                            @endif 
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="date_naissance">@lang('Date de naissance')</label>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control {{ $errors->has('date_naissance') ? ' is-invalid' : '' }}" value="{{old('date_naissance')}}" id="date_naissance" name="date_naissance"  >
                                @if ($errors->has('date_naissance'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('date_naissance')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="lieu_naissance">Lieu de naissance </label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control {{ $errors->has('lieu_naissance') ? ' is-invalid' : '' }}" value="{{old('lieu_naissance')}}" id="lieu_naissance" name="lieu_naissance" placeholder="EX: Paris.." >
                                @if ($errors->has('lieu_naissance'))
                                    <br>
                                    <div class="alert alert-warning ">
                                        <strong>{{$errors->first('lieu_naissance')}}</strong> 
                                    </div>
                                @endif 
                                </div>
                        </div>


                    </fieldset>


                </div>
                
                
                <div class="col-md-6 col-lg-6">

                    <fieldset>

                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="">@lang('Langue') </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control {{ $errors->has('lieu_naissance') ? ' is-invalid' : '' }}" value="{{old('ville')}}" id="ville" name="ville" placeholder="EX: Paris.." >
                                    @if ($errors->has('lieu_naissance'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('lieu_naissance')}}</strong> 
                                        </div>
                                    @endif 
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="">@lang('Note') </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="note" name="note"  rows="3" placeholder="" >{{old('note') ? old('note') : ""}}</textarea>
                                        <span class="help-block">
                                        <small></small>
                                        </span>
                                    </div>
                                    @if($errors->has('note'))
                                        <br>
                                        <br><br>
                                            <div class="alert alert-warning">
                                                <strong>{{$errors->first('note')}}</strong> 
                                            </div> 
                                        <hr> 
                                        @endif
                            </div>
                                                        
                        </fieldset>

                </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card p-0">
                    <div class="media">
                        <div class="p-5 bg-warning media-left media-middle">
                            <i class="ti-info-alt f-s-28 color-white"></i>
                        </div>
                        <div class="p-10 media-body">
                            <h4 class="color-warning m-r-10">@lang('Type de bien recherché') </h4>
                            
                            <div class="progress progress-sm m-t-10 m-b-0">
                                <div class="progress-bar boxshadow-none  bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6 ">
              
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="type_offre_rech">@lang('Type d\'offre') </label>
                                <div class="col-lg-6">
                                    <select class="js-select2 form-control {{$errors->has('type_offre_rech') ? 'is-invalid' : ''}}" id="type_offre_rech" name="type_offre_rech" style="width: 100%;" data-placeholder="Choose one.." >
                                    
                                        
                                        <option value="vente">@lang('Vente') </option>
                                        <option value="location">@lang('Location') </option>
                                        <option value="vente \ location">@lang('Vente \ Location') </option>
                                        
                                    </select>
                                    @if ($errors->has('type_offre_rech'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('type_offre_rech')}}</strong> 
                                        </div>
                                        @endif
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" >@lang('Surface habitable')</label>
                                <div class="col-lg-6">                                
                                    <div class="rangeslider">
                                            <div>
                                                <input type="text" id="range_23" value="" name="surface_habitable_rech" />
                                            </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="ville_rech">Ville</label>
                                <div class="col-lg-6">
                                <input type="text" class="form-control {{$errors->has('ville_rech') ? 'is-invalid' : ''}}" value="{{old('ville_rech')}}" id="ville" name="nom_rech"  >
                                    @if ($errors->has('ville_rech'))
                                        <br>
                                        <div class="alert alert-warning ">
                                            <strong>{{$errors->first('ville_rech')}}</strong> 
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                </div>

                <div class="col-md-6 col-lg-6 ">

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="type_bien_rech">@lang('Type de bien') </label>
                        <div class="col-lg-6">
                            <select class="js-select2 form-control {{$errors->has('type_bien_rech') ? 'is-invalid' : ''}}" id="type_bien_rech" name="type_bien_rech" style="width: 100%;" >
                            
                                
                                <option value="">@lang('Type de bien') </option>
                                <option value="Appartement">@lang('Appartement') </option>
                                <option value="Maison">@lang('Maison') </option>
                                <option value="Studio">@lang('Studio') </option>
                                <option value="Terrain">@lang('terrain') </option>
                                <option value="Mas">@lang('Mas') </option>
                                <option value="Duplex">@lang('Duplex') </option>
                                <option value="Immeuble">@lang('Immeuble') </option>
                                <option value="Propriete">@lang('Propriete') </option>
                                <option value="Cabanon">@lang('Cabanon') </option>
                                <option value="Villa">@lang('Villa') </option>
                                <option value="Rez de jardin">@lang('Rez de jardin') </option>
                                <option value="Château">@lang('Château') </option>
                                <option value="Loft">@lang('Loft') </option>
                                <option value="Ferme">@lang('Ferme') </option>
                                <option value="Maison de village">@lang('Maison de village') </option>
                                <option value="Fonds de commerce">@lang('Fonds de commerce') </option>
                                <option value="Murs commerciaux ">@lang('Murs commerciaux') </option>
                                <option value="Local professionnel">@lang('Local professionnel') </option>
                                <option value="Local commerciaux">@lang('Local commerciaux') </option>
                            
                                
                            </select>
                            @if ($errors->has('type_bien_rech'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('type_bien_rech')}}</strong> 
                                </div>
                                @endif
                            
                        </div>
                    </div>

                    <div class="form-group row">
                            <label class="col-lg-4 col-form-label" >@lang('Budget')</label>
                            <div class="col-lg-6">                                
                                <div class="rangeslider">
                                        <div>
                                            <input type="text" id="range_24" value="" name="budget_rech" />
                                        </div>
                                </div>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="pays_rech"> Pays</label>
                            <div class="col-lg-6">
                            <input type="text"  class="form-control {{ $errors->has('pays_rech') ? ' is-invalid' : '' }}" value="{{old('pays_rech')}}" id="pays_rech" name="pays_rech"  >
                            @if ($errors->has('pays_rech'))
                                <br>
                                <div class="alert alert-warning ">
                                    <strong>{{$errors->first('pays_rech')}}</strong> 
                                </div>
                            @endif
                        </div>
                    </div>
                                            
                          
                </div>
        </div>
    <br>
    <br>
    
        <div class="row">
            <div class="form-group row">
                <div class="col-lg-8 ml-auto">
                    <button type="submit" name="ajouterSeul" class="btn btn-lg btn-primary">Ajouter</button>
                </div>
            </div>                        
        </div>   
                
        </form>
    </div>
</div>
            