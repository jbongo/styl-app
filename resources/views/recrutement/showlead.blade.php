@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="col-lg-6">
                  <div class="panel panel-info lobipanel-basic">
                     <div class="panel-heading">Fiche contact.</div>
                     <div class="panel-body">
                        <div class="card alert">
                           <div class="card-body">
                              <div class="user-profile">
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <div class="user-photo m-b-30">
                                          <i class="material-icons" style="font-size: 175px;color: #f0f0f0;background: #a2a2a2;border-radius: 27px;">person</i>
                                       </div>
                                       <div class="user-work">
                                          <h4 style="color: #32ade1;text-decoration: underline;">Statistiques de suivi</h4>
                                          <div class="work-content">
                                             <p><strong>Appels: </strong><span class="badge badge-success">{{$array[0]}}</span> </p>
                                             <p><strong>Emails: </strong><span class="badge badge-warning">{{$array[1]}}</span></p>
                                             <p><strong>Rencontres: </strong><span class="badge badge-pink">{{$array[2]}}</span></p>
                                          </div>
                                       </div>
                                       @if($lead->qualification === 0)
                                       <div class="user-skill">
                                          <h4 style="color: #32ade1;text-decoration: underline;">Options</h4>
                                          <a type="button" data-toggle="modal" data-target="#leadedit" class="btn btn-warning btn-rounded btn-addon btn-xs m-b-10"><i class="ti-pencil"></i>Modifier</a>
                                          <a type="button" data-toggle="modal" data-target="#planifiate_usr" class="btn btn-info btn-rounded btn-addon btn-xs m-b-10"><i class="ti-plus"></i>Plannifier</a>
                                       </div>
                                       @endif
                                    </div>
                                    <div class="col-lg-8">
                                       <div class="user-profile-name" style="color: #d68300;">{{$lead->nom}} {{$lead->prenom}}</div>
                                       <div class="user-Location"><i class="ti-location-pin"></i> {{$lead->ville}}</div>
                                       @if($lead->qualification === 0)
                                       <div class="user-send-message"><a class="btn btn-success btn-addon to_usr" href="{{ route('lead.validate', $lead->id) }}" type="button"><i class="ti-medall"></i>Valider</a></div>
                                       @else
                                       <div class="card p-0">
                                             <div class="media bg-success">
                                                 <div class="p-20 bg-danger-dark media-left media-middle">
                                                     <i class="ti-medall f-s-48 color-white"></i>
                                                 </div>
                                                 <div class="p-20 media-body">
                                                     <h4 class="colcolor-white" style="color: white;"><strong>Prospect recruté</strong></h4>
                                                 </div>
                                             </div>
                                         </div>
                                       @endif
                                       <div class="custom-tab user-profile-tab">
                                          <ul class="nav nav-tabs" role="tablist">
                                             <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">Détails du prospect</a></li>
                                          </ul>
                                          <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane active" id="1">
                                                <div class="contact-information">
                                                   <div class="phone-content">
                                                      <span class="contact-title"><strong>Téléphone:</strong></span>
                                                      <span class="phone-number" style="color: #ff435c; text-decoration: underline;">{{$lead->telephone}}</span>
                                                   </div>
                                                   <div class="address-content">
                                                      <span class="contact-title"><strong>Adresse:</strong></span>
                                                      <span class="mail-address">{{$lead->adresse}}</span>
                                                   </div>
                                                   <div class="website-content">
                                                      <span class="contact-title"><strong>Code postal:</strong></span>
                                                      <span class="contact-website">{{$lead->code_postal}}</span>
                                                   </div>
                                                   <div class="website-content">
                                                      <span class="contact-title"><strong>Ville:</strong></span>
                                                      <span class="contact-website">{{$lead->ville}}</span>
                                                   </div>
                                                   <div class="email-content">
                                                      <span class="contact-title"><strong>Email:</strong></span>
                                                      <span class="contact-email" style="color: #ff435c; text-decoration: underline;">{{$lead->email}}</span>
                                                   </div>
                                                </div>
                                                <div class="basic-information">
                                                   <h4 style="color: #32ade1;text-decoration: underline;">Source du prospect</h4>
                                                   <div class="birthday-content">
                                                      <span class="contact-title"><strong>Canal source:</strong></span>
                                                      <span class="birth-date"><span class="badge badge-default">{{$lead->canalprospection->nom_canal}}</span></span>
                                                   </div>
                                                   <div class="gender-content">
                                                      <span class="contact-title"><strong>Date d'ajout:</strong></span>
                                                      <span class="gender">{{date('d-m-Y',strtotime($lead->created_at))}}</span>
                                                   </div>
                                                </div>
                                                <div class="basic-information">
                                                   <h4 style="color: #32ade1;text-decoration: underline;">Infos activité</h4>
                                                   <div class="birthday-content">
                                                      <span class="contact-title"><strong>Professionnel:</strong></span>
                                                      @if($lead->professionnel == 1)
                                                      <span class="birth-date"><span class="badge badge-success">OUI</span> </span>
                                                      @else
                                                      <span class="birth-date"><span class="badge badge-danger">NON</span> </span>
                                                      @endif
                                                   </div>
                                                   <div class="gender-content">
                                                      
                                                      <span class="contact-title"><strong>Immobilier:</strong></span>
                                                      @if($lead->pro_immo == 1)
                                                      <span class="birth-date"><span class="badge badge-success">OUI</span> </span>
                                                      @else
                                                      <span class="birth-date"><span class="badge badge-danger">NON</span> </span>
                                                      @endif
                                                   </div>
                                                   @if($lead->pro_immo == 1)
                                                   <div class="gender-content">
                                                      <span class="contact-title"><strong>Type immobilier:</strong></span>
                                                      <span class="gender">{{$lead->type_immo}}</span>
                                                   </div>
                                                   @endif
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
               <div class="col-lg-6">
                  <div class="panel panel-warning lobipanel-basic scrollbar scrollbar-lady-lips" id="cont">
                     <div class="panel-heading">Suivi du recrutement du prospect.</div>
                     <div class="panel-body scrollbar-near-moon" style="max-height: 780px; overflow-y:scroll;">
                        <div class="card alert">
                           <div class="recent-comment">
                              @php
                                 $today = strtotime(date("Y-m-d"));
                                 $ok = 1;
                                 $ko = 0;
                              @endphp
                              @foreach($collection as $el)
                              @if($el->role === "appel")
                              <div class="media">
                                 <div class="media-left">
                                    <i class="material-icons f-s-35 color-success">phone_forwarded</i>
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading"><strong>Appel</strong></h4>
                                    <p>{{$el->commentaires}}</p>
                                    <div class="comment-action" style="margin-right: 15px;">
                                          @if(($today - strtotime($el->date)) < 0 )
                                          <div class="badge badge-info">En cours</div>
                                          @elseif(($today - strtotime($el->date)) >= 0 && ($el->confirmation === NULL))
                                          <div class="badge badge-warning">Validation necessaire !</div>
                                          @elseif($el->confirmation == 1)
                                          <div class="badge badge-success">Abouti</div>
                                          @elseif($el->confirmation == 0)
                                          <div class="badge badge-danger">Non abouti</div>
                                          @endif
                                          @if((($today - strtotime($el->date)) >= 0) && $el->confirmation === NULL)
                                       <span class="m-l-10">
                                       <a href="{{ route('suivi.validate', [$ok, $el->id]) }}" class="check_biff"><i class="ti-check f-s-25 color-success"></i></a>
                                       <a href="{{ route('suivi.validate', [$ko, $el->id]) }}" class="uncheck_biff"><i class="ti-close f-s-25 color-danger"></i></a>
                                       </span>
                                       @endif
                                       </div>
                                    <p class="comment-date"><i class="ti-time"> </i> <strong> {{date('d-m-Y',strtotime($el->date))}} - {{$el->heure}}</strong></p>
                                 </div>
                              </div>
                              @elseif($el->role === "email")
                              <div class="media">
                                 <div class="media-left">
                                    <i class="material-icons f-s-35 color-warning">mail</i>
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading"><strong>Email</strong></h4>
                                    <p>{{$el->commentaires}}</p>
                                    <div class="comment-action" style="margin-right: 15px;">
                                          @if(($today - strtotime($el->date)) < 0)
                                          <div class="badge badge-info">En cours</div>
                                          @elseif(($today - strtotime($el->date)) >= 0 && $el->confirmation === NULL)
                                          <div class="badge badge-warning">Validation necessaire !</div>
                                          @elseif($el->confirmation === 1)
                                          <div class="badge badge-success">Abouti</div>
                                          @elseif($el->confirmation === 0)
                                          <div class="badge badge-danger">Non abouti</div>
                                          @endif
                                          @if((($today - strtotime($el->date)) >= 0) && $el->confirmation === NULL)
                                       <span class="m-l-10">
                                             <a href="{{ route('suivi.validate', [$ok, $el->id]) }}" class="check_biff"><i class="ti-check f-s-25 color-success"></i></a>
                                       <a href="{{ route('suivi.validate', [$ko, $el->id]) }}" class="uncheck_biff"><i class="ti-close f-s-25 color-danger"></i></a>
                                       </span>
                                       @endif
                                       </div>
                                       <p class="comment-date"><i class="ti-time"> </i> <strong> {{date('d-m-Y',strtotime($el->date))}} - {{$el->heure}}</strong></p>
                                 </div>
                              </div>
                              @elseif($el->role === "rencontre")
                              <div class="media">
                                 <div class="media-left">
                                    <i class="material-icons f-s-35 color-pink">weekend</i>
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading"><strong>Rencontre</strong></h4>
                                    <p>{{$el->commentaires}}</p>
                                    <div class="comment-action" style="margin-right: 15px;">
                                          @if(($today - strtotime($el->date)) < 0)
                                          <div class="badge badge-info">En cours</div>
                                          @elseif(($today - strtotime($el->date)) >= 0 && $el->confirmation === NULL)
                                          <div class="badge badge-warning">Validation necessaire !</div>
                                          @elseif($el->confirmation == 1)
                                          <div class="badge badge-success">Abouti</div>
                                          @elseif($el->confirmation == 0)
                                          <div class="badge badge-danger">Non abouti</div>
                                          @endif
                                          @if((($today - strtotime($el->date)) >= 0) && $el->confirmation === NULL)
                                       <span class="m-l-10">
                                             <a href="{{ route('suivi.validate', [$ok, $el->id]) }}" class="check_biff"><i class="ti-check f-s-25 color-success"></i></a>
                                       <a href="{{ route('suivi.validate', [$ko, $el->id]) }}" class="uncheck_biff"><i class="ti-close f-s-25 color-danger"></i></a>
                                       </span>
                                       @endif
                                       </div>
                                       <p class="comment-date"><i class="ti-time"> </i> <strong> {{date('d-m-Y',strtotime($el->date))}} - {{$el->heure}}</strong></p>
                                 </div>
                              </div>
                              @endif
                              @endforeach

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--planifier sur le calendar-->
      <div class="modal" id="planifiate_usr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Plannifier une tache concernant {{$lead->nom.' '.$lead->prenom}}</strong></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <br>
                     <form class="form-validy8745hgf form-horizontal" action="{{ route('suivi.add') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="lead_id" name="lead_id" value="{{$lead->id}}">
                        <div class="form-group row">
                                <label class="col-sm-4 control-label" for="role">Objet de la plannification<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                   <select class="js-select2 form-control" id="role" name="role" required>
                                      <option value="appel">Appel téléphonique</option>
                                      <option value="email">Envois d'un email</option>
                                      <option value="rencontre">Rencontrer le prospect</option>
                                   </select>
                                </div>
                             </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="date">Date<span class="text-danger">*</span></label>
                           <div class="col-lg-4">
                              <input type="date" id="date" class="form-control {{$errors->has('date') ? 'is-invalid' : ''}}" value="{{old('date')}}" name="date" required>
                              @if ($errors->has('date'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('date')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="heure">Heure prévue<span class="text-danger">*</span></label>
                           <div class="col-lg-2">
                              <input type="time" id="heure" class="form-control {{$errors->has('heure') ? 'is-invalid' : ''}}" value="{{old('heure')}}" name="heure" required>
                              @if ($errors->has('heure'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('heure')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-sm-4 control-label" for="commentaires">Commentaires et notes<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                   <textarea rows="6" id="commentaires" class="form-control {{$errors->has('commentaires') ? 'is-invalid' : ''}}" value="{{old('commentaires')}}" name="commentaires" placeholder="Ex: Envois model économique du réseau..." required></textarea>
                                   @if ($errors->has('commentaires'))
                                   <br>
                                   <div class="alert alert-warning ">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>{{$errors->first('commentaires')}}</strong> 
                                   </div>
                                   @endif
                                </div>
                             </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-success">valider</button>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      <!--fin-->

      <!--modal edit-->
      <div class="modal fade" id="leadedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel"><strong>Modifier la fiche prospect</strong></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form class="form-validy8745hgf form-horizontal" action="{{ route('lead.update', $lead->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="nom">Nom<span class="text-danger">*</span></label>
                           <div class="col-lg-4">
                              <input type="text" id="nom" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{$errors->has('nom') ? old('nom') : $lead->nom}} " name="nom" required>
                              @if ($errors->has('nom'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('nom')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="prenom">Prénom<span class="text-danger">*</span></label>
                           <div class="col-lg-4">
                              <input type="text" id="prenom" class="form-control {{$errors->has('prenom') ? 'is-invalid' : ''}}" value="{{$errors->has('prenom') ? old('prenom') : $lead->prenom}}" name="prenom" required>
                              @if ($errors->has('prenom'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('prenom')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="email">Email<span class="text-danger">*</span></label>
                           <div class="col-lg-2">
                              <input type="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$errors->has('email') ? old('email') : $lead->email}}" name="email"  required>
                              @if ($errors->has('email'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('email')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="telephone">Téléphone<span class="text-danger">*</span></label>
                           <div class="col-lg-2">
                              <input type="text" id="telephone" class="form-control {{$errors->has('telephone') ? 'is-invalid' : ''}}" value="{{$errors->has('telephone') ? old('telephone') : $lead->telephone}}" name="telephone" required>
                              @if ($errors->has('telephone'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('telephone')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="adresse">Adresse</label>
                           <div class="col-lg-4">
                              <input type="text" id="adresse" class="form-control {{$errors->has('adresse') ? 'is-invalid' : ''}}" value="{{$errors->has('adresse') ? old('adresse') : $lead->adresse}}" name="adresse" required>
                              @if ($errors->has('adresse'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('adresse')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="code_postal">Code postal<span class="text-danger">*</span></label>
                           <div class="col-lg-2">
                              <input type="text" id="code_postal" class="form-control {{$errors->has('code_postal') ? 'is-invalid' : ''}}" value="{{$errors->has('code_postal') ? old('code_postal') : $lead->code_postal}}" name="code_postal" required>
                              @if ($errors->has('code_postal'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('code_postal')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="ville">Ville<span class="text-danger">*</span></label>
                           <div class="col-lg-3">
                              <input type="text" id="ville" class="form-control {{$errors->has('ville') ? 'is-invalid' : ''}}" value="{{$errors->has('ville') ? old('ville') : $lead->ville}}" name="ville" required>
                              @if ($errors->has('ville'))
                              <br>
                              <div class="alert alert-warning ">
                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>{{$errors->first('ville')}}</strong> 
                              </div>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 control-label" for="b_pro">Contact professionnel ?</label>
                           <div class="col-lg-2">
                              <input type="checkbox" {{($lead->professionnel === 1) ? 'checked' : 'unchecked'}} data-toggle="toggle" id="b_pro" name="b_pro" data-off="Non" data-on="Oui" data-onstyle="warning" data-offstyle="default">
                           </div>
                           <div class="bouboule1">
                              <label class="col-sm-4 control-label" for="b_pro_immo">Professionnel de l'immobilier ?</label>
                              <div class="col-lg-2">
                                 <input type="checkbox" {{($lead->pro_immo === 1) ? 'checked' : 'unchecked'}} data-toggle="toggle" id="b_pro_immo" name="b_pro_immo" data-off="Non" data-on="Oui" data-onstyle="warning" data-offstyle="default">
                              </div>
                           </div>
                        </div>
                        <div class="form-group row" id="bouboule2">
                           <label class="col-sm-4 control-label" for="type_immo">Type immobilier <span class="text-danger">*</span></label>
                           <div class="col-lg-4">
                              <select class="js-select2 form-control" id="type_immo" name="type_immo" required>
                                 <option value="agence">Agence</option>
                                 <option value="mandataire">Mandataire</option>
                                 <option value="autre">Autre</option>
                              </select>
                           </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-warning">valider</button>
                  </div>
                  </form>
               </div>
            </div>
         </div>
@endsection
@section('js-content')
<script>
      $(document).ready(function() {
         $('#b_pro').is(':unchecked') ? $('.bouboule1').hide() : $('.bouboule1').show();
               if ($('#b_pro').is(':unchecked'))
                  $('#bouboule2').hide();
               else if(!($('#b_pro_immo').is(':unchecked')))
                  $('#bouboule2').show();
                  $('#b_pro_immo').is(':unchecked') ? $('#bouboule2').hide() : $('#bouboule2').show();
         $('#b_pro').change(function(e){
               e.preventDefault();
               $('#b_pro').is(':unchecked') ? $('.bouboule1').hide() : $('.bouboule1').show();
               if ($('#b_pro').is(':unchecked'))
                  $('#bouboule2').hide();
               else if(!($('#b_pro_immo').is(':unchecked')))
                  $('#bouboule2').show();
         });
         $('#b_pro_immo').change(function(e){
               e.preventDefault();
               $('#b_pro_immo').is(':unchecked') ? $('#bouboule2').hide() : $('#bouboule2').show();
         });
      });
   </script>

<script>
   $(document).ready(function() {
   $('a.check_biff').click(function(e) {
      e.preventDefault();   
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Valider dans le cas ou la tache plannifié a été réussie, continuer ?';
      processAjaxSwal(route, warning, reload);
   })

   $('a.uncheck_biff').click(function(b) {
      b.preventDefault();       
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Valider dans le cas ou la tache n\'a pas abouti ou annulée, continuer ?';
      processAjaxSwal(route, warning, reload);
   })

   $('a.to_usr').click(function(b) {
      b.preventDefault();       
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Valider le recrutement du prospect et le transformer en utilisateur continuer ?';
      processAjaxSwal(route, warning, reload);
   })
});
   </script>
@endsection