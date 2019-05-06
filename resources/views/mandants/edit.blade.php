@extends('layouts.main.dashboard')
@section('header_name')
    Modification des informations d' un mendant
@stop
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
            <h2>@lang('Modifier un mandant')</h2>
            
            
            @if($mandant->type == "personne_seule")
                @include('compenents.mandants.editPersonneSeule')
            @elseif($mandant->type == "couple")            
                @include('compenents.mandants.editCouple')
            @elseif($mandant->type == "personne_morale")            
                @include('compenents.mandants.editPersonneMorale')
            @endif
          
            {{-- <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                <h3></h3>
                <p></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <p>@include('compenents.mandants.addCouple')</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <p>@include('compenents.mandants.addPersonneMorale')</p>
                </div>
                
            </div> --}}

        </div>

    
        
@endsection

@section('js-content')    


<script>
    // modifie le style du  boutton datalist search 
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
    
            @foreach($emails_mandant as $email_ac)
                    liste_emails.push('{{$email_ac}}');
            @endforeach
    
    
            $('#assoc').click(function(){
                value_id = $('#contact_associe').val();
                
                value_nom = $('select#contact_associe option[value="'+value_id+'"]').text();
                value_titre = $('#titre').val();
    
                if(value_id != null){
    
                $('#liste_assoc').append('<div > <input type="hidden"  value="'+value_titre+'" name="contacts_associes_titre[]"  > <input type="hidden"  value="'+value_id+'" name="contacts_associes_nom[]"  > </div>');
                $('tbody#tbodi').append('<tr>'+
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

        
        $('#div_associer_contact').hide();
        $('#div_liste_contact').hide();

        $('#btn_div_associer_contact').click(function(){
            $('#div_associer_contact').slideToggle();
        });
        
        $('#btn_div_liste_contact').click(function(){
            $('#div_liste_contact').slideToggle();
        });
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
            
            type_mandant = $('#type_mandant_nc').val();
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
            '<input type="hidden"  value="'+type_mandant+'" name="type_mandant_send[]"  >'+ 
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
            
            $('tbody#tbodi').append('<tr>'+
                '<td>'+titre_nc+'</td>'+
                '<td>'+nom_nc+'</td>'+
                '<tr>');
    
        }
            
        });
    
    
    
    </script>
    
    {{-- ****************** FIN SCRIPT POUR PERSONNE MORALE **************************--}}

    {{-- Dissocier un contact --}}
    <script>
    
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
            title: '@lang('Vraiment dissocier ce contact  ?')',
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
                'Dissocié!',
                'Le contact a bien été dissocié.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'Le contact a pas été dissocié :)',
                'error'
                )
            }
        })
            })
        })
    </script>

    @endsection