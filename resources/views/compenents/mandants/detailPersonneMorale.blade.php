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
                                                <a href="{{route('mandants.index')}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-angle-left"></i>@lang('Retourner à la Liste des mandants')</a>
                                                <br>
                                               @admin
                                                @if($mandant->role == "prospect" )
                                            <a href="{{route('user.sendmailProfil',$mandant->id)}}" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5"><i class="ti-email"></i>@lang('Envoyer un email a l\'utilisateur pour completer son profil')</a>
                                                @endif
                                            @endadmin <hr>
                                           
                                            
                                            <div class="col-lg-8">
                                                <div class="custom-tab user-profile-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">Informations</a></li>
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="1">
                                                                    <div class="contact-information">
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Forme Juridique'):</span>
                                                                            <span class="phone-number">{{$mandant->forme_juridique}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Raison sociale'):</span>
                                                                            <span class="phone-number">{{$mandant->raison_sociale}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Siret'):</span>
                                                                            <span class="phone-number">{{$mandant->siret}}</span>
                                                                        </div>
                                                                        <div class="website-content">
                                                                            <span class="contact-title">@lang('Téléphone fixe'):</span>
                                                                            <span class="contact-website">{{$mandant->telephone_fixe}}</span>
                                                                        </div>
                                                                        <div class="skype-content">
                                                                            <span class="contact-title">@lang('Téléphone mobile'):</span>
                                                                            <span class="contact-skype">{{$mandant->telephone_mobile}}</span>
                                                                        </div>
                                                                        
                                                                        <div class="birthday-content">
                                                                            <span class="contact-title">@lang('Email'):</span>
                                                                            <span class="birth-date">{{$mandant->email}}</span>
                                                                        </div>
                                                                        <div class="skype-content">
                                                                                <span class="contact-title">@lang('Adresse'):</span>
                                                                                <span class="contact-skype">{{$mandant->adresse}}</span>
                                                                            </div>
                                                                            
                                                                            <div class="address-content">
                                                                                <span class="contact-title">@lang('Code postal'):</span>
                                                                                <span class="mail-address">{{$mandant->code_postal}}</span>
                                                                            </div>
                                                                            <div class="gender-content">
                                                                                <span class="contact-title">@lang('Ville'):</span>
                                                                                <span class="gender">{{$mandant->ville}}</span>
                                                                            </div>
                                                                            <div class="phone-content">
                                                                                <span class="contact-title">@lang('Pays'):</span>
                                                                                <span class="phone-number">{{$mandant->pays}}</span>
                                                                            </div>

                                                                        
                                                                        <div class="skype-content">
                                                                            <span class="contact-title">@lang('Source du contact'):</span>
                                                                            <span class="contact-skype">{{$mandant->source_contact}}</span>
                                                                        </div>


                                                                        
                                                                        <div class="phone-content">
                                                                                <span class="contact-title">@lang('Note'):</span>
                                                                                <span class="phone-number">{{$mandant->note}} </span>
                                                                            </div>
                                                                            
                                                                            <div class="phone-content">
                                                                                <span class="contact-title">@lang('Date de création') :</span>
                                                                                <span class="phone-number">{{ $mandant->created_at->format('d-m-Y ') }}</span>
                                                                            </div>
                                                                            <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Date de modification'):</span>
                                                                                    <span class="phone-number">{{$mandant->updated_at->format('d-m-Y')}}</span>
                                                                            </div>
                                                                                                                                             
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                    </div>
                                                    <br><br>
                                                      
                                                                                            
                                                    
                                                </div>
                                            </div>

                                            
        <div class="col-lg-4">
                <div class="card alert">
                    <div class="card-header">
                        <h2 class="f-s-20">@lang('Liste des contacts associés')</h2>
                    </div>
                    @foreach($mandant->mandants_associe as $associe)
                    <div class="card-body">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge success"><i class="fa fa-smile-o"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title">{{$associe->civilite}} {{$associe->nom}} {{$associe->prenom}}</h5>
                                    </div>
                                    <div class="timeline-body">
                                    <p><a href="{{route('mandant.show',$associe->id)}}" class="btn btn-dark btn-rounded ">Detail</a></p>
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
                                                <a href="{{route('mandants.edit', $mandant->id)}}" id="ajouter" name="ajouterSeul" class="btn btn-lg btn-warning">@lang('Modifier')</a>
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