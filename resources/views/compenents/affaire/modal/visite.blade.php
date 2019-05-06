<div class="modal fade" id="visite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter une visite</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-danger">
                <div class="panel-heading">
                   <div class="panel-title">INSTRUCTIONS</div>
                </div>
                <div class="panel-body">
                   Les visites du bien sont suivi en temps réel sur l'application par le mandant, cela lui permet d'avoir des retours et l'aider à choisir l'offre la plus adaptée à ses critères. 
                </div>
             </div>
             <div class="form-validation">
                <form class="form-valide89 form-horizontal" action="{{ route('visites.add', $bien->id) }}" method="post">
                 @csrf
                 <div class="form-group row">
                  <label class="col-sm-4 control-label" for="call">Rattacher un appel à la visite</label>
                  <div class="col-lg-2">
                     <input type="checkbox" unchecked data-toggle="toggle" id="call" name="call" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                  </div>
               </div>
               <div class="form-group row" id="psg">
                  <label class="col-sm-4 control-label" for="appels_id">Choisir l'appel'<span class="text-danger">*</span></label>
                  <div class="col-lg-6">
                     <select class="selectpicker col-lg-8" id="appels_id" name="appels_id" data-live-search="true" data-style="btn-info btn-rounded" required>
                        @foreach($bien->appels as $dr)
                        <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_appelant}}">{{$dr->nom_appelant}}</option>
                        @endforeach                                
                     </select>
                  </div>
               </div>
                 <div class="form-group row">
                      <label class="col-sm-4 control-label" for="nom_visiteur">Nom du visiteur<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="text" id="nom_visiteur" class="form-control {{$errors->has('nom_visiteur') ? 'is-invalid' : ''}}" value="{{old('nom_visiteur')}}" name="nom_visiteur" placeholder="Ex: Mme Rosa MIRALES..." required>
                         @if ($errors->has('nom_visiteur'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('nom_visiteur')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                     <label class="col-sm-4 control-label" for="adresse">Adresse<span class="text-danger">*</span></label>
                     <div class="col-lg-4">
                        <input type="text" id="adresse" class="form-control {{$errors->has('adresse') ? 'is-invalid' : ''}}" value="{{old('adresse')}}" name="adresse" placeholder="Ex: 25 Rue Carnot..." required>
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
                        <input type="text" id="code_postal" class="form-control {{$errors->has('code_postal') ? 'is-invalid' : ''}}" value="{{old('code_postal')}}" name="code_postal" placeholder="Ex: 30200..." required>
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
                        <input type="text" id="ville" class="form-control {{$errors->has('ville') ? 'is-invalid' : ''}}" value="{{old('ville')}}" name="ville" placeholder="Ex: Avignon..." required>
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
                      <label class="col-sm-4 control-label" for="date_visite">Date de la visite<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="date" id="date_visite" class="form-control {{$errors->has('date_visite') ? 'is-invalid' : ''}}" value="{{old('date_visite')}}" name="date_visite" required>
                         @if ($errors->has('date_visite'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('date_visite')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="commentaire">Commentaires<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <textarea rows="6" id="commentaire" class="form-control {{$errors->has('commentaire') ? 'is-invalid' : ''}}" value="{{old('commentaire')}}" name="commentaire" placeholder="Ex: Cuisine trop petite..."></textarea>
                         @if ($errors->has('commentaire'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('commentaire')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-primary submitvisite">valider</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>