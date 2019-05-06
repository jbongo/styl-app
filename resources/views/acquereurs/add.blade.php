@extends('layouts.main.dashboard')
@section('header_name')
    Ajouter des acquereurs
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    @section('pageActuelle')
    @lang('Ajout d\'acquereurs')
    @endsection
    
        <div class="card alert">
                <a href="{{route('acquereurs.index')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-arrow-left "></i>@lang('Liste des acquereurs')</a>
                <br>
                <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#home">@lang('Personne seule')</a></li>
                <li><a data-toggle="pill" href="#menu1">@lang('Couple')</a></li>
                <li><a data-toggle="pill" href="#menu2">@lang('Personne morale')</a></li>
                <li><a data-toggle="pill" href="#menu3">@lang('Groupe de personnes')</a></li>
            </ul>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <p>@include('compenents.acquereurs.addPersonneSeule')</p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <p>@include('compenents.acquereurs.addCouple')</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <p>@include('compenents.acquereurs.addPersonneMorale')</p>
                </div>
                <div id="menu3" class="tab-pane fade">
                        <p>@include('compenents.acquereurs.addSuccession')</p>
                </div>
                
            </div>

        </div>

    
        
@endsection

@section('js-content')    


<script>
    $('.selectpicker').selectpicker({
  style: 'btn-info',
  size: 4
});

</script>
<script>


   //surface habitable
   $("#range_23").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1500,
        from: 0,
        to: 1500,
        postfix: " m²",
        hide_min_max: true,
        hide_from_to: false,
        grid: false
    });

    //budget
   $("#range_24").ionRangeSlider({
        type: "double",
        min: 0,
        max: 3000000,
        from: 0,
        to: 1500000,
        postfix: " €",
        hide_min_max: true,
        hide_from_to: false,
        grid: false
    });

</script>



{{-- ******************SCRIPT POUR PERSONNE MORALE **************************--}}

{{-- Ajout d'un contact associe a une personne morale --}}
<script>

        var liste_emails = Array();
    
            @foreach($emails_acquereur as $email_ac)
                    liste_emails.push('{{$email_ac}}');
            @endforeach
    
    
            $('#assoc').click(function(){
                value_id = $('#contact_associe').val();
                
                value_nom = $('select#contact_associe option[value="'+value_id+'"]').text();
                value_titre = $('#titre').val();
    
                if(value_id != null){
    
                $('#liste_assoc').append('<div > <input type="hidden"  value="'+value_titre+'" name="contacts_associes_titre[]"  > <input type="hidden"  value="'+value_id+'" name="contacts_associes_nom[]"  > </div>');
                $('tbody').append('<tr>'+
                '<td>'+value_titre+'</td>'+
                '<td>'+value_nom+'</td>'+
                '<tr>');
                
                
                // $('#liste_assoc').append('<div > <input type="text"  value="'+value_titre+'" disabled  > <input type="text" disabled  value="'+value_nom+'"   > </div>');
                $('select#contact_associe option[value="'+value_id+'"]').attr('disabled','disabled');
    
                }
                
            
            });
    </script>
    
    
    {{-- Ajout d'un contact par formulaire pour une personne morale --}}
    <script>
        // afficher ou masquer le formlaire
    
        $('#add_contact_form').hide();
        $('#add_new_contact').click(function(){
          
            $('#add_contact_form').slideToggle();
        });
        // Fin
    
        // validation des champs du formulaire de contact
        $('#nom_error').hide();
        $('#email_error').hide();
        $('#email_existe_error').hide();
    
        
        // Lorsqu'on click sur le bouton ajouter le contact, on verifie les champs
        $('#btn_ajouter_le_contact').click(function(e){
            e.preventDefault();
            
            type_acquereur = $('#type_acquereur_nc').val();
            titre_nc = $('#titre_nc').val();
            civilite_nc = $('#civilite_nc').val();
            nom_nc = $('#nom_nc').val();
            prenom_nc = $('#prenom_nc').val();
            email_nc = $('#email_nc').val();
            adresse_nc = $('#adresse_nc').val();
            code_postal_nc = $('#code_postal_nc').val();
            ville_nc = $('#ville_nc').val();
            pays_nc = $('#pays_nc').val();
            telephone_mobile_nc = $('#telephone_mobile_nc').val();
            telephone_fixe_nc = $('#telephone_fixe_nc').val();
            source_contact_nc = $('#source_contact_nc option:selected ').text();
    
            
            nom_ok = 0;
            email_ok = 0;
            email_exist = 0;
    
            if(nom_nc == "" || nom_nc == " " || nom_nc == "  " || nom_nc == "   " ){
                $('#nom_error').show() ; 
                nom_ok = 0;
            }else{
                $('#nom_error').hide();
                nom_ok = 1;
            }   
            
            if(email_nc == "" || email_nc == " " || email_nc == "  " || email_nc == "   " ){
                $('#email_error').show() 
                email_ok = 0;
            }else{
                $('#email_error').hide();
                email_ok = 1;
            } 
         
            // Si l'email saisis existe, on affiche un message d'erreur
            if( liste_emails.indexOf(email_nc) != -1)
            {
                $('#email_existe_error').show();
                email_exist = 1;
            }
    
            else{
                $('#email_existe_error').hide();
                email_exist = 0;
            }
    
            // si le nom et l'email sont renseignés on enregistre le contact associé
           if(nom_ok == 1 && email_ok==1 && email_exist == 0){
           
            $('#liste_assoc').append('<div >'+
            '<input type="hidden"  value="'+type_acquereur+'" name="type_acquereur_send[]"  >'+ 
            '<input type="hidden"  value="'+titre_nc+'" name="contacts_associes_titre[]"  >'+ 
            '<input type="hidden"  value="'+civilite_nc+'" name="civilite_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+nom_nc+'" name="nom_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+prenom_nc+'" name="prenom_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+email_nc+'" name="email_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+adresse_nc+'" name="adresse_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+code_postal_nc+'" name="code_postal_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+ville_nc+'" name="ville_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+pays_nc+'" name="pays_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+telephone_mobile_nc+'" name="telephone_mobile_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+telephone_fixe_nc+'" name="telephone_fixe_nc_send[]"  >'+ 
            '<input type="hidden"  value="'+source_contact_nc+'" name="source_contact_nc_send[]"  >'+ 
             '</div>');
            
            // on rajoute l'email à la liste des emails existants
            liste_emails.push(email_nc);
           
            $('#nom_nc').val("");
            $('#prenom_nc').val("");
            $('#email_nc').val("");
            $('#adresse_nc').val("");
            $('#code_postal_nc').val("");
            $('#ville_nc').val("");
            $('#pays_nc').val("");
            $('#telephone_mobile_nc').val("");
            $('#telephone_fixe_nc').val("");
            $('#source_contact_nc').val("");
            
             $('#add_contact_form').hide();
            
            $('tbody').append('<tr>'+
                '<td>'+titre_nc+'</td>'+
                '<td>'+nom_nc+'</td>'+
                '<tr>');
    
        }
            
        });
    
    
    
    </script>
    
    {{-- ****************** FIN SCRIPT POUR PERSONNE MORALE **************************--}}



{{-- ******************SCRIPT POUR SUCCESSION DE PERSONNES **************************--}}

{{-- Ajout d'un membre de la succession --}}
<script>

    var liste_emails = Array();

        @foreach($emails_acquereur as $email_ac)
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

            $('#liste_membre').append('<div > <input type="hidden"  value="'+value_nom+'" > <input type="hidden"  value="'+value_id+'" name="acquereurs_ajoute_id[]"  > </div>');
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
    nom_gr = 0;
    nom_gr_existe = 0;
    function preventDefault(e) {
        e.preventDefault();
    }
    $('#nom_groupe').focusout(function(){
        nom_groupe = $('#nom_groupe').val();

        //###### Si le nom du groupe saisis existe, on affiche un message d'erreur
        if( liste_noms_groupes.indexOf(nom_groupe) != -1)
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

    $('#ajouter_membre').click(function(){

        $("form#formgroupe").bind("submit", preventDefault);
        nom_groupe = $('#nom_groupe').val();
        nom_groupe = $('#nom_groupe').val();

        //###### Si le nom du groupe saisis existe, on affiche un message d'erreur
        if( liste_noms_groupes.indexOf(nom_groupe) != -1)
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
        
        type_acquereur = $('#type_acquereur_succession').val();
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
        '<input type="hidden"  value="'+type_acquereur+'" name="type_acquereur_send[]"  >'+ 
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
        
        $('tbody').append('<tr>'+
            '<td>'+civilite_succession+' '+nom_succession+' '+prenom_succession+'</td>'+
            '<td>'+email_succession+'</td>'+
            '<tr>');

    }
        
    });

</script>

{{-- ****************** FIN POUR SUCCESSION DE PERSONNES **************************--}}

@endsection