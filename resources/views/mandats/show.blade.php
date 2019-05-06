@extends('layouts.main.dashboard')
@section('header_name')
Suivi d'affaire
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@php
 $tab = unserialize($mandat->dossiervente->serialize_doc_mandant);
 $tab2 = unserialize($mandat->dossiervente->serialize_doc_acquereur);
 $tab3 = unserialize($mandat->dossiervente->serialize_doc_bien);
 $det1 = 0;
 $det2 = 0;
 $det3 = 0;
 $role1 = "mdn";
 $role2 = "acq";
 $role3 = "bn";
 $today_cmpr = (strtotime(date("Y-m-d")) - strtotime($mandat->dossiervente->rendez_vous_compromis));
 $today_acte = (strtotime(date("Y-m-d")) - strtotime($mandat->dossiervente->rendez_vous_acte));
 function check($tet, $elem){
    foreach ($tet as $key => $one) {
       if (strcmp($elem[0], $one[0]) === 0)
         return 0;
    }
    return 1;
 }
@endphp
<!--modal groupe include from component-->
@if($mandat->statut === "actif"  || ($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre"))
@if($mandat->dossiervente->status === "debut" || $mandat->dossiervente->status === "offre")
    @include("compenents.affaire.modal.visite")
    @include("compenents.affaire.modal.offre")
    @include("compenents.affaire.modal.appel")
@endif
@include("compenents.affaire.modal.visitelist")
@include("compenents.affaire.modal.offrelist")
@include("compenents.affaire.modal.appellist")
@if($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre" && $mandat->dossiervente->status !== "cloture")
    @include("compenents.affaire.modal.docbien")
    @include("compenents.affaire.modal.docacq")
    @include("compenents.affaire.modal.docmdn")
    @include("compenents.affaire.modal.notairemdn")
    @include("compenents.affaire.modal.notaireacq")
@endif
@if(($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "compromis_signe") && $mandat->dossiervente->notaire_acq_id !== NULL && $mandat->dossiervente->notaire_mdn_id !== NULL)
    @include("compenents.affaire.modal.rdvcompromis")
@endif
@if($mandat->dossiervente->status === "acte_signe" && $mandat->dossiervente->notaire_acq_id !== NULL && $mandat->dossiervente->notaire_mdn_id !== NULL)
    @include("compenents.affaire.modal.rdvacte")
@endif
@endif

<!--modal groupe end-->
<div class="row">
        @include('compenents.affaire.widget')
        <div class="col-lg-12">
           <div class="card">
              <div class="card-body">
                 <div class="row">
                    <div class="col-lg-8">
                       @include('compenents.affaire.ui')
                    </div>
                    <div class="col-lg-4">
                       @include("compenents.affaire.implication")
                       @include("compenents.affaire.taches")               
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     @endsection
     @section('js-content')
     @if($mandat->statut === "actif" || ($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre"))
     <script>
        $(document).ready(function() {
            $('#listvisit').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     <script>
        $(document).ready(function() {
            $('#listoffres').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     <script>
        $(document).ready(function() {
            $('#listappel').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     <script>
        $(document).ready(function() {
            $('#listdocmdn').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     <script>
        $(document).ready(function() {
            $('#listdocbn').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     <script>
        $(document).ready(function() {
            $('#listdocacq').DataTable( {
                "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        }); 
     </script>
     @if($mandat->dossiervente->status === "debut" || $mandat->dossiervente->status === "offre")
     <script>
        $(document).ready(function() {
            switch($('#acquereur_type').val()){
                        case 'personne_seule':
                            $('#df1').show();
                            $('#df2').hide();
                            $('#df3').hide();
                            $('#df4').hide();
                            break;
                        case 'couple':
                            $('#df1').hide();
                            $('#df2').show();
                            $('#df3').hide();
                            $('#df4').hide();
                            break;
                        case 'personne_morale':
                            $('#df1').hide();
                            $('#df2').hide();
                            $('#df3').show();
                            $('#df4').hide();
                            break;
                        default:
                            $('#df1').hide();
                            $('#df2').hide();
                            $('#df3').hide();
                            $('#df4').show();
            }
            $('#acquereur_type').change(function(e){
               switch($('#acquereur_type').val()){
                    case 'personne_seule':
                        $('#df1').show();
                        $('#df2').hide();
                        $('#df3').hide();
                        $('#df4').hide();
                        break;
                    case 'couple':
                        $('#df1').hide();
                        $('#df2').show();
                        $('#df3').hide();
                        $('#df4').hide();
                        break;
                    case 'personne_morale':
                        $('#df1').hide();
                        $('#df2').hide();
                        $('#df3').show();
                        $('#df4').hide();
                        break;
                    default:
                        $('#df1').hide();
                        $('#df2').hide();
                        $('#df3').hide();
                        $('#df4').show();
                }
            });
        });
     </script>
     <script>
        $('.submit89').click(function(e){
            $('.form-valide89').validate();
                if ($('.form-valide89').valid() == true){
                    switch($('#acquereur_type').val()){
                        case 'personne_seule':
                           $('#df2').remove();
                           $('#df3').remove();
                           $('#df4').remove();
                           break;
                        case 'couple':
                           $('#df1').remove();
                           $('#df3').remove();
                           $('#df4').remove();
                           break;
                        case 'personne_morale':
                           $('#df1').remove();
                           $('#df2').remove();
                           $('#df4').remove();
                           break;
                        default:
                           $('#df1').remove();
                           $('#df2').remove();
                           $('#df3').remove();
                    }
                }
        });
     </script>
     @endif
     <!--push docu mandant-->
     <script>
        $('.push88').click(function(e){
             e.preventDefault();
            var level = $('.util input').serialize();
            $('#doc_mandant').modal('toggle');
              $.ajax({
                  type: "POST",
                  url: ("{{Route('affaire.docmdn.store', $mandat->dossiervente->id)}}"),
                  beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                    },
                  data: {
                      doc_mdn: level
                      },
                  success: function(data){
                    console.log(data);
                    swal(
                    'Effectué',
                    'La liste des documents est construite',
                    'success'
                    )
                    .then(function(){
                      location.reload();
                   })
                  },
                  error: function(data){
                    console.log(data);
                    swal(
                    'Echec',
                    'Une erreur est survenue vérifiez votre saisie.',
                    'error'
                    );
                  }
              });
        });
     </script>
     <!--push docu acquéreur-->
     <script>
        $('.pushacq').click(function(e){
             e.preventDefault();
            var level1 = $('.utilacq input').serialize();
            $('#doc_acquereur').modal('toggle');
            console.log(level1);
              $.ajax({
                  type: "POST",
                  url: ("{{Route('affaire.docacq.store', $mandat->dossiervente->id)}}"),
                  beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                    },
                  data: {
                      doc_acq: level1
                      },
                  success: function(data){
                    console.log(data);
                    swal(
                    'Effectué',
                    'La liste des documents est construite',
                    'success'
                    )
                    .then(function(){
                      location.reload();
                   })
                  },
                  error: function(data){
                    console.log(data);
                    swal(
                    'Echec',
                    'Une erreur est survenue vérifiez votre saisie.',
                    'error'
                    );
                  }
              });
        });
     </script>
     <!--push docu bien-->
     <script>
        $('.pushbn').click(function(e){
             e.preventDefault();
            var level2 = $('.utilbn input').serialize();
            $('#doc_bien').modal('toggle');
            console.log(level2);
              $.ajax({
                  type: "POST",
                  url: ("{{Route('affaire.docbn.store', $mandat->dossiervente->id)}}"),
                  beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                    },
                  data: {
                      doc_bn: level2
                      },
                  success: function(data){
                    console.log(data);
                    swal(
                    'Effectué',
                    'La liste des documents est construite',
                    'success'
                    )
                    .then(function(){
                      location.reload();
                   })
                  },
                  error: function(data){
                    console.log(data);
                    swal(
                    'Echec',
                    'Une erreur est survenue vérifiez votre saisie.',
                    'error'
                    );
                  }
              });
        });
     </script>
     <script>
        $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.accept').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })
        
        swalWithBootstrapButtons({
            title: '@lang('Assurez vous de la validité du document continuer?')',
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
                        type: 'get'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })
        
                swalWithBootstrapButtons(
                'Validé!',
                'Le document a été validé !',
                'success'
                )
                .then(function(){
                      location.reload();
                   })
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action est annulée !',
                'error'
                )
            }
        })
            })
        
            $('a.reject').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })
        
        swalWithBootstrapButtons({
            title: '@lang('Voulez-vous rejeter ce document?')',
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
                        type: 'get'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })
        
                swalWithBootstrapButtons(
                'Validé!',
                'Le document a été rejeté !',
                'success'
                )
                .then(function(){
                      location.reload();
                   })
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action est annulée !',
                'error'
                )
            }
        })
            })
            
        })
     </script>
     <!--appels-->
     @if($mandat->dossiervente->status === "debut" || $mandat->dossiervente->status === "offre")
     <script>
        $(document).ready(function() {
            if($('#source').val() === "passerelle")
                $('#tmc').show();
            else
                $('#tmc').hide();
            $('#source').change(function(u){
                u.preventDefault();
                if($('#source').val() === "passerelle")
                    $('#tmc').show();
                else
                    $('#tmc').hide();
            });
        });
     </script>
     <!--visite-->
     <script>
        $(document).ready(function() {
            $('#call').is(':unchecked') ? $('#psg').hide() : $('#psg').show();
            $('#call').change(function(e){
                e.preventDefault();
                $('#call').is(':unchecked') ? $('#psg').hide() : $('#psg').show();
            });
        });
     </script>
     <!--offres-->
     <script>
        $(document).ready(function() {
            $('#vis').is(':unchecked') ? $('#bfa').hide() : $('#bfa').show();
            $('#vis').change(function(e){
                e.preventDefault();
                $('#vis').is(':unchecked') ? $('#bfa').hide() : $('#bfa').show();
            });
        });
     </script>
     @endif
     <!--compromis ++++++ etc-->
     <!--notaires-->
     @if($mandat->dossiervente->notaire_acq_id !== NULL)
     <script>
        $(document).ready(function() {
            $('#rtc1').hide();
            $('.biff1').click(function(e){
                e.preventDefault();
                $('.rtc2').hide();
                $('.stuff1').hide();
                $('#rtc1').show();
            });
            $('.ret1').click(function(e){
                e.preventDefault();
                $('.rtc2').show();
                $('.stuff1').show();
                $('#rtc1').hide();
            });
        });
     </script>
     @endif
     @if($mandat->dossiervente->notaire_mdn_id !== NULL)
     <script>
        $(document).ready(function() {
            $('#rtf1').hide();
            $('.biff2').click(function(e){
                e.preventDefault();
                $('.rtf2').hide();
                $('.stuff2').hide();
                $('#rtf1').show();
            });
            $('.ret2').click(function(e){
                e.preventDefault();
                $('.rtf2').show();
                $('.stuff2').show();
                $('#rtf1').hide();
            });
        });
     </script>
     @endif
     <!--rendez_vous compromis et acte-->
     @if(($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "compromis_signe") && $mandat->dossiervente->notaire_acq_id !== NULL && $mandat->dossiervente->notaire_mdn_id !== NULL)
     <script>
        $(document).ready(function() {
            switch($('#notaire').val()){
                case 'notaire_mdn':
                    $('input[name=adresse]').val('{{$notairemdn->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notairemdn->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notairemdn->notaire->ville}}');
                    break ;
                default:
                    $('input[name=adresse]').val('{{$notaireacq->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notaireacq->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notaireacq->notaire->ville}}');
            }
            $('#bool_addr').change(function(e){
                e.preventDefault();
                if($('#bool_addr').is(':checked')){
                    $('#adresse_cmp').prop('readonly', false);
                    $('#code_postal_cmp').prop('readonly', false);
                    $('#ville_cmp').prop('readonly', false);
                }
                else{
                    $('#adresse_cmp').prop('readonly', true);
                    $('#code_postal_cmp').prop('readonly', true);
                    $('#ville_cmp').prop('readonly', true);
                }
            });
        $('#notaire').change(function(e){
            e.preventDefault();
            switch($('#notaire').val()){
                case 'notaire_mdn':
                    $('input[name=adresse]').val('{{$notairemdn->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notairemdn->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notairemdn->notaire->ville}}');
                    break ;
                default:
                    $('input[name=adresse]').val('{{$notaireacq->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notaireacq->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notaireacq->notaire->ville}}');
            }
        });
        });
     </script>
     @endif
     @if($mandat->dossiervente->adresse_compromis !== NULL && $mandat->dossiervente->rendez_vous_compromis !== NULL && $mandat->dossiervente->heure_compromis !== NULL)
     <script>
        $(document).ready(function() {
            $('#cmpr1').hide();
            $('.biff3').click(function(e){
                e.preventDefault();
                $('.cmpr2').hide();
                $('.stuff3').hide();
                $('#cmpr1').show();
            });
            $('.ret3').click(function(e){
                e.preventDefault();
                $('.cmpr2').show();
                $('.stuff3').show();
                $('#cmpr1').hide();
            });
        });
     </script>
     @endif
     @if($mandat->dossiervente->status === "acte_signe" && $mandat->dossiervente->notaire_acq_id !== NULL && $mandat->dossiervente->notaire_mdn_id !== NULL)
     <script>
        $(document).ready(function() {
            switch($('#notaire_act').val()){
                case 'notaire_mdn':
                    $('input[name=adresse]').val('{{$notairemdn->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notairemdn->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notairemdn->notaire->ville}}');
                    break ;
                default:
                    $('input[name=adresse]').val('{{$notaireacq->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notaireacq->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notaireacq->notaire->ville}}');
            }
            $('#bool_addr_act').change(function(e){
                e.preventDefault();
                if($('#bool_addr_act').is(':checked')){
                    $('#adresse_act').prop('readonly', false);
                    $('#code_postal_act').prop('readonly', false);
                    $('#ville_act').prop('readonly', false);
                }
                else{
                    $('#adresse_act').prop('readonly', true);
                    $('#code_postal_act').prop('readonly', true);
                    $('#ville_act').prop('readonly', true);
                }
            });
        $('#notaire_act').change(function(e){
            e.preventDefault();
            switch($('#notaire_act').val()){
                case 'notaire_mdn':
                    $('input[name=adresse]').val('{{$notairemdn->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notairemdn->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notairemdn->notaire->ville}}');
                    break ;
                default:
                    $('input[name=adresse]').val('{{$notaireacq->notaire->adresse}}');
                    $('input[name=code_postal]').val('{{$notaireacq->notaire->code_postal}}');
                    $('input[name=ville]').val('{{$notaireacq->notaire->ville}}');
            }
        });
        });
     </script>
     @endif
     @if($mandat->dossiervente->adresse_acte !== NULL && $mandat->dossiervente->rendez_vous_acte !== NULL && $mandat->dossiervente->heure_acte !== NULL)
     <script>
        $(document).ready(function() {
            $('#acte1').hide();
            $('.biff4').click(function(e){
                e.preventDefault();
                $('.acte2').hide();
                $('.stuff4').hide();
                $('#acte1').show();
            });
            $('.ret4').click(function(e){
                e.preventDefault();
                $('.acte2').show();
                $('.stuff4').show();
                $('#acte1').hide();
            });
        });
     </script>
     @endif

<!--confirmer ou annuler signature compromis-->
<script>
    $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.confirm_cmpr').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Confirmer uniquement si le compromis est signé, continuer ?')',
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
                        type: 'GET'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Signature Confirmée !',
                'L\'étape pour signer l\'acte est débloquée !',
                'success'
                )

                .then(function(){
                      location.reload();
                   })
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action a été annulée !',
                'error'
                )
            }
        })
            })
            
            //reject
            $('a.reject_cmpr').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Confirmer uniquement si le rendez-vous pour compromis a pas eu lieu, continuer ?')',
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
                        type: 'GET'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Effectué !',
                'Vous pouvez désormais fixer un autre rendez-vous ou suspendre le compromis dans paramètres !',
                'success'
                )
                .then(function(){
                      location.reload();
                   })
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action a été annulée !',
                'error'
                )
            }
        })
            })

        })
</script>
<!--confirmer ou annuler signature compromis fin-->

<!--confirmer ou annuler signature acte-->
<script>
    $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.confirm_acte').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Confirmer uniquement si acte signé, continuer ?')',
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
                        type: 'GET'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Signature Confirmée !',
                'Le bien a été vendu, félicitation !',
                'success'
                )
                .then(function(){
                      location.reload();
                   })
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action a été annulée !',
                'error'
                )
            }
        })
            })

            //reject
            $('a.reject_acte').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: 'Confirmer uniquement si le rendez-vous de l\'acte n\'a pas eu lieu, continuer ?',
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
                        type: 'GET'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Effectué !',
                'Vous pouvez désormais fixer un autre rendez-vous ou suspendre l\'acte dans paramètres !',
                'success'
                )
                .then(function(){
                      location.reload();
                   })
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'action a été annulée !',
                'error'
                )
            }
        })
            })
        })
</script>
<!--confirmer ou annuler signature acte fin-->

<!--suspendre compromis-->
<script>
        $(function() {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                })
                $('[data-toggle="tooltip"]').tooltip()
                $('a.bfm1').click(function(e) {
                    let that = $(this)
                    e.preventDefault()
                    const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
    })
    
            swalWithBootstrapButtons({
                title: 'Valider uniquement dans le cas ou le compromis actuel est annulé, continuer ?',
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
                            type: 'GET'
                        })
                        .done(function () {
                                that.parents('tr').remove()
                        })
    
                    swalWithBootstrapButtons(
                    'Compromis suspendu !',
                    'Le bien peut recevoir d\'autres offres d\'achat',
                    'success'
                    )
                    .then(function(){
                          location.reload();
                       })
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Annulé',
                    'L\'action a été annulée !',
                    'error'
                    )
                }
            })
                })
            })
    </script>
<!--suspendre compromis fin-->
@endif
@endsection