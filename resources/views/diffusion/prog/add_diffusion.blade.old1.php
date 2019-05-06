@extends('layouts.main.dashboard')
@section('header_name')
   @lang('Planifier des diffusions')
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
        @if (session('ok'))
       
            <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    
                    <strong> {{ session('ok') }}</strong>
            </div>
         @endif

    <style>
         
        body {
        background: #20262E;
        /* padding: 20px; */
        font-family: Helvetica;
        }

        #planning table {
        background-color: white;
        user-select: none;
        /* pointer-events:none; */
        }

        #planning table td, #planning table th {
        border: solid 1px grey;
        /* width: 100%; */
        }

        #planning table th:first-child {
        width: 200px;
        }

        #planning table td.selectable {
        cursor: pointer;
        }

        #planning table td.selected {
        background-color: #3AA677;
        }


</style>

<div class="row">        
    <div class="card alert">
                    
                <div class="col-lg-10">
                        <a href="{{url()->previous()}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-arrow-left "></i>@lang('Retour')</a>
                </div>
            <hr>
            <hr>
            <hr>
                <div class="card-body col-lg-12 col-md-12 col-sm-12">
                    

                    <div id="planning">
                        <table id="" class=" table student-data-table  m-t-20 "  style="width:100%">
                          <thead>
                            <tr id="head-weeks">
                              <th></th>
                            </tr>
                            <tr id="head-days">
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                      </div>
                      
            </div>
        </div>
    </div>
    <a class="btn btn-lg testo"  href="#" id=""  data-toggle="modal"  data-target="#add-category" title="@lang('Modifier le rôle de  ') ">
        <i class="ti-pencil-alt color-success"></i>
    </a>
    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>@lang('Planifiier') </strong></h4>
                </div>
                <div class="modal-body">
                    <form id="formRole">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="control-label">@lang('Date début')</label> <input class="form-control" value="12/03/2018" type="text" id="datepicker1">
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="control-label">@lang('Date fin')</label> <input class="form-control" type="text" id="datepicker2">
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <label class="control-label">@lang('Ajouter une annonce ?')</label>  
                                    <input type="checkbox" unchecked data-toggle="toggle" id="choose_annonce" name="choose_annonce" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                                
                            </div>
                            <div id="annonce" class="col-lg-6 col-md-6 col-sm-6 annonce">
                                    <label class="control-label">@lang('Choisissez une annonce')</label>
                                    <select class="form-control form-white" id="select_annonce" data-placeholder="choisir une annonce." name="annonce">
                                       @foreach ($annonces as $annonce)
                                            <option data-titre="{{$annonce->titre}}" value="{{$annonce->id}}">{{$annonce->identifiant_annonce}}</option>
                                       @endforeach

                                    </select>
                            </div>
                            <br> 
                                <div id="title" class="annonce">

                                 </div>
                        </div>
                        <hr>
                      

                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="user_id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('Fermer')</button>
                    <button type="button" id="sauvegarder" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">@lang('Planifier')</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
@stop


@section('js-content')

{{-- TABLEAU DES PLANIFICATIONS --}}
<script>
        $('.testo').hide();
        document.oncontextmenu = new Function("return false");
        var startDate = {{now()->timestamp}}
        
        var nbWeeks = 5;
        var nbWeekDays = 7;
        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"
                            ];

        // ## Construction de l'entête du tableau
        for (var week = 0; week < nbWeeks; week++) {
            var from = new Date((week * 7 * 86400 + startDate) * 1000);
        var to = new Date(((week * 7 + 6) * 86400 + startDate) * 1000);
            $("#head-weeks").append("<th colspan='" + nbWeekDays + "'>" + ("0" + from.getUTCDate()).slice(-2) + "-" + ("0" + to.getUTCDate()).slice(-2) +" "+monthNames[to.getMonth()]+"</th>");
        for (var day = 0; day < nbWeekDays; day++) {
            var date = new Date(((week * 7 + day) * 86400 + startDate) * 1000);
            
                $("#head-days").append("<th>" + ("0" + date.getUTCDate()).slice(-2) + "</th>");
        }	
        }
        // ##Fin

        // ## construction du tableau
        var nbPlatforms = {{$passerelles_size}};
        var passerelles = '{{$passerelles}}';
        var passerelles = JSON.parse(passerelles.replace(/&quot;/g,'"'));
        
        for (var platform = 0; platform < nbPlatforms; platform++) {
            // # première colonne du tableau
            var row = '<td>'+passerelles[platform]["nom"]+' <img src="/images/passerelles/'+passerelles[platform]["logo"]+'" width="50px" height="30px" alt="">  </td>';
            for (var week = 0; week < nbWeeks; week++) {
                for (var day = 0; day < nbWeekDays; day++) {
                var timestamp = (week * 7 + day) * 86400 + startDate;
                row += "<td class='selectable' data-timestamp='" + timestamp + "'></td>";
                }	
            }
            row = "<tr data-platform-id='" + passerelles[platform]["id"] + "'>" + row + "</tr>";
            $("tbody").append(row);
        }

        // ##Fin
        var SELECT_MODE = false;
        var SELECT_PLATFORM_ID = null;
        var SELECT_FROM = null;
        var SELECT_TO = null;

        function refresh() {
            // $(".selected").each(function() {
            // $(this).removeClass("selected");
            // });
        
            if (!SELECT_FROM || !SELECT_TO) {
                return;
            }
            // ## On colorie les cases sélectionées
            var from = Math.min(SELECT_FROM, SELECT_TO);
            var to = Math.max(SELECT_FROM, SELECT_TO);
                for (var timestamp = from; timestamp <= to; timestamp += 86400) {
                var cell = $("#planning tbody tr[data-platform-id=" + SELECT_PLATFORM_ID + "] td[data-timestamp=" + timestamp + "]");
                cell.addClass("selected");
            }
        }

        $(".selectable").on("mousedown", function(e) {
            if(e.which == 1){
                SELECT_MODE = true;
                SELECT_PLATFORM_ID = $(this).parent().data("platformId");
                SELECT_FROM = $(this).data("timestamp");
                SELECT_TO = SELECT_FROM;
                refresh(); 
            }else if (e.which == 3){
                $(this).removeClass("selected");
            }
            
        });

        $("body").on("mouseup", function() {
            if (!SELECT_MODE) {
                return;
            }
            var from = new Date(SELECT_FROM * 1000);
            var to = new Date(SELECT_TO * 1000);

            if (from > to) {
                var tmp = from;
                from = to;
                to = tmp;
            }
                // alert("Plateforme :" + SELECT_PLATFORM_ID + "\nDu :" + from.toLocaleDateString() + "\nAu :" + to.toLocaleDateString());
            
            // # on déclenche le modal
            $('#datepicker1').val(from.getDate()+' '+monthNames[from.getMonth()]+', '+from.getFullYear());
            $('#datepicker2').val(to.getDate()+' '+monthNames[to.getMonth()]+', '+to.getFullYear());
            $('.testo').trigger('click');

            SELECT_MODE = false;
            SELECT_PLATFORM_ID = null;
            SELECT_FROM = null;
            SELECT_TO = null;
            refresh();
        });

        $(".selectable").on("mousemove", function() {
            if (!SELECT_MODE) {
            return;
            }
            SELECT_TO = $(this).data("timestamp");
            refresh();
        });
</script>
{{-- FIN TAB --}}

{{-- MODAL PLANIFICATION--}}

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
        var annonce_title = "";

    $('.annonce').hide() ;
        annonce_title = $("#annonce option:selected").attr('data-titre');
        annonce_title = "<strong> Titre : </strong>"+annonce_title;
        $('#title').html(annonce_title);
        
    $("#select_annonce").change(function(){
        annonce_title = $("#annonce option:selected").attr('data-titre');
        annonce_title = "<strong> Titre : </strong>"+annonce_title;
        $('#title').html(annonce_title);
    })
    // Date deb
    $( function() {
        $( "#datepicker1" ).datepicker();
        $( "#datepicker1" ).datepicker( "option", "dateFormat", "DD, d MM, yy");
        $( "#datepicker1" ).datepicker( "option", "monthNames", [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ]);
        $( "#datepicker1" ).datepicker( "option", "dayNames", [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ]);
        $( "#datepicker1" ).datepicker( "option", "dayNamesMin", [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ] );

    });

    
    // Date fin
    $( function() {
        $( "#datepicker2" ).datepicker();
        $( "#datepicker2" ).datepicker( "option", "dateFormat", "DD, d MM, yy");
        $( "#datepicker2" ).datepicker( "option", "monthNames", [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ]);
        $( "#datepicker2" ).datepicker( "option", "dayNames", [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ]);
        $( "#datepicker2" ).datepicker( "option", "dayNamesMin", [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ] );

    });

    // # Choix des annonces
    $('#choose_annonce').change(function(e){
        e.preventDefault();
            $('#choose_annonce').is(':unchecked') ? $('#annonce').hide() : $('#annonce').show();
       });

</script>
{{-- FIN MODAL --}}
@endsection
