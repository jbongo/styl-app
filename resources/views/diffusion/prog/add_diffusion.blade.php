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
        /* background: #20262E; */
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
            /* background-image: -webkit-linear-gradient(bottom, #fbc2eb 30%, #a6c1ee 100%);       
            background-image: -webkit-linear-gradient(top, white 70%, #a6c1ee 100%);  */
            background: linear-gradient(to bottom, white 20%, #471B61 60%, white 20%);
                  
        }

        tr.aborder { 
        border-width:1px;
        border-style:dashed double none;
        border-bottom-color:white;
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
                     <div class="" style="float: right;">
                    <nav aria-label="navigation">
                    <ul class="pager">
                      <li><a href="#" id="precedent" title="Précédent">< Précédent</a></li>
                      <li><a href="#" id="suivant" title="Suivant">Suivant ></a></li>
                    </ul>
                </nav>
                </div>

                    <div id="planning">
                        <table id="tab_planning" class=" table student-data-table  m-t-20 "  style="width:100%">
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
    <a class="btn btn-lg btn_modal"  href="#" id=""  data-toggle="modal"  data-target="#add-category" >
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
                            <br> <br> 
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
        $('.btn_modal').hide();
        document.oncontextmenu = new Function("return false");
        var startDate = {{now()->timestamp}}
        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                                "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"
                                ];
        
        
        // ### Function de Construction du tableau
        function construction_tableau(startDate){
            var nbWeeks = 5;
            var nbWeekDays = 7;
            

            // ### Construction de l'entête du tableau
            for (var week = 0; week < nbWeeks; week++) {
                var from = new Date((week * 7 * 86400 + startDate) * 1000);
                var to = new Date(((week * 7 + 6) * 86400 + startDate) * 1000);
                $("#head-weeks").append("<th colspan='" + nbWeekDays + "'>" + ("0" + from.getUTCDate()).slice(-2) + "-" + ("0" + to.getUTCDate()).slice(-2) +" "+monthNames[to.getMonth()]+"</th>");
                // deuximème ligne de l'entête
                for (var day = 0; day < nbWeekDays; day++) {
                    var date = new Date(((week * 7 + day) * 86400 + startDate) * 1000);
                    
                        $("#head-days").append("<th>" + ("0" + date.getUTCDate()).slice(-2) + "</th>");
                }	
            }
            // ##Fin

            // ## construction du corps tableau
            var nbPlatforms = {{$passerelles_size}};
            var passerelles = '{{$passerelles}}';
            var passerelles = JSON.parse(passerelles.replace(/&quot;/g,'"'));
            
            for (var platform = 0; platform < nbPlatforms; platform++) {
                // # première colonne du tableau
                var row = '<th>'+passerelles[platform]["nom"]+' <img src="/images/passerelles/'+passerelles[platform]["logo"]+'" width="50px" height="30px" alt="">  </th>';
                for (var week = 0; week < nbWeeks; week++) {
                    for (var day = 0; day < nbWeekDays; day++) {
                    var timestamp = (week * 7 + day) * 86400 + startDate;
                    row += "<td class='selectable aborder' data-timestamp='" + timestamp + "'></td>";
                    }	
                }
                row = "<tr class='aborder' data-platform-id='" + passerelles[platform]["id"] + "'>" + row + "</tr>";
                $("tbody").append(row);
            }
        // ##Fin
        
        }
    // ###Fin

        // ##Première construction du tableau
        construction_tableau(startDate);
        

        var SELECT_MODE = false;
        var SELECT_PASSERELLE_ID = null;
        var SELECT_FROM = null;
        var SELECT_TO = null;

        // ## Fonction qui colorie les cellules entre deux dates selectionnées
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
                var cell = $("#planning tbody tr[data-platform-id=" + SELECT_PASSERELLE_ID + "] td[data-timestamp=" + timestamp + "]");
                cell.addClass("selected");
            }
        }
        // ## Fin

        function unrefresh() {
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
                var cell = $("#planning tbody tr[data-platform-id=" + SELECT_PASSERELLE_ID + "] td[data-timestamp=" + timestamp + "]");
                cell.removeClass("selected");
            }
        }

        function select_cellule(){
            // # Au clic d'une cellule
            $(".selectable").on("mousedown", function(e) {
                SELECT_MODE = true;
                    SELECT_PASSERELLE_ID = $(this).parent().data("platformId");
                    SELECT_FROM = $(this).data("timestamp");
                    SELECT_TO = SELECT_FROM;
                if(e.which == 1){   
                    refresh(); 
                }else if (e.which == 3){
                    unrefresh();
                }
                
            });
            // # Lorsqu'on relache le clic sur la cellule
            $("body").on("mouseup", function(e) {
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
                    // alert("Plateforme :" + SELECT_PASSERELLE_ID + "\nDu :" + from.toLocaleDateString() + "\nAu :" + to.toLocaleDateString());
                if(e.which === 1 ){
                    // # on déclenche le modal
                    $('#datepicker1').val(from.getDate()+' '+monthNames[from.getMonth()]+', '+from.getFullYear());
                    $('#datepicker2').val(to.getDate()+' '+monthNames[to.getMonth()]+', '+to.getFullYear());
                    $('.btn_modal').trigger('click');
                }
            

                SELECT_MODE = false;
                SELECT_PASSERELLE_ID = null;
                SELECT_FROM = null;
                SELECT_TO = null;
                // refresh();
            });
            // # au survole d'une cellule
            $(".selectable").on("mousemove", function(e) {
                if (!SELECT_MODE) {
                return;
                }
                SELECT_TO = $(this).data("timestamp");
            if (e.which == 1){
                
                refresh();
            }
            else if (e.which == 3){
                unrefresh();
                }
            });
        }
        
        select_cellule();



        // ### Tableau suivant

        $('#suivant').on('click',function(){
            $('#tab_planning').remove();
            var tab = `<table id="tab_planning" class=" table student-data-table  m-t-20 "  style="width:100%">
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
                        </table>`;
            $('#planning').html(tab);
            startDate+=86400*7;
            construction_tableau(startDate);
            select_cellule();
        });

        // ### Tableau précendent

        $('#precedent').on('click',function(){
            $('#tab_planning').remove();
            var tab = `<table id="tab_planning" class=" table student-data-table  m-t-20 "  style="width:100%">
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
                        </table>`;
            $('#planning').html(tab);
            startDate-=86400*7;
            construction_tableau(startDate);
            select_cellule();
        });
</script>
{{-- FIN TAB --}}

{{-- MODAL PLANIFICATION--}}

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
        var annonce_title = "";

    $('.annonce').hide() ;
        annonce_title = $("#annonce option:selected").attr('data-titre');
        annonce_title = "<br><strong> Titre de l'annonce : </strong>"+annonce_title;
        $('#title').html(annonce_title);

    $("#select_annonce").change(function(){
        annonce_title = $("#annonce option:selected").attr('data-titre');
        annonce_title = "<br><strong> Titre de l'annonce: </strong>"+annonce_title;
        $('#title').html(annonce_title);
        
    });

    // configuration du Datepicker
    function datepicker_config (datepick){
        $( datepick ).datepicker();
        $( datepick ).datepicker( "option", "dateFormat", "DD, d MM, yy");
        $( datepick ).datepicker( "option", "monthNames", [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ]);
        $( datepick ).datepicker( "option", "dayNames", [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ]);
        $( datepick ).datepicker( "option", "dayNamesMin", [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ] );
    }

    // Date deb
    datepicker_config("#datepicker1");
    // Date fin
    datepicker_config("#datepicker2");


    // # Choix des annonces
    $('#choose_annonce').change(function(e){
        e.preventDefault();
            $('#choose_annonce').is(':unchecked') ? $('.annonce').hide() : $('.annonce').show();
       });

    
    // # Enregistrement de la planification 

    
</script>
{{-- FIN MODAL --}}
@endsection