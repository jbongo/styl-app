<div class="modal fade" id="offer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter une offre d'achat</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-primary">
                <div class="panel-heading">
                   <div class="panel-title">INSTRUCTIONS</div>
                </div>
                <div class="panel-body">
                   L'offre est imprimée en PDF et envoyée automatiquement à l'acquéreur et au mandant par email,
                   si elle est acceptée par le mandant l'étape pour signer le compromis sera déclenchée immédiatement. 
                </div>
             </div>
             <div class="form-validation">
                <form class="form-valide89 form-horizontal" action="{{ route('offre.add', [$bien->id, $mandat->id]) }}" method="post">
                   {{ csrf_field() }}
                   <div class="form-group row">
                     <label class="col-sm-4 control-label" for="vis">Rattacher une visite à l'offre<span class="text-danger">*</span></label>
                     <div class="col-lg-2">
                        <input type="checkbox" unchecked data-toggle="toggle" id="vis" name="vis" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                     </div>
                  </div>
                  <div class="form-group row" id="bfa">
                     <label class="col-sm-4 control-label" for="visite_id">Choisir la visite<span class="text-danger">*</span></label>
                     <div class="col-lg-6">
                        <select class="selectpicker col-lg-8" id="visite_id" name="visite_id" data-live-search="true" data-style="btn-warning btn-rounded" required>
                           @foreach($bien->visites as $dr)
                           <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_visiteur}}">{{$dr->nom_visiteur}}</option>
                           @endforeach                                
                        </select>
                     </div>
                  </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="acquereur_type">Type de l'acquéreur<span class="text-danger">*</span></label>
                      <div class="col-lg-3">
                         <select class="js-select2 form-control" id="acquereur_type" name="acquereur_type" required>
                            @if(old('acquereur_type'))
                            <option selected value="{{old('acquereur_type')}}">{{old('acquereur_type')}}</option>
                            @endif
                            <option value="personne_seule">Personne simple</option>
                            <option value="couple">Couple</option>
                            <option value="personne_morale">Personne morale</option>
                            <option value="groupe">Groupe de personnes</option>
                         </select>
                      </div>
                   </div>
                   <div class="ach">
                      <div class="form-group row" id="df1">
                         <label class="col-sm-4 control-label" for="mandant_aqs_id">Associer l'acquéreur (Personne seule)<span class="text-danger">*</span></label>
                         <div class="col-lg-4">
                            <select class="selectpicker col-lg-8" id="mandant_aqs_id" name="mandant_aqs_id" data-live-search="true" data-style="btn-info btn-rounded" required>
                               @foreach($acquereur as $dr)
                               @if(old('mandant_aqs_id') && $dr->id == old('mandant_aqs_id')) 
                               <option selected value="{{old('mandant_aqs_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                               @endif
                               @if($dr->type === "personne_seule")
                               <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                               @endif
                               @endforeach                                
                            </select>
                         </div>
                      </div>
                      <div class="form-group row" id="df2">
                         <label class="col-sm-4 control-label" for="mandant_aqc_id">Associer l'acquéreur (Couple)<span class="text-danger">*</span></label>
                         <div class="col-lg-4">
                            <select class="selectpicker col-lg-8" id="mandant_aqc_id" name="mandant_aqc_id" data-live-search="true" data-style="btn-warning btn-rounded" required>
                               @foreach($acquereur as $dr)
                               @if(old('mandant_aqc_id') && $dr->id == old('mandant_aqc_id')) 
                               <option selected value="{{old('mandant_aqc_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                               @endif
                               @if($dr->type === "couple")
                               <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                               @endif
                               @endforeach                                
                            </select>
                         </div>
                      </div>
                      <div class="form-group row" id="df3">
                         <label class="col-sm-4 control-label" for="mandant_aqm_id">Associer l'acquéreur (Personne morale)<span class="text-danger">*</span></label>
                         <div class="col-lg-4">
                            <select class="selectpicker col-lg-8" id="mandant_aqm_id" name="mandant_aqm_id" data-live-search="true" data-style="btn-danger btn-rounded" required>
                               @foreach($acquereur as $dr)
                               @if(old('mandant_aqm_id') && $dr->id == old('mandant_aqm_id')) 
                               <option selected value="{{old('mandant_aqm_id')}}" data-tokens="{{$dr->raison_sociale}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->raison_sociale}}</option>
                               @endif
                               @if($dr->type === "personne_morale")
                               <option  value="{{$dr->id}}" data-tokens="{{$dr->raison_sociale}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->raison_sociale}}</option>
                               @endif
                               @endforeach                               
                            </select>
                         </div>
                      </div>
                      <div class="form-group row" id="df4">
                         <label class="col-sm-4 control-label" for="mandant_aqg_id">Associer l'acquéreur (Groupe)<span class="text-danger">*</span></label>
                         <div class="col-lg-4">
                            <select class="selectpicker col-lg-8" id="mandant_aqg_id" name="mandant_aqg_id" data-live-search="true" data-style="btn-pink btn-rounded" required>
                               @foreach($groupeacquereur as $dr)
                               @if(old('mandant_aqg_id') && $dr->id == old('mandant_aqg_id')) 
                               <option selected value="{{old('mandant_aqg_id')}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                               @endif
                               <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                               @endforeach                                
                            </select>
                         </div>
                      </div>
                   </div>
                   <div class="form-group row">
                     <label class="col-sm-4 control-label" for="range_01">Montant de l'offre (€)<span class="text-danger">*</span></label>
                     <div class="col-lg-2">
                        <input type="number" min="1" step="1" id="range_01" class="form-control {{$errors->has('range_01') ? 'is-invalid' : ''}}" value="{{old('range_01')}}" name="range_01" required>
                        @if ($errors->has('range_01'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('range_01')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="range_02">Montant de la commission (€)<span class="text-danger">*</span></label>
                     <div class="col-lg-2">
                        <input type="number" min="1" step="1" id="range_02" class="form-control {{$errors->has('range_02') ? 'is-invalid' : ''}}" value="{{old('range_02')}}" name="range_02" required>
                        @if ($errors->has('range_02'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('range_02')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="charge_commission">Commission à charge du <span class="text-danger">*</span></label>
                      <div class="col-lg-3">
                         <select class="js-select2 form-control" id="charge_commission" name="charge_commission" required>
                            <option value="mandant">Mandant</option>
                            <option value="aquereur">Acquéreur</option>
                         </select>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="date_offre">Date de l'offre<span class="text-danger">*</span></label>
                      <div class="col-lg-3">
                         <input type="date" id="date_offre" class="form-control {{$errors->has('date_offre') ? 'is-invalid' : ''}}" value="{{old('date_offre')}}" name="date_offre" placeholder="Ex: 0600060006..." required>
                         @if ($errors->has('date_offre'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('date_offre')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="duree_validite">Durée de validité de l'offre en jours<span class="text-danger">*</span></label>
                      <div class="col-lg-2">
                         <input type="number" min="1" max="360" step="1" id="duree_validite" class="form-control {{$errors->has('duree_validite') ? 'is-invalid' : ''}}" value="{{old('duree_validite')}}" name="duree_validite" required>
                         @if ($errors->has('duree_validite'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('duree_validite')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="conditions_suspensives">Conditions suspensives</label>
                      <div class="col-lg-4">
                         <textarea rows="6" id="conditions_suspensives" class="form-control {{$errors->has('conditions_suspensives') ? 'is-invalid' : ''}}" value="{{old('conditions_suspensives')}}" name="conditions_suspensives" placeholder="Ex: Acceptation d'un pret bancaire..."></textarea>
                         @if ($errors->has('conditions_suspensives'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('conditions_suspensives')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-primary submit89">valider</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>