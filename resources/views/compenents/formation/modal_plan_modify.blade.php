
<!-- modal for planification modifications -->
<div class="modal fade" id="edit-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left; font-size: small;">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><strong style="color: blue">Planifier la formation </strong>- {{ $formation->titre }}<br /><span style="font-size: x-small; color: red;">modifiez les champs qui ne conviennent pas à votre formation</span></h4>
        </div>
        <div class="modal-body">
           <div class="form-validation" style="display: block;">
              <form id="form-addmodify-{{$formation->id}}" class="form-addmodify row justify-content-start" action="{{ route('formation.store') }}" method="POST">
                 @csrf
                 <fieldset>
                    <div class="form-group col-sm-2" style="font-size: small;">
                       <label>Titre<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <label>Date de début<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <label>Date de fin<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <label>Type<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <span class="sallecontent2" @if ($formation->type == 'visio') style="display:none;" @endif>
                       <label>Adresse<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <label>Code Postal<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       <label>Ville<span class="text-danger"> *</span></label>
                       <div style="height: 1.5em;"></div>
                       </span>
                       <label>Nombre de places<span class="text-danger"> *</span></label>
                       <div style="height: 1.2em;"></div>
                       <label>Détails de la formation<span class="text-danger"></span></label>
                       <div style="height: 7em;"></div>
                       <label>Informations complémentaires<span class="text-danger"></span></label>
                    </div>
                    <div class="form-group col-sm-10">
                       <input id="titre" type="text" name="titre" style="width:98%;" value="{{ $formation->titre }}"></input>
                       <div style="height: 1.8em;"></div>
                       <input id="starting_date" type="datetime-local" name="starting_date" style="width:98%;" placeholder="AAAA-MM-JJ HH:MM" required></input>
                       <div style="height: 1.8em;"></div>
                       <input id="end_date" type="datetime-local" name="end_date" style="width:98%;" placeholder="AAAA-MM-JJ HH:MM" required></input>
                       <div style="height: 1.8em;"></div>
                       <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 98%;">
                          <label class="btn btn btn-secondary-romain @if ($formation->type == 'visio') active @endif" style="width: 49%;" @if ($formation->type == 'visio') checked @endif>
                          <input type="radio" class="visio"  autocomplete="off" value="visio" name="type" @if ($formation->type == 'visio') checked @endif><strong style="color: purple;">VISIOCONFERENCE</strong></label>
                          <label class="btn btn btn-secondary-romain @if ($formation->type == 'salle') active @endif" style="width: 49%;" @if ($formation->type == 'salle') checked @endif>
                          <input type="radio" class="salle"  autocomplete="off" value="salle" name="type" @if ($formation->type == 'salle') checked @endif><strong style="color: chocolate;">EN SALLE</strong></label>
                       </div>
                       <br />
                       <span class="sallecontent2" @if ($formation->type == 'visio') style="display:none;" @endif>
                       <input id="st" type="text" name="st" style="width:98%;" value="{{ $formation->st }}"></input>
                       <div style="height: 1.8em;"></div>
                       <input id="postal" type="text" name="postal" style="width:98%;" value="{{ $formation->postal }}"></input>
                       <div style="height: 1.8em;"></div>
                       <input id="lieu" type="text" name="lieu" style="width:98%;" value="{{ $formation->lieu }}"></input>
                       <div style="height: 1.8em;"></div>
                       </span>
                       <input id="nb_max" type="number" min="{{ $formation->nb_inscrits }}" max="2147483646" name="nb_max" style="width:98%;" value="{{ $formation->nb_max }}"></input>
                       <div style="height: 1.8em;"></div>
                       <textarea id="details" type="text" name="details" rows="4" style="width:98%; font-size: x-small; white-space: pre-line;">{{ $formation->details }}</textarea>
                       <textarea id="infocomp" type="text" name="infocomp" rows="4" style="width:98%; font-size: x-small; white-space: pre-line;">{{ $formation->infocomp }}</textarea>
                       <input id="id" type="number" name="id" value="{{ $formation->id }}" style="visibility: hidden;"></input>
                    </div>
                    <input type="button" name="next" class="nextmodify btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
                 </fieldset>
                 <fieldset style="display: none;">
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 200%;">
                       <label class="btn btn-secondary-romain @if (!($formation->option_ordi)) active @endif" style="width: 50%;">
                       <input type="radio" id="optionel" autocomplete="off" value="0" name="option_ordi" @if (!($formation->option_ordi)) checked @endif>Ordinateur ou tablette <strong style="color: darkgreen;">optionels</strong></label>
                       <label class="btn btn-secondary-romain @if ($formation->option_ordi) active @endif" style="width: 50%;">
                       <input type="radio" id="obligatoire" autocomplete="off" value="1" name="option_ordi" @if ($formation->option_ordi) checked @endif>Ordinateur ou tablette <strong style="color: darkblue;">nécessaires</strong></label>
                       </label>
                    </div>
                    <br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 200%;">
                       <label class="btn btn-secondary-romain @if ($formation->hierarchie == 'complementaire') active @endif" style="width: 50%;">
                       <input type="radio" id="complementaire" autocomplete="off" value="complementaire" name="hierarchie" @if ($formation->hierarchie == 'complementaire') checked @endif>formation <strong style="color: orange;">COMPLEMENTAIRE</strong>
                       </label>
                       <label class="btn btn-secondary-romain @if ($formation->hierarchie == 'necessaire') active @endif" style="width: 50%;">
                       <input type="radio" id="necessaire" autocomplete="off" value="necessaire" name="hierarchie" @if ($formation->hierarchie == 'necessaire') checked @endif>formation <strong style="color: red;">OBLIGATOIRE</strong>
                       </label>
                    </div>
                    <br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 200%;">
                       <label class="btn btn-secondary-romain @if (!($formation->presence)) active @endif" style="width: 50%;" checked>
                       <input type="radio" class="presence_inactif_modify" autocomplete="off" value="0" name="presence" @if (!($formation->presence)) checked @endif>quiz de validation de présence <strong style="color: grey;">DESACTIVE</strong>
                       </label>
                       <label class="btn btn-secondary-romain @if ($formation->presence) active @endif" style="width: 50%;">
                       <input type="radio" class="presence_actif_modify" autocomplete="off" value="1" name="presence" @if ($formation->presence) checked @endif>quiz de validation de présence <strong style="color: green;">ACTIF</strong>
                       </label>
                    </div>
                    <div class="presencesliderdivmodify">
                       <br />
                       <input type="number" class="presenceslider_modify" name="champs_presence" max="10" min="1" style="width:80%;"></input>
                    </div>
                    <br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 200%;">
                       <label class="btn btn-secondary-romain @if (!($formation->acquis)) active @endif" style="width: 50%;" checked>
                       <input type="radio" class="acquis_inactif_modify" autocomplete="off" value="0" name="acquis" @if (!($formation->acquis)) checked @endif>quiz d' appréciation d' acquis <strong style="color: grey;">DESACTIVE</strong>
                       </label>
                       <label class="btn btn-secondary-romain @if ($formation->acquis) active @endif" style="width: 50%;">
                       <input type="radio" class="acquis_actif_modify" autocomplete="off" value="1" name="acquis" @if ($formation->acquis) checked @endif>quiz d' appréciation d' acquis <strong style="color: green;">ACTIF</strong>
                       </label>
                    </div>
                    <div class="acquissliderdivmodify">
                       <br />
                       <input type="number" class="acquisslider_modify" name="champs_acquis" max="10" min="1" style="width:80%;"></input>
                    </div>
                    <br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 200%;">
                       <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                       <input type="radio" class="formation-gratuite_modify" autocomplete="off" name="payant" value="0"  checked>Formation <strong style="color: darkblue;">GRATUITE</strong>
                       </label>
                       <label class="btn btn-secondary-romain" style="width: 50%;">
                       <input type="radio" class="formation-payante_modify" autocomplete="off" name="payant" value="1" >Formation <strong style="color: purple;">PAYANTE</strong>
                       </label>
                    </div>
                    <div class="divprixmodify" style="display:none;">
                       <br />
                       Prix en euros: <br /><br /><input id="prix" type="number" min="1.00" max="1000000" step="0.01" value="1.00" style="width: 100%">
                    </div>
                    <div style="height: 3em;"></div>
                    <div class="input-group input-file" style="width: 100%;" name="pdf">
                       <span class="input-group-btn">
                       <button class="btn btn-default btn-choose" type="button">Fichier P D F</button>
                       </span>
                       <input type="text" class="form-control" placeholder='Résumé support de la séance...' style="width:142%; float: right;" />
                    </div>
                    <div style="height: 1.5em;"></div>
                    <input type="submit" name="submit" id="submit" class="nextmodify btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
                    <input type="submit" name="submit" id="submit" class="nextmodify btn btn-success continue"  style="float: right; margin-right: .5em; display: none;" value="Suivant"/>
                    <input type="button" name="previous" class="previousmodify btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
                 </fieldset>
                 <fieldset style="display: none;">
                    <div id="quizz_presence_setup">
                       Mise à jour de la formation {{ $formation->titre }}...
                    </div>
                 </fieldset>
           </div>
        </div>
     </div>
     </form>
  </div>
</div>
