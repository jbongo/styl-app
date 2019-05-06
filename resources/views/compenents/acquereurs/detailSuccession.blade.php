@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
@section('pageActuelle')
@lang('Informations de l\'utilisateurs')
@endsection
            @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
            @endif       
    <div class="row"> 
        <div class="col-lg-12">       
            <div class="card alert">
                    <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4></h4>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile m-t-15">
                                        <div class="row">
                                                <a href="{{route('acquereurs.index')}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-angle-left"></i>@lang('Retourner à la Liste des acquereurs')</a>
                                                <br>
                                               <hr>
                                                                                    
                                                <div class="col-lg-12">
                                                        <div class="card alert">
                                                            <div class="card-header">
                                                            <h2 class="f-s-20">@lang('Membres du groupe ')"{{$groupe->nom_groupe}}"</h2>
                                                            </div>
                                                            @foreach($groupe->acquereurs as $associe)
                                                            <div class="card-body">
                                                                <ul class="timeline">
                                                                    <li>
                                                                        <div class="timeline-badge success"><i class="fa fa-smile-o"></i></div>
                                                                        <div class="timeline-panel">
                                                                            <div class="timeline-heading">
                                                                                <h5 class="timeline-title">{{$associe->civilite}} {{$associe->nom}} {{$associe->prenom}} | {{$associe->email}} </h5>
                                                                            </div>
                                                                            <div class="timeline-body">
                                                                            <p><a href="{{route('acquereur.show',$associe->id)}}" class="btn btn-dark btn-rounded ">Detail</a></p>
                                                                            </div>
                                                                        </div>
                                                                    </li>                      
                                                                </ul>
                                                            </div>
                                                            @endforeach

                                                        </div>
                                                        <!-- /# card -->
                                                    </div>
                                            

                                        </div>
                                        <div class="row">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                <a href="{{route('groupeacquereur.edit', $groupe->id)}}" id="ajouter" name="ajouterSeul" class="btn btn-lg btn-warning">@lang('Modifier')</a>
                                                </div>
                                            </div>                        
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

        
    </div>
@endsection