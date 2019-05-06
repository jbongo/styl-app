@extends('layouts.main.dashboard')
@section('header_name')
    Informations sur l' utilisateur
@stop
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
   <div class="col-lg-8">
      <div class="card alert">
         <div class="col-lg-12">
            <div class="card alert">
               <div class="card-header">
                  <h4></h4>
               </div>
               <div class="card-body">
                  <div class="user-profile m-t-15">
                     <div class="row">
                        <a href="{{route('users')}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-angle-left"></i>@lang('Liste d\'utilisateurs')</a>
                        @admin
                        @if($user->role == "prospect" )
                        <a href="{{route('user.sendmailProfil',$user->id)}}" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5"><i class="ti-email"></i>@lang('Email pour completer le profil')</a>
                        @endif
                        <a href="#" class="btn btn-pink btn-flat btn-addon m-b-10 m-l-5"><i class="ti-settings"></i>@lang('Paramètres')</a>
                        @endadmin 
                        <hr>
                        <div class="col-lg-4">
                           <div class="user-photo m-b-30">
                              <img class="img-responsive" style="object-fit: cover; width: 225px; height: 225px; border: 5px solid #8ba2ad; border-style: solid; border-radius: 20px; padding: 3px;" src="{{asset('/images/photo_profile/'.(($user->photo_profile) ? $user->photo_profile : "user.png"))}}" alt="">
                              {{-- 
                              <div class="user-send-message"><button class="btn btn-primary btn-addon" type="button"><i class="ti-email"></i>Contacter</button></div>
                              --}}
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="user-profile-name">{{$user->prenom}} {{$user->nom}}</div>
                           <span class="badge badge-danger">Hors ligne</span>
                           <div class="custom-tab user-profile-tab">
                              <ul class="nav nav-tabs" role="tablist">
                                 <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">Informations</a></li>
                              </ul>
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="1">
                                    <div class="contact-information">
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Nom'):</span>
                                          <span class="phone-number">{{$user->nom}}</span>
                                       </div>
                                       <div class="website-content">
                                          <span class="contact-title">@lang('Prénom'):</span>
                                          <span class="contact-website">{{$user->prenom}}</span>
                                       </div>
                                       <div class="skype-content">
                                          <span class="contact-title">@lang('Adresse'):</span>
                                          <span class="contact-skype">{{$user->adresse}}</span>
                                       </div>
                                       <div class="skype-content">
                                          <span class="contact-title">@lang('Complément d\'adresse'):</span>
                                          <span class="contact-skype">{{$user->complement_adresse}}</span>
                                       </div>
                                       <div class="address-content">
                                          <span class="contact-title">@lang('Code postal'):</span>
                                          <span class="mail-address">{{$user->code_postal}}</span>
                                       </div>
                                       <div class="gender-content">
                                          <span class="contact-title">@lang('Ville'):</span>
                                          <span class="gender">{{$user->ville}}</span>
                                       </div>
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Pays'):</span>
                                          <span class="phone-number">{{$user->pays}}</span>
                                       </div>
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Téléphone'):</span>
                                          <span class="phone-number">{{$user->telephone}}</span>
                                       </div>
                                       <div class="birthday-content">
                                          <span class="contact-title">@lang('Email'):</span>
                                          <span class="birth-date">{{$user->email}}</span>
                                       </div>
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Date de création') :</span>
                                          <span class="phone-number">{{ $user->created_at->format('d-m-Y ') }}</span>
                                       </div>
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Date de modification'):</span>
                                          <span class="phone-number">{{$user->updated_at->format('d-m-Y')}}</span>
                                       </div>
                                       @if($user->role =="admin")
                                       @php($color = "danger")
                                       @elseif($user->role =="mandataire")
                                       @php($color = "success")
                                       @elseif($user->role =="personnel")
                                       @php($color = "warning")
                                       @elseif($user->role =="prospect")
                                       @php($color = "info")
                                       @elseif($user->role == "formateur" || $user->role == "intervenant")
                                       @php($color = "pink")
                                       @elseif($user->role =="prospect_plus")
                                       @php($color = "default")
                                       @endif
                                       <div class="phone-content">
                                          <span class="contact-title">@lang('Role'):</span>
                                          <span class="badge badge-{{$color}}">{{$user->role}}</span>
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
   <div class="col-lg-4">
      <div class="card alert">
         <div class="card-header">
            <h4 class="f-s-14">Dernières activités de l'utilisateur</h4>
         </div>
         <div class="card-body">
            <ul class="timeline">
               <li>
                  <div class="timeline-badge primary"><i class="fa fa-smile-o"></i></div>
                  <div class="timeline-panel">
                     <div class="timeline-heading">
                        <h5 class="timeline-title">Youtube, a video-sharing website, goes live.</h5>
                     </div>
                     <div class="timeline-body">
                        <p>10 minutes ago</p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="timeline-badge warning"><i class="fa fa-sun-o"></i></div>
                  <div class="timeline-panel">
                     <div class="timeline-heading">
                        <h5 class="timeline-title">Mashable, a news website and blog, goes live.</h5>
                     </div>
                     <div class="timeline-body">
                        <p>20 minutes ago</p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="timeline-badge danger"><i class="fa fa-times-circle-o"></i></div>
                  <div class="timeline-panel">
                     <div class="timeline-heading">
                        <h5 class="timeline-title">Google acquires Youtube.</h5>
                     </div>
                     <div class="timeline-body">
                        <p>30 minutes ago</p>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
      <!-- /# card -->
   </div>
   @if($user->role == "prospect" || $user->role == "prospect_plus" || $user->role == "mandataire"  )
   <div class="col-lg-4">
    <div class="card bg-danger">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="ti-home f-s-48 color-white"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h4>5</h4>
                <h5>Biens actifs</h5>
            </div>
        </div>
    </div>
   </div>
   <div class="col-lg-4">
    <div class="card bg-warning">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="ti-shopping-cart f-s-48 color-white"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h4>2</h4>
                <h5>Nombre de ventes</h5>
            </div>
        </div>
    </div>
   </div>
   <div class="col-lg-4">
    <div class="card bg-pink">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="ti-user f-s-48 color-white"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h4>2</h4>
                <h5>Nombre de fileuls</h5>
            </div>
        </div>
    </div>
   </div>
   <div class="col-lg-4">
    <div class="card">
        <div class="stat-widget-two">
            <div class="stat-content">
                <div class="stat-text">Chiffre d'affaire </div>
                <div class="stat-digit"></i>8500 €</div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
@endif
</div>
@if($user->role == "prospect" || $user->role == "prospect_plus" || $user->role == "mandataire"  )
<hr>
<div class="row">
   <div class="col-lg-12">
      <div class="card p-0">
         <div class="media">
            <div class="p-5 bg-info media-left media-middle">
               <i class="ti-user f-s-28 color-white"></i>
            </div>
            <div class="p-10 media-body">
               <h4 class="color-warning m-r-10">@lang('Informations de base') </h4>
               <div class="progress progress-sm m-t-10 m-b-0">
                  <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6">
      <div class="panel lobipanel-basic panel-dark">
         <div class="panel-heading">
            <div class="panel-title">@lang('Complément d\'informations personnelles')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Situation familialle') </b></span> : <span class="info-value"> {{($user->situation_matrimoniale == null ? "____________" : $user->situation_matrimoniale   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Nom de jeune fille') </b></span> : <span class="info-value"> {{($user->nom_jeune_fille == null ? "____________" : $user->nom_jeune_fille   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Date de naissance') </b></span> : <span class="info-value"> {{($user->date_naissance == null ? "____________" : $user->date_naissance   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Ville de naissance') </b></span> : <span class="info-value"> {{($user->ville_naissance == null ? "____________" : $user->ville_naissance   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Pays de naissance') </b></span> : <span class="info-value"> {{($user->pays_naissance == null ? "____________" : $user->pays_naissance   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Nationalité') </b></span> : <span class="info-value"> {{($user->nationnalite == null ? "____________" : $user->nationnalite   )}}</span>
            </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
   <div class="col-lg-6">
      <div class="panel lobipanel-basic panel-dark">
         <div class="panel-heading">
            <div class="panel-title">@lang('Autres informations')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Nom et prénom du père') </b></span> : <span class="info-value"> {{($user->nom_prenom_pere == null ? "____________" : $user->nom_prenom_pere   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Nom et prénom de la mére') </b></span> : <span class="info-value"> {{($user->nom_prenom_mere == null ? "____________" : $user->nom_prenom_mere   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Comment avez vous connu Styl\'immo ?') </b></span> : <span class="info-value"> {{($user->comment_connu_styli == null ? "____________" : $user->comment_connu_styli   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Où souhaitez vous exercer l\'activité de mandataire ?') </b></span> : <span class="info-value"> {{($user->ville_naissance == null ? "____________" : $user->ville_naissance   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Décrivez-vous, votre activité') </b></span> : <span class="info-value"> {{($user->ou_souhaiter_exercer == null ? "____________" : $user->ou_souhaiter_exercer   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Autres informations') </b></span> : <span class="info-value"> {{($user->autres_infos == null ? "____________" : $user->autres_infos   )}}</span>
            </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
</div>
<div class="row">
<div class="col-lg-12">
   <div class="card p-0">
      <div class="media">
         <div class="p-5 bg-info media-left media-middle">
            <i class="ti-user f-s-28 color-white"></i>
         </div>
         <div class="p-10 media-body">
            <h4 class="color-warning m-r-10">@lang('Informations professionnelles') </h4>
            <div class="progress progress-sm m-t-10 m-b-0">
               <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
         </div>
      </div>
   </div>
</div>
</div
<div class="row">
   <div class="col-lg-4">
      <div class="panel lobipanel-basic panel-info">
         <div class="panel-heading">
            <div class="panel-title">@lang('Informations de l\'entreprise')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Statut juridique') </b></span> : <span class="info-value"> {{($user->statut_juridique == null ? "____________" : $user->statut_juridique   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Numéro SIRET') </b></span> : <span class="info-value"> {{($user->numero_siret == null ? "____________" : $user->numero_siret   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Code NAF') </b></span> : <span class="info-value"> {{($user->code_caf == null ? "____________" : $user->code_caf   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Date d\'imatriculation') </b></span> : <span class="info-value"> {{($user->date_immatriculation == null ? "____________" : $user->date_immatriculation  )}}</span>
            </p>
            <p class="xxx">
                <span class="info-title"><b>@lang('Numéro d\'immatriculation RSAC') </b></span> : <span class="info-value"> {{($user->numero_carte_pro == null ? "____________" : $user->numero_carte_pro  )}}</span>
             </p>
             <p class="xxx">
                <span class="info-title"><b>@lang('Numéro d\'assurance') </b></span> : <span class="info-value"> {{($user->numero_assurance == null ? "____________" : $user->numero_assurance  )}}</span>
             </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
   <div class="col-lg-4">
      <div class="panel lobipanel-basic panel-warning">
         <div class="panel-heading">
            <div class="panel-title">@lang('Complément informations d\'entreprise')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Numéro de TVA') </b></span> : <span class="info-value"> {{($user->numero_tva == null ? "____________" : $user->numero_tva   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Numéro RCS') </b></span> : <span class="info-value"> {{($user->numero_rcs == null ? "____________" : $user->numero_rcs   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Nom légal de l\'entreprise ') </b></span> : <span class="info-value"> {{($user->nom_legal_entreprise == null ? "____________" : $user->nom_legal_entreprise   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Linkedin') </b></span> : <span class="info-value"> {{($user->linkedin == null ? "____________" : $user->linkedin   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Facebook') </b></span> : <span class="info-value"> {{($user->facebook == null ? "____________" : $user->facebook   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Twitter') </b></span> : <span class="info-value"> {{($user->twitter == null ? "____________" : $user->twitter   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Instagram') </b></span> : <span class="info-value"> {{($user->instagram == null ? "____________" : $user->instagram   )}}</span>
            </p>
         </div>
      </div>
   </div>
   <div class="col-lg-4">
      <div class="panel lobipanel-basic panel-pink">
         <div class="panel-heading">
            <div class="panel-title">@lang('Informations bancaires')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Nom de banque') </b></span> : <span class="info-value"> {{($user->nom_banque == null ? "____________" : $user->nom_banque   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Numéro du compte') </b></span> : <span class="info-value"> {{($user->numero_compte == null ? "____________" : $user->numero_compte   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('IBAN') </b></span> : <span class="info-value"> {{($user->iban == null ? "____________" : $user->iban   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('BIC') </b></span> : <span class="info-value"> {{($user->bic == null ? "____________" : $user->bic   )}}</span>
            </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card p-0">
         <div class="media">
            <div class="p-5 bg-info media-left media-middle">
               <i class="ti-user f-s-28 color-white"></i>
            </div>
            <div class="p-10 media-body">
               <h4 class="color-warning m-r-10">@lang('Pieces jointes et justificatifs') </h4>
               <div class="progress progress-sm m-t-10 m-b-0">
                  <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-6">
      <div class="panel lobipanel-basic panel-danger">
         <div class="panel-heading">
            <div class="panel-title">@lang('Documents personnelles')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Type de piece d\'identité') </b></span> : <span class="info-value"> {{($user->type_piece_identite == null ? "____________" : $user->type_piece_identite   )}}</span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Piece d\'identité') </b></span> :
               <span class="info-value">
               @if($user->piece_identite != null)
               <a href="{{route('user.getDocument',[$user->id,"piece_identite"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document') {{$user->piece_identite}}
               @endif
               </span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Livret de famille') </b></span> : 
               <span class="info-value">
               @if($user->livret_famille != null)
               <a href="{{route('user.getDocument',[$user->id,"livret_famille"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document')
               @endif
               </span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('RIB bancaire') </b></span> :
               <span class="info-value">
               @if($user->rib_banque != null)
               <a href="{{route('user.getDocument',[$user->id,"rib"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document')
               @endif
               </span>
            </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
   <div class="col-lg-6">
      <div class="panel lobipanel-basic panel-primary">
         <div class="panel-heading">
            <div class="panel-title">@lang('Documents profesionnels')</div>
         </div>
         <div class="panel-body">
            <p class="xxx">
               <span class="info-title"><b>@lang('Registre de commerce ou attestation d\'immatriculation') </b></span> : 
               <span class="info-value">
               @if($user->registre_commerce_ou_attestation_immatriculation != null)
               <a href="{{route('user.getDocument',[$user->id,"registre_commerce"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document')
               @endif
               </span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Carte professionnelle') </b></span>
               <span class="info-value">
               @if($user->carte_pro != null)
               <a href="{{route('user.getDocument',[$user->id,"carte_pro"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document')
               @endif
               </span>
            </p>
            <p class="xxx">
               <span class="info-title"><b>@lang('Attestation d\'assurance résponsabilité civile') </b></span> : 
               <span class="info-value">
               @if($user->attestation_assurance_responsabilite_civile != null)
               <a href="{{route('user.getDocument',[$user->id,"attestation_assurance"])}}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5"><i class="ti-download"></i>@lang('Télécharger')</a>
               @else
               @lang('Aucun document')
               @endif
               </span>
            </p>
         </div>
      </div>
   </div>
   <!-- /# column -->
</div>
@endif
@endsection