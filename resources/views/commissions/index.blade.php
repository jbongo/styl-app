/*
*@author : Belkacem
*@Controller: IndexCommissions
*@compenents: 
*@description : Listing de tous les models de commissions pour les contrats
*/

@extends('layouts.main.dashboard')
@section('header_name')
    Modification de l' étalonnage des commissions
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    <div class="row"> 
       
        <div class="col-lg-12">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
             @endif       
            <div class="card">
                <div class="card-body">
                        <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="pill" href="#home">@lang('Rémunération directe')</a></li>
                                <li><a data-toggle="pill" href="#menu1">@lang('Parrainage')</a></li>
                                <li><a data-toggle="pill" href="#menu2">@lang('Tarifs et abonnements')</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                <p>@include('compenents.commissions.direct')</p>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <p>@include('compenents.commissions.parrainage')</p>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <p>@include('compenents.commissions.abonnement')</p>
                                </div>
                                
                            </div>
                    </div>
                <!-- end table -->
            </div>
        </div>

    </div>

    
   
@stop
@section('js-content')
<!--3 data table init-->
<script>
    $(document).ready(function() {
                        $('#ex1').DataTable( {
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                            }
                        } );

                        $('#ex2').DataTable( {
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                            }
                        } );
                        $('#ex3').DataTable( {
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                            }
                        } );
                    } );
</script>
    <!--direct ajax drop-->
<script>
        $(function(e) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.delete-direct').click(function(e) {
                let that = $(this);
                e.preventDefault();
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Voulez vous vraiment supprimer ce model ?')',
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
                        type: 'PUT'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Supprimé!',
                'Le model a bien été supprimé.',
                'success'
                )
                
                
            } else if (
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'Le model n\'a pas été supprimé.',
                'error'
                )
            }
        })
            })
        })
    </script>
    <!--direct modal show-->
    <script>
        $(document).ready(function(){

$('.show1').on('click',function(e){
    var id = $(this).attr('id') ;
    $.ajax({
        url: '/commissions/direct/show/'+id,
        type: 'GET',
        dataType: 'text',
        success: function(data, statut){
            var tmp = JSON.parse(data);
            $('#pkg-type').html(tmp['pack_type']);
            $('#nom').html(tmp['nom']);
            $('#init-percent').html(tmp['pourcentage_depart']);
            $('#free-duration').html(tmp['duration_gratuitee']);
            if(tmp['pack_type'] == "Starter"){
                $('#starter').show();
                $('#duration').html(tmp['duration_starter']);
                $('#expert').hide();
            }
            else{
                $('#starter').hide();
                $('#min-vnt').html(tmp['minimum_vente']);
                $('#min-fll').html(tmp['minimum_fileuls']);
                $('#min-chf').html(tmp['minimum_chiffre_affaire']);
                $('#dd-prct').html(tmp['sub_pourcentage']);
                $('#expert').show();
            }

            if(tmp['palier'] == 1){
                $("#palier-container").show();
                var wrapper = $(".data-palier")
                var i = 0;
                var tmp2 = tmp['serialize_palier'].split("&");
                for(j = 0; j < tmp2.length; j++){
                    tmp2[j] = tmp2[j].substr(tmp2[j].indexOf("=", 0) + 1, tmp2[j].length);
                }
                var palier = [];
                for (i = 0; i < tmp2.length; i += 4){
                chunk = tmp2.slice(i, i + 4);
                palier.push(chunk);
                }            
                $(wrapper).html('');
                palier.forEach(function(el){
                $(wrapper).append('<tr><td>'+el[0]+'</td><td>'+el[1]+' %</td><td>'+el[2]+' €</td><td>'+el[3]+' €</td></tr>');
            });
            }
            else
                $("#palier-container").hide();
            /*$('#nomPrenom').html(user[0].nom+' '+user[0].prenom);
            $('#user_id').attr('value',user[0].id);*/
        },
        error: function(resultat,statut,erreur){
            swal(
                'Echec',
                'Une erreur s\'est produite pendant la récupération des données !',
                'error'
            );
        }

    });

    });
});
</script>
    <!--modal end-->
    <!--abonnement drop-->
    <script>
            $(function(e) {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                })
                $('[data-toggle="tooltip"]').tooltip()
                $('a.abn-delete').click(function(e) {
                    let that = $(this);
                    e.preventDefault();
                    const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
    })
    
            swalWithBootstrapButtons({
                title: '@lang('Voulez vous vraiment supprimer cet abonnement ?')',
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
                            type: 'PUT'
                        })
                        .done(function () {
                                that.parents('tr').remove()
                        })
    
                    swalWithBootstrapButtons(
                    'Supprimé!',
                    'L\'abonnement a bien été supprimé.',
                    'success'
                    )
                    
                    
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Annulé',
                    'L\'abonnement n\'a pas été supprimé.',
                    'error'
                    )
                }
            })
                })
            })
        </script>
        <!--parrainage drop-->
    <script>
            $(function(e) {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                })
                $('[data-toggle="tooltip"]').tooltip()
                $('a.prng-delete').click(function(e) {
                    let that = $(this);
                    e.preventDefault();
                    const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
    })
    
            swalWithBootstrapButtons({
                title: '@lang('Voulez vous vraiment supprimer ce plan ?')',
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
                            type: 'PUT'
                        })
                        .done(function () {
                                that.parents('tr').remove()
                        })
    
                    swalWithBootstrapButtons(
                    'Supprimé!',
                    'Le plan a bien été supprimé.',
                    'success'
                    )
                    
                    
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Annulé',
                    'Le plan n\'a pas été supprimé.',
                    'error'
                    )
                }
            })
                })
            })
        </script>
<!--parrainage modal show-->
<script>
        $(document).ready(function(){

$('.show2').on('click',function(e){
    
    var id = $(this).attr('id') ;
    $.ajax({
        url: '/commissions/parrainage/show/'+id,
        type: 'GET',
        dataType: 'text',
        success: function(data, statut){
            var tmp = JSON.parse(data);
            console.log(tmp);
            $('#pln-name').html(tmp['nom']);
            $('#pln-100').html(tmp['forfait_100percent']);
            $('#yr0').html(tmp['pourcentage_annee1']);
            $('#pln-duration').html(tmp['nombre_annee']);
            var wrapper = $(".data-palier-1")
            var i = 0;
            var tmp2 = tmp['serialize_annee_data'].split("&");
            for(j = 0; j < tmp2.length; j++){
                tmp2[j] = tmp2[j].substr(tmp2[j].indexOf("=", 0) + 1, tmp2[j].length);
            }
            var palier = [];
            for (i = 0; i < tmp2.length; i += 4){
                chunk = tmp2.slice(i, i + 4);
                palier.push(chunk);
            }            
            $(wrapper).html('');
            palier.forEach(function(el){
                $(wrapper).append('<tr><td>'+el[0]+'</td><td>'+el[1]+'</td><td>'+el[2]+'</td><td>'+el[3]+'</td></tr>');
            });
        },
        error: function(resultat,statut,erreur){
            swal(
                'Echec',
                'Une erreur s\'est produite pendant la récupération des données !',
                'danger'
            );
        }

    });

    });
});
</script>
@endsection