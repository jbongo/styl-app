@extends('layouts.main.dashboard')
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
                    <div class="card p-0">
                            <div class="media">
                                <div class="p-20 media-body">
                                    <h4 class="color-warning">Détails des documents</h4>
                                <br>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="background-color: #ececec;">Toute modification d'informations entraine la génération d'un avenant lié à ces informations et l'envoi d'une notification au mandataire concerné pour
                                        signer le nouvel avenant.
                                    </li>
                                    <li class="list-group-item" style="background-color: #ececec;">Le contrat tel qu'il apparait ici peut étre different de celui généré initalement, en effet le model se base sur les dernieres modifications en date pour afficher le contrat.</li>
                                    <li class="list-group-item" style="background-color: #ececec;">Les modifications apportées apparaissent dans les avenants liés au contrat, vous pouvez les consulte en cliquant sur le bouton ci-dessous.</li>
                                </ul>
                                    <br>
                                    <a type="button" href="{{route('contrat.avenants',$contrat->id)}}" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-folder"></i>Avenants du contrat</a>
                                    <a type="button" href="{{route('contrat.index')}}" class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-arrow-left"></i>Retour</a>
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="card-body">
                     <ul class="nav nav-pills">
                             <li class="active"><a data-toggle="pill" href="#hm">@lang("Contrat")</a></li>
                             <li><a data-toggle="pill" href="#an1">@lang("Annexe 1")</a></li>
                             <li><a data-toggle="pill" href="#an2">@lang("Annexe 2")</a></li>
                             <li><a data-toggle="pill" href="#an3">@lang("Annexe 3")</a></li>
                             <li><a data-toggle="pill" href="#an4">@lang("Annexe 4")</a></li>
                             @if($user->bool_annex_5 == 1)
                                <li><a data-toggle="pill" href="#an5">@lang("Annexe 5")</a></li>
                            @endif
                         </ul>
                         <div class="tab-content">
                                 <div id="hm" class="tab-pane fade in active">
                                 <h3></h3>
                                 <p>@include("compenents.contrats.render.contrat")</p>
                                 </div>
                                 <div id="an1" class="tab-pane fade">
                                     <p>@include("compenents.contrats.render.annex1")</p>
                                 </div>
                                 <div id="an2" class="tab-pane fade">
                                     <p>@include("compenents.contrats.render.annex2")</p>
                                 </div>
                                 <div id="an3" class="tab-pane fade">
                                     <p>@include("compenents.contrats.render.annex3")</p>
                                 </div>
                                 <div id="an4" class="tab-pane fade">
                                     <p>@include("compenents.contrats.render.annex4")</p>
                                 </div>
                                 @if($user->bool_annex_5 == 1)
                                 <div id="an5" class="tab-pane fade">
                                     <p>@include("compenents.contrats.render.annex5")</p>
                                 </div>
                                 @endif                          
                             </div>
                             <div class="col-md-6">
                                    <div class="panel panel-dark m-t-8">
                                       <div class="panel-heading">Actions possibles</div>
                                       <div class="panel-body">
                                            <div class="card p-0">
                                                    <div class="media">
                                                        <div class="p-20 media-body">
                                                            <h4 class="color-warning">Contrat</h4>
                                                            <a href="{{route('contrat.user.edit',$user->id)}}" type="button" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Mandataire</a>
                                                            @if($contrat->verif_rsac == 0)
                                                                <a href="{{route('contrat.validation',$contrat->id)}}" type="button" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Validation RSAC</a>
                                                            @endif
                                                            <h4 class="color-warning">Téléchargement</h4>
                                                            @php($doc = 0)
                                                            <a type="button" href="{{route('contrat.download',[$contrat->id, $doc])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Contrat</a>
                                                            <a type="button" href="{{route('contrat.download',[$contrat->id, $doc + 1])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Annexe 1</a>
                                                            <a type="button" href="{{route('contrat.download',[$contrat->id, $doc + 2])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Annexe 2</a>
                                                            <a type="button" href="{{route('contrat.download',[$contrat->id, $doc + 3])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Annexe 3</a>
                                                            <a type="button" href="{{route('contrat.download',[$contrat->id, $doc + 4])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Annexe 4</a>
                                                            @if($user->bool_annex_5 == 1)
                                                                <a type="button" href="{{route('contrat.download',[$contrat->id, $doc + 5])}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>Annexe 5</a>
                                                            @endif
                                                            <div class="progress progress-sm m-t-10 m-b-0">
                                                                <div class="progress-bar boxshadow-none  bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                        <div class="card p-0">
                                                    <div class="media">
                                                        <div class="p-20 media-body">
                                                            <h4 class="color-warning">Avenants annexe 1</h4>
                                                            <a type="button" href="{{route('contrat.starter.edit',$dr_starter->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Pack Starter</a>
                                                            <a type="button" href="{{route('contrat.expert.edit',$dr_expert->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Pack Expert</a>
                                                            <div class="progress progress-sm m-t-10 m-b-0">
                                                                <div class="progress-bar boxshadow-none  bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card p-0">
                                                        <div class="media">
                                                            <div class="p-20 media-body">
                                                                <h4 class="color-warning">Avenants annexe 2</h4>
                                                                <a type="button" href="{{route('parrainage.contrat.edit',$parrainage->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Parrainage</a>
                                                                <div class="progress progress-sm m-t-10 m-b-0">
                                                                    <div class="progress-bar boxshadow-none  bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card p-0">
                                                            <div class="media">
                                                                <div class="p-20 media-body">
                                                                    <h4 class="color-warning">Avenants annexe 3</h4>
                                                                    <a type="button" href="{{route('abonnement.contrat.edit',$abn_starter->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Tarif Starter</a>
                                                                    <a type="button" href="{{route('abonnement.contrat.edit',$abn_expert->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Tarif Expert</a>
                                                                    <div class="progress progress-sm m-t-10 m-b-0">
                                                                        <div class="progress-bar boxshadow-none  bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card p-0">
                                                                <div class="media">
                                                                    <div class="p-20 media-body">
                                                                        <h4 class="color-warning">Avenants annexe 4</h4>
                                                                        <a href="{{route('contrat.setting')}}" type="button" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Honorraires</a>
                                                                        <div class="progress progress-sm m-t-10 m-b-0">
                                                                            <div class="progress-bar boxshadow-none  bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                                        </div>
                                                                    </div>
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