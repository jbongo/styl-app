<div class="row">
    <div class="col-lg-12">
       <div class="panel panel-danger m-t-15" id="cont">
          <div class="panel-heading">Agenda de suivi des prospects.</div>
          <div class="panel-body">
             <div class="card alert">
                <div class="card-body">
                   <div class="row">
                      <div class="col-lg-4 col-sm-12 col-md-8">
                         <a href="#" data-toggle="modal" data-target="#planifiate" class="btn btn-success btn-rounded btn-addon btn-lg">
                         <i class="fa fa-plus color"></i> Plannification
                         </a>
                         <br><br>
                         <!--<div class="panel panel-warning lobipanel-basic" id="cont">
                            <div class="panel-heading">Taches du mois en cours.</div>
                            <div class="panel-body">
                               <div class="card">
                                  <div class="media">
                                     <div class="media-body media-text-left">
                                        <h4>20</h4>
                                        <p class="color-white"><strong style="color: #3bb1e2;">Appels à passer</strong></p>
                                     </div>
                                     <div class="media-right meida media-middle">
                                        <i class="material-icons f-s-48 color-success">phone_forwarded</i>
                                     </div>
                                  </div>
                               </div>
                               <div class="card">
                                  <div class="media">
                                     <div class="media-body media-text-left">
                                        <h4>278</h4>
                                        <p class="color-white"><strong style="color: #3bb1e2;">Emails à envoyer</strong></p>
                                     </div>
                                     <div class="media-right meida media-middle">
                                        <i class="material-icons f-s-48 color-danger">mail</i>
                                     </div>
                                  </div>
                               </div>
                               <div class="card">
                                  <div class="media">
                                     <div class="media-body media-text-left">
                                        <h4>3</h4>
                                        <p class="color-white"><strong style="color: #3bb1e2;">Rencontres</strong></p>
                                     </div>
                                     <div class="media-right meida media-middle">
                                        <i class="material-icons f-s-48 color-warning">weekend</i>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>-->
                         <div class="panel panel-default lobipanel-basic scrollbar scrollbar-lady-lips" id="cont">
                            <div class="panel-heading">Taches journalières.</div>
                            <div class="panel-body scrollbar-near-moon" style="max-height: 620px; overflow-y:scroll;">
                                    @php
                                    $ok = 1;
                                    $ko = 0;
                                 @endphp
                                @foreach($today as $el)
                                @if($el->role === "appel")
                                <div class="card" style="border-color: #1de9b6;">
                                    <div class="stat-widget-four">
                                            <div class="stat-header">
                                                    @if($el->confirmation === NULL)    
                                                        <div class="card-option drop-menu pull-right">
                                                                <i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" style="color: #40b3e2; font-size: 20px;" aria-expanded="true" role="link"></i>
                                                                <ul class="card-option-dropdown dropdown-menu">
                                                                        <li><a class="check_agenda" href="{{ route('suivi.validate', [$ok, $el->id]) }}"><i class="ti-check color-success"></i> Abouti</a></li>
                                                                        <li><a class="uncheck_agenda" href="{{ route('suivi.validate', [$ko, $el->id]) }}"><i class="ti-close color-danger"></i>Non abouti</a></li>
                                                                    </ul>
                                                            </div>
                                                            @endif
                                                </div>
                                        <div class="stat-icon">
                                            <i class="material-icons f-s-35 color-success">phone_forwarded</i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="text-left dib" style="margin-right: 60px;">
                                                <ul>
                                                <li><strong><span class="ti-user"></span> {{$el->leads->nom.' '.$el->leads->prenom}}</strong></li>
                                                    <li><span class="ti-time"></span> {{$el->heure}}</li>
                                                        <li><span class="ti-mobile"></span> <strong style="color: #37afe1; text-decoration: underline;">{{$el->leads->telephone}}</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($el->role === "email")
                                <div class="card" style="border-color: #f39c12;">
                                        <div class="stat-widget-four">
                                                <div class="stat-header">
                                                        @if($el->confirmation === NULL)    
                                                        <div class="card-option drop-menu pull-right">
                                                                <i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" style="color: #40b3e2; font-size: 20px;" aria-expanded="true" role="link"></i>
                                                                <ul class="card-option-dropdown dropdown-menu">
                                                                        <li><a class="check_agenda" href="{{ route('suivi.validate', [$ok, $el->id]) }}"><i class="ti-check color-success"></i> Abouti</a></li>
                                                                        <li><a class="uncheck_agenda" href="{{ route('suivi.validate', [$ko, $el->id]) }}"><i class="ti-close color-danger"></i>Non abouti</a></li>
                                                                    </ul>
                                                            </div>
                                                            @endif
                                                    </div>
                                            <div class="stat-icon">
                                                <i class="material-icons f-s-35 color-warning">mail</i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="text-left dib" style="margin-right: 60px;">
                                                    <ul>
                                                    <li><strong><span class="ti-user"></span> {{$el->leads->nom.' '.$el->leads->prenom}}</strong></li>
                                                        <li><span class="ti-time"></span> {{$el->heure}}</li>
                                                            <li><span class="ti-email"></span> <strong style="color: #37afe1; text-decoration: underline;">{{$el->leads->email}}</strong></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($el->role === "rencontre")
                                    <div class="card" style="border-color: #e6a1f2;">
                                            <div class="stat-widget-four">
                                                    <div class="stat-header">
                                                        @if($el->confirmation === NULL)    
                                                        <div class="card-option drop-menu pull-right">
                                                                <i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" style="color: #40b3e2; font-size: 20px;" aria-expanded="true" role="link"></i>
                                                                <ul class="card-option-dropdown dropdown-menu">
                                                                        <li><a class="check_agenda" href="{{ route('suivi.validate', [$ok, $el->id]) }}"><i class="ti-check color-success"></i> Abouti</a></li>
                                                                        <li><a class="uncheck_agenda" href="{{ route('suivi.validate', [$ko, $el->id]) }}"><i class="ti-close color-danger"></i>Non abouti</a></li>
                                                                    </ul>
                                                            </div>
                                                            @endif
                                                        </div>
                                                <div class="stat-icon">
                                                    <i class="material-icons f-s-35 color-pink">weekend</i>
                                                </div>
                                                <div class="stat-content">
                                                    <div class="text-left dib" style="margin-right: 60px;">
                                                        <ul>
                                                        <li><strong><span class="ti-user"></span> {{$el->leads->nom.' '.$el->leads->prenom}}</strong></li>
                                                            <li><span class="ti-time"></span> {{$el->heure}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                            </div>
                         </div>
                         <!--<div id="external-events" class="m-t-20">
                            <br>
                            <div class="external-event bg-primary" data-class="bg-primary">
                                <i class="fa fa-move"></i>New Theme Release
                            </div>
                            <div class="external-event bg-pink" data-class="bg-pink">
                                <i class="fa fa-move"></i>My Event
                            </div>
                            <div class="external-event bg-warning" data-class="bg-warning">
                                <i class="fa fa-move"></i>Meet manager
                            </div>
                            <div class="external-event bg-dark" data-class="bg-dark">
                                <i class="fa fa-move"></i>Create New theme
                            </div>
                            </div>-->
                      </div>
                      <div class="col-md-12 col-sm-12 col-lg-8">
                         <div class="card-box">
                            <div id="calendar"></div>
                         </div>
                      </div>
                      <!-- end col -->
                      <!-- BEGIN MODAL -->
                      <div class="modal fade none-border" id="event-modal">
                         <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title"><strong>Add New Event</strong></h4>
                               </div>
                               <div class="modal-body"></div>
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                  <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                               </div>
                            </div>
                         </div>
                      </div>
                      <!--planifier sur le calendar-->
                      <div class="modal" id="planifiate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel"><strong>Plannifier une tache</strong></h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                     </button>
                                  </div>
                                  <div class="modal-body">
                                     <div class="panel lobipanel-basic panel-warning">
                                        <div class="panel-heading">
                                           <div class="panel-title">Attention</div>
                                        </div>
                                        <div class="panel-body">
                                           Remplissez correctement le formulaire, tous les champs finissant par <span class="text-danger">*</span> sont obligatoires et vous devez disposer de toutes les informations, une saisie incorrecte entrainera la non validation de la fiche.
                                        </div>
                                     </div>
                                     <br>
                                     <form class="form-validy8745hgf form-horizontal" action="{{ route('suivi.add') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                           <label class="col-sm-4 control-label" for="lead_id">Choisir le prospect<span class="text-danger">*</span></label>
                                           <div class="col-lg-4">
                                              <select class="selectpicker col-lg-8" id="lead_id" name="lead_id" data-live-search="true" data-style="btn-pink btn-rounded" required>
                                                 @foreach($leads as $dr)
                                                 <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->prenom}} {{$dr->email}} {{$dr->telephone}} {{$dr->code_postal}} {{$dr->ville}}">{{$dr->nom}} {{$dr->prenom}}</option>
                                                 @endforeach                                
                                              </select>
                                           </div>
                                        </div>
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
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- /# card -->
    </div>
    <!-- /# column -->
 </div>