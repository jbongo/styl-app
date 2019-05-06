@if (session('ok'))
       
<div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
</div>
@endif   

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="panel lobipanel-basic panel-warning">
               <div class="panel-heading">
                  <div class="panel-title">Instructions</div>
               </div>
               <div class="panel-body"> 
                  Attention, tous les champs doivent étre remplis correctement pour que votre inscription soit définitivement 
                  validée, assurez vous de la validité des informations avant d'envoyer votre dossier.
                  Vous pouvez soumettre vos informations de carte et de votre assurance résponsabilité
                  civile professionnelles plus tard si vous ne les avez pas encore, toutefois vous n'aurez accès aux
                  fonctionnalité principales du logiciel (Ajout de bien, mandats affaires...) qu'une fois ces informations soumises
                  et validées par un administrateur.
                  Pour les pieces justificatives et les documents les formats possibles sont: <strong>.pdf .jpeg .docx .doc .png</strong> la taille maximale est de <strong>5 Mb </strong> pour chaque piece. 
               </div>
            </div>
            <div class="form-validation">
                <form class="form-valide2 form-horizontal" id="msform" action="{{route('user.infoscompl', auth::user()->id)}}" enctype="multipart/form-data" method="post">
                    <!-- progressbar -->
                    <ul id="progressbar">
                       <li class="active">Informations de base</li>
                       <li>Informations professionnelles</li>
                       <li>Pieces jointes et justificatifs</li>
                    </ul>
                    <!-- fieldsets -->
                    @csrf
                    <fieldset>
                       <div class="row">
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-default">
                                <div class="panel-heading">
                                   <div class="panel-title">Complément d'informations personnelles</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="choice-famille">Situation familialle<span class="text-danger">*</span></label>
                                      <div class="col-sm-4">
                                         <select class="js-select2 form-control" id="choice-marital" name="situation_matri" style="width: 100%;" data-placeholder="Choose one.." required>
                                          @if($user->situation_matrimoniale)
                                          <option value="{{$user->situation_matrimoniale}}" > {{$user->situation_matrimoniale}} </option>
                                          @else
                                          <option value ="{{old('situation_matri')}}" >{{old('situation_matri')}}</option>
                                          @endif
                                            <option value="En couple">En couple</option>
                                            <option value="Célibataire">Célibataire</option>
                                            <option value="Marié">Marié(e)</option>
                                            <option value="Divorcé">Divorcé(e)</option>
                                            <option value="Veuf">Veuf(ve)</option>
                                         </select>
                                      </div>
                                      @if($errors->has('situation_matri'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('situation_matri')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>          
                                                       
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="val-lastname">Nom de jeune fille</label>
                                      <div class="col-sm-6">
                                      <input class="form-control" type="text" value="{{old('nom_jeune_fille') ? old('nom_jeune_fille') : $user->nom_jeune_fille}} " name="nom_jeune_fille" placeholder="Nom...">
                                         <span class="help-block">
                                         <small>Laissez vide si absent.</small>
                                         </span>
                                      </div>
                                      @if($errors->has('nom_jeune_fille'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_jeune_fille')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="birthday-date">Date de naissance<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control " id="birthday-date" value="{{old('date_naissance') ? old('date_naissance') : $user->date_naissance}}" name="date_naissance" type="date" placeholder="Ex: 09/09/1988..." required>
                                      </div>
                                      @if($errors->has('date_naissance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('date_naissance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="birthday-town">Ville de naissance<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" name="ville_naissance" value="{{old('ville_naissance') ? old('ville_naissance') : $user->ville_naissance}}"  id="birthday-town" type="text" placeholder="Ex: Paris..." required>
                                      </div>
                                      @if($errors->has('ville_naissance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('ville_naissance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="birth-country">Pays de naissance<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="birth-country" name="pays_naissance" value="{{old('pays_naissance') ? old('pays_naissance') : $user->pays_naissance}}"  type="text" placeholder="Ex: France..." required>
                                      </div>
                                      @if($errors->has('pays_naissance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('pays_naissance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="nationality-country">Nationalité<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="nationality-country" name="nationalite" value="{{old('nationalite') ? old('nationalite') : $user->nationnalite}}" type="text"  required>
                                         <span class="help-block">
                                         <small>Modifiez si hors France.</small>
                                         </span>
                                      </div>
                                      @if($errors->has('nationalite'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nationalite')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- /# column -->
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-pink">
                                <div class="panel-heading">
                                   <div class="panel-title">Autres informations</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label" for="dad">Nom et prénom du père<span class="text-danger">*</span></label>
                                      <div class="col-sm-5">
                                         <input class="form-control" id="dad" name="nom_pere" type="text" value="{{old('nom_pere') ? old('nom_pere') : $user->nom_prenom_pere}}"  placeholder="Nom et prénom..." required>
                                      </div>
                                      @if($errors->has('nom_pere'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_pere')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label" for="mom">Nom et prénom de la mére<span class="text-danger">*</span></label>
                                      <div class="col-sm-5">
                                         <input class="form-control" id="mom" name="nom_mere" type="text" value="{{old('nom_mere') ? old('nom_mere') : $user->nom_prenom_mere}}" placeholder="Nom et prénom..." required>
                                      </div>
                                      @if($errors->has('nom_mere'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_mere')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label" for="choice-know">Comment avez vous connu Styl'immo ?<span class="text-danger">*</span></label>
                                      <div class="col-sm-4">
                                         <select class="js-select2 form-control" id="choice-know"  name="comment_connu_styli"  style="width: 100%;" data-placeholder="Choose one.." required>
                                            
                                          @if($user->comment_connu_styli)
                                          <option value="{{$user->comment_connu_styli}}" > {{$user->comment_connu_styli}} </option>
                                          @else
                                          <option value="{{old('comment_connu_styli')}}">{{old('comment_connu_styli')}}</option>
                                          @endif
                                            <option value="Bouche à oreil">Bouche à oreil</option>
                                            <option value="Publicité internet">Publicité internet</option>
                                            <option value="Par le biais d'un mandataire">Par le biais d'un mandataire</option>
                                            <option value="Panneau publicitaire">Panneau publicitaire</option>
                                            <option value="Réseaux sociaux">Réseaux sociaux</option>
                                         </select>
                                      </div>
                                      @if($errors->has('comment_connu_styli'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('comment_connu_styli')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label" for="code-activity">@lang('Où souhaitez vous exercer l\'activité de mandataire ?')<span class="text-danger">*</span></label>
                                      <div class="col-sm-5">
                                         <textarea class="form-control" id="code-activity" name="ou_exercer"  rows="3" placeholder="Ex: 75001, 94230..." required>{{old('ou_exercer') ? old('ou_exercer') : $user->ou_souhaiter_exercer}}</textarea>
                                         <span class="help-block">
                                         <small>Séparez par des virgules.</small>
                                         </span>
                                      </div>
                                      @if($errors->has('ou_exercer'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('ou_exercer')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label" for="description">@lang('Décrivez-vous, votre activité')<span class="text-danger">*</span></label>
                                      <div class="col-sm-5">
                                         <textarea class="form-control" id="description" name="description"  rows="3" placeholder="" required>{{old('description') ? old('description') : $user->description}}</textarea>
                                         <span class="help-block">
                                         <small>@lang('Cette informations apparaitra sur le site de stylimmo')</small>
                                         </span>
                                      </div>
                                      @if($errors->has('description'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('description')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label">Autres informations</label>
                                      <div class="col-sm-5">
                                         <textarea class="form-control" name="autre_info" row="3" placeholder="...">{{old('autre_info') ? old('autre_info') : $user->autres_infos}}</textarea>
                                      </div>
                                      @if($errors->has('autre_info'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('autre_info')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- /# column -->
                       </div>
                       <input type="button" name="next" class="next action-button" value="Suivant" />
                    </fieldset>
                    <fieldset>
                       <div class="row">
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-default">
                                <div class="panel-heading">
                                   <div class="panel-title">Informations de l'entreprise</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="choice-corporate">Statut juridique<span class="text-danger">*</span></label>
                                      <div class="col-sm-4">
                                         <select class="js-select2 form-control" id="choice-corporate" name="statut_juridique" style="width: 100%;" data-placeholder="Choose one.." required>
                                         
                                          @if($user->statut_juridique)
                                          <option value="{{$user->statut_juridique}}" > {{$user->statut_juridique}} </option>
                                          @else
                                          <option value="{{old('statut_juridique')}}">{{old('statut_juridique')}}</option> 
                                          @endif
                                            <option value="VRP">VRP</option>
                                            <option value="Portage salarial">Portage salarial</option>
                                            <option value="Autoentrepreneur">Autoentrepreneur</option>
                                            <option value="Agent commercial">Agent commercial</option>
                                            <option value="Entreprise individuelle">EI Entreprise individuelle</option>
                                            <option value="Entreprise individuelle à résponsabilité limitée">EIRL Entreprise individuelle à résponsabilité limitée</option>
                                            <option value="unipersonnelle à résponsabilité limitée">EURL unipersonnelle à résponsabilité limitée</option>
                                            <option value="Societé à action simplifiée unipersonnelle">SASU Societé à action simplifiée unipersonnelle</option>
                                         </select>
                                      </div>
                                      @if($errors->has('statut_juridique'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('statut_juridique')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="siret">Numéro SIRET<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="siret"  value="{{old('numero_siret') ? old('numero_siret') : $user->numero_siret}}" name="numero_siret" type="text" placeholder="Ex: 802 954 785 00028" required>
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 14 caractères')</small>
                                          </span>
                                        </div>
                                     
                                      @if($errors->has('numero_siret'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('numero_siret')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="siren">Numéro SIREN<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="siren" name="numero_siren" value="{{old('numero_siren') ? old('numero_siren') : $user->numero_siren}}"  type="text" placeholder="Ex: 802 954 785" required>
                                      
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 9 caractères')</small>
                                          </span>  </div>
                                      @if($errors->has('numero_siren'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('numero_siren')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Code NAF</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" value="{{old('code_naf') ? old('code_naf') : $user->code_caf}}" name="code_naf" placeholder="Ex: 4711D">
                                         <span class="help-block">
                                                <small>@lang('Ce champ est de la forme 1234A')</small>
                                          </span>
                                        </div>
                                      @if($errors->has('code_naf'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('code_naf')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="date-matricle">Date d'imatriculation<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="date-matricle" value="{{old('date_immatriculation') ? old('date_immatriculation') : $user->date_immatriculation}}" name="date_immatriculation" type="date" placeholder="Ex: 25/08/2015" required>
                                      </div>
                                      @if($errors->has('date_immatriculation'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('date_immatriculation')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                </div>
                             </div>
                             <div class="panel lobipanel-basic panel-default">
                                <div class="panel-heading">
                                   <div class="panel-title">Complément informations d'entreprise</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Numéro de TVA</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="numero_tva" value="{{old('numero_tva') ? old('numero_tva') : $user->numero_tva}}" placeholder="Ex: FR22802954785">
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 13 caractères')</small>
                                          </span>
                                        </div>
                                      @if ($errors->has('numero_tva'))
                                      <br>
                                      <br><br>
                                          <div class="alert alert-warning">
                                              <strong>{{$errors->first('numero_tva')}}</strong> 
                                          </div> 
                                      <hr> 
                                      @endif
                                   </div>
                                   
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Numéro RCS</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="numero_rcs" value="{{old('numero_rcs') ? old('numero_rcs') : $user->numero_rcs}}" placeholder="Ex: RCS Paris 654 987 321">
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 9 caractères')</small>
                                          </span>
                                        </div>
                                      @if ($errors->has('numero_rcs'))
                                      <br>
                                      <br><br>
                                          <div class="alert alert-warning">
                                              <strong>{{$errors->first('numero_rcs')}}</strong> 
                                          </div> 
                                      <hr> 
                                      @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Nom légal de l'entreprise</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="nom_legal" value="{{old('nom_legal') ? old('nom_legal') : $user->nom_legal_entreprise}}" placeholder="Nom...">
                                         
                                         @if($errors->has('nom_legal'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_legal')}}</strong> 
                                              </div> 
                                          <hr> 
                                          @endif
                                         
                                         <span class="help-block">
                                         <small>Laissez vide si absence d'informations ou statut auto entrepreneur.</small>
                                         </span>
                                      </div>
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label"><i class="ti-linkedin"></i> @lang('Linkedin')</label>
                                      <div class="col-sm-6">
                                          <input class="form-control" type="text" name="linkedin" value="{{old('linkedin') ? old('linkedin') : $user->linkedin}}" placeholder="">
                                         
                                         @if($errors->has('linkedin'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('linkedin')}}</strong> 
                                              </div> 
                                          <hr> 
                                          @endif
                                         
                                         <span class="help-block">
                                         <small></small>
                                         </span>
                                      </div>
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label"><i class="ti-facebook"></i> @lang('Facebook')</label>
                                      <div class="col-sm-6">
                                          <input class="form-control" type="text" name="facebook" value="{{old('facebook') ? old('facebook') : $user->facebook}}" placeholder="">
                                         
                                         @if($errors->has('facebook'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('facebook')}}</strong> 
                                              </div> 
                                          <hr> 
                                          @endif
                                         
                                         <span class="help-block">
                                         <small></small>
                                         </span>
                                      </div>
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label"><i class="ti-twitter"></i> @lang('Twitter')</label>
                                      <div class="col-sm-6">
                                          <input class="form-control" type="text" name="twitter" value="{{old('twitter') ? old('twitter') : $user->twitter}}" placeholder="">
                                         
                                         @if($errors->has('twitter'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('twitter')}}</strong> 
                                              </div> 
                                          <hr> 
                                          @endif
                                         
                                         <span class="help-block">
                                         <small></small>
                                         </span>
                                      </div>
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label"><i class="ti-instagram"></i> @lang('Instagram')</label>
                                      <div class="col-sm-6">
                                          <input class="form-control" type="text" name="instagram" value="{{old('instagram') ? old('instagram') : $user->instagram}}" placeholder="">
                                         
                                         @if($errors->has('instagram'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('instagram')}}</strong> 
                                              </div> 
                                          <hr> 
                                          @endif
                                         
                                         <span class="help-block">
                                         <small></small>
                                         </span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- /# column -->
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-pink">
                                <div class="panel-heading">
                                   <div class="panel-title">Informations bancaires</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="bank-name">Nom de banque<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="bank-name" name="nom_banque" value="{{old('nom_banque') ? old('nom_banque') : $user->nom_banque}}" type="text" placeholder="Nom..." required>
                                      </div>
  
                                      @if($errors->has('nom_banque'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_banque')}}</strong> 
                                              </div> 
                                          <hr> 
                                      @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="rib">Numéro du compte<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="rib" name="numero_compte" value="{{old('numero_compte') ? old('numero_compte') : $user->numero_compte}}" type="text"  placeholder="Ex: 12345 12345 1234567891A 12" required>
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 11 caractères')</small>
                                          </span>
                                        </div>
                                      @if($errors->has('numero_compte'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('numero_compte')}}</strong> 
                                              </div> 
                                          <hr> 
                                      @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="iban">IBAN<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="iban" name="iban" value="{{old('iban') ? old('iban') : $user->iban}}" type="text" placeholder="Ex: FR00 1234 5123 4512 3456 7891 A12" required>
                                      
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir au moins 14 caractères')</small>
                                          </span>  </div>
  
                                      @if($errors->has('iban'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('iban')}}</strong> 
                                              </div> 
                                          <hr> 
                                      @endif
  
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="bic">BIC<span class="text-danger">*</span></label>
                                      <div class="col-sm-6">
                                         <input class="form-control" id="bic" name="bic" value="{{old('bic') ? old('bic') : $user->bic}}" type="text"  placeholder="Ex: ABCDEFGH" required>
                                         <span class="help-block">
                                                <small>@lang('Ce champ doit contenir 9 caractères')</small>
                                          </span>
                                        </div>
                                      @if($errors->has('bic'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('bic')}}</strong> 
                                              </div> 
                                          <hr> 
                                      @endif
                                   </div>
                                </div>
                             </div>
                             {{-- <div class="panel lobipanel-basic panel-pink">
                                <div class="panel-heading">
                                   <div class="panel-title">Informations carte professionnelle et assurance</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Numéro de carte</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" value="{{old('numero_carte') ? old('numero_carte') : $user->numero_carte_pro}}" name="numero_carte" placeholder="Ex: 1245879632145">
                                      </div>
                                      @if($errors->has('numero_carte'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('numero_carte')}}</strong> 
                                              </div> 
                                          <hr> 
                                      @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Nom de l'organisme délivrant</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="nom_organisme_deliv" value="{{old('nom_organisme_deliv') ? old('nom_organisme_deliv') : $user->nom_organisme_delivrant_carte_pro}}"  placeholder="Nom">
                                      </div>
                                      @if($errors->has('nom_organisme_deliv'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_organisme_deliv')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Date de délivrance</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="date" name="date_delivrance" value="{{old('date_delivrance') ? old('date_delivrance') : $user->date_delivrance_carte_pro}}"  placeholder="Ex: 12/05/2015">
                                      </div>
                                      @if($errors->has('date_delivrance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('date_delivrance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Numéro d'assurance</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="numero_assurance" value="{{old('numero_assurance') ? old('numero_assurance') : $user->numero_assurance}}"  placeholder="Ex: 12345678965A78">
                                      </div>
                                      @if($errors->has('numero_assurance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('numero_assurance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Nom de l'organisme d'assurance</label>
                                      <div class="col-sm-6">
                                         <input class="form-control" type="text" name="nom_organisme_assurance" value="{{old('nom_organisme_assurance') ? old('nom_organisme_assurance') : $user->nom_organisme_assurance}}"  placeholder="Nom..">
                                      </div>
                                      @if($errors->has('nom_organisme_assurance'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('nom_organisme_assurance')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                </div>
                             </div> --}}
                          </div>
                          <!-- /# column -->
                       </div>
                       <input type="button" name="previous" class="previous action-button" value="Précedent" />
                       <input type="button" name="next" class="next action-button" value="Suivant" />
                    </fieldset>
                    <fieldset>
                       <div class="row">
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-default">
                                <div class="panel-heading">
                                   <div class="panel-title">Documents personnelles</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="choice-id-card">Type de piece d'identité<span class="text-danger">*</span></label>
                                      <div class="col-sm-4">
                                         <select class="js-select2 form-control" id="choice-id-card" name="type_piece_identite" style="width: 100%;" data-placeholder="Choose one.." required>
                                          @if($user->type_piece_identite)
                                          <option value="{{$user->type_piece_identite}}" > {{$user->type_piece_identite}} </option>
                                          @else
                                          <option value="{{old('type_piece_identite')}}">{{old('type_piece_identite')}}</option>
                                          @endif
                                            <option value="Passeport">Passeport</option>
                                            <option value="Carte d'identité">Carte d'identité</option>
                                            <option value="Titre de séjour">Titre de séjour</option>
                                            <option value="Permis de conduire">Permis de conduire</option>
                                         </select>
                                      </div>
                                      @if($errors->has('type_piece_identite'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('type_piece_identite')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="id-doc">Piece d'identité<span class="text-danger">*</span></label>
                                     
                                      <div class="col-sm-6" id="piece_identite_content">
                                       @if(!$user->piece_identite)
                                         <input class="form-control" id="piece_identitex"  name="piece_identite" type="file" required>
                                         <span class="help-block">
                                         <small>(Fichier: pdf, jpeg, png).</small>
                                         </span>
                                      @else
                                       <a href="#" id="piece_identite" class="btn btn-warning"> Modifer </a>
                                      @endif
                                      </div>
  
                                      @if($errors->has('piece_identite'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('piece_identite')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                      
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="livret_famille">Livret de famille<span class="text-danger">*</span></label>
                                     
                                      <div class="col-sm-6" id="livret_famille_content"> 
                                      @if(!$user->livret_famille)
                                          <input class="form-control" id="livret_famillex" name="livret_famille" type="file" required>
                                      @else
                                          <a href="#" id="livret_famille" class="btn btn-warning"> Modifer </a>
                                      @endif    
                                     </div>
  
                                     @if($errors->has('livret_famille'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('livret_famille')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                                           
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label" for="rib-doc">RIB bancaire<span class="text-danger">*</span></label>
  
                                      <div class="col-sm-6" id="rib_banque_content">
                                      @if(!$user->rib_banque)
                                         <input class="form-control" id="rib_banquex"  name="rib_banque" type="file" required>
                                      @else
                                         <a href="#" id="rib_banque" class="btn btn-warning"> Modifer </a>
                                      @endif
                                      
                                      </div>
                                      @if($errors->has('rib_banque'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('rib_banque')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                      
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- /# column -->
                          <div class="col-lg-6">
                             <div class="panel lobipanel-basic panel-pink">
                                <div class="panel-heading">
                                   <div class="panel-title">Documents profesionnels</div>
                                </div>
                                <div class="panel-body">
                                   <div class="form-group">
                                      <label class="col-sm-5 control-label">Registre de commerce ou attestation d'immatriculation<span class="text-danger">*</span></label>
                                      
                                      <div class="col-sm-5" id="mod_registre_commerce_content">
                                      @if(!$user->registre_commerce_ou_attestation_immatriculation)
                                         <input class="form-control" id="mod_registre_commercex"  name="registre_commerce" type="file" required>
                                      @else
                                        <a href="#" id="mod_registre_commerce" class="btn btn-warning"> Modifer </a>
                                      @endif
                                      </div>
  
                                      @if($errors->has('registre_commerce'))
                                          <br>
                                          <br><br>
                                              <div class="alert alert-warning">
                                                  <strong>{{$errors->first('registre_commerce')}}</strong> 
                                              </div> 
                                          <hr> 
                                       @endif
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- /# column -->
                       </div>
                       <input type="button" name="previous" class="previous action-button" value="Précedent" >
                       <input type="submit" name="next" id="submit" class="next action-button" value="Envoyer" >
                    </fieldset>
                 </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js-content')
<script>
        

function modifierFichier ( btn_mod, div_mod, input_name ){
    $(btn_mod).click(function(){
    $(btn_mod).fadeOut(300);
    $(div_mod).append('<input class="form-control" id="'+btn_mod+'" type="file" name="'+input_name+'">');
    });
}

modifierFichier("#mod_carte_pro","#mod_carte_pro_content","carte_pro");
modifierFichier("#mod_attestation_assu","#mod_attestation_assu_content","attestation_assurance");
modifierFichier("#mod_registre_commerce","#mod_registre_commerce_content","registre_commerce");
modifierFichier("#rib_banque","#rib_banque_content","rib_banque");
modifierFichier("#livret_famille","#livret_famille_content","livret_famille");
modifierFichier("#piece_identite","#piece_identite_content","piece_identite");




</script>

<!--country-->
<script>
   function autocomplete(inp, arr) {
     /*the autocomplete function takes two arguments,
     the text field element and an array of possible autocompleted values:*/
     var currentFocus;
     /*execute a function when someone writes in the text field:*/
     inp.addEventListener("input", function(e) {
         var a, b, i, val = this.value;
         /*close any already open lists of autocompleted values*/
         closeAllLists();
         if (!val) { return false;}
         currentFocus = -1;
         /*create a DIV element that will contain the items (values):*/
         a = document.createElement("DIV");
         a.setAttribute("id", this.id + "autocomplete-list");
         a.setAttribute("class", "autocomplete-items");
         /*append the DIV element as a child of the autocomplete container:*/
         this.parentNode.appendChild(a);
         /*for each item in the array...*/
         for (i = 0; i < arr.length; i++) {
           /*check if the item starts with the same letters as the text field value:*/
           if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
             /*create a DIV element for each matching element:*/
             b = document.createElement("DIV");
             /*make the matching letters bold:*/
             b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
             b.innerHTML += arr[i].substr(val.length);
             /*insert a input field that will hold the current array item's value:*/
             b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
             /*execute a function when someone clicks on the item value (DIV element):*/
             b.addEventListener("click", function(e) {
                 /*insert the value for the autocomplete text field:*/
                 inp.value = this.getElementsByTagName("input")[0].value;
                 /*close the list of autocompleted values,
                 (or any other open lists of autocompleted values:*/
                 closeAllLists();
             });
             a.appendChild(b);
           }
         }
     });
     /*execute a function presses a key on the keyboard:*/
     inp.addEventListener("keydown", function(e) {
         var x = document.getElementById(this.id + "autocomplete-list");
         if (x) x = x.getElementsByTagName("div");
         if (e.keyCode == 40) {
           /*If the arrow DOWN key is pressed,
           increase the currentFocus variable:*/
           currentFocus++;
           /*and and make the current item more visible:*/
           addActive(x);
         } else if (e.keyCode == 38) { //up
           /*If the arrow UP key is pressed,
           decrease the currentFocus variable:*/
           currentFocus--;
           /*and and make the current item more visible:*/
           addActive(x);
         } else if (e.keyCode == 13) {
           /*If the ENTER key is pressed, prevent the form from being submitted,*/
           e.preventDefault();
           if (currentFocus > -1) {
             /*and simulate a click on the "active" item:*/
             if (x) x[currentFocus].click();
           }
         }
     });
     function addActive(x) {
       /*a function to classify an item as "active":*/
       if (!x) return false;
       /*start by removing the "active" class on all items:*/
       removeActive(x);
       if (currentFocus >= x.length) currentFocus = 0;
       if (currentFocus < 0) currentFocus = (x.length - 1);
       /*add class "autocomplete-active":*/
       x[currentFocus].classList.add("autocomplete-active");
     }
     function removeActive(x) {
       /*a function to remove the "active" class from all autocomplete items:*/
       for (var i = 0; i < x.length; i++) {
         x[i].classList.remove("autocomplete-active");
       }
     }
     function closeAllLists(elmnt) {
       /*close all autocomplete lists in the document,
       except the one passed as an argument:*/
       var x = document.getElementsByClassName("autocomplete-items");
       for (var i = 0; i < x.length; i++) {
         if (elmnt != x[i] && elmnt != inp) {
           x[i].parentNode.removeChild(x[i]);
         }
       }
     }
     /*execute a function when someone clicks in the document:*/
     document.addEventListener("click", function (e) {
         closeAllLists(e.target);
         });
   }
   
   /*An array containing all the country names in the world:*/
   var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
   
   /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
   autocomplete(document.getElementById("birth-country"), countries);
   autocomplete(document.getElementById("nationality-country"), countries);
</script>
<!--country-->

<script>
   var current_fs, next_fs, previous_fs; 
   var left, opacity, scale; 
   var animating; 
   
   $(".next").click(function(){
   
       //validation
       var form = $(".form-valide2");
   		form.validate({
                   errorClass: "invalid-feedback animated fadeInDown",
                   errorElement: "div",
                   errorPlacement: function(e, a) {
                       jQuery(a).parents(".form-group > div").append(e)
                   },
                   highlight: function(e) {
                       jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                   },
                   success: function(e) {
                       jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                   },
   			rules: {
                   "choice-marital": {
                           required: !0
                   },
                   "ville-naissance": {
                           required: !0
                   },
                   "birth-date": {
                           required: !0
                   },
                   "birthday-town": {
                           required: !0
                   },
                   "birth-country": {
                           required: !0
                   },
                   "nationality-country": {
                           required: !0
                   },
                   "dad": {
                           required: !0
                   },
                   "mom": {
                           required: !0
                   },
                   "choice-know": {
                           required: !0
                   },
                   "code-activity": {
                           required: !0
                   },
                   "choice-corporate": {
                           required: !0
                   },
                   "siret": {
                           required: !0
                   },
                   "siren": {
                           required: !0
                   },
                   "date-matricle": {
                           required: !0
                   },
                   "bank-name": {
                           required: !0
                   },
                   "rib": {
                           required: !0
                   },
                   "iban": {
                           required: !0
                   },
                   "bic": {
                           required: !0
                   },
                   "choice-id-card": {
                           required: !0
                   },
                   "id-doc": {
                           required: !0,
                           extension: "pdf|jpeg|docx|doc|png",
                           filesize: 5097152
                   },
                   "familly-doc": {
                           required: !0,
                           extension: "pdf|jpeg|docx|doc|png",
                           filesize: 5097152
                   },
                   "rib-doc": {
                           required: !0,
                           extension: "pdf|jpeg|docx|doc|png",
                           filesize: 5097152
                   },
                   "corps-doc": {
                           required: !0,
                           extension: "pdf|jpeg|docx|doc|png",
                           filesize: 5097152
                   }
   			},
   			messages: {
                   "birth-country": "Le pays de naissance doit etre saisi !",
                   "choice-marital": "Vous devez choisir une situation familialle !",
                   "nationality-country": "Le pays de nationalité doit etre saisi !",
                   "birthday-town": "La ville de naissance doit etre saisie !",
                   "birthday-date": "Veuillez renseigner votre date de naissance !",
                   "dad": "Veillez saisir le nom et le prénom du père !",
                   "mom": "Veillez saisir le nom et le prénom de la mère !",
                   "choice-know": "Il faut préciser comment avez vous connu notre réseau !",
                   "code-activity": "Il faut préciser les codes posteaux ou vous souhaitez exercer, veuillez séparés par des virgules !",
                   "choice-corporate": "Vous devez rensegner le status de votre entreprise !",
                   "siret": "Veuillez rensegner votre numéro siret correctement !",
                   "siren": "Veuillez rensegner votre numéro siren correctement !",
                   "date-matricle": "Veillez saisir la date d'immatriculation !",
                   "bank-name": "Veillez saisir le nom de votre banque !",
                   "rib": "Veillez saisir votre rib correctement !",
                   "iban": "Veillez saisir votre IBAN correctement !",
                   "bic": "Veillez saisir votre BIC correctement !",
                   "choice-id-card": "Veillez choisir un type de piece d'identité !",
                   "id-doc": "Veillez choisir un fichier valide pour la piece d'identité !",
                   "familly-doc": "Veillez choisir un fichier valide pour le livret de famille !",
                   "rib-doc": "Veillez choisir un fichier valide pour le rib !",
                   "corps-doc": "Veillez choisir un fichier valide pour l'attestation d'immatriculation !"
   			}
   		});
   		
       if (form.valid() == true){
   	if(animating) return false;
   	    animating = true;
   	
   	current_fs = $(this).parent();
   	next_fs = $(this).parent().next();
   	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
   	next_fs.show(); 
   	current_fs.animate({opacity: 0}, {
   		step: function(now, mx) {
   			scale = 1 - (1 - now) * 0.2;
   			left = (now * 50)+"%";
   			opacity = 1 - now;
   			current_fs.css({
           'transform': 'scale('+scale+')',
         });
   			next_fs.css({'left': left, 'opacity': opacity});
   		}, 
   		duration: 0, 
   		complete: function(){
   			current_fs.hide();
   			animating = false;
   		}, 
   		easing: 'easeInOutBack'
   	});
   }
   });
   
   $(".previous").click(function(){
   	if(animating) return false;
   	animating = true;
   	
   	current_fs = $(this).parent();
   	previous_fs = $(this).parent().prev();
   	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
       previous_fs.show();
       current_fs.hide();
   	current_fs.animate({opacity: 0}, {
   		step: function(now, mx) {
   			scale = 0.8 + (1 - now) * 0.2;
   			left = ((1-now) * 50)+"%";
   			opacity = 1 - now;
   			current_fs.css({'left': left});
   			previous_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
   		}, 
   		duration: 0, 
   		complete: function(){
               current_fs.hide();
               animating = false;
   		}, 
   		seasing: 'easeInOutBack'
   	});
   });

   $("#submit").click(function(e){
    // e.preventDefault();
    // var data = $('#msform').serialize();

    // $.ajax({
    //     url: $('#msform').attr('action'),
    //     data: data,
    //     method: 'PUT',
    //     success: function(message){
    //         console.log(message);
    //     },
    //     error: function(error){
    //         console.log(error);
    //     }
    // })

    //  $('#msform').submit(); 
    // alert($('#msform').serialize());
    });
</script>