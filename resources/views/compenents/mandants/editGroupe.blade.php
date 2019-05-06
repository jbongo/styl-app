@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    @section('pageActuelle')
    @lang('Modification d\'mandants')
    @endsection
    
    <div class="card alert">
        
        <a href="{{route('mandants.index')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-arrow-left "></i>@lang('Liste des mandants')</a>
        <br>
        <br>
    <h2>@lang('Modifier le groupe ') "{{$groupe->nom_groupe}}"</h2>


        <div class="card-body">
                @if (session('ok'))
            
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        
                        <strong> {{ session('ok') }}</strong>
                </div>
            @endif
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-success media-left media-middle">
                                    <i class="ti-link  f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Liste des membres') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>                
            <div class="form-validation">
                    <form class="form-valide" id="formgroupe" action="{{ route('groupemandant.update', $groupe->id) }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="" value="succession_personne" name="type_mandant">

                    <br>
                    <br>
                    <div class="row">
                            <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nom_groupe">@lang('Nom du groupe ( ou succession)') <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                    <input type="text" class="form-control" value="{{old('nom_groupe') ? old('nom_groupe') : $groupe->nom_groupe}}" id="nom_groupe" name="nom_groupe" placeholder="Nom du groupe.." >
                                    <br>
                                    <div class="alert alert-warning " id="nom_groupe_error">
                                        <strong>@lang('Le champ Nom du groupe est obligatoire')</strong> 
                                    </div>
                                    <div class="alert alert-warning " id="nomgroupe_existe_error">
                                        <strong>@lang('cet nom existe déja')</strong> 
                                    </div>
                                    </div>
                                </div>            
                            
                            <div class="col-md-6 col-lg-6">                                    
            
                                <fieldset>
                            
        
                                    <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="membre_succession">@lang('Selectionner un membre') </label>
                                            <div class="col-lg-8">
        
                                                <select class="selectpicker col-lg-6" id="membre_succession" name="membre_succession" data-live-search="true" data-style="btn-warning" >
                                                       
                                                    @foreach($mandant_non_membres as $mandant_non_membre)
                                                    
                                                        <option  value="{{$mandant_non_membre->id}}" mail="{{$mandant_non_membre->email}}" data-tokens="{{$mandant_non_membre->nom}} {{$mandant_non_membre->prenom}}">{{$mandant_non_membre->civilite}}  {{$mandant_non_membre->nom}} {{$mandant_non_membre->prenom}}</option>
                                                        
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
                       
                            
                                <input type="hidden" class="" value="personne_seule_succession" id="type_mandant" name="type_mandant_succession">
                        
                                
        
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
                {{-- End div_contact_associer --}}

                <div >

                        <br>
                        <br>
                        {{-- table2 --}}
                        
                        <br>
                            <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: inherit !important;">
                                        <table  id="example" class=" table student-data-table  m-t-20 "  style="width:70%">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Civilité')</th>                                        
                                                    <th>@lang('Nom')</th>                                        
                                                    <th>@lang('Email')</th>
                                                    <th>@lang('Modifier')</th>                                        

                                                    <th>@lang('Supprimer du groupe')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($groupe->mandants as $associe)
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
                                                            <span><a href="{{route('mandants.edit',$associe->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $associe->nom}} "><i class="ti-pencil-alt color-success"></i></a></span>
                                                    </td>
                                                                                        
                                    
                                                    <td>
                                                        <span><a  href="{{route('mandants.retirer',[$groupe->id, $associe->id])}}" class="dissocier" data-toggle="tooltip" title="@lang('Dissocier ') {{ $associe->nom }}"><i class="btn ti-close  color-danger"></i> </a></span>
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

        </div>

    
        
@endsection

@section('js-content')    



{{-- ******************SCRIPT POUR SUCCESSION DE PERSONNES **************************--}}

{{-- Ajout d'un membre de la succession --}}
<script>

        var liste_emails = Array();
    
            @foreach($emails_mandant as $email_ac)
                    liste_emails.push('{{$email_ac}}');
            @endforeach

        var liste_noms_groupes = Array();

            @foreach($noms_groupes as $nom_gr)
                liste_noms_groupes.push('{{$nom_gr}}');
                
            @endforeach
    
    
            $('#add_membre').click(function(){
                value_id = $('#membre_succession').val();
                
                value_nom = $('select#membre_succession option[value="'+value_id+'"]').text();
                value_email = $('select#membre_succession option[value="'+value_id+'"]').attr('mail');
               
                if(value_id != null){
    
                $('#liste_membre').append('<div > <input type="hidden"  value="'+value_nom+'" > <input type="hidden"  value="'+value_id+'" name="mandants_ajoute_id[]"  > </div>');
                $('tbody#membre').append('<tr>'+
                '<td>'+value_nom+'</td>'+
                '<td>'+value_email+'</td>'+
                '<tr>');
                
                $('select#membre_succession option[value="'+value_id+'"]').attr('disabled','disabled');
    
                }
                
            
            });
    </script>
    
    
    {{-- Ajout d'un membre par formulaire pour une succession de personnes --}}
    <script>
        // afficher ou masquer le formlaire
    
        $('#add_contact_form_succession').hide();
        $('#add_new_contact_succession').click(function(){
          
            $('#add_contact_form_succession').slideToggle();
        });
        // Fin
    
        // validation des champs du formulaire de contact
        $('#nom_error_succession').hide();
        $('#nom_groupe_error').hide();
        $('#email_error_succession').hide();
        $('#email_existe_error_succession').hide();
        $('#nomgroupe_existe_error').hide();

        
        $("form#formgroupe").bind("submit", preventDefault);
            
            function preventDefault(e) {
                e.preventDefault();
            }
        
        nom_gr = 0;
        nom_gr_existe = 0;
        $('#nom_groupe').focusout(function(){
            nom_groupe = $('#nom_groupe').val();

            //###### Si le nom du groupe saisis existe, on affiche un message d'erreur
            if( liste_noms_groupes.indexOf(nom_groupe) != -1 && nom_groupe != "{{$groupe->nom_groupe}}" )
            {
                $('#nomgroupe_existe_error').show();
                nom_gr_existe = 1;
            }

            else{
                $('#nomgroupe_existe_error').hide();
                nom_gr_existe = 0;
            }
            //######
          
            if(nom_groupe == "" || nom_groupe == " " || nom_groupe == "  " || nom_groupe == "   " ){
                $('#nom_groupe_error').show() ; 
    
                $("form#formgroupe").bind("submit", preventDefault);
                nom_gr = 0;
            }else{
                $('#nom_groupe_error').hide();
                nom_gr = 1;
                $("form#formgroupe").unbind("submit", preventDefault);
    
            }
        });
    
        $("form#formgroupe").bind("submit", preventDefault);

        $('#ajouter').click(function(){
            nom_groupe = $('#nom_groupe').val();
            

            //###### Si le nom du groupe saisis existe, on affiche un message d'erreur
            if( liste_noms_groupes.indexOf(nom_groupe) != -1 && nom_groupe != "{{$groupe->nom_groupe}}")
            {
                $('#nomgroupe_existe_error').show();
                nom_gr_existe = 1;
            }

            else{
                $('#nomgroupe_existe_error').hide();
                nom_gr_existe = 0;

            }
            //######
          
            if(nom_groupe == "" || nom_groupe == " " || nom_groupe == "  " || nom_groupe == "   " ){
                $('#nom_groupe_error').show() ;     
                nom_gr = 0;
            }else{
                $('#nom_groupe_error').hide();
                nom_gr = 1;
    
            }
            (nom_gr == 0) ?  $('#nom_groupe_error').show() :  $('#nom_groupe_error').hide() ; 
            
            if(nom_gr == 1 && nom_gr_existe ==0 ) {
            $("form#formgroupe").unbind("submit", preventDefault);

            }
            else{
                $("form#formgroupe").bind("submit", preventDefault);

            }
            
        });
        // Lorsqu'on click sur le bouton ajouter le contact, on verifie les champs
        $('#btn_ajouter_le_contact_succession').click(function(e){
            e.preventDefault();
            
            type_mandant = $('#type_mandant_succession').val();
            nom_groupe = $('#nom_groupe').val();
            civilite_succession = $('#civilite_succession').val();
            nom_succession = $('#nom_succession').val();
            prenom_succession = $('#prenom_succession').val();
            email_succession = $('#email_succession').val();
            adresse_succession = $('#adresse_succession').val();
            code_postal_succession = $('#code_postal_succession').val();
            ville_succession = $('#ville_succession').val();
            pays_succession = $('#pays_succession').val();
            telephone_mobile_succession = $('#telephone_mobile_succession').val();
            telephone_fixe_succession = $('#telephone_fixe_succession').val();
            source_contact_succession = $('#source_contact_succession option:selected ').text();
    
            
            nom_ok = 0;
            email_ok = 0;
            email_exist = 0;
    
            if(nom_succession == "" || nom_succession == " " || nom_succession == "  " || nom_succession == "   " ){
                $('#nom_error_succession').show() ; 
                nom_ok = 0;
            }else{
                $('#nom_error_succession').hide();
                nom_ok = 1;
            }   
            
            if(email_succession == "" || email_succession == " " || email_succession == "  " || email_succession == "   " ){
                $('#email_error_succession').show() 
                email_ok = 0;
            }else{
                $('#email_error_succession').hide();
                email_ok = 1;
            } 
         
            // Si l'email saisis existe, on affiche un message d'erreur
            if( liste_emails.indexOf(email_succession) != -1)
            {
                $('#email_existe_error_succession').show();
                email_exist = 1;
            }
    
            else{
                $('#email_existe_error_succession').hide();
                email_exist = 0;
            }
    
            // si le nom et l'email sont renseignés on enregistre le contact associé
           if(nom_ok == 1 && email_ok==1 && email_exist == 0){
           
            $('#liste_membre').append('<div >'+
            '<input type="hidden"  value="'+type_mandant+'" name="type_mandant_send[]"  >'+ 
            '<input type="hidden"  value="'+civilite_succession+'" name="civilite_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+nom_succession+'" name="nom_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+prenom_succession+'" name="prenom_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+email_succession+'" name="email_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+adresse_succession+'" name="adresse_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+code_postal_succession+'" name="code_postal_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+ville_succession+'" name="ville_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+pays_succession+'" name="pays_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+telephone_mobile_succession+'" name="telephone_mobile_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+telephone_fixe_succession+'" name="telephone_fixe_succession_send[]"  >'+ 
            '<input type="hidden"  value="'+source_contact_succession+'" name="source_contact_succession_send[]"  >'+ 
             '</div>');
            
            // on rajoute l'email à la liste des emails existants
            liste_emails.push(email_succession);
           
            $('#nom_succession').val("");
            $('#prenom_succession').val("");
            $('#email_succession').val("");
            $('#adresse_succession').val("");
            $('#code_postal_succession').val("");
            $('#ville_succession').val("");
            $('#pays_succession').val("");
            $('#telephone_mobile_succession').val("");
            $('#telephone_fixe_succession').val("");
            $('#source_contact_succession').val("");
            
             $('#add_contact_form_succession').hide();
            
            $('tbody#membre').append('<tr>'+
                '<td>'+civilite_succession+' '+nom_succession+' '+prenom_succession+'</td>'+
                '<td>'+email_succession+'</td>'+
                '<tr>');
    
        }
            
        });
    
    </script>
    <script>
        $( document ).ready(function() {
       
    
            $(function() {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                })
                $('[data-toggle="tooltip"]').tooltip()
                $('a.dissocier').click(function(e) {
                    let that = $(this)
                    e.preventDefault()
                    const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
    })
    
            swalWithBootstrapButtons({
                title: '@lang(' Voulez vraiment retirer ce membre ?')',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '@lang('Oui')',
                cancelButtonText: '@lang('Non')',
                
            }).then((result) => {
                if (result.value) {
                    $('[data-toggle="tooltip"]').tooltip('hide')
                        $.ajax({                        
                            url: that.attr('href'),
                            type: 'POST'
                        })
                        .done(function () {
                                that.parents('tr').remove()
                        })
    
                    swalWithBootstrapButtons(
                    'Retiré !',
                    'Membre retiré du groupe.',
                    'success'
                    )
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Annulé',
                    'Ce membre n\'a pas été retiré du groupe :)',
                    'error'
                    )
                }
            })
                })
            })
    
     });
        </script>
    
    {{-- ****************** FIN POUR SUCCESSION DE PERSONNES **************************--}}

@endsection