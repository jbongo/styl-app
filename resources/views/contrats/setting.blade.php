@extends('layouts.main.dashboard')
@section('header_name')
    Changement des paramètres du contrat
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
                                <li class="active"><a data-toggle="pill" href="#home">@lang('Informations de l\'entreprise')</a></li>
                                <li><a data-toggle="pill" href="#menu1">@lang('Barème d\'honoraires')</a></li>
                            </ul>
                            <div class="col-lg-12">
                                    <div class="panel panel-danger m-t-15">
                                       <div class="panel-heading"><strong>Paramètres des contrats</strong></div>
                                       <div class="panel-body">
                                            <ul class="list-group list-group-flush">
                                                    <li class="list-group-item" style="background-color: #ececec;">Vérifiez bien les informations avant de les envoyer, elles seront apparues sur tous les nouveaux contrats.</li>
                                                    <li class="list-group-item" style="background-color: #ececec;">La modification du barème d'honoraires génére automatiquement un avenant à chaque contrat actif.</li>
                                                </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                <h3></h3>
                                <p>@include('compenents.contrats.entreprise')</p>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <p>@include('compenents.contrats.shemacommissions')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                    </div>
                <!-- end table -->
            </div>
        </div>

    </div>
@stop

@section('js-content')
<script>
    $('.shema').click(function(e){ 
          e.preventDefault();
          var form = $(".form-valide4");
         var level = $('#palier input').serialize();
         console.log(level);
 
         $.ajax({
             type: "POST",
             url: ("{{route('contrat.settingcommission')}}"),
             beforeSend: function(xhr, type) {
                 if (!type.crossDomain) {
                     xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                 }
             },
             data: {
                   nbpalier: $('#nb-palier').val(), palierdata: level
             },
             success: function(data){
                console.log(data);
                 swal(
                 'Modifié',
                 'Le barème est modifié avec succées!',
                 'success'
                 )
                 .then(function(){
                     window.location.href = "{{route('contrat.setting')}}";
                 })
               },
               error: function(data){
                 console.log(data);
                 swal(
                 'Echec',
                 'Le barème n\'a pas été modifié!',
                 'danger'
                 );
               }
         });
    });
 </script>
@endsection