@extends('layouts.main.dashboard')
@section('header_name')
    Gestion des contrats
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
                                <li class="active"><a data-toggle="pill" href="#home">@lang('Contrats actifs')</a></li>
                                <li><a data-toggle="pill" href="#menu1">@lang('Contrats à générer')</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                <h3></h3>
                                <p>@include('compenents.contrats.actif')</p>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <p>@include('compenents.contrats.inactif')</p>
                                </div>                                
                            </div>
                    </div>
                <!-- end table -->
            </div>
        </div>

    </div>  
@stop

@section('js-content')

<!--info base-->
<script>
$(document).ready(function(){
    $('#actif').DataTable({
        "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('#inactif').DataTable({
        "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
});
</script>
@endsection