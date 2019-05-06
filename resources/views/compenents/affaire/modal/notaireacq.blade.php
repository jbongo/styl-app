<div class="modal fade" id="notaire_acq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Associer un notaire à l'acquéreur.</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
               <div class="panel lobipanel-basic panel-info">
                     <div class="panel-heading">
                        <div class="panel-title">Suivi des documents</div>
                     </div>
                     <div class="panel-body">
                        Si vous changer le notaire après avoir plannifié le rendez-vous de signature du compromis ou de l'acte, celui ci sera réinitialisé et vous devrez 
                        le plannifier à nouveau.
                     </div>
                  </div>
            <div class="form-validation" id="rtc1">
               <form class="form-valide77 form-horizontal" action="{{ route('dossier.notaireacq', $mandat->dossiervente->id) }}" method="post">
                  @csrf
                  @if($mandat->dossiervente->notaire_acq_id !== NULL)
                  <a type="button" class="btn btn-default btn-rounded btn-addon btn-sm m-b-10 m-l-5 ret1"><i class="ti-arrow-left"></i>Retour</a>
                  @endif
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="notaire_acq">Choisir le notaire à associer<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <select class="selectpicker col-lg-8" id="notaire_acq" name="notaire_acq" data-live-search="true" data-style="btn-pink btn-rounded" required>
                           @foreach($notaire as $dr)
                           <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->telephone}} {{$dr->code_postal}}">Nom: {{$dr->nom}} email: {{$dr->email}} Téléphone: {{$dr->telephone}}</option>
                           @endforeach                                
                        </select>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-primary">valider</button>
                  </div>
               </form>
            </div>
            @if($mandat->dossiervente->notaire_acq_id !== NULL)
            <div  class="rtc2">
                  <div class="panel lobipanel-basic panel-pink">
                        <div class="panel-heading">
                           <div class="panel-title">Details du notaire associé</div>
                        </div>
                        <div class="panel-body">
                              <a type="button" class="btn btn-warning btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5 biff1"><i class="ti-pencil-alt"></i>Modifier</a>
               <ul class="list-group">
                  <li class="list-group-item">
                     <h5><strong>Nom du notaire: </strong>   {{$notaireacq->nom}}</h5>
                  </li>
                  <li class="list-group-item list-group-item-warning">
                     <h5><strong>Téléphone: </strong>   {{$notaireacq->telephone}}</h5>
                  </li>
                  <li class="list-group-item">
                     <h5><strong>Email: </strong>   {{$notaireacq->email}}</h5>
                  </li>
                  <li class="list-group-item list-group-item-warning">
                     <h5><strong>Adresse de l'office: </strong>   {{$notaireacq->notaire->adresse}}</h5>
                  </li>
                  <li class="list-group-item">
                     <h5><strong>Code postal: </strong>   {{$notaireacq->notaire->code_postal}}</h5>
                  </li>
                  <li class="list-group-item list-group-item-warning">
                     <h5><strong>Ville: </strong>   {{$notaireacq->notaire->ville}}</h5>
                  </li>
               </ul>
            </div>
         </div>
               
            </div>
            <div class="modal-footer stuff1">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
            @endif
         </div>
      </div>
   </div>
</div>