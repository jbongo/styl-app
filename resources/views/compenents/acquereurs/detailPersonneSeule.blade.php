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
                                               @admin
                                                @if($acquereur->role == "prospect" )
                                            <a href="{{route('user.sendmailProfil',$acquereur->id)}}" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5"><i class="ti-email"></i>@lang('Envoyer un email a l\'utilisateur pour completer son profil')</a>
                                                @endif
                                            @endadmin <hr>
                                           
                                            
                                            <div class="col-lg-12">
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
                                                                            <span class="contact-title">@lang('Civilité'):</span>
                                                                            <span class="phone-number">{{$acquereur->civilite}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Nom'):</span>
                                                                            <span class="phone-number">{{$acquereur->nom}}</span>
                                                                        </div>
                                                                        <div class="website-content">
                                                                            <span class="contact-title">@lang('Prénom'):</span>
                                                                            <span class="contact-website">{{$acquereur->prenom}}</span>
                                                                        </div>
                                                                        <div class="skype-content">
                                                                            <span class="contact-title">@lang('Catégorie'):</span>
                                                                            <span class="contact-skype">{{$acquereur->categorie}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Téléphone Mobile'):</span>
                                                                            <span class="phone-number">{{$acquereur->telephone_mobile}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Téléphone Fixe'):</span>
                                                                            <span class="phone-number">{{$acquereur->telephone_fixe}}</span>
                                                                        </div>
                                                                        <div class="birthday-content">
                                                                            <span class="contact-title">@lang('Email'):</span>
                                                                            <span class="birth-date">{{$acquereur->email}}</span>
                                                                        </div>
                                                                        <div class="skype-content">
                                                                            <span class="contact-title">@lang('Source du contact'):</span>
                                                                            <span class="contact-skype">{{$acquereur->source_contact}}</span>
                                                                        </div>


                                                                        <div class="skype-content">
                                                                            <span class="contact-title">@lang('Adresse'):</span>
                                                                            <span class="contact-skype">{{$acquereur->adresse}}</span>
                                                                        </div>
                                                                        
                                                                        <div class="address-content">
                                                                            <span class="contact-title">@lang('Code postal'):</span>
                                                                            <span class="mail-address">{{$acquereur->code_postal}}</span>
                                                                        </div>
                                                                        <div class="gender-content">
                                                                            <span class="contact-title">@lang('Ville'):</span>
                                                                            <span class="gender">{{$acquereur->ville}}</span>
                                                                        </div>
                                                                        <div class="phone-content">
                                                                            <span class="contact-title">@lang('Pays'):</span>
                                                                            <span class="phone-number">{{$acquereur->pays}}</span>
                                                                        </div>
                                                                                                                                             
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="1">
                                                                    <div class="contact-information">
                                                                            <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Date de naissance'):</span>
                                                                                    <span class="phone-number">{{$acquereur->date_naissance}}</span>
                                                                                </div>
                                                                                <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Lieu de naissance'):</span>
                                                                                    <span class="phone-number">{{$acquereur->lieu_naissance}}</span>
                                                                                </div>
                                                                                <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Langue'):</span>
                                                                                    <span class="phone-number">{{$acquereur->langue}} </span>
                                                                                </div>
                                                                                <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Note'):</span>
                                                                                    <span class="phone-number">{{$acquereur->note}} </span>
                                                                                </div>
                                                                                
                                                                                <div class="phone-content">
                                                                                    <span class="contact-title">@lang('Date de création') :</span>
                                                                                    <span class="phone-number">{{ $acquereur->created_at->format('d-m-Y ') }}</span>
                                                                                </div>
                                                                                <div class="phone-content">
                                                                                        <span class="contact-title">@lang('Date de modification'):</span>
                                                                                        <span class="phone-number">{{$acquereur->updated_at->format('d-m-Y')}}</span>
                                                                                </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <br><br>
                                                    <div class="row">
                                                        <div class="form-group row">
                                                            <div class="col-lg-8 ml-auto">
                                                            <a href="{{route('acquereurs.edit', $acquereur->id)}}" id="ajouter" name="ajouterSeul" class="btn btn-lg btn-warning">@lang('Modifier')</a>
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
            </div>
        </div>

        
    </div>
@endsection