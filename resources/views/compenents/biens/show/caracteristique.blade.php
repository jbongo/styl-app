<div id="bloc_carac">

<form action="{{route('bien.update',$bien->id)}}" id="caracter" method="post">
        @csrf

        <input type="text" name="type_update" hidden value="caracteristique" >
<div class="row">
    <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
            <h4> <strong>@lang('Principal')</strong></h4>                          
    </div>
    <div class="col-md-1 col-lg-1 col-sm-1">
        <a  class="btn btn-dark" id="btn_update_principal" style="height: 39px; margin-left: -10px; margin-bottom: 10px;">
            <i class="material-icons">mode_edit</i>
        </a>         
    </div>        
</div>
<br>
<div class="row">
    <div class="col-md-6 col-lg-6 col-lg-offset-2 col-md-offset-2">
        <button id="btn_enregistrer_caract" class="btn btn-dark btn-flat btn-addon btn-lg "  style="position: fixed;bottom: 10px; z-index:1 ;" type="submit"><i class="ti-save"></i>@lang('Enregistrer')</button>
    </div>
</div>
 
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 " >
        <h5> <strong>@lang('Titre du bien')</strong></h5>                          
    </div>
    <div class="col-md-9 col-lg-9 col-sm-9">

       <p class="show_champ_principal">
           {{$bien->titre_annonce}} 
       </p>
        <div class="col-lg-6 col-md-6 hide_champ_principal">
            <input type="text" class="form-control " value="{{$bien->titre_annonce}}" id="titre_annonce" name="titre_annonce" required  >
        </div>
       

    </div>
</div>
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3 " >
            <h5> <strong>  @lang('Texte du bien') </strong></h5>                          
    </div>
    <div class="col-md-9 col-lg-9 col-sm-9" >
       <p  class="show_champ_principal">
           {{$bien->description_annonce}} 
       </p>
       <div class="col-lg-6 col-md-6 hide_champ_principal">                   
       <textarea class="form-control"  name="description_annonce" id="description_annonce" cols="30" rows="10" required>{{$bien->description_annonce}}</textarea>
       </div>
    </div>        
</div>

<br>
<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-6 ">
        <div class="row">
            <div class="col-md-10 col-lg-10 col-sm-10 " style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Texte fiche vitrine')</strong></h4>                          
            </div>
            <div class="col-md-1 col-lg-1 col-sm-1">
                <a  class="btn btn-dark" id="btn_update_vitrine" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                    <i class="material-icons">mode_edit</i>
                </a>         
            </div>   
            
            <div class="col-md-12 col-lg-12 col-sm-12 ">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3 " >
                        <h5> <strong>@lang('Titre du bien')</strong></h5>                          
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9">
                
                       <p class="show_champ_vitrine">
                           {{$bien->titre_annonce_vitrine}} 
                       </p>
                        <div class="col-lg-10 col-md-10 hide_champ_vitrine">
                            <input type="text" class="form-control " value="{{$bien->titre_annonce_vitrine}}" id="titre_annonce_vitrine" name="titre_annonce_vitrine" required  >
                        </div>
                       
                
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3 " >
                            <h5> <strong>  @lang('Texte du bien') </strong></h5>                          
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9" >
                       <p  class="show_champ_vitrine">
                           {{$bien->description_annonce_vitrine}} 
                       </p>
                       <div class="col-lg-10 col-md-10 hide_champ_vitrine">                   
                       <textarea class="form-control"  name="description_annonce_vitrine" id="description_annonce_vitrine" cols="30" rows="10" required>{{$bien->description_annonce_vitrine}}</textarea>
                       </div>
                    </div>        
                </div>                    
            </div>
            
        </div>              
    </div>

    <div class="col-md-6 col-lg-6 col-sm-6 ">
        <div class="row">
            <div class="col-md-10 col-lg-10 col-sm-10 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Texte fiche privée')</strong></h4>                          
            </div>
            <div class="col-md-1 col-lg-1 col-sm-1">
                <a  class="btn btn-dark" id="btn_update_prive" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                    <i class="material-icons">mode_edit</i>
                </a>         
            </div>  
            <div class="col-md-12 col-lg-12 col-sm-12 ">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3 " >
                        <h5> <strong>@lang('Titre du bien')</strong></h5>                          
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9">
                
                       <p class="show_champ_privee">
                           {{$bien->titre_annonce_privee}} 
                       </p>
                        <div class="col-lg-10 col-md-10 hide_champ_privee">
                            <input type="text" class="form-control " value="{{$bien->titre_annonce_privee}}" id="titre_annonce_privee" name="titre_annonce_privee" required  >
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-3 " >
                            <h5> <strong>  @lang('Texte du bien') </strong></h5>                          
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-9" >
                       <p  class="show_champ_privee">
                           {{$bien->description_annonce_privee}} 
                       </p>
                       <div class="col-lg-10 col-md-10 hide_champ_privee">                   
                       <textarea class="form-control"  name="description_annonce_privee" id="description_annonce_privee" cols="30" rows="10" required>{{$bien->description_annonce_privee}}</textarea>
                       </div>
                    </div>        
                </div>                    
            </div>  
        </div>              
    </div>      
</div>
<br>
<br>
<br>
<br>

<div class="row">
    <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
            <h4> <strong>@lang('Informations')</strong> @lang('sur le bien')</h4>                          
    </div>
    <div class="col-md-1 col-lg-1 col-sm-1" >
            <button class="btn btn-dark btn-flat btn-addon" type="button" id="btn_clic_masquer_infos_bien" style="height: 39px;margin-left:-10px;margin-bottom:10px;"><i  class="ti-minus"></i>&nbsp;</button>
    </div>        
</div>
<br>
<div id="div_clic_masquer_infos_bien">

    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Offre')</strong> & @lang('Type du bien')</h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1">

            <a  class="btn btn-dark" id="xxxxxxxxxx" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>                 

        </div>        
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-2 "style="background: #5c96b3; color: white;">
                <h5> @lang('Offre')</strong> </h5>                          
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4">
            {{$bien->type_offre}}
        </div>  
        <div class="col-md-2 col-lg-2 col-sm-2 "style="background: #5c96b3; color: white;">
                <h5> @lang('Type')</strong> </h5>                          
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4">
            {{$bien->type_bien}}
        </div>        
    </div>


    {{-- Agencement Intérieur  --}}
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Agencement')</strong> & @lang('Intérieur')</h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1" id="btn_update_agi">

            <a  class="btn btn-dark" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>                 

        </div>        
    </div>
    <br>
    <div class="row" id="div_agencement_interieur">

            <div class="col-md-6 col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_chambre_agencement_interieur">@lang('Nombre de chambres') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control" value="{{$bien->nb_chambre_agencement_interieur}}" id="nb_chambre_agencement_interieur" name="nb_chambre_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_chambre_agencement_interieur}}
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_salle_bain_agencement_interieur">@lang('Nombre de salles de bain') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_salle_bain_agencement_interieur}}"  id="nb_salle_bain_agencement_interieur" name="nb_salle_bain_agencement_interieur" placeholder="" > 
                        </div>

                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_salle_bain_agencement_interieur}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_salle_eau_agencement_interieur">@lang('Nombre de salles d\'eau') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_salle_eau_agencement_interieur}}"  id="nb_salle_eau_agencement_interieur" name="nb_salle_eau_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_salle_eau_agencement_interieur}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_wc_agencement_interieur">@lang('Nombre de WC') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_wc_agencement_interieur}}"  id="nb_wc_agencement_interieur" name="nb_wc_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_wc_agencement_interieur}}
                        </div>
                    </div>

                {{-- div pour afficher ou masquer ce bloc--}}
                <div id="agencement_interieur_plus"> 

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_lot_agencement_interieur">@lang('Nombre de lots') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_lot_agencement_interieur}}"  id="nb_lot_agencement_interieur" name="nb_lot_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_lot_agencement_interieur}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_couchage_agencement_interieur">@lang('Nombre de couchages') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_couchage_agencement_interieur}}"  id="nb_couchage_agencement_interieur" name="nb_couchage_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_couchage_agencement_interieur}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="nb_niveau_agencement_interieur">@lang('Nombre de niveaux') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                        <input type="number" min="0" class="form-control " value="{{$bien->nb_niveau_agencement_interieur}}"  id="nb_niveau_agencement_interieur" name="nb_niveau_agencement_interieur" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->nb_niveau_agencement_interieur}}
                        </div>
                    </div>


                    <div class=" form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label">@lang('Grenier / combles') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                            @php  $grenier = $bien->grenier_comble_agencement_interieur @endphp
                            <label class="radio-inline"><input type="radio" value="@lang('Non précisé')" name="grenier_comble_agencement_interieur" @if($grenier == "Non précisé") checked  @endif  >@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Oui')"  @if($grenier == "Oui") checked  @endif name="grenier_comble_agencement_interieur" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Non')"  @if($grenier == "Non") checked  @endif name="grenier_comble_agencement_interieur">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->grenier_comble_agencement_interieur}}
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label">@lang('Buanderie') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                                @php  $buanderie = $bien->buanderie_agencement_interieur @endphp
                            <label class="radio-inline"><input type="radio" value="@lang('Non précisé')"  @if($buanderie == "Non précisé") checked  @endif name="buanderie_agencement_interieur" >@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Oui')"  @if($buanderie == "Oui") checked  @endif name="buanderie_agencement_interieur" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Non')"  @if($buanderie == "Non") checked  @endif name="buanderie_agencement_interieur">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->buanderie_agencement_interieur}}
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label">@lang('Meublé') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_agi">
                                @php  $meuble = $bien->meuble_agencement_interieur @endphp
                            <label class="radio-inline"><input type="radio" value="@lang('Non précisé')" @if($meuble == "Non précisé") checked  @endif name="meuble_agencement_interieur" >@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Oui')" @if($meuble == "Oui") checked  @endif name="meuble_agencement_interieur" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" value="@lang('Non')" @if($meuble == "Non") checked  @endif name="meuble_agencement_interieur">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_agi">
                        {{$bien->meuble_agencement_interieur}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-6">

                <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="surface_carrez_agencement_interieur">@lang('Surface') </label>
                        <div class="col-lg-6 col-md-6">                           
                            
                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="surface_carrez_agencement_interieur">@lang('Carrez (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_agi">
                                        <input type="number" min="0" class="form-control " value="{{$bien->surface_carrez_agencement_interieur}}" id="surface_carrez_agencement_interieur" name="surface_carrez_agencement_interieur" > 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_agi">
                                    {{$bien->surface_carrez_agencement_interieur}}
                                    </div> 
                                </div>
                                                                  
                            </div>

                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="surface_habitable_agencement_interieur">@lang('Habitable (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_agi">
                                        <input type="number" min="0" class="form-control " value="{{$bien->surface_habitable_agencement_interieur}}" id="surface_habitable_agencement_interieur" name="surface_habitable_agencement_interieur" > 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_agi">
                                    {{$bien->surface_habitable_agencement_interieur}}
                                    </div>  
                                </div> 
                                                                 
                            </div>

                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="surface_sejour_agencement_interieur">@lang('Séjour (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_agi">
                                        <input type="number" min="0" class="form-control " value="{{$bien->surface_sejour_agencement_interieur}}" id="surface_sejour_agencement_interieur" name="surface_sejour_agencement_interieur" > 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_agi">
                                    {{$bien->surface_sejour_agencement_interieur}}
                                    </div>
                                </div>                                    
                            </div>
                        
                        </div>
                    </div>

                    <div class="form-group row">
                            <label class="col-lg-4 col-md-4 col-form-label" for="cuisine_type_agencement_interieur">@lang('Cuisine') </label>
                            <div class="col-lg-6 col-md-6">                           
                                
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="cuisine_type_agencement_interieur">@lang('Type') </label>
                                        <div class="col-lg-8 col-md-8 hide_champ_agi">
                                            <select class="js-select2 form-control" id="cuisine_type_agencement_interieur" name="cuisine_type_agencement_interieur" style="width: 100%;">
                                                @if($bien->cuisine_type_agencement_interieur)
                                                <option value="{{$bien->cuisine_type_agencement_interieur}}">{{$bien->cuisine_type_agencement_interieur}} </option>
                                                @endif
                                                <option value="Non défini">@lang('Non défini') </option>
                                                <option value="Américaine">@lang('Américaine') </option>
                                                <option value="Kitchnette">@lang('Kitchenette') </option>
                                                <option value="Séparée">@lang('Séparée') </option>
                                                <option value="Sans">@lang('Sans') </option>
                                            </select>  
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_agi">
                                        {{$bien->cuisine_type_agencement_interieur}}
                                        </div>
                                    </div>                                 
                                </div>

                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="cuisine_etat_agencement_interieur">@lang('Etat') </label>
                                        <div class="col-lg-8 col-md-8 hide_champ_agi">
                                            <select class="js-select2 form-control" id="cuisine_etat_agencement_interieur" name="cuisine_etat_agencement_interieur" style="width: 100%;">
                                                @if($bien->cuisine_etat_agencement_interieur)
                                                <option value="{{$bien->cuisine_etat_agencement_interieur}}">{{$bien->cuisine_etat_agencement_interieur}} </option>
                                                @endif

                                                <option value="Non défini">@lang('Non défini') </option>
                                                <option value="Sémi-équipée">@lang('Sémi-équipée') </option>
                                                <option value="Equipée">@lang('Equipée') </option>                                                    
                                            </select>  
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_agi">
                                        {{$bien->cuisine_etat_agencement_interieur}}
                                        </div>
                                    </div>                                 
                                </div>
        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-md-4 col-form-label" for="situation_exposition_agencement_interieur">@lang('Situation') </label>
                            <div class="col-lg-6 col-md-6">                           
                                
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="situation_exposition_agencement_interieur"> @lang('Exposition') </label>
                                        <div class="col-lg-8 col-md-8 hide_champ_agi">
                                                <select class="js-select2 form-control" id="situation_exposition_agencement_interieur" name="situation_exposition_agencement_interieur" style="width: 100%;"  >
                                                        
                                                        @if($bien->situation_exposition_agencement_interieur)
                                                        <option value="{{$bien->situation_exposition_agencement_interieur}}">{{$bien->situation_exposition_agencement_interieur}} </option>
                                                        @endif

                                                        <option value="Non définie">@lang('Non définie') </option>
                                                        <option value="Nord">@lang('Nord') </option>
                                                        <option value="Nord-Est">@lang('Nord-Est') </option>                   
                                                        <option value="Est">@lang('Est') </option>                   
                                                        <option value="Sud-Est">@lang('Sud-Est') </option>                   
                                                        <option value="Sud">@lang('Sud') </option>                   
                                                        <option value="Sud-Ouest">@lang('Sud-Ouest') </option>                   
                                                        <option value="Ouest">@lang('Ouest') </option>                   
                                                        <option value="Nord-Ouest">@lang('Nord-Ouest') </option>                   
                                                        <option value="Nord-Sud">@lang('Nord-Sud') </option>                   
                                                        <option value="Est-Ouest">@lang('Est-Ouest') </option>                             
                                                </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_agi">
                                        {{$bien->situation_exposition_agencement_interieur}}
                                        </div>
                                    </div>                           
                                </div>
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="situation_vue_agencement_interieur">@lang('Vue')</label>
                                        <div class="col-lg-8 col-md-8 hide_champ_agi">
                                            <input type="text" class="form-control " value="{{$bien->situation_vue_agencement_interieur}}" id="situation_vue_agencement_interieur" name="situation_vue_agencement_interieur"  >
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_agi">
                                            {{$bien->situation_vue_agencement_interieur}}
                                        </div>
                                    </div>                                    
                                </div>

                            </div>
                        </div>
                        <br>
            </div>

    </div>



    {{-- Agencement Extérieur  --}}
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Agencement')</strong> & @lang('Extérieur')</h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1" id="btn_update_age">

            <a  class="btn btn-dark" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>                 

        </div>        
    </div>
    <br>
    <div class="row" id="div_agencement_exterieur">
            <div class="col-md-6 col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="mitoyennete_agencement_exterieur">@lang('Mitoyenneté') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_age">
                            <select class="js-select2 form-control" id="mitoyennete_agencement_exterieur" name="mitoyennete_agencement_exterieur" style="width: 100%;">
                                @if($bien->mitoyennete_agencement_exterieur)
                                <option value="{{$bien->mitoyennete_agencement_exterieur}}">{{$bien->mitoyennete_agencement_exterieur}} </option>
                                @endif
                                <option value="Non précisé">@lang('Non précisé') </option>
                                <option value="Indépendant">@lang('Indépendant') </option>
                                <option value="1 côté">@lang('1 côté') </option>                                                    
                                <option value="2 côtés">@lang('2 côtés') </option>                                                    
                                <option value="3 côtés">@lang('3 côtés') </option>                                                    
                                <option value="4 côtés">@lang('4 côtés') </option>                                                    
                                                                                
                            </select>  
                            
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_age">
                            {{$bien->mitoyennete_agencement_exterieur}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="etages_agencement_exterieur">@lang('Etages') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_age">
                            <input type="number" min="0" value="{{$bien->etages_agencement_exterieur}}" class="form-control "  id="etages_agencement_exterieur" name="etages_agencement_exterieur" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_age">
                            {{$bien->etages_agencement_exterieur}}
                        </div>
                    </div>
    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="terrasse_agencement_exterieur">@lang('Terrasse') </label>
                        <div class="col-lg-8 col-md-8 ">                    
                            <div class="row">
                                <div class=" form-group row">
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    @php  $terrasse = $bien->terrasse_agencement_exterieur @endphp
                                    <label class="radio-inline"><input type="radio"  @if($terrasse == "Non précisé") checked  @endif value="@lang('Non précisé')" name="terrasse_agencement_exterieur" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio"  @if($terrasse == "Oui") checked  @endif value="@lang('Oui')" name="terrasse_agencement_exterieur" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio"  @if($terrasse == "Non") checked  @endif value="@lang('Non')" name="terrasse_agencement_exterieur">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->terrasse_agencement_exterieur}}
                                </div>                                    
                                    
                                </div>
                                {{-- Affiche ou masque la zone --}}
                                <div id="terrasse_oui_agencement_exterieur">                          
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label " for="nombre_terrasse_agencement_exterieur">@lang('Nombre') </label>
                                        <div class="col-lg-6 col-md-6 hide_champ_age">
                                            <input type="number" min="0" value="{{$bien->nombre_terrasse_agencement_exterieur}}" class="form-control "  id="nombre_terrasse_agencement_exterieur" name="nombre_terrasse_agencement_exterieur" placeholder=""> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_age">
                                            {{$bien->nombre_terrasse_agencement_exterieur}}
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="surface_terrasse_agencement_exterieur">@lang('Surface (m²)') </label>
                                        <div class="col-lg-6 col-md-6 hide_champ_age">
                                            <input type="number" value="{{$bien->surface_terrasse_agencement_exterieur}}" min="0" class="form-control "  id="surface_terrasse_agencement_exterieur" name="surface_terrasse_agencement_exterieur" placeholder=""> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_age">
                                            {{$bien->surface_terrasse_agencement_exterieur}}
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            </div>                           
                        
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="plain_pied_agencement_exterieur">@lang('Plain pied') </label>
                        <div class="col-lg-6 col-md-6">                  
                            <div class="row">
                                <div class=" form-group row hide_champ_age">
                                    <div class="col-lg-10 col-md-10">
                                         @php  $plain = $bien->plain_pied_agencement_exterieur @endphp
                                        <label class="radio-inline"><input type="radio" @if($plain == "Non précisé") checked  @endif value="@lang('Non précisé')" name="plain_pied_agencement_exterieur" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($plain == "Oui") checked  @endif value="@lang('Oui')" name="plain_pied_agencement_exterieur" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($plain == "Non") checked  @endif value="@lang('Non')" name="plain_pied_agencement_exterieur">@lang('Non')</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->plain_pied_agencement_exterieur}}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="sous_sol_agencement_exterieur">@lang('Sous sol') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_age">
                            <select class="js-select2 form-control" id="sous_sol_agencement_exterieur" name="sous_sol_agencement_exterieur" style="width: 100%;">
                                    @if($bien->sous_sol_agencement_exterieur)
                                    <option value="{{$bien->sous_sol_agencement_exterieur}}">{{$bien->sous_sol_agencement_exterieur}} </option>
                                    @endif
                                <option value="Non précisé">@lang('Non précisé') </option>
                                <option value="Sans">@lang('Sans') </option>
                                <option value="Avec">@lang('Avec') </option>                                                    
                                <option value="Avec et amenagé">@lang('Avec et amenagé') </option>                                                                                          
                            </select> 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_age">
                            {{$bien->sous_sol_agencement_exterieur}}
                        </div>
                    </div> 
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="surface_jardin_agencement_exterieur">@lang('Jardin') </label>
                        <div class="col-lg-6 col-md-6">                           
                            
                            <div class="row">                                         
                                <div class="form-group row ">
                                    <label class="col-lg-4 col-md-4 col-form-label " for="surface_jardin_agencement_exterieur">@lang('Surface (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_age">
                                        <input type="number" value="{{$bien->surface_jardin_agencement_exterieur}}" min="0" class="form-control "  id="surface_jardin_agencement_exterieur" name="surface_jardin_agencement_exterieur" placeholder=""> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->surface_jardin_agencement_exterieur}}
                                    </div>
                                </div>                                    
                            </div>
                            <div class="row">
                                <div class=" form-group row ">
                                    <label class="col-lg-4 col-md-4 col-form-label">@lang('Privatif') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_age">
                                        @php  $privatif = $bien->privatif_jardin_agencement_exterieur @endphp
                                        <label class="radio-inline"><input type="radio" @if($privatif == "Non précisé") checked  @endif value="@lang('Non précisé')" name="privatif_jardin_agencement_exterieur" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($privatif == "Oui") checked  @endif  value="@lang('Oui')" name="privatif_jardin_agencement_exterieur" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($privatif == "Non") checked  @endif value="@lang('Non')" name="privatif_jardin_agencement_exterieur">@lang('Non')</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->privatif_jardin_agencement_exterieur}}
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <hr>
                {{-- div pour afficher ou masquer ce bloc--}}
                <div id="agencement_exterieur_plus"> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="type_cave_agencement_exterieur">@lang('Cave') </label>
                        <div class="col-lg-8 col-md-8">                    
                            <div class="row">
                                <div class=" form-group row">
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    @php  $type_cave = $bien->type_cave_agencement_exterieur @endphp
                                    <label class="radio-inline"><input type="radio" @if($type_cave == "Non précisé") checked  @endif value="@lang('Non précisé')" name="type_cave_agencement_exterieur" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($type_cave == "Oui") checked  @endif value="@lang('Oui')" name="type_cave_agencement_exterieur" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($type_cave == "Non") checked  @endif value="@lang('Non')" name="type_cave_agencement_exterieur">@lang('Non')</label>
                                </div> 
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->type_cave_agencement_exterieur}}
                                </div>                                   
                                    
                                </div>
                                {{-- Affiche ou masque la zone --}}
                                <div id="type_cave_oui_agencement_exterieur"> 

                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="surface_cave_agencement_exterieur">@lang('Surface (m²)') </label>
                                        <div class="col-lg-6 col-md-6 hide_champ_age">
                                            <input type="number" value="{{$bien->surface_cave_agencement_exterieur}}" min="0" class="form-control "  id="surface_cave_agencement_exterieur" name="surface_cave_agencement_exterieur" placeholder=""> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_age">
                                            {{$bien->surface_cave_agencement_exterieur}}
                                        </div>
                                    </div>                                    
                                </div>
                                </div>
                            </div>                           
                            
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="balcon_agencement_exterieur">@lang('Balcon') </label>
                        <div class="col-lg-8 col-md-8">                    
                            <div class="row">
                                <div class=" form-group row">
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    @php  $balcon = $bien->balcon_agencement_exterieur @endphp
                                    <label class="radio-inline"><input type="radio" @if($balcon == "Non précisé") checked  @endif  value="@lang('Non précisé')" name="balcon_agencement_exterieur" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($balcon == "Oui") checked  @endif value="@lang('Oui')" name="balcon_agencement_exterieur" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($balcon == "Non") checked  @endif value="@lang('Non')" name="balcon_agencement_exterieur">@lang('Non')</label>
                                </div>  
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->balcon_agencement_exterieur}}
                                </div>                                  
                                    
                                </div>
                                {{-- Affiche ou masque la zone --}}
                                <div id="balcon_oui_agencement_exterieur"> 
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="nb_balcon_agencement_exterieur">@lang('Nombre') </label>
                                        <div class="col-lg-6 col-md-6 hide_champ_age">
                                            <input type="number" min="0" class="form-control " value="{{$bien->nb_balcon_agencement_exterieur}}" id="nb_balcon_agencement_exterieur" name="nb_balcon_agencement_exterieur" placeholder=""> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_age">
                                            {{$bien->nb_balcon_agencement_exterieur}}
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">                                         
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="surface_balcon_agencement_exterieur">@lang('Surface (m²)') </label>
                                        <div class="col-lg-6 col-md-6 hide_champ_age">
                                            <input type="number" value=" {{$bien->surface_balcon_agencement_exterieur}}" min="0" class="form-control "  id="surface_balcon_agencement_exterieur" name="surface_balcon_agencement_exterieur" placeholder=""> 
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_age">
                                            {{$bien->surface_balcon_agencement_exterieur}}
                                        </div>
                                    </div>                                    
                                </div>
                                </div>
                            </div>                           
                            
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="loggia_agencement_exterieur">@lang('Loggia') </label>
                        <div class="col-lg-6 col-md-6">                    
                            <div class="row">
                                <div class=" form-group row">
                                    <div class="col-lg-10 col-md-10 hide_champ_age">
                                        @php  $loggia = $bien->loggia_agencement_exterieur @endphp
                                        <label class="radio-inline"><input type="radio" @if($loggia == "Non précisé") checked  @endif value="@lang('Non précisé')" name="loggia_agencement_exterieur" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($loggia == "Oui") checked  @endif value="@lang('Oui')" name="loggia_agencement_exterieur" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($loggia == "Non") checked  @endif value="@lang('Non')" name="loggia_agencement_exterieur">@lang('Non')</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->loggia_agencement_exterieur}}
                                    </div>
                                </div>
                            </div>
                            {{-- Affiche ou masque la zone --}}
                            <div id="loggia_oui_agencement_exterieur"> 
                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="surface_loggia_agencement_exterieur">@lang('Surface (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_age">
                                        <input type="number" value=" {{$bien->surface_loggia_agencement_exterieur}}" min="0" class="form-control "  id="surface_loggia_agencement_exterieur" name="surface_loggia_agencement_exterieur" placeholder=""> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->surface_loggia_agencement_exterieur}}
                                    </div>
                                </div>                                    
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="veranda_agencement_exterieur">@lang('Véranda') </label>
                        <div class="col-lg-6 col-md-6">                  
                            <div class="row">
                                <div class=" form-group row">
                                    <div class="col-lg-10 col-md-10 hide_champ_age">
                                        @php  $veranda = $bien->veranda_agencement_exterieur @endphp
                                        <label class="radio-inline"><input type="radio" type="radio" @if($veranda == "Non précisé") checked  @endif value="@lang('Non précisé')" name="veranda_agencement_exterieur" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" type="radio" @if($veranda == "Oui") checked  @endif value="@lang('Oui')" name="veranda_agencement_exterieur" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" type="radio" @if($veranda == "Non") checked  @endif value="@lang('Non')" name="veranda_agencement_exterieur">@lang('Non')</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->veranda_agencement_exterieur}}
                                    </div>
                                </div>
                            </div>
                            {{-- Affiche ou masque la zone --}}
                            <div id="veranda_oui_agencement_exterieur">
                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="surface_veranda_agencement_exterieur">@lang('Surface (m²)') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_age">
                                        <input type="number" value="{{$bien->surface_veranda_agencement_exterieur}}" min="0" class="form-control "  id="surface_veranda_agencement_exterieur" name="surface_veranda_agencement_exterieur" placeholder=""> 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->surface_veranda_agencement_exterieur}}
                                    </div>
                                </div>                                    
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">

                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="nombre_garage_agencement_exterieur">@lang('Garage') </label>
                    <div class="col-lg-6 col-md-6">                           
                        
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4 col-form-label" for="nombre_garage_agencement_exterieur">@lang('Nombre') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <input type="number" value="{{$bien->nombre_garage_agencement_exterieur}}" min="0" class="form-control "  id="nombre_garage_agencement_exterieur" name="nombre_garage_agencement_exterieur" > 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->nombre_garage_agencement_exterieur}}
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4 col-form-label" for="surface_garage_agencement_exterieur">@lang('Surface (m²)') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <input type="number" value="{{$bien->nombre_garage_agencement_exterieur}}" min="0" class="form-control "  id="surface_garage_agencement_exterieur" name="surface_garage_agencement_exterieur" > 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->nombre_garage_agencement_exterieur}}
                                </div>
                            </div>                                    
                        </div>                       
                        
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="parking_interieur_agencement_exterieur">@lang('Parkings') </label>
                    <div class="col-lg-6 col-md-6">                           
                        
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4 col-form-label" for="parking_interieur_agencement_exterieur">@lang('Intérieurs') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <input type="number" value="{{$bien->parking_interieur_agencement_exterieur}}" min="0" class="form-control "  id="parking_interieur_agencement_exterieur" name="parking_interieur_agencement_exterieur" > 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->parking_interieur_agencement_exterieur}}
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4 col-form-label" for="parking_exterieur_agencement_exterieur">@lang('Extérieurs') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <input type="number" value="{{$bien->parking_exterieur_agencement_exterieur}}" min="0" class="form-control "  id="parking_exterieur_agencement_exterieur" name="parking_exterieur_agencement_exterieur" > 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->parking_exterieur_agencement_exterieur}}
                                </div>
                            </div>                                    
                        </div>                       
                    
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="statut_piscine_agencement_exterieur">@lang('Piscine') </label>
                    <div class="col-lg-6 col-md-6">                           
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="statut_piscine_agencement_exterieur">@lang('Statut') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <select class="js-select2 form-control" id="statut_piscine_agencement_exterieur" name="statut_piscine_agencement_exterieur" style="width: 100%;">
                                        @if($bien->statut_piscine_agencement_exterieur)
                                        <option value="{{$bien->statut_piscine_agencement_exterieur}}">{{$bien->statut_piscine_agencement_exterieur}} </option>
                                        @endif
                                        <option value="Non défini">@lang('Non défini') </option>
                                        <option value="Privative">@lang('Privative') </option>
                                        <option value="Collective">@lang('Collective') </option>                                                    
                                        <option value="Collective surveillée">@lang('Collective surveillée') </option>                                                    
                                    </select>  
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->statut_piscine_agencement_exterieur}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                                  
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-form-label" for="dimension_piscine_agencement_exterieur">@lang('Dimensions') </label>
                                    <div class="col-lg-8 col-md-8 hide_champ_age">
                                        <input type="text" value="{{$bien->dimension_piscine_agencement_exterieur}}"  class="form-control "  id="dimension_piscine_agencement_exterieur" name="dimension_piscine_agencement_exterieur" > 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_age">
                                        {{$bien->dimension_piscine_agencement_exterieur}}
                                    </div>
                                </div>                                                                      
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-md-4 col-form-label" for="volume_piscine_agencement_exterieur">@lang('Volume') (m<sup>3</sup>) </label>
                                <div class="col-lg-8 col-md-8 hide_champ_age">
                                    <input type="number" value="{{$bien->volume_piscine_agencement_exterieur}}" min="0" class="form-control "  id="volume_piscine_agencement_exterieur" name="volume_piscine_agencement_exterieur" > 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_age">
                                    {{$bien->volume_piscine_agencement_exterieur}}
                                </div>
                            </div>                                    
                        </div>
                            
                        
                    </div>
                </div>
                <hr>
                <br>
            </div>

    </div>

    {{-- Terrain   --}}
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Terrain  ')</strong></h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1" id="btn_update_terrain">

            <a  class="btn btn-dark" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>                 

        </div>        
    </div>
    <br>

    <div class="row" id="div_terrain">

            <div class="col-md-6 col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4   col-form-label" for="surface_terrain">@lang('Surface terrain') </label>
                        <div class="col-lg-6 col-md-6 hide_champ_terrain">
                        <input type="number" min="0" value="{{$bien->surface_terrain_terrain}}" class="form-control "  id="surface_terrain" name="surface_terrain" placeholder="" > 
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->surface_terrain_terrain}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="constructible_terrain">@lang('Constructible') </label>
                        <div class="col-lg-6 col-md-6">                           
                            
                            <div class="row">
                                <div class=" form-group row">                                   
                                    <div class="col-lg-10 col-md-10 hide_champ_terrain">
                                        @php  $constructible = $bien->constructible_terrain @endphp
                                        <label class="radio-inline"><input type="radio" @if($constructible == "Non précisé") checked  @endif value="@lang('Non précisé')" name="constructible_terrain" >@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($constructible == "Oui") checked  @endif value="@lang('Oui')" name="constructible_terrain" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($constructible == "Non") checked  @endif value="@lang('Non')" name="constructible_terrain">@lang('Non')</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                                        {{$bien->constructible_terrain}}
                                    </div>
                                </div>
                               
                            </div>
                            {{-- Affiche ou masque la zone --}}
                            <div id="constructible_oui_terrain">
                            <div class="row">                                         
                                <div class="form-group row">
                                    <label class="col-lg-5 col-md-5 col-form-label" for="surface_constructible_terrain">@lang('Surface (m²)') </label>
                                    <div class="col-lg-7 col-md-7 hide_champ_terrain">
                                        <input type="number" value="{{$bien->surface_constructible_terrain}}" min="0" class="form-control "  id="surface_constructible_terrain" name="surface_constructible_terrain" > 
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                                        {{$bien->surface_constructible_terrain}}
                                    </div> 
                                </div>     
                                                              
                            </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="topographie_terrain">@lang('Topographie') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <select class="js-select2 form-control" id="topographie_terrain" name="topographie_terrain" style="width: 100%;">
                                @if($bien->topographie_terrain)
                                <option value="{{$bien->topographie_terrain}}">{{$bien->topographie_terrain}} </option>
                                @endif
                                <option value="Non défini">@lang('Non défini') </option>
                                <option value="Plat">@lang('Plat') </option>
                                <option value="En pente">@lang('En pente') </option>                                                    
                                <option value="A aménager">@lang('A amenager') </option>                                                    
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->topographie_terrain}}
                        </div>
                    </div>     
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="emprise_au_sol_terrain">@lang('Emprise au sol')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->emprise_au_sol_terrain}}" class="form-control "  id="emprise_au_sol_terrain" name="emprise_au_sol_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->emprise_au_sol_terrain}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="emprise_au_sol_residuelle_terrain">@lang('Emprise au sol Résiduelle')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->emprise_au_sol_residuelle_terrain}}" class="form-control "  id="emprise_au_sol_residuelle_terrain" name="emprise_au_sol_residuelle_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->emprise_au_sol_residuelle_terrain}}
                        </div>
                    </div>
                {{-- div pour afficher ou masquer ce bloc--}}
                <div id="terrain_div1_plus"> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="shon_terrain">@lang('SHON')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->shon_terrain}}" class="form-control "  id="shon_terrain" name="shon_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->shon_terrain}}
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="ces_terrain">@lang('CES')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->ces_terrain}}" class="form-control "  id="ces_terrain" name="ces_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->ces_terrain}}
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="pos_terrain">@lang('POS')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->pos_terrain}}" class="form-control "  id="pos_terrain" name="pos_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->pos_terrain}}
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="codification_plu_terrain">@lang('Codification PLU')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->codification_plu_terrain}}" class="form-control "  id="codification_plu_terrain" name="codification_plu_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->codification_plu_terrain}}
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="droit_de_passage_terrain">@lang('Droit de passage')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->droit_de_passage_terrain}}" class="form-control "  id="droit_de_passage_terrain" name="droit_de_passage_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->droit_de_passage_terrain}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="reference_cadastrale_terrain">@lang('Référence cadastrale')</label>
                        <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            <input type="text" value="{{$bien->reference_cadastrale_terrain}}" class="form-control "  id="reference_cadastrale_terrain" name="reference_cadastrale_terrain"  >
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_terrain">
                            {{$bien->reference_cadastrale_terrain}}
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-6 col-lg-6">

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="piscinable_terrain">@lang('Piscinable') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                        @php  $piscinable = $bien->piscinable_terrain @endphp
                        <label class="radio-inline"><input type="radio" @if($piscinable == "Non précisé") checked  @endif value="@lang('Non précisé')" name="piscinable_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($piscinable == "Oui") checked  @endif value="@lang('Oui')" name="piscinable_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($piscinable == "Non") checked  @endif value="@lang('Non')" name="piscinable_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->piscinable_terrain}}
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="arbore_terrain">@lang('Arboré') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                        @php  $arbore = $bien->arbore_terrain @endphp
                        <label class="radio-inline"><input type="radio" @if($arbore == "Non précisé") checked  @endif value="@lang('Non précisé')" name="arbore_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($arbore == "Oui") checked  @endif value="@lang('Oui')" name="arbore_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($arbore == "Non") checked  @endif value="@lang('Non')" name="arbore_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->arbore_terrain}}
                    </div>
                </div><hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="viabilise_terrain">@lang('Viabilisé') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            @php  $viabilise = $bien->viabilise_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($viabilise == "Non précisé") checked  @endif value="@lang('Non précisé')" name="viabilise_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($viabilise == "Oui") checked  @endif value="@lang('Oui')" name="viabilise_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($viabilise == "Non") checked  @endif value="@lang('Non')" name="viabilise_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->viabilise_terrain}}
                    </div>
                </div> <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Cloturé') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            @php  $cloture = $bien->cloture_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($cloture == "Non précisé") checked  @endif  value="@lang('Non précisé')" name="cloture_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($cloture == "Oui") checked  @endif value="@lang('Oui')" name="cloture_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($cloture == "Non") checked  @endif value="@lang('Non')" name="cloture_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->cloture_terrain}}
                    </div>
                </div>     
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Divisible') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            @php  $divisible_terr = $bien->divisible_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($divisible_terr == "Non précisé") checked  @endif value="@lang('Non précisé')" name="divisible_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($divisible_terr == "Oui") checked  @endif value="@lang('Oui')" name="divisible_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($divisible_terr == "Non") checked  @endif value="@lang('Non')" name="divisible_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->divisible_terrain}}
                    </div>
                </div>     <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Possibilité de tout à l\'égout') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            @php  $possibilite = $bien->possiblite_egout_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($possibilite == "Non précisé") checked  @endif value="@lang('Non précisé')" name="possiblite_egout_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($possibilite == "Oui") checked  @endif value="@lang('Oui')" name="possiblite_egout_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($possibilite == "Non") checked  @endif value="@lang('Non')" name="possiblite_egout_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->possiblite_egout_terrain}}
                    </div>
                </div>     
                <hr>
            {{-- div pour afficher ou masquer ce bloc--}}
            <div id="terrain_div2_plus"> 
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Informations Copropriété') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                        @php  $info_co = $bien->info_copopriete_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($info_co == "Non précisé") checked  @endif value="@lang('Non précisé')" name="info_copopriete_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($info_co == "Oui") checked  @endif value="@lang('Oui')" name="info_copopriete_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($info_co == "Non") checked  @endif value="@lang('Non')" name="info_copopriete_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->info_copopriete_terrain}}
                    </div>
                </div>     
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Accès') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_terrain">
                            @php  $acces_terr = $bien->acces_terrain @endphp

                        <label class="radio-inline"><input type="radio" @if($acces_terr == "Non précisé") checked  @endif value="@lang('Non précisé')" name="acces_terrain" >@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($acces_terr == "Oui") checked  @endif value="@lang('Oui')" name="acces_terrain" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($acces_terr == "Non") checked  @endif value="@lang('Non')" name="acces_terrain">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_terrain">
                        {{$bien->acces_terrain}}
                    </div>
                </div>     
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="">@lang('Raccordements') </label>
                    <div class="col-lg-6 col-md-6">                           
                        
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Eau') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_terrain">
                                    @php  $raccordement = $bien->raccordement_eau_terrain @endphp

                                    <label class="radio-inline"><input type="radio" @if($raccordement == "Non précisé") checked  @endif value="@lang('Non précisé')" name="raccordement_eau_terrain" >@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement == "Oui") checked  @endif value="@lang('Oui')" name="raccordement_eau_terrain" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement == "Non") checked  @endif value="@lang('Non')" name="raccordement_eau_terrain">@lang('Non')</label>
                                </div>
                            </div>    
                            <div class="col-lg-6 col-md-6 show_champ_terrain">
                                {{$bien->raccordement_eau_terrain}}
                            </div>                              
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Gaz') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_terrain">
                                    @php  $raccordement_gaz = $bien->raccordement_gaz_terrain @endphp

                                    <label class="radio-inline"><input type="radio" @if($raccordement_gaz == "Non précisé") checked  @endif value="@lang('Non précisé')" name="raccordement_gaz_terrain" >@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_gaz == "Oui") checked  @endif value="@lang('Oui')" name="raccordement_gaz_terrain" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_gaz == "Non") checked  @endif value="@lang('Non')" name="raccordement_gaz_terrain">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_terrain">
                                    {{$bien->raccordement_gaz_terrain}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Electricité') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_terrain">
                                    @php  $raccordement_elec = $bien->raccordement_electricite_terrain @endphp

                                    <label class="radio-inline"><input type="radio" @if($raccordement_elec == "Non précisé") checked  @endif value="@lang('Non précisé')" name="raccordement_electricite_terrain" >@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_elec == "Oui") checked  @endif value="@lang('Oui')" name="raccordement_electricite_terrain" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_elec == "Non") checked  @endif value="@lang('Non')" name="raccordement_electricite_terrain">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_terrain">
                                    {{$bien->raccordement_electricite_terrain}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Téléphone') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_terrain">
                                    @php  $raccordement_tel = $bien->raccordement_telephone_terrain @endphp

                                    <label class="radio-inline"><input type="radio" @if($raccordement_tel == "Non précisé") checked  @endif value="@lang('Non précisé')" name="raccordement_telephone_terrain" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_tel == "Oui") checked  @endif value="@lang('Oui')" name="raccordement_telephone_terrain" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($raccordement_tel == "Non") checked  @endif value="@lang('Non')" name="raccordement_telephone_terrain">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_terrain">
                                    {{$bien->raccordement_telephone_terrain}}
                                </div>
                            </div>                                 
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            </div>

    </div>
    <br>


    {{-- Équipements  --}}
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
            <h4> <strong>@lang('Équipements ')</strong></h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1" id="btn_update_equipement">
            <a  class="btn btn-dark" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>               
        </div>        
    </div>
    <br>
    <div class="row" id="div_equipement">

            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="format_equipement">@lang('Format') </label>
                            <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                <select class="js-select2 form-control" id="format_equipement" name="format_equipement" style="width: 100%;">            
                                    
                                    @if($bien->format_equipement)
                                    <option value="{{$bien->format_equipement}}">{{$bien->format_equipement}} </option>
                                    @endif

                                    <option value="Non précisé">@lang('Non précisé') </option>
                                    <option value="Central">@lang('Central') </option>
                                    <option value="Collectif">@lang('Collectif') </option>                                                    
                                    <option value="Individuel">@lang('Individuel') </option>                                                    
                                </select>                            
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_equipement">
                                {{$bien->format_equipement}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="type_equipement">@lang('Type') </label>
                            <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                <select class="js-select2 form-control" id="type_equipement" name="type_equipement" style="width: 100%;">
                                    @if($bien->type_equipement)
                                    <option value="{{$bien->type_equipement}}">{{$bien->type_equipement}} </option>
                                    @endif            
                                    <option value="Non précisé">@lang('Non précisé') </option>
                                    <option value="Air">@lang('Air') </option>
                                    <option value="Cheminée">@lang('Cheminée') </option>
                                    <option value="Convecteur">@lang('Convecteur') </option>
                                    <option value="Poêle">@lang('Poêle') </option>
                                    <option value="Radiateur">@lang('Radiateur') </option>
                                    <option value="Rayonnant">@lang('Rayonnant') </option>
                                    <option value="Sol">@lang('Sol') </option>
                                                                                                
                                </select>                            
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_equipement">
                                {{$bien->type_equipement}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="energie_equipement">@lang('Energie') </label>
                            <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                <select class="js-select2 form-control" id="energie_equipement" name="energie_equipement" style="width: 100%;">            
                                    @if($bien->energie_equipement)
                                    <option value="{{$bien->energie_equipement}}">{{$bien->energie_equipement}} </option>
                                    @endif  
                                    <option value="Non défini">@lang('Non défini') </option>
                                    <option value="Aérothermie">@lang('Aérothermie') </option>
                                    <option value="Bois">@lang('Bois') </option>
                                    <option value="Charbon">@lang('Charbon') </option>
                                    <option value="Climatisation">@lang('Climatisation') </option>
                                    <option value="Électrique">@lang('Électrique') </option>
                                    <option value="Fioul">@lang('Fioul') </option>
                                    <option value="Gaz">@lang('Gaz') </option>
                                    <option value="Géothermie">@lang('Géothermie') </option>
                                    <option value="Granules">@lang('Granules') </option>
                                    <option value="Mixte">@lang('Mixte') </option>
                                    <option value="Pompe">@lang('Pompe') </option>
                                    <option value="Sans">@lang('Sans') </option>
                                    <option value="Solaire">@lang('Solaire') </option>
                                                                                    
                                </select>                            
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_equipement">
                                {{$bien->energie_equipement}}
                            </div>
                        </div>
                    </div>
                </div>


            </div> 
            <hr>
            <div class="col-md-6 col-lg-6">
                    
                <hr>
                <div class="row">
                        <div class=" form-group row">                                   
                            <div class="col-lg-10 col-md-10">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Ascenseur') </label>
                                <div class="hide_champ_equipement"> 
                                    @php  $ascenseur_equip = $bien->ascenseur_equipement @endphp
                                    <label class="radio-inline"><input type="radio"@if($ascenseur_equip == "Non précisé") checked  @endif value="@lang('Non précisé')" name="ascenseur_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio"@if($ascenseur_equip == "Oui") checked  @endif value="@lang('Oui')" name="ascenseur_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio"@if($ascenseur_equip == "Non") checked  @endif value="@lang('Non')" name="ascenseur_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->ascenseur_equipement}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class=" form-group row">                                   
                            <div class="col-lg-10 col-md-10">
                                                        
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Accès Handicapé') </label>
                                <div class="hide_champ_equipement"> 
                                        @php  $acces_handi = $bien->acces_handicape_equipement @endphp
                                        <label class="radio-inline"><input type="radio" @if($acces_handi == "Non précisé") checked  @endif value="@lang('Non précisé')" name="acces_handicape_equipement" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($acces_handi == "Oui") checked  @endif value="@lang('Oui')" name="acces_handicape_equipement" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($acces_handi == "Non") checked  @endif value="@lang('Non')" name="acces_handicape_equipement">@lang('Non')</label>
                                                                    
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->acces_handicape_equipement}}
                                </div>
                            </div>
                        </div>
                    </div> 
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="prix_public">@lang('Climatisation') </label>
                        <div class="col-lg-6 col-md-6">                           
                            
                            <div class="row">
                                <div class=" form-group row">                                   
                                    <div class="col-lg-10 col-md-10 hide_champ_equipement">
                                        @php  $climatisation_equi = $bien->climatisation_equipement @endphp
                                        <label class="radio-inline"><input type="radio" @if($climatisation_equi == "Non précisé") checked  @endif value="@lang('Non précisé')" name="climatisation_equipement" checked>@lang('Non précisé')</label>
                                        <label class="radio-inline"><input type="radio" @if($climatisation_equi == "Oui") checked  @endif value="@lang('Oui')" name="climatisation_equipement" >@lang('Oui')</label>
                                        <label class="radio-inline"><input type="radio" @if($climatisation_equi == "Non") checked  @endif value="@lang('Non')" name="climatisation_equipement">@lang('Non')</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                                        {{$bien->climatisation_equipement}}
                                    </div>
                                </div>

                                {{-- Affiche ou masque cette zone --}}
                                <div id="climatisation_oui_equipement">
                                <div class="row">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-md-4 col-form-label" for="climatisation_specification_equipement">@lang('Spécifications')</label>
                                        <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                            <input type="text" value="{{$bien->climatisation_specification_equipement}}" class="form-control "  id="climatisation_specification_equipement" name="climatisation_specification_equipement"  >
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                                            {{$bien->climatisation_specification_equipement}}
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>                       
                        
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="eau_alimentation_equipement">@lang('Eau') </label>
                        <div class="col-lg-6 col-md-6">                           
                        
                            <div class="row">
                                <div class=" form-group row">                                   
                                    
                                        <label class="col-lg-5 col-md-5 col-form-label" for="eau_alimentation_equipement">@lang('Alimentation')</label>
                                        <div class="col-lg-7 col-md-7 hide_champ_equipement">
                                            <select class="js-select2 form-control" id="eau_alimentation_equipement" name="eau_alimentation_equipement" style="width: 100%;">           
                                                
                                                @if($bien->eau_alimentation_equipement)
                                                <option value="{{$bien->eau_alimentation_equipement}}">{{$bien->eau_alimentation_equipement}} </option>
                                                @endif
                                                <option value="Non défini">@lang('Non défini') </option>
                                                <option value="Sans">@lang('Sans') </option>
                                                <option value="Individuel">@lang('Individuel') </option>
                                                <option value="Collectif">@lang('Collectif') </option>
                                                <option value="Puit">@lang('Puit') </option>
                                                                                                    
                                            </select>  
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                                            {{$bien->eau_alimentation_equipement}}
                                        </div>
                                    
                                </div>
                            </div>  

                            <div class="row">
                                <div class=" form-group row">                                   
                                    <label class="col-lg-5 col-md-5 col-form-label" for="eau_assainissement_equipement">@lang('Assainissement')</label>
                                    <div class="col-lg-7 col-md-7 hide_champ_equipement">
                                        <select class="js-select2 form-control" id="eau_assainissement_equipement" name="eau_assainissement_equipement" style="width: 100%;">           
                                            @if($bien->eau_assainissement_equipement)
                                            <option value="{{$bien->eau_assainissement_equipement}}">{{$bien->eau_assainissement_equipement}} </option>
                                            @endif
                                            <option value="Non défini">@lang('Non défini') </option>
                                            <option value="Sans">@lang('Sans') </option>
                                            <option value="Tout à l'égout">@lang('Tout à l\'égout') </option>
                                            <option value="Fosse septique">@lang('Fosse septique') </option>
                                            <option value="Fosse toutes eaux">@lang('Fosse toutes eaux') </option>                                                 
                                            <option value="Micro-station">@lang('Micro-station') </option>                                                 
                                        </select>  
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                                        {{$bien->eau_assainissement_equipement}}
                                    </div>
                                </div>
                            </div>  
                            
                        </div>
                        
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-md-4 col-form-label" for="eau_chaude_distribution_equipement">@lang('Eau chaude') </label>
                        <div class="col-lg-6 col-md-6">                           
                        
                            <div class="row">
                                <div class=" form-group row">                                   
                                    
                                        <label class="col-lg-5 col-md-5 col-form-label" for="eau_chaude_distribution_equipement">@lang('Distribution')</label>
                                        <div class="col-lg-7 col-md-7 hide_champ_equipement">
                                            <select class="js-select2 form-control" id="eau_chaude_distribution_equipement" name="eau_chaude_distribution_equipement" style="width: 100%;">           
                                                @if($bien->eau_chaude_distribution_equipement)
                                                <option value="{{$bien->eau_chaude_distribution_equipement}}">{{$bien->eau_chaude_distribution_equipement}} </option>
                                                @endif
                                                <option value="Non défini">@lang('Non défini') </option>
                                                <option value="Individuel">@lang('Individuel') </option>
                                                <option value="Collectif">@lang('Collectif') </option>
                                                <option value="Centrale">@lang('Centrale') </option>
                                                                                                    
                                            </select>  
                                        </div>
                                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                                            {{$bien->eau_chaude_distribution_equipement}}
                                        </div>
                                    
                                </div>
                            </div>  

                            <div class="row">
                                <div class=" form-group row">                                   
                                    <label class="col-lg-5 col-md-5 col-form-label" for="eau_chaude_energie_equipement">@lang('Energie')</label>
                                    <div class="col-lg-7 col-md-7 hide_champ_equipement">
                                        <select class="js-select2 form-control" id="eau_chaude_energie_equipement" name="eau_chaude_energie_equipement" style="width: 100%;">           
                                            @if($bien->eau_chaude_energie_equipement)
                                            <option value="{{$bien->eau_chaude_energie_equipement}}">{{$bien->eau_chaude_energie_equipement}} </option>
                                            @endif

                                            <option value="Non défini">@lang('Non défini') </option>
                                            <option value="Gaz">@lang('Gaz') </option>
                                            <option value="Ballon électrique">@lang('Ballon électrique') </option>
                                            <option value="Fioul">@lang('Fioul') </option>
                                            <option value="Solaire">@lang('Solaire') </option>
                                            <option value="Géothermie">@lang('Géothermie') </option>
                                            <option value="Mixte">@lang('Mixte') </option>
                                            <option value="Sans">@lang('Sans') </option>
                                            <option value="Autre">@lang('Autre') </option>
                                            <option value="Aérothermie">@lang('Aérothermie') </option>                                                 
                                        </select>  
                                    </div>
                                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                                        {{$bien->eau_chaude_energie_equipement}}
                                    </div>
                                </div>
                            </div>  
                            
                        </div>
                        
                    </div> 
                    <hr>
                {{-- div pour afficher ou masquer ce bloc--}}
                <div id="equipement_div1_plus"> 
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-select">@lang('Cheminée') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_equipement">
                            @php  $cheminee_equipe = $bien->cheminee_equipement @endphp
                            <label class="radio-inline"><input type="radio" @if($cheminee_equipe == "Non précisé") checked  @endif value="@lang('Non précisé')" name="cheminee_equipement" checked>@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" @if($cheminee_equipe == "Oui") checked  @endif value="@lang('Oui')" name="cheminee_equipement" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" @if($cheminee_equipe == "Non") checked  @endif value="@lang('Non')" name="cheminee_equipement">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                            {{$bien->cheminee_equipement}}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-select">@lang('Arrosage automatique') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_equipement hide_champ_equipement">
                            @php  $arrosage_auto = $bien->arrosage_automatique_equipement @endphp
                            <label class="radio-inline"><input type="radio" @if($arrosage_auto == "Non précisé") checked  @endif value="@lang('Non précisé')" name="arrosage_automatique_equipement" checked>@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" @if($arrosage_auto == "Oui") checked  @endif value="@lang('Oui')" name="arrosage_automatique_equipement" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" @if($arrosage_auto == "Non") checked  @endif value="@lang('Non')" name="arrosage_automatique_equipement">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                            {{$bien->arrosage_automatique_equipement}}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-select">@lang('Barbecue') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                @php  $barbecue_equip = $bien->barbecue_equipement @endphp
                            <label class="radio-inline"><input type="radio" @if($barbecue_equip == "Non précisé") checked  @endif value="@lang('Non précisé')" name="barbecue_equipement" checked>@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" @if($barbecue_equip == "Oui") checked  @endif value="@lang('Oui')" name="barbecue_equipement" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" @if($barbecue_equip == "Non") checked  @endif value="@lang('Non')" name="barbecue_equipement">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                            {{$bien->barbecue_equipement}}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-select">@lang('Tennis') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_equipement">
                            @php  $tennis_equip = $bien->tennis_equipement @endphp                            
                            <label class="radio-inline"><input type="radio" @if($tennis_equip == "Non précisé") checked  @endif value="@lang('Non précisé')" name="tennis_equipement" checked>@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" @if($tennis_equip == "Oui") checked  @endif value="@lang('Oui')" name="tennis_equipement" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" @if($tennis_equip == "Non") checked  @endif value="@lang('Non')" name="tennis_equipement">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                            {{$bien->tennis_equipement}}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-select">@lang('Local à vélo') </label>
                        <div class="col-lg-8 col-md-8 hide_champ_equipement">
                             @php  $local_a_velo = $bien->local_a_velo_equipement @endphp
                            <label class="radio-inline"><input type="radio" @if($local_a_velo == "Non précisé") checked  @endif value="@lang('Non précisé')" name="local_a_velo_equipement" checked>@lang('Non précisé')</label>
                            <label class="radio-inline"><input type="radio" @if($local_a_velo == "Oui") checked  @endif value="@lang('Oui')" name="local_a_velo_equipement" >@lang('Oui')</label>
                            <label class="radio-inline"><input type="radio" @if($local_a_velo == "Non") checked  @endif value="@lang('Non')" name="local_a_velo_equipement">@lang('Non')</label>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_equipement">
                            {{$bien->local_a_velo_equipement}}
                        </div>
                    </div>
                    <hr>
                </div>
            
            </div>

            <div class="col-md-6 col-lg-6">

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Volets électriques') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                        @php  $volet_elec = $bien->volet_electrique_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($volet_elec == "Non précisé") checked  @endif value="@lang('Non précisé')" name="volet_electrique_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($volet_elec == "Oui") checked  @endif value="@lang('Oui')" name="volet_electrique_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($volet_elec == "Non") checked  @endif value="@lang('Non')" name="volet_electrique_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->volet_electrique_equipement}}
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Gardien') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                        @php  $gardien_equi = $bien->gardien_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($gardien_equi == "Non précisé") checked  @endif value="@lang('Non précisé')" name="gardien_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($gardien_equi == "Oui") checked  @endif value="@lang('Oui')" name="gardien_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($gardien_equi == "Non") checked  @endif value="@lang('Non')" name="gardien_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->gardien_equipement}}
                    </div>
                </div><hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Double vitrage') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                        @php  $double_vitrage = $bien->double_vitrage_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($double_vitrage == "Non précisé") checked  @endif value="@lang('Non précisé')" name="double_vitrage_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($double_vitrage == "Oui") checked  @endif value="@lang('Oui')" name="double_vitrage_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($double_vitrage == "Non") checked  @endif value="@lang('Non')" name="double_vitrage_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->double_vitrage_equipement}}
                    </div>
                </div> <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Triple vitrage') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                            @php  $triple_vitrage = $bien->triple_vitrage_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($triple_vitrage == "Non précisé") checked  @endif value="@lang('Non précisé')" name="triple_vitrage_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($triple_vitrage == "Oui") checked  @endif value="@lang('Oui')" name="triple_vitrage_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($triple_vitrage == "Non") checked  @endif value="@lang('Non')" name="triple_vitrage_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->triple_vitrage_equipement}}
                    </div>
                </div>     
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Câble') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                            @php  $cable_equip = $bien->cable_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($cable_equip == "Non précisé") checked  @endif value="@lang('Non précisé')" name="cable_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($cable_equip == "Oui") checked  @endif value="@lang('Oui')" name="cable_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($cable_equip == "Non") checked  @endif value="@lang('Non')" name="cable_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->cable_equipement}}
                    </div>
                </div>   
                <hr>

            {{-- div pour afficher ou masquer ce bloc--}}
            <div id="equipement_div2_plus">     
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="">@lang('Sécurité') </label>
                    <div class="col-lg-6 col-md-6">                           
                        
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Porte blindée') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_porte = $bien->securite_porte_blinde_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_porte == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_porte_blinde_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_porte == "Oui") checked  @endif value="@lang('Oui')" name="securite_porte_blinde_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_porte == "Non") checked  @endif value="@lang('Non')" name="securite_porte_blinde_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_porte_blinde_equipement}}
                                </div>
                            </div>                                  
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Interphone') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_inter = $bien->securite_interphone_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_inter == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_interphone_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_inter == "Oui") checked  @endif value="@lang('Oui')" name="securite_interphone_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_inter == "Non") checked  @endif value="@lang('Non')" name="securite_interphone_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_interphone_equipement}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Visiophone') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_visio = $bien->securite_visiophone_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_visio == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_visiophone_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_visio == "Oui") checked  @endif value="@lang('Oui')" name="securite_visiophone_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_visio == "Non") checked  @endif value="@lang('Non')" name="securite_visiophone_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_visiophone_equipement}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Alarme') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_alarme = $bien->securite_alarme_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_alarme == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_alarme_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_alarme == "Oui") checked  @endif value="@lang('Oui')" name="securite_alarme_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_alarme == "Non") checked  @endif value="@lang('Non')" name="securite_alarme_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_alarme_equipement}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Digicode') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_digi = $bien->securite_digicode_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_digi == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_digicode_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_digi == "Oui") checked  @endif value="@lang('Oui')" name="securite_digicode_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_digi == "Non") checked  @endif value="@lang('Non')" name="securite_digicode_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_digicode_equipement}}
                                </div>
                            </div>                                 
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-select">@lang('Détecteur de fumée') </label>
                                <div class="col-lg-8 col-md-8 hide_champ_equipement">
                                        @php  $securite_detecte = $bien->securite_detecteur_de_fumee_equipement @endphp
                                    <label class="radio-inline"><input type="radio" @if($securite_detecte == "Non précisé") checked  @endif value="@lang('Non précisé')" name="securite_detecteur_de_fumee_equipement" checked>@lang('Non précisé')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_detecte == "Oui") checked  @endif value="@lang('Oui')" name="securite_detecteur_de_fumee_equipement" >@lang('Oui')</label>
                                    <label class="radio-inline"><input type="radio" @if($securite_detecte == "Non") checked  @endif value="@lang('Non')" name="securite_detecteur_de_fumee_equipement">@lang('Non')</label>
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_equipement">
                                    {{$bien->securite_detecteur_de_fumee_equipement}}
                                </div>
                            </div>                                 
                        </div>

                    
                    </div>
                </div> 
                <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Portail électrique') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                            @php  $portail_elec = $bien->portail_electrique_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($portail_elec == "Non précisé") checked  @endif value="@lang('Non précisé')" name="portail_electrique_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($portail_elec == "Oui") checked  @endif value="@lang('Oui')" name="portail_electrique_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($portail_elec == "Non") checked  @endif value="@lang('Non')" name="portail_electrique_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->portail_electrique_equipement}}
                    </div>
                </div> 
                <hr>   
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-select">@lang('Cuisine d\'été') </label>
                    <div class="col-lg-8 col-md-8 hide_champ_equipement">
                        @php  $cuisine_ete = $bien->cuisine_ete_equipement @endphp
                        <label class="radio-inline"><input type="radio" @if($cuisine_ete == "Non précisé") checked  @endif value="@lang('Non précisé')" name="cuisine_ete_equipement" checked>@lang('Non précisé')</label>
                        <label class="radio-inline"><input type="radio" @if($cuisine_ete == "Oui") checked  @endif value="@lang('Oui')" name="cuisine_ete_equipement" >@lang('Oui')</label>
                        <label class="radio-inline"><input type="radio" @if($cuisine_ete == "Non") checked  @endif value="@lang('Non')" name="cuisine_ete_equipement">@lang('Non')</label>
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_equipement">
                        {{$bien->cuisine_ete_equipement}}
                    </div>
                </div>   
                <hr> 
            </div>               
        </div>
        
    </div>


    {{-- Diagnostics & Compléments   --}}
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Diagnostics & Compléments')</strong></h4>                          
        </div>
        <div class="col-md-1 col-lg-1 col-sm-1" id="btn_update_diagnostic">

            <a  class="btn btn-dark" style="height: 39px;margin-left:-10px;margin-bottom:10px;">
                <i class="material-icons">mode_edit</i>
            </a>                 

        </div>        
    </div>
    <br>
    <div class="row" id="div_diagnostic">
            <div class="col-md-6 col-lg-6">

                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="annee_construction_diagnostic">@lang('Année de construction') </label>
                    <div class="col-lg-4 col-md-4 hide_champ_diagnostic">
                        <input type="number" value="{{$bien->annee_construction_diagnostic}}" min="1800" max="3000" class="form-control "  id="annee_construction_diagnostic" name="annee_construction_diagnostic" placeholder=""> 
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                        {{$bien->annee_construction_diagnostic}}
                    </div>
                </div> 
    <hr>
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-form-label" for="dpe_bien_soumi_diagnostic">@lang('DPE') </label>
                    <div class="col-lg-6 col-md-6">                           
                        
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-10 col-md-10 col-form-label" for="dpe_bien_soumi_diagnostic">@lang('Ce bien est soumis au DPE') </label>
                                <div class="col-lg-2 col-md-2 hide_champ_diagnostic">
                                    <input type="checkbox" @if($bien->dpe_bien_soumi_diagnostic == "on") checked @endif  id="dpe_bien_soumi_diagnostic" name="dpe_bien_soumi_diagnostic" > 
                                </div>
                                <div class="col-lg-2 col-md-2 show_champ_diagnostic">
                                    <input type="checkbox" disabled @if($bien->dpe_bien_soumi_diagnostic == "on") checked @endif>
                                </div>
                                
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-10 col-md-10 col-form-label" for="dpe_vierge_diagnostic">@lang('DPE vierge pour ce bien') </label>
                                <div class="col-lg-2 col-md-2 hide_champ_diagnostic">
                                    <input type="checkbox" @if($bien->dpe_vierge_diagnostic == "on") checked @endif  id="dpe_vierge_diagnostic" name="dpe_vierge_diagnostic" > 
                                </div>
                                <div class="col-lg-2 col-md-2 show_champ_diagnostic">
                                    <input type="checkbox" disabled @if($bien->dpe_vierge_diagnostic == "on") checked @endif>
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label" for="dpe_consommation_diagnostic">@lang('Consommation') </label>
                                <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                    <input type="text" value="{{$bien->dpe_consommation_diagnostic}}" class="form-control "  id="dpe_consommation_diagnostic" name="dpe_consommation_diagnostic" placeholder=""> 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                    {{$bien->dpe_consommation_diagnostic}}
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label" for="dpe_ges_diagnostic">@lang('GES') </label>
                                <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                    <input type="text" value="{{$bien->dpe_ges_diagnostic}}" class="form-control "  id="dpe_ges_diagnostic" name="dpe_ges_diagnostic" placeholder=""> 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                    {{$bien->dpe_ges_diagnostic}}
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">                                         
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label" for="dpe_diagnostic">@lang('Date') </label>
                                <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                    <input type="date" value="{{$bien->dpe_diagnostic}}" class="form-control "  id="dpe_diagnostic" name="dpe_diagnostic" placeholder=""> 
                                </div>
                                <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                    {{$bien->dpe_diagnostic}}
                                </div>
                            </div>                                    
                        </div>
                
                    </div>
                </div>
    <hr>
                <div class=" form-group row">                                   
                    <label class="col-lg-5 col-md-5 col-form-label" for="etat_exterieur_diagnostic">@lang('Etat extérieur')</label>
                    <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                        <select class="js-select2 form-control" id="etat_exterieur_diagnostic" name="etat_exterieur_diagnostic" style="width: 100%;">           
                            @if($bien->etat_exterieur_diagnostic)
                            <option value="{{$bien->etat_exterieur_diagnostic}}">{{$bien->etat_exterieur_diagnostic}} </option>
                            @endif
                            <option value="Non défini">@lang('Non défini') </option>
                            <option value="Travaux à prévoir">@lang('Travaux à prévoir') </option>
                            <option value="A rafraichir">@lang('A rafraichir') </option>
                            <option value="Etat moyen">@lang('Etat moyen') </option>
                            <option value="Bon état">@lang('Bon état') </option>
                            <option value="Execellent état">@lang('Execellent état') </option>
                                                                    
                        </select>  
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                        {{$bien->etat_exterieur_diagnostic}}
                    </div>
                </div>

                <div class=" form-group row">                                   
                    <label class="col-lg-5 col-md-5 col-form-label" for="etat_interieur_diagnostic">@lang('Etat intérieur')</label>
                    <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                        <select class="js-select2 form-control" id="etat_interieur_diagnostic" name="etat_interieur_diagnostic" style="width: 100%;">           
                            @if($bien->etat_interieur_diagnostic)
                            <option value="{{$bien->etat_interieur_diagnostic}}">{{$bien->etat_interieur_diagnostic}} </option>
                            @endif
                            <option value="Non défini">@lang('Non défini') </option>
                            <option value="Gros travaux à prévoir">@lang('Gros travaux à prévoir') </option>
                            <option value="Travaux à prévoir">@lang('Travaux à prévoir') </option>
                            <option value="A rafraichir">@lang('A rafraichir') </option>
                            <option value="Habitable (m²)">@lang('Habitable (m²)') </option>
                            <option value="Etat moyen">@lang('Etat moyen') </option>
                            <option value="Bon état">@lang('Bon état') </option>
                            <option value="Execellent état">@lang('Execellent état') </option>
                            <option value="Neuf">@lang('Neuf') </option>
                            <option value="Refait à neuf">@lang('Refait à neuf') </option>
                                                                    
                        </select>  
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                        {{$bien->etat_interieur_diagnostic}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-5 col-md-5 col-form-label" for="surface_annexe_diagnostic">@lang('Surfaces annexes') </label>
                    <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                        <input type="number" value="{{$bien->surface_annexe_diagnostic}}" min="0" class="form-control "  id="surface_annexe_diagnostic" name="surface_annexe_diagnostic" placeholder=""> 
                    </div>
                    <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                        {{$bien->surface_annexe_diagnostic}}
                    </div>
                </div>
                        
        </div>

        <div class="col-md-6 col-lg-6">

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="etat_parasitaire_diagnostic">@lang('État parasitaire') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                        
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $etat_parasi = $bien->etat_parasitaire_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($etat_parasi == "Non précisé") checked  @endif value="@lang('Non précisé')" name="etat_parasitaire_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($etat_parasi == "Oui") checked  @endif value="@lang('Oui')" name="etat_parasitaire_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($etat_parasi == "Non") checked  @endif value="@lang('Non')" name="etat_parasitaire_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->etat_parasitaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                    {{-- Affiche ou masque la zone --}}
                    <div id="etat_parasitaire_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="etat_parasitaire_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->etat_parasitaire_date_diagnostic}}" class="form-control "  id="etat_parasitaire_date_diagnostic" name="etat_parasitaire_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->etat_parasitaire_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="etat_parasitaire_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                            <textarea name="etat_parasitaire_commentaire_diagnostic" class="form-control" id="etat_parasitaire_commentaire_diagnostic" cols="8" rows="3">{{$bien->etat_parasitaire_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->etat_parasitaire_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                    </div>
                    <hr>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="amiante_diagnostic">@lang('Amiante') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $amiante_diagnostic = $bien->amiante_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($amiante_diagnostic == "Non précisé") checked  @endif value="@lang('Non précisé')" name="amiante_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($amiante_diagnostic == "Oui") checked  @endif value="@lang('Oui')" name="amiante_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($amiante_diagnostic == "Non") checked  @endif value="@lang('Non')" name="amiante_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->amiante_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                {{-- Affiche ou masque la zone --}}
                <div id="amiante_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="amiante_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->amiante_date_diagnostic}}" class="form-control "  id="amiante_date_diagnostic" name="amiante_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->amiante_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="amiante_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="amiante_commentaire_diagnostic" class="form-control" id="amiante_commentaire_diagnostic" cols="8" rows="3">{{$bien->amiante_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->amiante_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>
                    <hr>
                </div>
            </div>
        {{-- div pour afficher ou masquer ce bloc--}}
        <div id="diagnostic_plus"> 
            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="electrique_diagnostic">@lang('Électrique') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $electrique_diag = $bien->electrique_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($electrique_diag == "Non précisé") checked  @endif value="@lang('Non précisé')" name="electrique_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($electrique_diag == "Oui") checked  @endif value="@lang('Oui')" name="electrique_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($electrique_diag == "Non") checked  @endif value="@lang('Non')" name="electrique_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->electrique_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                {{-- Affiche ou masque la zone --}}
                <div id="electrique_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="electrique_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->electrique_date_diagnostic}}" class="form-control "  id="electrique_date_diagnostic" name="electrique_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->electrique_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="electrique_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="electrique_commentaire_diagnostic" class="form-control" id="electrique_commentaire_diagnostic" cols="8" rows="3">{{$bien->electrique_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->electrique_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>
                    <hr>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="loi_carrez_diagnostic">@lang('Loi Carrez') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $loi_carrez_dia = $bien->loi_carrez_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($loi_carrez_dia == "Non précisé") checked  @endif value="@lang('Non précisé')" name="loi_carrez_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($loi_carrez_dia == "Oui") checked  @endif value="@lang('Oui')" name="loi_carrez_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($loi_carrez_dia == "Non") checked  @endif value="@lang('Non')" name="loi_carrez_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->loi_carrez_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                    {{-- Affiche ou masque la zone --}}
                <div id="loi_carrez_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="loi_carrez_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->loi_carrez_date_diagnostic}}" class="form-control "  id="loi_carrez_date_diagnostic" name="loi_carrez_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->loi_carrez_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="loi_carrez_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="loi_carrez_commentaire_diagnostic" class="form-control" id="loi_carrez_commentaire_diagnostic" cols="8" rows="3">{{$bien->loi_carrez_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->loi_carrez_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   

                </div>

                    <hr>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="risque_nat_diagnostic">@lang('Risques nat. et tech') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $risque_nat = $bien->risque_nat_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($risque_nat == "Non précisé") checked  @endif value="@lang('Non précisé')" name="risque_nat_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($risque_nat == "Oui") checked  @endif value="@lang('Oui')" name="risque_nat_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($risque_nat == "Non") checked  @endif value="@lang('Non')" name="risque_nat_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->risque_nat_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                {{-- Affiche ou masque la zone --}}
                <div id="risque_nat_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="risque_nat_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->risque_nat_date_diagnostic}}" class="form-control "  id="risque_nat_date_diagnostic" name="risque_nat_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->risque_nat_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="risque_nat_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="risque_nat_commentaire_diagnostic" class="form-control" id="risque_nat_commentaire_diagnostic" cols="8" rows="3">{{$bien->risque_nat_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->risque_nat_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>
                    <hr>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="plomb_diagnostic">@lang('Plomb') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $plomb_diagnostic = $bien->plomb_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($plomb_diagnostic == "Non précisé") checked  @endif value="@lang('Non précisé')" name="plomb_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($plomb_diagnostic == "Oui") checked  @endif value="@lang('Oui')" name="plomb_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($plomb_diagnostic == "Non") checked  @endif value="@lang('Non')" name="plomb_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->plomb_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                {{-- Affiche ou masque la zone --}}
                <div id="plomb_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="plomb_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->plomb_date_diagnostic}}" class="form-control "  id="plomb_date_diagnostic" name="plomb_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->plomb_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="plomb_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="plomb_commentaire_diagnostic" class="form-control" id="" cols="8" rows="3">{{$bien->plomb_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->plomb_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>

                    <hr>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="gaz_diagnostic">@lang('Gaz') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $gaz_diagnostic = $bien->gaz_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($gaz_diagnostic == "Non précisé") checked  @endif value="@lang('Non précisé')" name="gaz_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($gaz_diagnostic == "Non précisé") checked  @endif value="@lang('Oui')" name="gaz_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($gaz_diagnostic == "Non précisé") checked  @endif value="@lang('Non')" name="gaz_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->gaz_diagnostic}}
                            </div>
                        </div>                                    
                    </div>
                    {{-- Affiche ou masque la zone --}}
                <div id="gaz_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="gaz_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->gaz_date_diagnostic}}" class="form-control "  id="gaz_date_diagnostic" name="gaz_date_diagnostic" placeholder=""> 
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->gaz_date_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="gaz_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="gaz_commentaire_diagnostic" class="form-control" id="gaz_commentaire_diagnostic" cols="8" rows="3">{{$bien->gaz_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->gaz_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>
                    <hr>
                </div>


            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-md-4 col-form-label" for="assainissement_diagnostic">@lang('Assainissement') </label>
                <div class="col-lg-6 col-md-6">                           
                    
                    <div class="row">                                         
                        <div class="form-group row">
                            
                            <div class="col-lg-10 col-md-10 hide_champ_diagnostic">
                                @php  $assainissement_diag = $bien->assainissement_diagnostic @endphp
                                <label class="radio-inline"><input type="radio" @if($assainissement_diag == "Non précisé") checked  @endif value="@lang('Non précisé')" name="assainissement_diagnostic" checked>@lang('Non précisé')</label>
                                <label class="radio-inline"><input type="radio" @if($assainissement_diag == "Oui") checked  @endif value="@lang('Oui')" name="assainissement_diagnostic" >@lang('Oui')</label>
                                <label class="radio-inline"><input type="radio" @if($assainissement_diag == "Non") checked  @endif value="@lang('Non')" name="assainissement_diagnostic">@lang('Non')</label>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->assainissement_diagnostic}}
                            </div>
                        </div>                                    
                    </div>

                    {{-- Affiche ou masque la zone --}}
                <div id="assainissement_oui_diagnostic">
                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-5 col-md-5 col-form-label" for="assainissement_date_diagnostic">@lang('Date') </label>
                            <div class="col-lg-7 col-md-7 hide_champ_diagnostic">
                                <input type="date" value="{{$bien->assainissement_date_diagnostic}}" class="form-control "  id="assainissement_date_diagnostic" name="assainissement_date_diagnostic" placeholder=""> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                            {{$bien->assainissement_date_diagnostic}}
                        </div>                                    
                    </div>

                    <div class="row">                                         
                        <div class="form-group row">
                            <label class="col-lg-12 col-md-12 col-form-label" for="assainissement_commentaire_diagnostic">@lang('Commentaires'): </label>
                            <div class="col-lg-12 col-md-12 hide_champ_diagnostic">
                                <textarea name="assainissement_commentaire_diagnostic" class="form-control" id="assainissement_commentaire_diagnostic" cols="8" rows="3">{{$bien->assainissement_commentaire_diagnostic}}</textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 show_champ_diagnostic">
                                {{$bien->assainissement_commentaire_diagnostic}}
                            </div>
                        </div>                                    
                    </div>   
                </div>
                    <hr>
                </div>
            </div>
        </div>

        </div>
        
    </div>
</div>

</form>

</div>