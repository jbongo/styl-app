@extends('layouts.main.dashboard')
@section('header_name')
Portail des formations
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')

@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      @admin_or_formateur
      <a href="#addmodel" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5" data-toggle="modal"><i class="ti-plus"></i>@lang('Ajouter un modèle')</a>
      @endadmin_or_formateur
      @admin_or_intervenant
      <a href="#addformation" class="btn btn-dark btn-flat btn-addon m-b-10 m-l-5" data-toggle="modal"><i class="ti-plus"></i>@lang('Ajouter une formation unique')</a>
      <a href="{{ route('formation.plan') }}" class="btn btn-info btn-flat btn-addon m-b-10 m-l-5" style="float: right;" data-toggle="modal"><i class="ti-calendar"></i>@lang('Planifier une formation à partir d\'un modèle préconçu')</a>
      @endadmin_or_intervenant
      @admin_or_formateur
      <a href="{{ route('formation.cat') }}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5" style="float: right;" data-toggle="modal"><i class="ti-panel"></i>@lang('Modifier les catégories et sous-catégories')</a>
      @endadmin_or_formateur
      <div class="card-body">
        <div class="table-responsive" style="overflow-x: inherit !important;">
          <table  id="formations" class=" table student-data-table  m-t-20 ">
            <thead>
              <tr>
                <th>Date</th>
                <th>Durée</th>
                <!-- pour le tri -->
                <th style="display: none;"></th>
                <th>Importance</th>
                @admin_or_intervenant 
                <th></th>
                @endadmin_or_intervenant
                <th>Titre</th>
                <th></th>
                <th>Type</th>
                <th>Lieu</th>
                <th style="text-align: right;">Disponibilité</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="font-size: small">
              @foreach ($formations as $formation)
              <!-- si la formation n' a pas commencé -->
              @if (strtotime($formation->starting_date) > time() && $formation->is_model === 0)
              <tr>
                <td width="13%">
                  <span style="display: none;"> {{ $formation->starting_date }} </span>{{ strftime("%a %d %B", strtotime($formation->starting_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->starting_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->starting_date)) }}</strong>
                </td>
                <td style="display: none;"> {{ $formation->diff }} </td>
                <!-- variable pour le tri des durées -->
                <td @if ($formation->diff > 47) style="color:mediumvioletred;" @elseif ($formation->diff > 23) style="color:red;" @elseif ($formation->diff > 7) style="color:darkorange;" @elseif ($formation->diff > 3) style="color:orange;" @else style="color:green;" @endif width="6%">                                  
                <strong>{{ $formation->duration }}</strong>
                </td>
                <td width="6%">@if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</td>
                @admin_or_intervenant 
                <td width="3%"> @if ($formation->nb_inscrits) <a id="buttonusr" data-toggle="modal" style="font-size: small;" title="Inscrits" data-target="#usr-{{ $formation->id }}" href="#users"><strong class="badge badge-grey hoverusrs">{{ $formation->nb_inscrits }}</strong></a> @endif
                </td>
                @endadmin_or_intervenant
                <td width="30%" style="font-size: x-small;">                                   
                  {{ $formation->titre }} @if ($formation->category) <span style="float: right;"><strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @admin_or_formateur<a href="/formation/uncat/{{ $formation->id }}" data-toggle="tooltip" title="Décatégoriser" class="uncat" id="{{ $formation->id }}"><span class="ti-close color-danger"></span></a>@endadmin_or_formateur</span>@endif
                </td>
                <td width="5%">
                  <a id="buttondt" data-toggle="modal" style="font-size: small;" title="Détails" data-target="#pend-{{ $formation->id }}" href="#details"><i class="material-icons color-info hoverdetails">visibility</i></a>
                  @if ($formation->multiname)
                  @php
                    $multiname = explode (',' , $formation->multiname);
                    $size = count ($multiname);
                  @endphp
                  &nbsp<a id="buttonmultidt" data-toggle="modal" style="font-size: small;" title="Formations inclues" data-target="#multi-{{ $formation->id }}" href="#multi"><i class="material-icons color-warning hoverdetails">@if ($size < 10) filter_{{ $size }} @else filter_9_plus @endif</i></a>
                  @endif
                </td>
                <!-- responsive colors for type-->
                <td width="4%" @if ($formation->type == "salle") style="color:chocolate; text-align:center;" @else style="color:purple; text-align:center;" @endif>
                {{ $formation->type }}
                </td>
                <td width="9%">
                {{ $formation->lieu }}
                </td>
                <!-- responsive colors number of registrations-->
                <td width="9%" @if ($formation->nb_inscrits < $formation->nb_max / 2) style="color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="color:red;" @else style="color:grey;" @endif>
                @if ($formation->nb_max) <span style="display: none;">{{ $formation->nb_inscrits / $formation->nb_max }}</span> @endif
                <strong>@if ($formation->nb_max && $formation->nb_inscrits >= $formation->nb_max)<span class="badge badge-dark" style="float: right;">COMPLET</span> @else <span style="float: right;"> &nbsp <span class="badge" @if ($formation->nb_inscrits < $formation->nb_max / 2) style="background-color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="background-color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="background-color:red;" @else style="background-color:grey;" @endif>OUVERT</span></span> @endif @admin_or_intervenant<span style="float: left;">@if ($formation->nb_max) {{ $formation->nb_max - $formation->nb_inscrits }} @endif &nbsp &nbsp</span> @endadmin_or_intervenant</strong>
                </td>
                <td>
                  <!-- formulaire de formation -->
                  @mandataire
                  @php $is = 0; @endphp
                  @foreach ($formation->users as $usr)
                  @if (Auth::user()->id == $usr->id) <a href="/formation/unsubscribe/{{ $formation->id }}" data-toggle="tooltip" title="Se désinscrire" class="desinscrire" id="{{ $formation->id }}"><i class="material-icons color-danger hovergray">unsubscribe</i></a> @php $is = 1; @endphp @endif @endforeach
                  @if (!$is && $formation->nb_max > $formation->nb_inscrits) <a href="/formation/register/{{ $formation->id }}" data-toggle="tooltip" title="S' inscrire" class="inscrire" id="{{ $formation->id }}"><i class="material-icons color-info hovergray">subscriptions</i></a> @endif
                  @if ($formation->nb_max == $formation->nb_inscrits) <a data-toggle="tooltip" title="M' avertir quand une place se libère" class="email" href="#email-{{ $formation->id }}"><i class="material-icons color-success hovergray">email</i></a> @endif
                  @endmandataire
                  @formateur_or_intervenant
                  @if (Auth::user()->id === $formation->speaker_id)
                  <a data-toggle="modal" title="Modifier" href="#edit-{{ $formation->id }}" class="modify_modal_trigger" transfer="{{ $formation->id }}"><i class="material-icons color-warning hovergray">edit</i></a>
                  @endif
                  @endformateur_or_intervenant
                  @admin
                  <a data-toggle="modal" title="Modifier" href="#edit-{{ $formation->id }}" class="modify_modal_trigger" transfer="{{ $formation->id }}"><i class="material-icons color-warning hovergray">edit</i></a>
                  <a  href="/formation/delete/{{ $formation->id }}" class="delete" id="{{ $formation->id }}" data-toggle="tooltip" title="Archiver la formation"><i class="material-icons color-danger hovergray">delete</i></a>
                  @endadmin
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade refresh" id="addformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left;" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center; color: grey;"><strong>Ajouter une formation UNIQUE</strong></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-16" style="text-align: center;">
            <ul  id="progressbar">
              <li class="active">Informations basiques liees a la formation</li>
              <li>Options, documents et catégorisation</li>
              <li>Quizzes et Objectifs</li>
            </ul>
          </div>
        </div>
        <div class="form-validation" style="display: block">
          <form class="form-addadd row justify-content-start" id="prevententer" action="{{ route('formation.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <fieldset>
              <div class="form-group col-sm-2" style="font-size: small;">
                <label>Titre<span class="text-danger"> *</span></label>
                <div style="height: 1.35em;"></div>
                <label>Date de début<span class="text-danger">*</span></label>
                <div style="height: 1.35em;"></div>
                <label>Date de fin<span class="text-danger">*</span></label>
                <div style="height: 1.4em;"></div>
                <label>Type<span class="text-danger"></span></label>
                <div style="height: 1.6em;"></div>
                <span class="sallecontent" style="display:none;">
                  <label>Adresse<span class="text-danger"> *</span></label>
                  <div style="height: 1.35em;"></div>
                  <label>Code Postal<span class="text-danger"> *</span></label>
                  <div style="height: 1.35em;"></div>
                  <label>Ville<span class="text-danger"> *</span></label>
                  <div style="height: 1.35em;"></div>
                </span>
                <label>Durée minimum conseillée<span class="text-danger"> *</span></label>
                <div style="height: 1.35em;"></div>
                <label>Nombre de places<span class="text-danger"> *</span></label>
                <div style="height: 1.35em;"></div>
                <label class="align-bottom">Détails de la formation<span class="text-danger"></span></label>
                <div style="height: 11em;"></div>
                <label>Informations complémentaires<span class="text-danger"></span></label>
              </div>
              <div class="form-group col-sm-10">
                <input id="titre" type="text" name="titre" style="width:95%;" placeholder="Titre de la formation" required><br /><br />
                <input id="starting_date" type="date" name="starting_date" style="width:85%;" required><input id="starting_time" type="time" name="starting_time" style="width:10%;" required><br /><br />
                <input id="end_date" type="date" name="end_date" style="width:85%;" required><input id="end_time" type="time" name="end_time" style="width:10%;" required><br /><br />
                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; width: 95%;">
                  <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                  <input type="radio" id="visio"  autocomplete="off" value="visio" name="type" checked><strong style="color: purple;">VISIOCONFERENCE</strong></label>
                  <label class="btn btn-secondary-romain" style="width: 50%;">
                  <input type="radio" id="salle"  autocomplete="off" value="salle" name="type"><strong style="color: chocolate;">EN SALLE</strong></label>
                </div>
                <br />
                <span class="sallecontent" style="display:none;">
                <input id="st" type="text" name="st" style="width:95%;" placeholder="Complément d' addresse"><br /><br />
                <input id="postal" type="number" name="postal" style="width:95%;" placeholder="Code postal de la formation"><br /><br />
                <input id="lieu" type="text" name="lieu" style="width:95%;" placeholder="Ville de la formation"><br /><br />
                </span>
                <input id="days" type="number" name="days" style="width:5%;" value="0" min="0" max="364"> jours <input id="hours" type="number" name="hours" style="width:5%;" value="0" min="0" max="7"> heures<br /><br />                      
                <input id="nb_max" type="number" name="nb_max" max="2147483646" min="1" style="width:95%;" placeholder="Nombre de places" required><br /><br />
                <textarea id="details" name="details" rows="6" style="width:95%;" placeholder="Détails de la formation" style="font-size: x-small; white-space: pre-line;"></textarea>
                <br /><br />
                <textarea id="infocomp" name="infocomp" rows="6" style="width:95%;" placeholder="Informations complémentaires (exemple: adresse mail, télephone, groupe facebook, aide pour trouver l' adresse etc...)" style="font-size: x-small; white-space: pre-line;"></textarea>
              </div>
              <input type="button" name="next" class="nextadd btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <fieldset style="display:none;">
              <div class="col-sm-16">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="colorassign" type="button" data-toggle="dropdown" style="width: 100%;"><span id="bye">Choisir le nom de la catégorie parente</span><span id="selected"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                      @foreach ($formationcategories as $categories)
                        @if (!($categories->parent))
                        <label class="btn btn-secondary-romain catparent" style="width: 100%;"><input type="radio" name="parent" autocomplete="off" value="{{$categories->nom}}" colortomenu="btn btn-{{$categories->tag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$categories->tag_color}}">{{$categories->tag}}</strong> {{$categories->nom}}</label>
                        @endif
                      @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @foreach ($formationcategories as $categories)
              <div class="col-sm-16"  style="display:none;" id="subcat-{{$categories->nom}}">
              <div style="height: 1em;"></div>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="subcolorassign-{{$categories->nom}}" type="button" data-toggle="dropdown" style="width: 100%;"><span class="subbye">Choisir le nom de la sous-catégorie</span><span id="subselected-{{$categories->nom}}"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                    @foreach ($formationcategories as $subcategories)
                      @if ($subcategories->parent == $categories->nom)
                        <label class="btn btn-secondary-romain clicksubcat {{$categories->nom}}" style="width: 100%;"><input type="radio" name="catnom" autocomplete="off" value="{{$subcategories->nom}}" subcolortomenu="btn btn-{{$subcategories->soustag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$subcategories->soustag_color}}">{{$subcategories->soustag}}</strong> {{$subcategories->nom}}</label>
                      @endif
                    @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @endforeach
              <div style="height: 3em;"></div>
              <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="optionel" autocomplete="off" value="0" name="option_ordi">Ordinateur ou tablette <strong style="color: darkgreen;">optionels</strong></label>
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="obligatoire" autocomplete="off" value="1" name="option_ordi" checked>Ordinateur ou tablette <strong style="color: darkblue;">nécessaires</strong></label>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="complementaire" autocomplete="off" value="complementaire" name="hierarchie" checked>formation <strong style="color: orange;">COMPLEMENTAIRE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="necessaire" autocomplete="off" value="necessaire" name="hierarchie">formation <strong style="color: red;">OBLIGATOIRE</strong>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="presence_inactif_add" autocomplete="off" value="0" name="presence" checked>quiz de validation de présence <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="presence_actif_add" autocomplete="off" value="1" name="presence">quiz de validation de présence <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div id="presencesliderdivadd">
                <br />
                <input type="number" id="presenceslider_add" name="champs_presence" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="acquis_inactif_add" autocomplete="off" value="0" name="acquis" checked>quiz d' appréciation d' acquis <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="acquis_actif_add" autocomplete="off" value="1" name="acquis">quiz d' appréciation d' acquis <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div id="acquissliderdivadd">
                <br />
                <input type="number" id="acquisslider_add" name="champs_acquis" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="formation-gratuite" autocomplete="off" name="payant" value="0"  checked>Formation <strong style="color: darkblue;">GRATUITE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="formation-payante" autocomplete="off" name="payant" value="1" >Formation <strong style="color: purple;">PAYANTE</strong>
                </label>
              </div>
              <div id="divprix" style="display:none;">
                <br />
                Prix en euros: <br /><br /><input id="prix" type="number" min="1.00" max="1000000" step="0.01" value="1.00" style="width: 100%">
              </div>
              <div style="height: 3em;"></div>
              <div style="display: table; margin: 0 auto; width: 100%;">
                <div class="input-group input-file" style="width: 100%;" name="pdf">
                  <span class="input-group-btn">
                  <button class="btn btn-default btn-choose" type="button">PDF</button>
                  </span>
                  <input type="text" class="form-control" placeholder='PDF de la séance...' />
                </div>
                <div style="height: 1.5em;"></div>
              </div>
              <input type="submit" name="submit" id="submit" class="nextadd btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
              <input type="submit" name="submit" id="submit" class="nextadd btn btn-success continue"  style="float: right; margin-right: .5em; display: none;" value="Suivant"/>
              <input type="button" name="previous" class="previousadd btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <!--              <fieldset style="display: none;">
              </fieldset> -->
            <fieldset style="display: none;">
              <div id="quizz_presence_setup">
                Formation en cours de création...
              </div>
            </fieldset>
            <!--                            </fieldset> --> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade refresh" id="addmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true" style="text-align: left;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center; color: green;"><strong>Ajouter un modèle de formation</strong></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-16" style="text-align: center;">
            <ul  id="progressbar">
              <li class="active">Informations basiques liees a la formation</li>
              <li>Options, documents et catégorisation</li>
              <li>Quizzes et Objectifs</li>
            </ul>
          </div>
        </div>
        <div class="form-validation" style="display: block">
          <form class="form-add row justify-content-start" id="prevententer" action="{{ route('formation.model') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <fieldset>
              <div class="form-group col-sm-2" style="font-size: small;">
                <label>Titre<span class="text-danger"> *</span></label>
                <div style="height: 1.35em;"></div>
                <label>Type<span class="text-danger"></span></label>
                <div style="height: 1.6em;"></div>
                <label>Durée minimum conseillée<span class="text-danger"> *</span></label>
                <div style="height: 1.35em;"></div>
                <label class="align-bottom">Détails de la formation<span class="text-danger"></span></label>
                <div style="height: 11em;"></div>
                <label>Informations complémentaires<span class="text-danger"></span></label>
              </div>
              <div class="form-group col-sm-10">
                <input id="titre" type="text" name="titre" style="width:95%;" placeholder="Titre du modèle de formation" required><br /><br />
                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; width: 95%;">
                  <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                  <input type="radio" id="visiomodel"  autocomplete="off" value="visio" name="type" checked><strong style="color: purple;">VISIOCONFERENCE</strong></label>
                  <label class="btn btn-secondary-romain" style="width: 50%;">
                  <input type="radio" id="sallemodel"  autocomplete="off" value="salle" name="type"><strong style="color: chocolate;">EN SALLE</strong></label>
                </div>
                <br />
                </span>
                <input id="days" type="number" name="days" style="width:5%;" value="0" min="0" max="364"> jours <input id="hours" type="number" name="hours" style="width:5%;" value="0" min="0" max="7"> heures<br /><br />
                <textarea id="details" name="details" rows="6" style="width:95%;" placeholder="Détails de la formation" style="font-size: x-small; white-space: pre-line;"></textarea>
                <br /><br />
                <textarea id="infocomp" name="infocomp" rows="6" style="width:95%;" placeholder="Informations complémentaires (exemple: adresse mail, télephone, groupe facebook, aide pour trouver l' adresse etc...)" style="font-size: x-small; white-space: pre-line;"></textarea>
              </div>
              <input type="button" name="next" class="next btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <fieldset style="display:none;">
              <div class="col-sm-16">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="colorassignmodel" type="button" data-toggle="dropdown" style="width: 100%;"><span id="byemodel">Choisir le nom de la catégorie parente</span><span id="selectedmodel"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                      @foreach ($formationcategories as $categories)
                      @if (!($categories->parent))
                      <label class="btn btn-secondary-romain catparentmodel" style="width: 100%;"><input type="radio" name="parent" autocomplete="off" value="{{$categories->nom}}" colortomenu="btn btn-{{$categories->tag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$categories->tag_color}}">{{$categories->tag}}</strong> {{$categories->nom}}</label>
                      @endif
                      @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @foreach ($formationcategories as $categories)
              <div class="col-sm-16"  style="display:none;" id="subcatmodel-{{$categories->nom}}">
              <div style="height: 1em;"></div>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="subcolorassignmodel-{{$categories->nom}}" type="button" data-toggle="dropdown" style="width: 100%;"><span class="subbyemodel">Choisir le nom de la sous-catégorie</span><span id="subselectedmodel-{{$categories->nom}}"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                    @foreach ($formationcategories as $subcategories)
                      @if ($subcategories->parent == $categories->nom)
                        <label class="btn btn-secondary-romain clicksubcatmodel {{$categories->nom}}-model" style="width: 100%;"><input type="radio" name="catnom" autocomplete="off" value="{{$subcategories->nom}}" subcolortomenu="btn btn-{{$subcategories->soustag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$subcategories->soustag_color}}">{{$subcategories->soustag}}</strong> {{$subcategories->nom}}</label>
                      @endif
                    @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @endforeach
              <div style="height: 3em;"></div>
              <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="optionel" autocomplete="off" value="0" name="option_ordi">Ordinateur ou tablette <strong style="color: darkgreen;">optionels</strong></label>
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="obligatoire" autocomplete="off" value="1" name="option_ordi" checked>Ordinateur ou tablette <strong style="color: darkblue;">nécessaires</strong></label>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="complementaire" autocomplete="off" value="complementaire" name="hierarchie" checked>formation <strong style="color: orange;">COMPLEMENTAIRE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="necessaire" autocomplete="off" value="necessaire" name="hierarchie">formation <strong style="color: red;">OBLIGATOIRE</strong>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="presence_inactif" autocomplete="off" value="0" name="presence" checked>quiz de validation de présence <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="presence_actif" autocomplete="off" value="1" name="presence">quiz de validation de présence <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div id="presencesliderdiv">
                <br />
                <input type="number" id="presenceslider" name="champs_presence" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="acquis_inactif" autocomplete="off" value="0" name="acquis" checked>quiz d' appréciation d' acquis <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="acquis_actif" autocomplete="off" value="1" name="acquis">quiz d' appréciation d' acquis <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div id="acquissliderdiv">
                <br />
                <input type="number" id="acquisslider" name="champs_acquis" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" id="formation-gratuite_add" autocomplete="off" name="payant" value="0"  checked>Formation <strong style="color: darkblue;">GRATUITE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" id="formation-payante_add" autocomplete="off" name="payant" value="1" >Formation <strong style="color: purple;">PAYANTE</strong>
                </label>
              </div>
              <div id="divprix" style="display:none;">
                <br />
                Prix en euros: <br /><br /><input id="prix" type="number" min="1.00" max="1000000" step="0.01" value="1.00" style="width: 100%">
              </div>
              <div style="height: 3em;"></div>
              <div style="display: table; margin: 0 auto; width: 100%;">
                <div class="input-group input-file" style="width: 100%;" name="pdf">
                  <span class="input-group-btn">
                  <button class="btn btn-default btn-choose" type="button">PDF</button>
                  </span>
                  <input type="text" class="form-control" placeholder='PDF de la séance...' />
                </div>
                <div style="height: 1.5em;"></div>
              </div>
              <input type="submit" name="submit" id="submit" class="next btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
              <input type="submit" name="submit" id="submit" class="next btn btn-success continue"  style="float: right; margin-right: .5em; display: none;" value="Suivant"/>
              <input type="button" name="previous" class="previous btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <!--              <fieldset style="display: none;">
              </fieldset> -->
            <fieldset style="display: none;">
              <div id="quizz_presence_setup">
                Modèle en cours de création...
              </div>
            </fieldset>
            <!--                            </fieldset> --> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@foreach ($formations as $formation)
@if (strtotime($formation->starting_date) > time() && $formation->is_model === 0)
<div class="modal fade" id="multi-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  @php
    $multiname = explode (',' , $formation->multiname);
    $arraydatestart = explode (',' , $formation->startdatearray);
    $arraydateend = explode (',' , $formation->enddatearray);
    $arraytimestart = explode (',' , $formation->starttimearray);
    $arraytimeend = explode (',' , $formation->endtimearray);
  @endphp
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><strong>{{ $formation->titre }} <span @if ($formation->type == "salle") style="color:chocolate;" @else style="color:purple;" @endif>[ {{ $formation->type }} ] </span> @admin_or_intervenant <span @if ($formation->nb_inscrits < $formation->nb_max / 2) style="color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="color:red;" @else style="color:grey;" @endif>( {{ $formation->nb_inscrits }} / {{ $formation->nb_max }} )</span> @endadmin_or_intervenant @if ($formation->type == 'salle') &nbsp à &nbsp {{ $formation->lieu }} [ {{ $formation->postal }} ]@endif @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</strong> @if ($formation->category) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @endif</h4>
      </div>
      <div class="modal-body">
        <div class="panel lobipanel-basic panel-warning">
          <div class="panel-heading">
            Formations inclues dans la multiformation
          </div>
          <div class="panel-body" style="white-space: pre-line; width : 100%;">
            @foreach ($multiname as $key => $multi)
             {{ $key + 1 }} . <strong> {{ $multi }} </strong><span style="text-align:right; float:right"> Du {{ strftime("%a %d %B", strtotime($arraydatestart[$key])) }} à <strong>{{ $arraytimestart[$key] }}</strong> Au {{ strftime("%a %d %B", strtotime($arraydateend[$key])) }} à <strong> {{ $arraytimeend[$key] }} </strong></span><br />
             @foreach ($formations as $form)
              @if ($multi == $form->titre)
                <span style="font-size: x-small"> {{ $form->details }} </span><br />
                @if ($form->infocomp)
                <span style="font-size: x-small"> {{ $form->infocomp }} </span><br />
                @endif
                @if ($form->option_ordi)
                <h6><span class="btn ti-desktop color-danger"></span>Ordinateur ou tablette INDISPENSABLES pour ce module de formation<span class="btn ti-tablet color-warning"></span></h6><br />
                @endif
              @endif
             @endforeach
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="usr-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><strong>{{ $formation->titre }} <span @if ($formation->type == "salle") style="color:chocolate;" @else style="color:purple;" @endif>[ {{ $formation->type }} ] </span><span @if ($formation->nb_inscrits < $formation->nb_max / 2) style="color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="color:red;" @else style="color:grey;" @endif>( {{ $formation->nb_inscrits }} / {{ $formation->nb_max }} )</span> @if ($formation->type == 'salle') &nbsp à &nbsp {{ $formation->lieu }} [ {{ $formation->postal }} ]@endif @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</strong> @if ($formation->category) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @endif</h4>
      </div>
      <div class="modal-body">
        <div class="panel lobipanel-basic panel-dark">
          <div class="panel-heading" style="color: black; box-shadow: 0 0 2px 2px grey; text-shadow: 1px -1px lightgrey;"><strong>
            @lang('Utilisateurs inscrits')
          </div>
          <div class="panel-body" style="white-space: pre-line; font-size: small; width : 100%;">
          @foreach ($formation->users as $key => $usr)
           <br />
           {{ $key + 1 }} . {{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, {{ $usr->role }} de {{ $usr->ville }} ( {{ $usr->code_postal }} ) , s ' est @if ( $usr->civilite == 'Mme') inscrite @else inscrit @endif le {{ strftime("%a %d %B", strtotime($usr->pivot->created_at)) }} à <strong @if (intval(strftime("%H", strtotime($usr->pivot->created_at))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($usr->pivot->created_at)) }} . <a id="buttonusr{{ $usr->id }}" data-toggle="tooltip" style="margin-right: 6em; float:right;" href="/users/{{ $usr->id }}" title="{{ $usr->prenom }} {{ $usr->nom }}"><i class="material-icons md-24 color-info hoverdetails">account_box</i></a> </strong>
          @endforeach
          </div></strong>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="pend-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- responsive colors for type and number of registrations-->
        <h4 class="modal-title" id="exampleModalLabel"><strong>{{ $formation->titre }} @admin_or_intervenant <span @if ($formation->type == "salle") style="color:chocolate;" @else style="color:purple;" @endif>[ {{ $formation->type }} ] </span><span @if ($formation->nb_inscrits < $formation->nb_max / 2) style="color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="color:red;" @else style="color:grey;" @endif>( {{ $formation->nb_inscrits }} / {{ $formation->nb_max }} )</span> @endadmin_or_intervenant @if ($formation->type == 'salle') &nbsp à &nbsp {{ $formation->lieu }} [ {{ $formation->postal }} ]@endif @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</strong> @if ($formation->category) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @endif</h4>
      </div>
      <div class="modal-body">
        <div class="panel lobipanel-basic panel-primary">
          <div class="panel-heading">
            <div class="panel-title">Détails</div>
          </div>
          <div class="panel-body" style="white-space: pre-line; font-size: small;">{{ $formation->details }}</div>
        </div>
        <div class="panel lobipanel-basic panel-warning">
          <div class="panel-heading">
            <div class="panel-title">Horaires</div>
          </div>
          <div class="panel-body" style="white-space: pre-line;">du {{ strftime("%a %d %B", strtotime($formation->starting_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->starting_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->starting_date)) }}</strong> <br />au {{ strftime("%a %d %B", strtotime($formation->end_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->end_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->end_date)) }}</strong></div>
        </div>
        @if ($formation->type == 'salle') 
        <div class="panel lobipanel-basic panel-success">
          <div class="panel-heading">
            <div class="panel-title">Adresse Complète</div>
          </div>
          <div class="panel-body" style="white-space: pre-line; font-size: small;">{{ $formation->st }} à {{ $formation->lieu }} [ {{ $formation->postal }} ]</div>
        </div>
        @endif
        <div class="panel lobipanel-basic panel-danger">
          <div class="panel-heading">
            <div class="panel-title">Informations Complémentaires</div>
          </div>
          <div class="panel-body" style="white-space: pre-line; font-size: small;">
            {{ $formation->infocomp }} @if ($formation->option_ordi)
            <br /> 
            <h4><span class="btn ti-desktop color-danger"></span>Ordinateur ou tablette INDISPENSABLES<span class="btn ti-tablet color-warning"></span></h4>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left; font-size: small;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><strong style="color: orangered;">Modifier la formation</strong> &nbsp {{ $formation->titre }}</h4>
      </div>
      <div class="modal-body">
        <div class="form-validation" style="display: block;">
          <form id="form-add-{{ $formation->id }}" class="row justify-content-start" action="{{ route('formation.update') }}" method="POST">
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
                <input id="titre" type="text" name="titre" style="width:98%;" value="{{ $formation->titre }}">
                <div style="height: 1.8em;"></div>
                <input id="starting_date" type="date" name="starting_date" style="width:88%;" value="@php echo( date('Y-m-d', strtotime($formation->starting_date)) ) @endphp" required><input id="starting_time" type="time" name="starting_time" style="width:10%;" value="@php echo( date('H:i', strtotime($formation->starting_date)) ) @endphp" required>
                <div style="height: 1.8em;"></div>
                <input id="end_date" type="date" name="end_date" style="width:88%;" value="@php echo( date('Y-m-d', strtotime($formation->end_date)) ) @endphp" required><input id="end_time" type="time" name="end_time" style="width: 10%;" value="@php echo( date('H:i', strtotime($formation->end_date)) ) @endphp" required>
                <div style="height: 1.8em;"></div>
                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 98%;">
                  <label class="btn btn btn-secondary-romain @if ($formation->type == 'visio') active @endif" style="width: 49%;" @if ($formation->type == 'visio') checked @endif>
                  <input type="radio" class="visio"  autocomplete="off" value="visio" name="type" @if ($formation->type == 'visio') checked @endif><strong style="color: purple;">VISIOCONFERENCE</strong></label>
                  <label class="btn btn btn-secondary-romain @if ($formation->type == 'salle') active @endif" style="width: 49%;" @if ($formation->type == 'salle') checked @endif>
                  <input type="radio" class="salle"  autocomplete="off" value="salle" name="type" @if ($formation->type == 'salle') checked @endif><strong style="color: chocolate;">EN SALLE</strong></label>
                </div>
                <br />
                <span class="sallecontent2" @if ($formation->type == 'visio') style="display:none;" @endif>
                <input id="st" type="text" name="st" style="width:98%;" value="{{ $formation->st }}">
                <div style="height: 1.8em;"></div>
                <input id="postal" type="text" name="postal" style="width:98%;" value="{{ $formation->postal }}">
                <div style="height: 1.8em;"></div>
                <input id="lieu" type="text" name="lieu" style="width:98%;" value="{{ $formation->lieu }}">
                <div style="height: 1.8em;"></div>
                </span>
                <input id="nb_max" type="number" min="{{ $formation->nb_inscrits }}" max="2147483646" name="nb_max" style="width:98%;" value="{{ $formation->nb_max }}">
                <div style="height: 1.8em;"></div>
                <textarea id="details" type="text" name="details" rows="4" style="width:98%; font-size: x-small; white-space: pre-line;">{{ $formation->details }}</textarea>
                <div style="height: 1.8em;"></div>
                <textarea id="infocomp" type="text" name="infocomp" rows="4" style="width:98%; font-size: x-small; white-space: pre-line;">{{ $formation->infocomp }}</textarea>
                <input id="id" type="number" name="id" value="{{ $formation->id }}" style="visibility: hidden;">
              </div>
              <input type="button" name="next" class="nextmodify btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger uncheck" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <fieldset style="display: none;">
            <div style="height: 1em;"></div>
            <div class="btn-group btn-group-toggle btn-block changecat" id="changecat-{{ $formation->id }}" data-toggle="buttons" ><label class="btn btn-secondary-romain" style="width: 100%"><input type="checkbox" class="btn btn-secondary-romain" name="on" unchecked><strong style="color: darkred;">CHANGER LA CATEGORIE DE LA FORMATION @if ($formation->category) ({{$formation->category->parent}} {{$formation->category->nom}}) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}">{{$formation->category->soustag}}</strong> @endif</strong></label></div>
            <div style="display: none;" id="showcat-{{$formation->id}}">
              <div style="height: 2em;"></div>
              <div class="col-sm-16">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="colorassignmodify-{{$formation->id}}" type="button" data-toggle="dropdown" style="width: 100%;"><span id="byemodify-{{$formation->id}}">Choisir le nom de la catégorie parente</span><span id="selectedmodify-{{$formation->id}}"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                      @foreach ($formationcategories as $category)
                      @if (!($category->parent))
                      <label class="btn btn-secondary-romain catparentmodify" style="width: 100%;"><input type="radio" name="parent" autocomplete="off" value="{{$category->nom}}" colortomenu="btn btn-{{$category->tag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$category->tag_color}}">{{$category->tag}}</strong> {{$category->nom}}</label>
                      @endif
                      @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @foreach ($formationcategories as $category)
              <div class="col-sm-16"  style="display:none;" id="subcatmodify-{{$category->nom}}-{{$formation->id}}">
              <div style="height: 1em;"></div>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="subcolorassignmodify-{{$formation->id}}-{{$category->nom}}" type="button" data-toggle="dropdown" style="width: 100%;"><span class="subbyemodify-{{$formation->id}}">Choisir le nom de la sous-catégorie</span><span id="subselectedmodify-{{$formation->id}}-{{$category->nom}}"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                    @foreach ($formationcategories as $subcategory)
                      @if ($subcategory->parent == $category->nom)
                        <label class="btn btn-secondary-romain clicksubcatmodify" style="width: 100%;" id="{{$category->nom}}"><input type="radio" name="catnom" autocomplete="off" value="{{$subcategory->nom}}" subcolortomenu="btn btn-{{$subcategory->soustag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$subcategory->soustag_color}}">{{$subcategory->soustag}}</strong> {{$subcategory->nom}}</label>
                      @endif
                    @endforeach
                    </label>
                  </label>
                </div>
              </div>
              @endforeach
              </div>
              <div style="height: 3em;"></div>
              <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain @if (!($formation->option_ordi)) active @endif" style="width: 50%;">
                <input type="radio" id="optionel" autocomplete="off" value="0" name="option_ordi" @if (!($formation->option_ordi)) checked @endif>Ordinateur ou tablette <strong style="color: darkgreen;">optionels</strong></label>
                <label class="btn btn-secondary-romain @if ($formation->option_ordi) active @endif" style="width: 50%;">
                <input type="radio" id="obligatoire" autocomplete="off" value="1" name="option_ordi" @if ($formation->option_ordi) checked @endif>Ordinateur ou tablette <strong style="color: darkblue;">nécessaires</strong></label>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain @if ($formation->hierarchie == 'complementaire') active @endif" style="width: 50%;">
                <input type="radio" id="complementaire" autocomplete="off" value="complementaire" name="hierarchie" @if ($formation->hierarchie == 'complementaire') checked @endif>formation <strong style="color: orange;">COMPLEMENTAIRE</strong>
                </label>
                <label class="btn btn-secondary-romain @if ($formation->hierarchie == 'necessaire') active @endif" style="width: 50%;">
                <input type="radio" id="necessaire" autocomplete="off" value="necessaire" name="hierarchie" @if ($formation->hierarchie == 'necessaire') checked @endif>formation <strong style="color: red;">OBLIGATOIRE</strong>
                </label>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain @if (!($formation->presence)) active @endif" style="width: 50%;" checked>
                <input type="radio" class="presence_inactif_modify" autocomplete="off" value="0" name="presence" @if (!($formation->presence)) checked @endif>quiz de validation de présence <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain @if ($formation->presence) active @endif" style="width: 50%;">
                <input type="radio" class="presence_actif_modify" autocomplete="off" value="1" name="presence" @if ($formation->presence) checked @endif>quiz de validation de présence <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div class="presencesliderdivmodify">
                <br />
                <input type="number" class="presenceslider_modify" name="champs_presence" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain @if (!($formation->acquis)) active @endif" style="width: 50%;" checked>
                <input type="radio" class="acquis_inactif_modify" autocomplete="off" value="0" name="acquis" @if (!($formation->acquis)) checked @endif>quiz d' appréciation d' acquis <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain @if ($formation->acquis) active @endif" style="width: 50%;">
                <input type="radio" class="acquis_actif_modify" autocomplete="off" value="1" name="acquis" @if ($formation->acquis) checked @endif>quiz d' appréciation d' acquis <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div class="acquissliderdivmodify">
                <br />
                <input type="number" class="acquisslider_modify" name="champs_acquis" max="10" min="1" style="width:80%;">
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
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
                <input type="text" class="form-control" placeholder='Résumé support de la séance...' style="width:100%; float: right;" />
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
@endif
@endforeach
@endsection
@section('js-content')
<script>

  var current_fs, next_fs, previous_fs;
  var currentmodify_fs, nextmodify_fs, previousmodify_fs;
  var currentadd_fs, nextadd_fs, previousadd_fs; 
  var left, opacity, scale; 
  var animating;
  var transfer;
  var table;
  var parent;
  parent = 0;
  var subcat;
  var parentmodify;
  parentmodify = 0;
  var subcatmodify;
  var parentmodel;
  parentmodel = 0;
  var subcatmodel;
  /* current_fs = $(".form-add").parent();
  next_fs = $(".form-add").parent().next();
  previous_fs = $(".previous").parent().prev();
  next_fs.hide(); 
  current_fs.hide();
  current_fs.show(); */
  $('#presencesliderdiv').hide();
  $('#acquissliderdiv').hide();
  $('#presencesliderdivadd').hide();
  $('#acquissliderdivadd').hide();
  $('.presencesliderdivmodify').hide();
  $('.acquissliderdivmodify').hide();
/*  $('#prevententer').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    $(".next");
    return false;
  }
}); */
  
  $('.refresh').on('hidden.bs.modal', function () {
      location.reload();
    })

  $(".uncheck").click(function(){
    $('input[name=catnom]').removeAttr('checked');
    $('input[name=parent]').removeAttr('checked');
    $('input[name=on]').removeAttr('checked');
  });

  //validation inscription form
  $(".next").click(function(){
  
  //validation
  var form = $(".form-add");
  $.validator.messages.required = '';
      form.validate({
            errorClass: "bg-danger",
             });
    /*        messages: {
               "titre": "Vous devez saisir le tribunal d'immatriculation !",
               "starting_date": "Vous devez saisir correctement le numéro RSAC !",
               "end_date": "Vous devez saisir la date d'immatriculation RSAC !",
               "nb_max": "Vous devez saisir l'organisme d'assurance !",
           }*/
  if (form.valid() == true){
  if(animating) return false;
      animating = true;
  
  current_fs = $(this).parent();
  next_fs = $(this).parent().next();
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
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
      duration: 400, 
      complete: function(){
          current_fs.hide();
          animating = false;
          next_fs.show(); 
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
      duration: 400, 
      complete: function(){
          current_fs.hide();
          animating = false;
      }, 
      seasing: 'easeInOutBack'
  });
  });

   $(".nextadd").click(function(){
  
  //validation
  var form = $(".form-addadd");
  $.validator.messages.required = '';
      form.validate({
            errorClass: "bg-danger",
              rules: {
               "lieu": {
                       required: !0
               },
               "postal": {
                       required: !0
               },
               "st": {
                       required: !0
               }
               },
             });
    /*        messages: {
               "titre": "Vous devez saisir le tribunal d'immatriculation !",
               "starting_date": "Vous devez saisir correctement le numéro RSAC !",
               "end_date": "Vous devez saisir la date d'immatriculation RSAC !",
               "nb_max": "Vous devez saisir l'organisme d'assurance !",
           }*/
  if (form.valid() == true){
  if(animating) return false;
      animating = true;
  
  currentadd_fs = $(this).parent();
  nextadd_fs = $(this).parent().next();
  $("#progressbar li").eq($("fieldset").index(nextadd_fs)).addClass("active");
  currentadd_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 1 - (1 - now) * 0.2;
          left = (now * 50)+"%";
          opacity = 1 - now;
          currentadd_fs.css({
      'transform': 'scale('+scale+')',
    });
          nextadd_fs.css({'left': left, 'opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentadd_fs.hide();
          animating = false;
          nextadd_fs.show(); 
      }, 
      easing: 'easeInOutBack'
  });
  }
  });
  
  $(".previousadd").click(function(){
  if(animating) return false;
  animating = true;
  
  currentadd_fs = $(this).parent();
  previousadd_fs = $(this).parent().prev();
  $("#progressbar li").eq($("fieldset").index(currentadd_fs)).removeClass("active");
  previousadd_fs.show();
  currentadd_fs.hide();
  currentadd_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 0.8 + (1 - now) * 0.2;
          left = ((1-now) * 50)+"%";
          opacity = 1 - now;
          currentadd_fs.css({'left': left});
          previousadd_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentadd_fs.hide();
          animating = false;
      }, 
      seasing: 'easeInOutBack'
  });
  });

  //validation modify form

  $(".modify_modal_trigger").click(function(){
    transfer = $(this).attr('transfer');
    console.log(transfer);
  });
  $(".nextmodify").click(function(){
    //validation
  var form = $("#form-add-" + transfer);
  $.validator.messages.required = '';
      form.validate({
            errorClass: "bg-danger",
              rules: {
               "lieu": {
                       required: !0
               },
               "postal": {
                       required: !0
               },
               "st": {
                       required: !0
               }
               },
             });
    /*        messages: {
               "titre": "Vous devez saisir le tribunal d'immatriculation !",
               "starting_date": "Vous devez saisir correctement le numéro RSAC !",
               "end_date": "Vous devez saisir la date d'immatriculation RSAC !",
               "nb_max": "Vous devez saisir l'organisme d'assurance !",
           }*/
  if (form.valid() == true){
  if(animating) return false;
      animating = true;
  
  currentmodify_fs = $(this).parent();
  nextmodify_fs = $(this).parent().next();
  currentmodify_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 1 - (1 - now) * 0.2;
          left = (now * 50)+"%";
          opacity = 1 - now;
          currentmodify_fs.css({
      'transform': 'scale('+scale+')',
    });
          nextmodify_fs.css({'left': left, 'opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentmodify_fs.hide();
          animating = false;
          nextmodify_fs.show(); 
      },
      easing: 'easeInOutBack'
  });
  }
  });
  
  $(".previousmodify").click(function(){
  if(animating) return false;
  animating = true;
  
  currentmodify_fs = $(this).parent();
  previousmodify_fs = $(this).parent().prev();
  previousmodify_fs.show();
  currentmodify_fs.hide();
  currentmodify_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 0.8 + (1 - now) * 0.2;
          left = ((1-now) * 50)+"%";
          opacity = 1 - now;
          currentmodify_fs.css({'left': left});
          previousmodify_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentmodify_fs.hide();
          animating = false;
      }, 
      seasing: 'easeInOutBack'
  });
  });

  $(".changecat").click(function(){
    console.log(transfer);
    setTimeout(function(){
     if($('input[name=on]').is(":checked")) // check if the radio is checked
        $('#showcat' + '-' + transfer).show();
     else
     {
        $('input[name=catnom]').removeAttr('checked');
        $('input[name=parent]').removeAttr('checked');
        $('#showcat' + '-' + transfer).hide();
        $('input[name=on]').removeAttr('checked');
     }
    }, 50);
  });

  $(".catparent").click(function(){
      $("#bye").hide();
    setTimeout(function(){
          if (parent)
            $("#subcat-" + parent).hide();
          parent = $('input[name=parent]:checked').val();
          $('#selected').html(parent);
          $("#colorassign").removeClass();
          $("#colorassign").attr('class', $('input[name=parent]:checked').attr('colortomenu'));
          $("#subcat-" + parent).show();
    }, 100);
  });
  $('.clicksubcat').on('click', function(){
      $(".subbye").hide();
    setTimeout(function(){
          subcat = $('input[name=catnom]:checked').val();
          $("#subselected-" + parent).html(subcat);
          $("#subcolorassign-" + parent).removeClass();
          $("#subcolorassign-" + parent).attr('class', $('input[name=catnom]:checked').attr('subcolortomenu'));
    }, 100);
  });
  $(".catparentmodel").click(function(){
      $("#byemodel").hide();
    setTimeout(function(){
          if (parentmodel)
            $("#subcatmodel-" + parentmodel).hide();
          parentmodel = $('input[name=parent]:checked').val();
          $("#selectedmodel").html(parentmodel);
          $("#colorassignmodel").removeClass();
          $("#colorassignmodel").attr('class', $('input[name=parent]:checked').attr('colortomenu'));
          $("#subcatmodel-" + parentmodel).show();
    }, 100);
  });
  $('.clicksubcatmodel').on('click', function(){
      $(".subbyemodel").hide();
    setTimeout(function(){
          subcatmodel = $('input[name=catnom]:checked').val();
          $('#subselectedmodel-' + parentmodel).html(subcatmodel);
          $('#subcolorassignmodel-' + parentmodel).removeClass();
          $('#subcolorassignmodel-' + parentmodel).attr('class', $('input[name=catnom]:checked').attr('subcolortomenu'));
    }, 100);
  });
  $(".catparentmodify").click(function(){
      $('#byemodify-' + transfer).hide();
    setTimeout(function(){
          if (parentmodify)
            $('#subcatmodify-' + parentmodify + '-' + transfer).hide();
          parentmodify = $('input[name=parent]:checked').val();
          $('#selectedmodify-' + transfer).html(parentmodify);
          $('#colorassignmodify-' + transfer).removeClass();
          $('#colorassignmodify-' + transfer).attr('class', $('input[name=parent]:checked').attr('colortomenu'));
          $('#subcatmodify-' + parentmodify + '-' + transfer).show();
    }, 100);
  });
  $(".clicksubcatmodify").on('click', function(){
      $('.subbyemodify-' + transfer).hide();
    setTimeout(function(){
          subcatmodify = $('input[name=catnom]:checked').val();
          $('#subselectedmodify-' + transfer + '-' + parentmodify).html(subcatmodify);
          $('#subcolorassignmodify-' + transfer + '-' + parentmodify).removeClass();
          $('#subcolorassignmodify-' + transfer + '-' + parentmodify).attr('class', $('input[name=catnom]:checked').attr('subcolortomenu'));
    }, 100);
  });
       $(document).ready(function() {
         $(".visio") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent2').hide();
                 }
             });
         $(".salle") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent2').show();
                 }
             });
         $("#visio") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent').hide();
                 }
             });
         $("#salle") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent').show();
                 }
             });
         $("#formation-gratuite") // select the radio by its id
             .change(function(){ // bind a function to the change event
              console.log('yolo');
                 if( $(this).is(":checked") ){ // check if the radio is checked
                      e.preventDefault();
                   $('#divprix').hide();
                 }
             });
         $("#formation-payante") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('#divprix').show();
                 }
             });
         $("#formation-payante_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixmodify').show();
                 }
             });
         $("#formation-gratuite_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixmodify').hide();
                 }
             });
         $("#formation-payante_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixadd').show();
                 }
             });
         $("#formation-gratuite_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixadd').hide();
                 }
             });
         $("#acquis_actif") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('#acquissliderdiv').show();
                   $('#acquisslider').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
                 }
             });
         $(".acquis_actif_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('.acquissliderdivmodify').show();
                   console.log('yolo');
                   $('.acquisslider_modify').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
                 }
             });
         $("#acquis_actif_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('#acquissliderdivadd').show();
                   console.log('yolo');
                   $('#acquisslider_add').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
                 }
             });
         $("#presence_actif") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('#presencesliderdiv').show();
                   $('#presenceslider').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
 /*                  $bool = 1;
                   $('#quizz_presence_setup').show(); */
                 }
             });
         $(".presence_actif_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('.presencesliderdivmodify').show();
                   $('.presenceslider_modify').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
 /*                  $bool = 1;
                   $('#quizz_presence_setup').show(); */
                 }
             });
         $("#presence_actif_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('#presencesliderdivadd').show();
                   $('#presenceslider_add').ionRangeSlider({
                       grid: true,
                       grid_num: 9,
                       min: 1,
                       max: 10,
                       from: 1,
                       step: 1,
                       postfix: " champ(s)",
                       disable: false,
                   });
 /*                  $bool = 1;
                   $('#quizz_presence_setup').show(); */
                 }
             });
         $("#presence_inactif") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('#presencesliderdiv').hide();
                  if ( $("#acquis_inactif").is(":checked") ) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $(".presence_inactif_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('.presencesliderdivmodify').hide();
                  if ( $(".acquis_inactif_modify").is(":checked")) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $("#presence_inactif_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('#presencesliderdivadd').hide();
                  if ( !($("#acquis_actif_add").is(":checked"))) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $("#acquis_inactif") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('#acquissliderdiv').hide();
                  if ( $("#presence_inactif").is(":checked") ) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $(".acquis_inactif_modify") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('.acquissliderdivmodify').hide();
                  if ( $(".presence_inactif_modify").is(":checked")) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $("#acquis_inactif_add") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('#acquissliderdivadd').hide();
                  if ( !($("#presence_actif_add").is(":checked"))) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
       });
       $(function() {
           $(".input-file").before(
             function() {
               if ( ! $(this).prev().hasClass('input-ghost') ) {
                 var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                 element.attr("name",$(this).attr("name"));
                 element.change(function(){
                   element.next(element).find('input').val((element.val()).split('\\').pop());
                 });
                 $(this).find("button.btn-choose").click(function(){
                   element.click();
                 });
                 $(this).find('input').mousedown(function() {
                   $(this).parents('.input-file').prev().click();
                   return false;
                 });
                 return element;
               }
             }
           );
           $('[data-toggle="tooltip"]').tooltip()
           $('[data-toggle="modal"]').tooltip()
           $(".hoverdetails").hover(function(){
              $(this).css("color", "red");
              }, function(){
              $(this).css("color", "");
           });
           $(".hoverusrs").hover(function(){
              $(this).css("color", "black");
              }, function(){
              $(this).css("color", "");
           });
           $(".hovergray").hover(function(){
              $(this).css("color", "gray");
            }, function(){
              $(this).css("color", "");
              });
           table = $('#formations').dataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                            }
  });
           $('a.delete').click(function(e) {
               let that = $(this)
               e.preventDefault()
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Vraiment ARCHIVER cette formation ?')',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: '@lang('Oui')',
           cancelButtonText: '@lang('Non')',
           
       }).then((result) => {
           if (result.value) {
               $('[data-toggle="tooltip"]').tooltip('hide')
                   $.ajax({                        
                       url: that.attr('href'),
                       type: 'GET',
                   })
                   .done(function () {
                           that.parents('tr').remove()
                   })
  
               swalWithBootstrapButtons(
               'Supprimé!',
               'Cette formation a bien été archivée.',
               'success'
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'Pas de stress, cette formation n\'a pas été archivée.',
               'error'
               )
           }
       })
           })


           $('a.inscrire').click(function(e) {
               let that = $(this)
               e.preventDefault()
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Voulez-vous vous inscrire pour la formation ?')',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: '@lang('Oui')',
           cancelButtonText: '@lang('Non')',
           
       }).then((result) => {
           if (result.value) {
               $('[data-toggle="tooltip"]').tooltip('hide')
                   $.ajax({                        
                       url: that.attr('href'),
                       type: 'GET',
                   })
                   .done(function () {
                            location.reload();
                  })
  
               swalWithBootstrapButtons(
               'OK!',
               'Vous êtes à présent inscrit pour cette formation',
               'success'
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'Vous ne vous êtes pas inscrit pour cette formation',
               'error'
               )
           }
       })
           })

 $('a.desinscrire').click(function(e) {
               let that = $(this)
               e.preventDefault()
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Voulez-vous vous désinscrire à la formation ?')',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: '@lang('Oui')',
           cancelButtonText: '@lang('Non')',
           
       }).then((result) => {
           if (result.value) {
               $('[data-toggle="tooltip"]').tooltip('hide')
                   $.ajax({                        
                       url: that.attr('href'),
                       type: 'GET',
                   })
                   .done(function () {
                            location.reload();
                  })
  
               swalWithBootstrapButtons(
               'OK!',
               'Vous n\' êtes plus inscrit à cette formation',
               'success'
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'Vous êtes toujours inscrit à cette formation',
               'error'
               )
           }
       })
           })
 $('a.uncat').click(function(e) {
               let that = $(this)
               e.preventDefault();
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Voulez-vous vous décatégoriser cette formation ?')',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: '@lang('Oui')',
           cancelButtonText: '@lang('Non')',
           
       }).then((result) => {
           if (result.value) {
                console.log(that.attr('href'));
               $('[data-toggle="tooltip"]').tooltip('hide');
                   $.ajax({                        
                       url: that.attr('href'),
                       type: 'GET',
                   })
                   .done(function () {
                            location.reload();
                  })
  
               swalWithBootstrapButtons(
               'OK!',
               'La formation n\' appartient plus à une catégorie',
               'success',
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'La formation appartient toujours à une catégorie',
               'error',
               )
           }
       })
           })

           $('a.email').click(function(e) {
               let that = $(this)
               e.preventDefault()
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Recevoir un email si une place pour cette formation se libère ?')',
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: '@lang('Oui')',
           cancelButtonText: '@lang('Non')',
           
       }).then((result) => {
           if (result.value) {
               $('[data-toggle="tooltip"]').tooltip('hide')
                   $.ajax({                        
                       url: that.attr('href'),
                       type: 'GET',
                   })
                   .done(function () {
                 //  $formation->nb_inscrits++;
             //              that.parents('tr').html()
                   })
  
               swalWithBootstrapButtons(
               'OK!',
               'Un email vous sera envoyé si une place se libère',
               'success'
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'Processus d\' envoi d\' email annulé',
               'error'
               )
           }
       })
           })
       })
   
</script>
@endsection
