<div class="modal fade" id="appel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter un appel</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-info">
                <div class="panel-heading">
                   <div class="panel-title">INSTRUCTIONS</div>
                </div>
                <div class="panel-body">
                   Les appels permettent de faire un meilleur suivi du bien, le fait de les repertorier permet de remonter des statistiques en ce qui concerne l'efficacité des passerelles afin d'améliorer le processus de diffusion d'annonces. 
                </div>
             </div>
             <div class="form-validation">
                <form class="form-appel form-horizontal" action="{{ route('appels.add', $bien->id) }}" method="post">
                 @csrf
                 <div class="form-group row">
                    <label class="col-sm-4 control-label" for="source">Source de l'appel<span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                       <select class="js-select2 form-control" id="source" name="source" required>
                          @if(old('source'))
                           <option selected value="{{old('source')}}">{{old('source')}}</option>
                          @endif
                          <option value="bouche_oreille">Bouche à oreille</option>
                          <option value="passerelle">Site d'annonce</option>
                          <option value="reseaux_sociaux">Reseaux sociaux</option>
                          <option value="pub_affiche">Fiche publicitaire</option>
                          <option value="pub_internet">Pub internet</option>
                          <option value="site_stylimmo">Site Styl'immo</option>
                          <option value="autre">Autre</option>
                       </select>
                    </div>
                 </div>
                 <div class="form-group row" id="tmc">
                  <label class="col-sm-4 control-label" for="passerelles_id">Choisir la passerelle<span class="text-danger">*</span></label>
                  <div class="col-lg-6">
                     <select class="selectpicker col-lg-8" id="passerelles_id" name="passerelles_id" data-live-search="true" data-style="btn-danger btn-rounded" required>
                        @foreach($passerelles as $dr)
                        <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}}">{{$dr->nom}}</option>
                        @endforeach                                
                     </select>
                  </div>
               </div>
                 <div class="form-group row">
                      <label class="col-sm-4 control-label" for="nom_appelant">Nom et prénom de l'appelant<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="text" id="nom_appelant" class="form-control" value="{{old('nom_appelant')}}" name="nom_appelant" placeholder="Ex: Mme Julie LEMAIRE..." required>
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
                      <label class="col-sm-4 control-label" for="date_appel">Date de l'appel<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <input type="date" id="date_appel" class="form-control {{$errors->has('date_appel') ? 'is-invalid' : ''}}" value="{{old('date_appel')}}" name="date_appel" required>
                         @if ($errors->has('date_appel'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('date_appel')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="form-group row">
                      <label class="col-sm-4 control-label" for="commentaires">Commentaires<span class="text-danger">*</span></label>
                      <div class="col-lg-4">
                         <textarea rows="6" id="commentaires" class="form-control" value="{{old('commentaires')}}" name="commentaires" placeholder="Ex: Renseignement sur le prix..."></textarea>
                         @if ($errors->has('commentaires'))
                         <br>
                         <div class="alert alert-warning ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{$errors->first('commentaires')}}</strong> 
                         </div>
                         @endif
                      </div>
                   </div>
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-primary submitappel">valider</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>