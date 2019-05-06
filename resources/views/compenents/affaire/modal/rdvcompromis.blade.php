<div class="modal fade" id="rdv_compromis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Rendez-vous signature compromis</strong></h5>
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
                   Il s'agit ici de la date et du lieu du rendez_vous pour la signature du  compromis, l'adresse est généralement celle du cabinet du notaire ou de l'étude à la quelle il est attaché, si ce n'est pas
                   la meme cliquez sur le bouton modifier l'adresse.
                </div>
             </div>
             <div class="form-validation" id="cmpr1">
                  @if($mandat->dossiervente->adresse_compromis !== NULL && $mandat->dossiervente->rendez_vous_compromis !== NULL && $mandat->dossiervente->heure_compromis !== NULL)
                     <a type="button" class="btn btn-default btn-rounded btn-addon btn-sm m-b-10 m-l-5 ret3"><i class="ti-arrow-left"></i>Retour</a>
                  @endif
                <form class="form-valide89 form-horizontal" action="{{ route('rdv.compromis', $mandat->dossiervente->id) }}" method="post">
                 @csrf
                 <div class="form-group row">
                    <label class="col-sm-4 control-label" for="notaire">Notaire signant le compromis<span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                       <select class="js-select2 form-control" id="notaire" name="notaire" required>
                          @if(old('notaire'))
                          <option selected value="{{old('notaire')}}">{{old('notaire')}}</option>
                          @endif
                          <option value="notaire_mdn">Notaire du mandant</option>
                          <option value="notaire_acq">Notaire de l'acquéreur</option>
                       </select>
                    </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-sm-4 control-label" for="bool_addr">Modifier l'adresse</label>
                     <div class="col-lg-2">
                        <input type="checkbox" unchecked data-toggle="toggle" id="bool_addr" name="bool_addr" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                     </div>
                  </div> 
                 <div class="form-group row">
                      <label class="col-sm-4 control-label" for="adresse">Adresse complète du rendez-vous<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="text" id="adresse_cmp" class="form-control {{$errors->has('adresse') ? 'is-invalid' : ''}}" value="{{$errors->has('adresse') ? old('adresse') : $notairemdn->notaire->adresse}}" name="adresse" placeholder="Ex: 25 Rue CARNOT..." required readonly>
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
                       <input type="text" id="code_postal_cmp" class="form-control {{$errors->has('code_postal') ? 'is-invalid' : ''}}" value="{{$errors->has('code_postal') ? old('code_postal') : $notairemdn->notaire->code_postal}}" name="code_postal" placeholder="Ex: 75008" required readonly>
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
                       <input type="text" id="ville_cmp" class="form-control {{$errors->has('ville') ? 'is-invalid' : ''}}" value="{{$errors->has('ville') ? old('ville') : $notairemdn->notaire->ville}}" name="ville" placeholder="Ex: Paris..." required readonly>
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
                      <label class="col-sm-4 control-label" for="date_rdv">Date du rendez vous<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="date" id="date_rdv" class="form-control {{$errors->has('date_rdv') ? 'is-invalid' : ''}}" value="{{old('date_rdv')}}" name="date_rdv" required>
                         @if ($errors->has('date_rdv'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('date_rdv')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                    <label class="col-sm-4 control-label" for="heure_rdv">Heure du rendez vous<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                       <input type="time" id="heure_rdv" class="form-control {{$errors->has('heure_rdv') ? 'is-invalid' : ''}}" value="{{old('heure_rdv')}}" name="heure_rdv" required>
                       @if ($errors->has('heure_rdv'))
                       <br>
                       <div class="alert alert-warning ">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>{{$errors->first('heure_rdv')}}</strong> 
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
             @if($mandat->dossiervente->adresse_compromis !== NULL && $mandat->dossiervente->rendez_vous_compromis !== NULL && $mandat->dossiervente->heure_compromis !== NULL)
             <div  class="cmpr2">
                <br>
                <div class="panel lobipanel-basic panel-pink">
                     <div class="panel-heading">
                        <div class="panel-title">Details du rendez-vous</div>
                     </div>
                     <div class="panel-body">
                           @if($today_cmpr < 0)
                           <a type="button" class="btn btn-danger btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5 biff3"><i class="ti-pencil-alt"></i>Changer</a>
                           @endif
                  <ul class="list-group">
                        <li class="list-group-item list-group-item-default">
                              <h5><strong>Notaire en charge du dossier: </strong> @if($mandat->dossiervente->notaire_compromis === "mandant"){{$notairemdn->nom}} @else {{$notaireacq->nom}} @endif</h5>
                           </li>
                     <li class="list-group-item list-group-item-default">
                        <h5><strong>Adresse: </strong>   {{$mandat->dossiervente->adresse_compromis}}</h5>
                     </li>
                     <li class="list-group-item list-group-item-default">
                        <h5><strong>Date du rendez-vous: </strong>   <span class="label label-info">{{date('d-m-Y',strtotime($mandat->dossiervente->rendez_vous_compromis))}}</span></h5>
                     </li>
                     <li class="list-group-item list-group-item-default">
                        <h5><strong>Heure du rendez-vous: </strong><span class="label label-danger">{{$mandat->dossiervente->heure_compromis}}</span></h5>
                     </li>
                     @if($today_cmpr > 0)
                     <li class="list-group-item list-group-item-danger">
                           <h5><strong>Valider la signature du compromis: </strong><a type="button" href="{{ route('rdv.compromis.reject', $mandat->dossiervente->id) }}" class="btn btn-danger btn-rounded btn-sm m-b-10 m-l-5 reject_cmpr">Annuler</a> <a type="button" href="{{ route('rdv.compromis.confirm', $mandat->dossiervente->id) }}" class="btn btn-success btn-rounded btn-sm m-b-10 m-l-5 confirm_cmpr">Valider</a></h5>
                        </li>
                     @endif
                  </ul>
               </div>
            </div>
               </div>
               <div class="modal-footer stuff3">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
               </div>
             @endif
          </div>
       </div>
    </div>
 </div>