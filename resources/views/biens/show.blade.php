@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12">
      @if (session('ok'))
      <div class="alert alert-success alert-dismissible fade in">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
      </div>
      @endif    
      <div class="row">
         <!-- Navigation Buttons -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-pills nav-tabs" id="myTabs">
               <li id="li_home_nav" class="active"><a href="#home_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">home</i> @lang('ACCUEIL')</a></li>
               <li id="li_caracteristique_nav"><a href="#caracteristique_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">info_outline</i> @lang('CARACTERISTIQUES')</a></li>
               <li ><a href="#prix_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">euro_symbol</i> @lang('PRIX')</a></li>
               <li ><a href="#secteur_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">map</i> @lang('SECTEUR')</a></li>
               <li ><a href="#photo_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">perm_media</i> @lang('PHOTOS / MEDIAS')</a></li>
               <li ><a href="#impression_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">print</i> @lang('IMPRESSIONS')</a></li>
               <li ><a href="#reporting_nav" data-toggle="pill"> <i class="material-icons" style="font-size: 15px;">pie_chart</i> @lang('REPORTING')</a></li>
            </ul>
         </div>
         <!-- Content -->
         <div class=" col-lg-9 col-md-9 col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="tab-content">
                     <div class="tab-pane active" id="home_nav"> @include('compenents.biens.show.accueil')</div>
                     <div class="tab-pane" id="caracteristique_nav">@include('compenents.biens.show.caracteristique')</div>
                     <div class="tab-pane" id="prix_nav">@include('compenents.biens.show.prix')</div>
                     <div class="tab-pane" id="secteur_nav">@include('compenents.biens.show.secteur')</div>
                     <div class="tab-pane" id="photo_nav">@include('compenents.biens.show.photo_medias')</div>
                     <div class="tab-pane" id="impression_nav">@include('compenents.biens.show.impression')</div>
                     <div class="tab-pane" id="document_nav">@include('compenents.biens.show.document')</div>
                     <div class="tab-pane" id="reporting_nav">@include('compenents.biens.show.reporting')</div>
                     <div class="tab-pane" id="contact_nav">@include('compenents.biens.show.contact')</div>
                  </div>
               </div>
            </div>
         </div>
         <div class=" col-lg-3 col-md-3 col-sm-12">
            <div class="card">
               <div class="card-header" style="text-align: center;">
                  <strong>Statut du bien</strong>
                  <br><br>
                  <input type="checkbox" checked data-toggle="toggle" id="archive_bn" name="archive_bn" data-off="Archivé" data-on="Actuel" data-onstyle="success" data-offstyle="warning">
               </div>
               <div class="card-body">
                  <ul class="timeline">
                     <li>
                        <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid #1de9b6; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title"><strong>EN ESTIMATION</strong></h5>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid #1de9b6; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title"><strong>BIEN ACTIF</strong></h5>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="timeline-badge danger" ><i class="fa fa-times-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid red; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title">SOUS OFFRE</h5>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="timeline-badge danger"><i class="fa fa-times-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid red; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title">SOUS COMPROMIS</h5>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="timeline-badge danger"><i class="fa fa-times-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid red; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title">VENDU</h5>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="timeline-badge danger"><i class="fa fa-times-circle-o"></i></div>
                        <div class="timeline-panel" style="border: 1px solid red; border-style: groove; border-radius: 30px;">
                           <div class="timeline-heading">
                              <h5 class="timeline-title">MANDAT CLOS</h5>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class=" col-lg-3 col-md-3 col-sm-12">
            <div class="card">
               <div class="card-header" style="text-align: center;">
                  <strong>Actions associées</strong>
               </div>
               <br><br>
               <div class="card-body">
                  <div class="col-md-4 col-lg-4 col-sm-4" style="text-align: center;">
                     <a  class="btn btn-default btn-outline" id="btn_update_dossier_dispo">
                     <i class="material-icons">work_outline</i>
                     </a>         
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4" style="text-align: center;">
                     <a  class="btn btn-default btn-outline" id="btn_update_dossier_dispo">
                     <i class="material-icons">tv</i>
                     </a>         
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4" style="text-align: center;">
                     <a  class="btn btn-success" id="btn_update_dossier_dispo">
                     <i class="material-icons">share</i>
                     </a>         
                  </div>
               </div>
            </div>
         </div>
         <div class=" col-lg-3 col-md-3 col-sm-12">
            <div class="card">
               <div class="card-header" style="text-align: center;">
                  <strong>Rapprochement </strong>
               </div>
               <br><br>
               <div class="card-body">
                  <div class="col-md-6 col-lg-6 col-sm-6" style="text-align: center;">
                     <a type="button" class="btn btn-warning btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-briefcase"></i>Mes acquéreurs <span class="badge badge-danger" style="border-radius: 112px 112px 112px 112px;background: red; color: white;">7</span></a>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6" style="text-align: center;">
                     <a type="button" class="btn btn-success btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-world"></i>Réseau <span class="badge badge-danger" style="border-radius: 112px 112px 112px 112px;background: red; color: white;">19</span></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js-content')
<script>
   //{{-- CARACTERISTIQUE --}}
   function masquerDiv(id_zone_masque, id_bouton_clic){
       
       $(id_bouton_clic).click(function(){
           $(id_zone_masque).slideToggle();        
           $(this,'.ti-minus').toggleClass("ti-plus") ;            
       });
   }
   
   function masquerRadio(champ_radio, div_radio){
   
   $('input[type=radio][name='+champ_radio+']').change(function() {
       (this.value == 'Oui') ? $(div_radio).slideDown() : $(div_radio).slideUp() ;   
   });
   }
   
   
   masquerDiv(div_clic_masquer_infos_bien,btn_clic_masquer_infos_bien);
   
   // boutons radio pour agencement extérieur
   masquerRadio("terrasse_agencement_exterieur","#terrasse_oui_agencement_exterieur");
   masquerRadio("type_cave_agencement_exterieur","#type_cave_oui_agencement_exterieur");
   masquerRadio("balcon_agencement_exterieur","#balcon_oui_agencement_exterieur");
   masquerRadio("loggia_agencement_exterieur","#loggia_oui_agencement_exterieur");
   masquerRadio("veranda_agencement_exterieur","#veranda_oui_agencement_exterieur");
   // boutons radio pour terrain
   masquerRadio("constructible_terrain","#constructible_oui_terrain");
   // boutons radio pour équipement
   masquerRadio("climatisation_equipement","#climatisation_oui_equipement");
   // boutons radio pour Diagnostics & compléments
   masquerRadio("etat_parasitaire_diagnostic","#etat_parasitaire_oui_diagnostic");
   masquerRadio("amiante_diagnostic","#amiante_oui_diagnostic");
   masquerRadio("electrique_diagnostic","#electrique_oui_diagnostic");
   masquerRadio("loi_carrez_diagnostic","#loi_carrez_oui_diagnostic");
   masquerRadio("risque_nat_diagnostic","#risque_nat_oui_diagnostic");
   masquerRadio("plomb_diagnostic","#plomb_oui_diagnostic");
   masquerRadio("gaz_diagnostic","#gaz_oui_diagnostic");
   masquerRadio("assainissement_diagnostic","#assainissement_oui_diagnostic");
   
   $('.hide_champ_agi').hide();
   $('.hide_champ_age').hide();
   $('.hide_champ_equipement').hide();
   $('.hide_champ_terrain').hide();
   $('.hide_champ_diagnostic').hide();
   $('.hide_champ_principal').hide();
   $('.hide_champ_vitrine').hide();
   $('.hide_champ_privee').hide();
   
   // on cache les boutons d'enregistrement par defaut 
   $('#btn_enregistrer_caract').hide();
   $('#btn_enregistrer_prix').hide();
   $('#btn_enregistrer_secteur').hide();
   
   
   
   $('#bloc_carac').on('click','#btn_update_agi',function(){
     $('.show_champ_agi').hide();
     $('.hide_champ_agi').show();
     $('#btn_enregistrer_caract').show();
   
   });
   
   
   $('#bloc_carac').on('click','#btn_update_age',function(){
     $('.show_champ_age').hide();
     $('.hide_champ_age').show();
     $('#btn_enregistrer_caract').show();
   });
   
   $('#bloc_carac').on('click','#btn_update_equipement',function(){
     $('.show_champ_equipement').hide();
     $('.hide_champ_equipement').show();
     $('#btn_enregistrer_caract').show();
   });
   
   
   $('#bloc_carac').on('click','#btn_update_diagnostic',function(){
     $('.show_champ_diagnostic').hide();
     $('.hide_champ_diagnostic').show();
     $('#btn_enregistrer_caract').show();
   });
   
   
   $('#bloc_carac').on('click','#btn_update_terrain',function(){
     $('.show_champ_terrain').hide();
     $('.hide_champ_terrain').show();
     $('#btn_enregistrer_caract').show();
   });
   
   
   $('#bloc_carac').on('click','#btn_update_principal',function(){
     $('.show_champ_principal').hide();
     $('.hide_champ_principal').show();
     $('#btn_enregistrer_caract').show();
   });
   
   $('#bloc_carac').on('click','#btn_update_vitrine',function(){
     $('.show_champ_vitrine').hide();
     $('.hide_champ_vitrine').show();
     $('#btn_enregistrer_caract').show();
   });
   
   $('#bloc_carac').on('click','#btn_update_prive',function(){
     $('.show_champ_privee').hide();
     $('.hide_champ_privee').show();
     $('#btn_enregistrer_caract').show();
   });
   // {{-- FIN CARACTERISTIQUE --}}
   
   
   // {{--  PRIX --}}
   $('.hide_champ_infos_prix').hide();
   $('.hide_champ_dossier_dispo').hide();
   
   
   
   $('#bloc_prix').on('click','#btn_update_infos_prix',function(){
     $('.show_champ_infos_prix').hide();
     $('.hide_champ_infos_prix').show();
     $('#btn_enregistrer_prix').show();
   });
   
   $('#bloc_prix').on('click','#btn_update_dossier_dispo',function(){
     $('.show_champ_dossier_dispo').hide();
     $('.hide_champ_dossier_dispo').show();
     $('#btn_enregistrer_prix').show();
   });
   
   
   // {{--  PRIX --}}
   
   
   // {{-- SECTEUR --}}
   $('.hide_champ_secteur').hide();
   
   $('#bloc_secteur').on('click','#btn_update_secteur',function(){
     $('.show_champ_secteur').hide();
     $('.hide_champ_secteur').show();
     $('#btn_enregistrer_secteur').show();
   
   });
   
   // {{-- FIN SECTEUR --}}
   
</script>
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   // cette fonction permet de réccupérer les photos du bloc id et de recalculer leurs positions afin de l'afficher 
   // dans le span (children[0])   
   function display_position(id){           
         // élement du dom sur lequel on clic
         var index = $('ul'+id+' li').index(this);
         var list = $('ul'+id+' li');
   
         //on reparcour les photos pour leur attribuer une position
         for(var i = 0; i < list.length; i++){
           list[i].children[0].innerHTML = i+1;
         } 
   }
   
   display_position("#sortable_visible");
   display_position("#sortable_invisible");
   
   
   // @@@@@@@@ Liste des photos visibles
     
   $('#btn_save_visible').hide();
   
     $( function() {
         $( "#sortable_visible" ).sortable({
           grid: [ 20, 10 ],
         });
     } );
   
     $('#sortable_visible').mousemove(function () {
         display_position("#sortable_visible");
         
     });
     
     
     $('#sortable_visible').mouseup(function () {
       $('#btn_save_visible').show();
         
     });
    
       // Ajouter une photo visible 
       $('#div_add_photo_visible').hide();
   
       $('#clic_add_photo_visible').click(function(){
         $('#div_add_photo_visible').fadeIn();
       });
   
       $('#refresh_div_visible').click(function(){
         $('#div_add_photo_visible').fadeOut();
         $("#sortable_visible").load(" #sortable_visible");
       });
       
   
       $('#btn_save_visible').click(function(){
          
           // élement du dom sur lequel on clic
           var list_id = $('ul#sortable_visible div');
           var list_id_tab = Array();
           // var list_position = $('ul#sortable_visible li');
           
           //on reparcour les photos pour leur attribuer une position
           for(var i = 0; i < list_id.length; i++){
             // console.log(list_id[i].getAttribute("id"));
             list_id_tab.push(list_id[i].getAttribute("id"));
             i++;
   
           } 
           
           //On envoie les nouvelles positions pour les sauvegarder
           $.ajax({
             type : "POST",
             url: '/images-update',
             datatype: 'json',
             data : {"list" : JSON.stringify(list_id_tab)},
   
               success: function(data){
                  console.log(data);
                 swal("Super!", "Nouvelles positions enregistrées!", "success");
               },
               error: function(data){
                  console.log(data);
               },
   
   
           });
          
           $('#btn_save_visible').hide();
       });
       
       
       
     // @@@@@@@@@ fin
     
   
   
     // @@@@@@@@ Liste des photos invisibles
     $('#btn_save_invisible').hide();
     $( function() {
         $( "#sortable_invisible" ).sortable({
           grid: [ 20, 10 ]
         });
     } );
   
     $("ul#sortable_invisible li").mousemove(function () {
       display_position("#sortable_invisible");
       
     });
   
      $('#sortable_invisible').mouseup(function () {
       $('#btn_save_invisible').show();
         
     });
    
       // Ajouter une photo invisible 
       $('#div_add_photo_invisible').hide();
   
       $('#clic_add_photo_invisible').click(function(){
         $('#div_add_photo_invisible').fadeIn();
       });
   
       $('#refresh_div_invisible').click(function(){
         $('#div_add_photo_invisible').fadeOut();
         $("#sortable_invisible").load(" #sortable_invisible");
       });
       
   
       $('#btn_save_invisible').click(function(){
          
           // élement du dom sur lequel on clic
           var list_id = $('ul#sortable_invisible div');
           var list_id_tab = Array();
           // var list_position = $('ul#sortable_invisible li');
           
           //on reparcour les photos pour leur attribuer une position
           for(var i = 0; i < list_id.length; i++){
             // console.log(list_id[i].getAttribute("id"));
             list_id_tab.push(list_id[i].getAttribute("id"));
             i++;
   
           } 
           
           //On envoie les nouvelles positions pour les sauvegarder
           $.ajax({
             type : "POST",
             url: '/images-update',
             datatype: 'json',
             data : {"list" : JSON.stringify(list_id_tab)},
   
               success: function(data){
                  console.log((data));
                 swal("Super!", "Nouvelles positions enregistrées!", "success");
               },
               error: function(data){
                  console.log(data);
               },
   
   
           });
          
           $('#btn_save_invisible').hide();
       });
       
     
     // @@@@@@@@@ fin
     
   
   
   
     //@@@@@@@@@@@@@@@@@@@@@ SUPPRESSION DES PHOTOS DU BIEN @@@@@@@@@@@@@@@@@@@@@@@@@@
   
   $( document ).ready(function() {
    
   $(function() {
       $.ajaxSetup({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
       })
       $('[data-toggle="tooltip"]').tooltip()
       $('#photos').on('click','.delete',function(e) {
           let that = $(this)
           e.preventDefault()
           const swalWithBootstrapButtons = swal.mixin({
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
       })
   
   swalWithBootstrapButtons({
       title: '@lang('Vraiment supprimer cette photo  ?')',
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#DD6B55',
       confirmButtonText: '@lang('Oui')',
       cancelButtonText: '@lang('Non')',
       
   }).then((result) => {
       if (result.value) {
           // $('[data-toggle="tooltip"]').tooltip('hide')
               $.ajax({                        
                   url: that.attr('href'),
                   type: 'GET'
               })
               .done(function () {
                       // that.parents('tr').remove()
                      that.parent().parent().parent().remove();
                       
                          
         
         var index = $('ul#sortable_visible li').index(this);
         var list = $('ul#sortable_visible li');        
         for(var i = 0; i < list.length; i++){
           list[i].children[0].innerHTML = i+1;
           // console.log(list[i].children[0].innerHTML);
         }                    
   
   
   
               })
   
           swalWithBootstrapButtons(
           'Supprimé!',
           'Photo supprimée.',
           'success'
           )
           
           
       } else if (
           result.dismiss === swal.DismissReason.cancel
       ) {
           swalWithBootstrapButtons(
           'Annulé',
           'Cette photo n\'a pas été supprimée :)',
           'error'
           )
       }
   })
       })
   })
   
   });
    //@@@@@@@@@@@@@@@@@@@@@ FIN @@@@@@@@@@@@@@@@@@@@@@@@@@
   
   
    //@@@@@@@@@@@@@@@@@@@@@ MODIFICATION DES BIENS @@@@@@@@@@@@@@@@@@@@@@@@@@
   
   
   
   // @@@ Modification du bloc caractéristique
   $( document ).ready(function() {   
    $(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })
        $('[data-toggle="tooltip"]').tooltip()
        $('#bloc_carac').on('click','#btn_enregistrer_caract',function(e) {
            let that = $(this)
            e.preventDefault()
            const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        })
   
    swalWithBootstrapButtons({
        title: '@lang('Voulez-vous vraiment enregistrer ?')',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: '@lang('Oui')',
        cancelButtonText: '@lang('Non')',
        
    }).then((result) => {
        if (result.value) {
            // $('[data-toggle="tooltip"]').tooltip('hide')
                $.ajax({                        
                    url: '{{route('bien.update',$bien->id)}}',
                    type: 'POST',
                    data: $('form#caracter').serialize(),
                    success: function(data){
                       console.log(data);
                    },
                    error:function(data){
                      console.log(data);
                    }
   
                })
                .done(function () {
                 
                 // location.reload();
                  
                 $("#bloc_carac").load(" #bloc_carac",function(){
                   ready: {
                     $('#btn_enregistrer_caract').hide();
                     
                     $('.hide_champ_agi').hide();
                     $('.hide_champ_age').hide();
                     $('.hide_champ_equipement').hide();
                     $('.hide_champ_terrain').hide();
                     $('.hide_champ_diagnostic').hide();
                     $('.hide_champ_principal').hide();
                     $('.hide_champ_vitrine').hide();
                     $('.hide_champ_privee').hide();
                   }  
                 });
               
   
                })
   
            swalWithBootstrapButtons(
            'Enregistré!',
            'Vos données ont été sauvegardées.',
            'success'
            )
            
            
        } else if (
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
            'Annulé',
            'Enregistrement non éffectué :)',
            'error'
            )
        }
    })
        })
    })
   
   });
   // Fin modification bloc caracteristique
   
   // @@@ Modification du bloc prix
   $( document ).ready(function() {   
    $(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })
        $('[data-toggle="tooltip"]').tooltip()
        $('#bloc_prix').on('click','#btn_enregistrer_prix',function(e) {
            let that = $(this)
            e.preventDefault()
            const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        })
   
    swalWithBootstrapButtons({
        title: '@lang('Voulez-vous vraiment enregistrer ?')',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: '@lang('Oui')',
        cancelButtonText: '@lang('Non')',
        
    }).then((result) => {
        if (result.value) {
            // $('[data-toggle="tooltip"]').tooltip('hide')
                $.ajax({                        
                    url: '{{route('bien.update',$bien->id)}}',
                    type: 'POST',
                    data: $('form#prix').serialize(),
                    success: function(data){
                       console.log(data);
                    },
                    error:function(data){
                      console.log(data);
                    }
   
                })
                .done(function () {
                 
                 // location.reload();
                  
                 $("#bloc_prix").load(" #bloc_prix",function(){
                   ready: {
                     $('#btn_enregistrer_prix').hide();
                     
                     $('.hide_champ_infos_prix').hide();
                     $('.hide_champ_dossier_dispo').hide();
           
                   }  
                 });
               
   
                })
   
            swalWithBootstrapButtons(
            'Enregistré!',
            'Vos données ont été sauvegardées.',
            'success'
            )
            
            
        } else if (
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
            'Annulé',
            'Enregistrement non éffectué :)',
            'error'
            )
        }
    })
        })
    })
   
   });
   // @@@@@@ Fin modification prix
   
   // @@@ Modification du bloc secteur
   $( document ).ready(function() {   
    $(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })
        $('[data-toggle="tooltip"]').tooltip()
        $('#bloc_secteur').on('click','#btn_enregistrer_secteur',function(e) {
            let that = $(this)
            e.preventDefault()
            const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        })
   
    swalWithBootstrapButtons({
        title: '@lang('Voulez-vous vraiment enregistrer ?')',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: '@lang('Oui')',
        cancelButtonText: '@lang('Non')',
        
    }).then((result) => {
        if (result.value) {
            // $('[data-toggle="tooltip"]').tooltip('hide')
                $.ajax({                        
                    url: '{{route('bien.update',$bien->id)}}',
                    type: 'POST',
                    data: $('form#secteur').serialize(),
                    success: function(data){
                       console.log(data);
                    },
                    error:function(data){
                      console.log(data);
                    }
   
                })
                .done(function () {
                 
                 // location.reload();
                  
                 $("#bloc_secteur").load(" #bloc_secteur",function(){
                   ready: {
                     $('#btn_enregistrer_secteur').hide();
                     $('.hide_champ_secteur').hide();
   
                   }  
                 });
               
   
                })
   
            swalWithBootstrapButtons(
            'Enregistré!',
            'Vos données ont été sauvegardées.',
            'success'
            )
            
            
        } else if (
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
            'Annulé',
            'Enregistrement non éffectué :)',
            'error'
            )
        }
    })
        })
    })
   
   });
   // @@@@@@ Fin modification secteur
   
   
     //@@@@@@@@@@@@@@@@@@@@@ FIN @@@@@@@@@@@@@@@@@@@@@@@@@@
   
     
</script>
@endsection