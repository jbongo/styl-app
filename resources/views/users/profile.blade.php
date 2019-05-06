@extends('layouts.main.dashboard')
@prospect

@else
    @include('compenents.navbar')
@endprospect

@extends('compenents.header')

@section('content')
    @section('pageActuelle')
    @lang('Mon profil')
    @endsection

    <div class="row"> 
        <div class="col-lg-6">       
            <div class="card alert">
                    <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h4>Mon profil</h4>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile m-t-15">
                                        <div class="row">
                                          
                                                @not_prospect_or_plus
                                                <a href="{{route('users')}}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-angle-left"></i>@lang('Retourner à la Liste des utilisateurs')</a> &nbsp;&nbsp;
                                               <span><a href="{{route('user.edit',$user->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $user->nom }}"><i class="ti-pencil-alt color-success"></i>@lang('Modifier mon profil')</a></span>
                                               @endnot_prospect_or_plus
                                               <hr>
                                           
                                            <div class="col-lg-4">
                                                <div class="user-photo m-b-30">
                                                    <img class="img-responsive" id="photodisplay" style="object-fit: cover; width: 225px; height: 225px; border: 5px solid #8ba2ad; border-style: solid; border-radius: 20px; padding: 3px;" src="{{asset('/images/photo_profile/'.(($user->photo_profile) ? $user->photo_profile : "user.png"))}}" alt="@lang('Photo de profil')">
                                                    
                                                    <div class="user-send-message"><button class="btn btn-success btn-addon" type="button" id="modifPhoto"><i class="ti-pencil"></i>@lang('Photo de profil')</button></div>
                                                    
                                                </div>
                                            <form action="{{route('user.photoProfile')}}" method="post" enctype="multipart/form-data">
                                                      @csrf  
                                                    <input class="form-control" id="photobtn" type="hidden" name="photo">
                                                    <input class="form-control btn-danger"  id="valider" value="Enregistrer" type="hidden" name="submit">
                                                </form>
                                            </div>
                                            <div class="col-lg-8">
                                            <div class="user-profile-name">{{$user->prenom}} {{$user->nom}}</div>
                                                <span class="badge badge-success">@lang('En ligne')</span>
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
                                                                <div class="phone-content">
                                                                    <span class="contact-title">@lang('Dernière connexion'):</span>
                                                                    <span class="phone-number">A implémenter</span>
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

        <!--prospect plus et mandataire-->
        @prospect_plus_or_mandataire
        <div class="col-lg-4">
                <div class="card p-0">
                        <div class="media">
                           <div class="p-20 media-body">
                              <h4 class="color-danger">Mon contrat</h4>
                              <br>
                              <p>   Vous pouvez télécharger votre contrat ici.</p>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-lg-offset-1">
                                    @php($doc = 0)
                                    <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc])}}" style="margin-bottom: 20px;">Contrat</a>
                                    <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc + 1])}}" style="margin-bottom: 20px;">Annexe 1</a>
                                    <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc + 2])}}" style="margin-bottom: 20px;">Annexe 2</a>
                                    <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc + 3])}}" style="margin-bottom: 20px;">Annexe 3</a>
                                <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc + 4])}}" style="margin-bottom: 20px;">Annexe 4</a>
                                <!--mandataire-->
                                @mandataire
                                <a class="btn btn-pink" href="{{route('contrat.user.download', [$user->id, $doc + 5])}}" style="margin-bottom: 20px;">Annexe 5</a>
                                @endmandataire
                                <!--mandataire-->
                            </div>
                        </div>
                    </div>
        </div>
        @endprospect_plus_or_mandataire
<!--prospect plus et mandataire fin-->

<!--prospect plus-->
@prospect_plus_no_annex5
        <div class="col-lg-4">
                <div class="card p-0">
                        <div class="media">
                           <div class="p-20 media-body">
                              <h4 class="color-danger">Recommandation</h4>
                              <br>
                              <p>Vos informations RSAC et assurance ne sont pas à jour, pensez à les completer sinon votre compte sera bloqué.</p>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-4">

                                <a class="btn btn-pink" href="{{route('contrat.getannex5')}}" style="margin-bottom: 20px;">Completer</a>
                            </div>
                        </div>
                    </div>
        </div>
@endprospect_plus_no_annex5
<!--prospect plus fin-->
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
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">StumbleUpon is acquired by eBay. </h5>
                                </div>
                                <div class="timeline-body">
                                    <p>15 minutes ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">StumbleUpon is acquired by eBay. </h5>
                                </div>
                                <div class="timeline-body">
                                    <p>15 minutes ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">StumbleUpon is acquired by eBay. </h5>
                                </div>
                                <div class="timeline-body">
                                    <p>15 minutes ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">StumbleUpon is acquired by eBay. </h5>
                                </div>
                                <div class="timeline-body">
                                    <p>15 minutes ago</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge success"><i class="fa fa-check-circle-o"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">StumbleUpon is acquired by eBay. </h5>
                                </div>
                                <div class="timeline-body">
                                    <p>15 minutes ago</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
@endsection

@section('js-mb')

<script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photodisplay').fadeOut();
                $('#photodisplay').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

$('#modifPhoto').click(function(){
$('#modifPhoto').fadeOut(500);
$("#photobtn").attr('type','file');

});
    $("#photobtn").change(function () {
        readURL(this);
        $('#valider').attr('type','submit');
    });

</script>
<script>
    console.log("test");
    </script>
@endsection