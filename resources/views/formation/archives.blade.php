@extends('layouts.main.dashboard')
@section('header_name')
Archives des formations
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
<div class="row"> 
  <div class="col-lg-12">
    <div class="card">
      <a href="{{ route('formation.apply') }}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5" style="float: right;" data-toggle="modal"><i class="ti-back-left"></i>@lang('Portail des formations')</a>
      <div class="card-body">
        <div class="table-responsive" style="overflow-x: inherit !important;">
            <table  id="formations" class=" table student-data-table  m-t-20 "  style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Durée</th>
                        <th style="display: none;"></th>
                        <th>Importance</th>
                        <th></th>
                        <th>Titre</th>  
                        <th></th>                                      
                        <th>Type</th>
                        <th>Lieu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: small">
                @foreach ($formation_archives as $formation)
                <!-- si la formation est finie -->
                    <tr>
                        <td width="13%">
                        @if ( $formation->is_model )
                        <strong> EST UN MODELE </strong>
                        @else
                        <span style="display: none;"> {{ $formation->starting_date }} </span>{{ strftime("%a %d %B", strtotime($formation->starting_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->starting_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->starting_date)) }}</strong>
                        @endif
                        </td>
                        <td style="display: none;"> {{ $formation->diff }} </td> <!-- variable pour le tri des durées -->
                        <td @if ($formation->diff > 47) style="color:mediumvioletred;" @elseif ($formation->diff > 23) style="color:red;" @elseif ($formation->diff > 7) style="color:darkorange;" @elseif ($formation->diff > 3) style="color:orange;" @else style="color:green;" @endif width="7%">                                  
                        <strong>{{ $formation->duration }}</strong>
                        </td>
                        <td width="6%">@if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</td>
                        <td width="3%"> @if ($formation->nb_inscrits) <a id="buttonusr" data-toggle="modal" style="font-size: small;" title="Inscrits" data-target="#usr-{{ $formation->id }}" href="#users"><strong class="badge badge-grey hoverusrs">{{ $formation->nb_inscrits }}</strong></a> @endif
                        </td>
                        <td width="38%" style="font-size: x-small;">                
                        {{ $formation->titre }} @if ($formation->category) <span style="float: right;"><strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong></span> @endif
                        </td>
                        <td width="5%">
                            <a id="buttondt" data-toggle="modal" style="font-size: small;" data-target="#pend-{{ $formation->id }}" href="#details" title="Détails"><i class="material-icons color-info hoverdetails">visibility</i></a>
                            @if ($formation->multiname)
                            @php
                              $multiname = explode (',' , $formation->multiname);
                              $size = count ($multiname);
                            @endphp
                            &nbsp<a id="buttonmultidt" data-toggle="modal" style="font-size: small;" title="Formations inclues" data-target="#multi-{{ $formation->id }}" href="#multi"><i class="material-icons color-warning hoverdetails">@if ($size < 10) filter_{{ $size }} @else filter_9_plus @endif</i></a>
                            @endif
                        </td>
                        <!-- responsive colors for type-->
                        <td width="5%" @if ($formation->type == "salle") style="color:chocolate; text-align:center;" @else style="color:purple; text-align:center;" @endif>
                         {{ $formation->type }}
                        </td>
                        <td width="10%">
                         {{ $formation->lieu }}
                        </td>
                        <td>
                            <span>
                                @if ( $formation->multiname )<a href="#addmulti-{{ $formation->id }}" class="retrievemulti" id="rmulti-{{ $formation->id }}" data-toggle="modal" title="restaurer sous forme de multiformation"><i class="material-icons color-darkgreen hovergray multi modify_modal_trigger" transfer="{{ $formation->id }}">format_list_numbered</i></a> @endif
                                <a  href="/formation/retrieve/{{ $formation->id }}" class="retrieve" id="{{ $formation->id }}" data-toggle="tooltip" title="restaurer sous forme de modèle"><i class="material-icons color-info hovergray">restore</i></a>
                            </span>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@foreach ($formation_archives as $formation)
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
           {{ $key + 1 }} . {{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, {{ $usr->role }} de {{ $usr->ville }} ( {{ $usr->code_postal }} ) , s ' est @if ( $usr->civilite == 'Mme') inscrite @else inscrit @endif le {{ strftime("%a %d %B", strtotime($usr->created_at)) }} .
          @endforeach
          </div></strong>
        </div>
      </div>
    </div>
  </div>
</div>
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
        <h4 class="modal-title" id="exampleModalLabel"><strong>{{ $formation->titre }} @admin <span @if ($formation->type == "salle") style="color:chocolate;" @else style="color:purple;" @endif>[ {{ $formation->type }} ] </span><span @if ($formation->nb_inscrits < $formation->nb_max / 2) style="color:green;" @elseif ($formation->nb_inscrits < $formation->nb_max *.75) style="color:orange;" @elseif ($formation->nb_inscrits < $formation->nb_max) style="color:red;" @else style="color:grey;" @endif>( {{ $formation->nb_inscrits }} / {{ $formation->nb_max }} )</span> @endadmin @if ($formation->type == 'salle') &nbsp à &nbsp {{ $formation->lieu }} [ {{ $formation->postal }} ]@endif @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</strong> @if ($formation->category) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @endif</h4>
      </div>
      <div class="modal-body">
        <div class="panel lobipanel-basic panel-warning">
          <div class="panel-heading">
            Formations inclues dans la multiformation
          </div>
          <div class="panel-body" style="white-space: pre-line; font-size: small; width : 100%;">
            @foreach ($multiname as $key => $multi)
             {{ $key + 1 }} . <strong> {{ $multi }} </strong><span style="text-align:right; float:right"> Du {{ strftime("%a %d %B", strtotime($arraydatestart[$key])) }} à <strong>{{ $arraytimestart[$key] }}</strong> Au {{ strftime("%a %d %B", strtotime($arraydateend[$key])) }} à <strong> {{ $arraytimeend[$key] }} </strong></span><br />
             @foreach ($formation_archives as $form)
              @if ($multi == $form->titre)
                <span style="font-size: x-small"> {{ $form->details }} </span><br />
              @endif
             @endforeach
            @endforeach
          </div>
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
            <h4 class="modal-title" id="exampleModalLabel"><strong>{{ $formation->titre }} <span @if ($formation->type == "salle") style="color:chocolate;" @else style="color:purple;" @endif>[ {{ $formation->type }} ] </span> @if ($formation->type == 'salle') &nbsp à &nbsp {{ $formation->lieu }} [ {{ $formation->postal }} ]@endif @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</strong> @if ($formation->category) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}" data-toggle="tooltip" @if($formation->category->parent) title="{{$formation->category->parent}}" @else title="{{$formation->category->nom}}" @endif style="font-size: x-small">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}" data-toggle="tooltip" title="{{$formation->category->nom}}" style="font-size: x-small">{{$formation->category->soustag}}</strong> @endif</h4>
         </div>
         <div class="modal-body">
            <div class="panel lobipanel-basic panel-primary">
               <div class="panel-heading">
                  <div class="panel-title">Détails</div>
               </div>
               <div class="panel-body" style="white-space: pre-line; font-size: small;">{{ $formation->details }}</div>
            </div>
            @if ( !$formation->is_model )
            <div class="panel lobipanel-basic panel-warning">
               <div class="panel-heading">
                  <div class="panel-title">Horaires</div>
               </div>
               <div class="panel-body" style="white-space: pre-line;">du {{ strftime("%a %d %B", strtotime($formation->starting_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->starting_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->starting_date)) }}</strong> <br />au {{ strftime("%a %d %B", strtotime($formation->end_date)) }} <strong @if (intval(strftime("%H", strtotime($formation->end_date))) < 12) style="color: #ddaa00;" @else style="color: darkblue;" @endif>{{ strftime("%H:%M", strtotime($formation->end_date)) }}</strong></div>
            </div>
            @endif
            @if ($formation->type == 'salle') <div class="panel lobipanel-basic panel-success">
               <div class="panel-heading">
                  <div class="panel-title">Adresse Complète</div>
               </div>
               <div class="panel-body" style="white-space: pre-line; font-size: small;">{{ $formation->st }} à {{ $formation->lieu }} [ {{ $formation->postal }} ]</div>
            </div> @endif
           <div class="panel lobipanel-basic panel-danger">
               <div class="panel-heading">
                  <div class="panel-title">Informations Complémentaires</div>
               </div>
               <div class="panel-body" style="white-space: pre-line; font-size: small;">{{ $formation->infocomp }}</div>
            </div>
          </div>
      </div>
   </div>
</div>
<div class="modal fade refresh" id="addmulti-{{ $formation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left; font-size: small;" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><strong style="color: purple">Planifier une formation multiple </strong><br /><span style="font-size: x-small; color: red;">modifiez les champs qui ne conviennent pas à votre formation</span></h4>
      </div>
      <div class="modal-body">
        <div class="form-validation" style="display: block;">
          <form id="form-addmulti-{{ $formation->id }}" class="form-addmulti row justify-content-start" action="{{ route('formation.retrievestore') }}" method="POST">
            @csrf
            <fieldset>
              <input style="display:none;" value="{{ $formation->id }}" name="id" />
              <div class="form-group col-sm-6" style="font-size: small;">
                <div><br/><br /><br /></div>
                <div class="ordername" style="display: none;"></div>
              </div>
              <div class="form-group col-sm-2" style="font-size: small;">
                <div></div>
                <div class="ordertime" style="display: none;"></div>
              </div>
              <div class="form-group col-sm-4" style="font-size: small;">
                <div style="height: 4em;"></div>
                <div class="assign_date{{ $formation->id }}"></div>
              </div>  
              <input type="button" name="next" class="nextnew btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger uncheck" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <fieldset style="display:none;">
              <div style="color: purple; text-align: center;">Vérifiez que l' ordre et les informations rentrées sont corrects</div>
                <div style="height: 2em;"></div>
              <div class="form-group col-sm-6" style="font-size: small;">
                <div><br/><br /><br /></div>
                <div class="ordername2"></div>
                <div class="shadowinput"></div>
              </div>
              <div class="form-group col-sm-6" style="font-size: small;">
                <div><br/><br /><br /></div>
                <div class="ordertime2"></div>
              </div>
              <input type="button" name="next" class="nextnew btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <input type="button" name="previous" class="previousnew btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <fieldset style="display: none">
              <div class="form-group col-sm-2" style="font-size: small;">
                <label>Titre de la multi-formation<span class="text-danger"> *</span></label>
                <div style="height: 1.5em;"></div>
                <label>Type<span class="text-danger"> *</span></label>
                <div style="height: 1.8em;"></div>
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
                <div style="height: 6em;"></div>
                <label>Informations complémentaires<span class="text-danger"></span></label>
              </div>
              <div class="form-group col-sm-10">
                <input id="titre" type="text" name="titre" style="width:98%;" value="{{ $formation->titre }} - retrieved"></input>
                <div style="height: 1.8em;"></div>
                <div></div>
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
                <div style="height: 1.8em;"></div>
                <textarea id="infocomp" type="text" name="infocomp" rows="4" style="width:98%; font-size: x-small; white-space: pre-line;">{{ $formation->infocomp }}</textarea>
                <input id="id" type="number" name="id" value="{{ $formation->id }}" style="visibility: hidden;"></input>
              </div>
              <input type="button" name="next" class="nextnew btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <input type="button" name="previous" class="previousnew btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <fieldset style="display: none;">
              <div style="height: 1em;"></div>
              <div class="btn-group btn-group-toggle btn-block changecatmulti" id="changecatmulti" data-toggle="buttons" ><label class="btn btn-secondary-romain" style="width: 100%"><input type="checkbox" class="btn btn-secondary-romain" name="on" unchecked><strong style="color: darkred;">CHANGER LA CATEGORIE DE LA FORMATION @if ($formation->category) ({{$formation->category->parent}} {{$formation->category->nom}}) <strong class="badge badge-pill badge-{{$formation->category->tag_color}}">{{$formation->category->tag}}</strong> <strong class="badge badge-pill badge-{{$formation->category->soustag_color}}">{{$formation->category->soustag}}</strong> @endif</strong></label></div>
              <div style="display: none;" id="showcatmulti">
                <div style="height: 2em;"></div>
                <div class="col-sm-16">
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" id="colorassignmulti" type="button" data-toggle="dropdown" style="width: 100%;"><span id="byemulti">Choisir le nom de la catégorie parente</span><span id="selectedmulti"></span>
                    <span class="caret"></span></button>
                    <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                    <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                    @foreach ($formationcategories as $category)
                    @if (!($category->parent))
                    <label class="btn btn-secondary-romain catparentmulti" style="width: 100%;"><input type="radio" name="parent" autocomplete="off" value="{{$category->nom}}" colortomenu="btn btn-{{$category->tag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$category->tag_color}}">{{$category->tag}}</strong> {{$category->nom}}</input></label>
                    @endif
                    @endforeach
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              @foreach ($formationcategories as $category)
              <div class="col-sm-16"  style="display:none;" id="subcatmulti-{{$category->nom}}">
                <div style="height: 1em;"></div>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="subcolorassignmulti-{{$category->nom}}" type="button" data-toggle="dropdown" style="width: 100%;"><span class="subbyemulti">Choisir le nom de la sous-catégorie</span><span id="subselectedmulti-{{$category->nom}}"></span>
                  <span class="caret"></span></button>
                  <label class="dropdown-menu" style="margin: 0 auto; width: 100%;">
                  <label class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                  @foreach ($formationcategories as $subcategory)
                  @if ($subcategory->parent == $category->nom)
                  <label class="btn btn-secondary-romain clicksubcatmulti" style="width: 100%;" id="{{$category->nom}}"><input type="radio" name="catnom" autocomplete="off" value="{{$subcategory->nom}}" subcolortomenu="btn btn-{{$subcategory->soustag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$subcategory->soustag_color}}">{{$subcategory->soustag}}</strong> {{$subcategory->nom}}</input></label>
                  @endif
                  @endforeach
                  </label>
                  </label>
                </div>
              </div>
              @endforeach
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
                <input type="radio" class="presence_inactif_new" autocomplete="off" value="0" name="presence" @if (!($formation->presence)) checked @endif>quiz de validation de présence <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain @if ($formation->presence) active @endif" style="width: 50%;">
                <input type="radio" class="presence_actif_new" autocomplete="off" value="1" name="presence" @if ($formation->presence) checked @endif>quiz de validation de présence <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div class="presencesliderdivnew">
                <br />
                <input type="number" class="presenceslider_new" name="champs_presence" max="10" min="1" style="width:80%;"></input>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain @if (!($formation->acquis)) active @endif" style="width: 50%;" checked>
                <input type="radio" class="acquis_inactif_new" autocomplete="off" value="0" name="acquis" @if (!($formation->acquis)) checked @endif>quiz d' appréciation d' acquis <strong style="color: grey;">DESACTIVE</strong>
                </label>
                <label class="btn btn-secondary-romain @if ($formation->acquis) active @endif" style="width: 50%;">
                <input type="radio" class="acquis_actif_new" autocomplete="off" value="1" name="acquis" @if ($formation->acquis) checked @endif>quiz d' appréciation d' acquis <strong style="color: green;">ACTIF</strong>
                </label>
              </div>
              <div class="acquissliderdivnew">
                <br />
                <input type="number" class="acquisslider_new" name="champs_acquis" max="10" min="1" style="width:80%;"></input>
              </div>
              <br />
              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                <label class="btn btn-secondary-romain active" style="width: 50%;" checked>
                <input type="radio" class="formation-gratuite_new" autocomplete="off" name="payant" value="0"  checked>Formation <strong style="color: darkblue;">GRATUITE</strong>
                </label>
                <label class="btn btn-secondary-romain" style="width: 50%;">
                <input type="radio" class="formation-payante_new" autocomplete="off" name="payant" value="1" >Formation <strong style="color: purple;">PAYANTE</strong>
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
              <input type="submit" name="submit" id="submit" class="nextnew btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
              <input type="submit" name="submit" id="submit" class="nextnew btn btn-success continue"  style="float: right; margin-right: .5em; display: none;" value="Suivant"/>
              <input type="button" name="previous" class="previousnew btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <fieldset style="display: none;">
              <div id="quizz_presence_setup">
                Mise à jour de la formation multiple {{ $formation->titre }}...
              </div>
            </fieldset>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
@endforeach
@endsection
@section('js-content')

<script>

  var current_fs, next_fs, previous_fs;
  var currentmodify_fs, nextmodify_fs, previousmodify_fs;
  var currentnew_fs, nextnew_fs, previousnew_fs;
  var left, opacity, scale; 
  var animating;
  var transfer;
  var parentmodel;
  parentmodel = 0;
  var subcatmodel;
  var parentmodify;
  parentmodify = 0;
  var subcatmodify;
  var parentnew;
  parentnew = 0;
  var parentmulti;
  parentmulti = 0;
  var subcatnew;
  var subcatmulti; 
  var onechecked = 0;
  var loop = 0;
  var starttimearray = [];
  var endtimearray = [];
  var startdatearray = [];
  var enddatearray = [];
  var multiname = [];
  var pos = 0;

  $('#presencesliderdiv').hide();
  $('#acquissliderdiv').hide();
  $('.presencesliderdivmodify').hide();
  $('.acquissliderdivmodify').hide();
  $('.presencesliderdivnew').hide();
  $('.acquissliderdivnew').hide();

    moment.locale('fr'); // set local time

  $(".modify_modal_trigger").click(function(){
    transfer = $(this).attr('transfer');
    console.log(transfer);
  });

  $('.refresh').on('hidden.bs.modal', function () {
      location.reload();
    })

  // PLANIFIER UNE FORMATION MULTIPLE

 $(".retrievemulti").click(function(){
 	console.log('where are you?')
  $.multifunction = function(){
              // DECLARATION DE VARIABLE TAMPON ---------------------------------------------------------------------------------------------------------------------------------------------------

      console.log('coucou');
      var starttimearray2 = [];
      var endtimearray2 = [];
      var startdatearray2 = [];
      var enddatearray2 = [];
      var tmp = [];

              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // REQUETE AJAX ---------------------------------------------------------------------------------------------------------------------------------------------------------------------

      $.ajax({
         type : "GET",
         url: '/formation/multiretrieve/' + transfer,
         dataType: 'json',
         success: function(data){

              console.log(data);
			starttimearray = data[0];
			endtimearray = data[1];
			startdatearray = data[2];
			enddatearray = data[3];
			multiname = data[4];
             var i = -1;
             var multi = 0;
             var excess = 0;
             var multiname2 = [];

              // AFFICHAGE DES CLASSES HTML DYNAMIQUES --------------------------------------------------------------------------------------------------------------------------------------------
             $(".ordername").show();
             $(".ordertime").show();
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // DEBUT DE LA BOUCLE QUI GERE L AFFICHAGE DES FORMATIONS UNE PAR UNE ---------------------------------------------------------------------------------------------------------------
             i = -1;
             while (++i < multiname.length)
             {
              var endminarray = [];
              var startminarray = [];
              console.log('startdateaarray' + startdatearray);
              if(multiname[i])
              {
                console.log('startdateaarray' + startdatearray[i]);
                if (!loop)
                {
                  $(".ordername").append(multiname[i] + '<div style="height:3.8em"></div>');
                }
                console.log(startdatearray[i] + enddatearray[i] + starttimearray[i] + endtimearray[i])

               // AFFICHAGE DES DATES ET HEURES QUAND ON REVIENT EN ARRIERE DANS LE MULTISTEP -----------------------------------------------------------------------------------------------------
                if (startdatearray[i] != undefined && enddatearray[i] != undefined && starttimearray[i] != undefined && endtimearray[i] != undefined)
                {
                  var s = new Date(startdatearray[i]);
                  startminarray = starttimearray[i].split(":");
                  var d = s.getDate();
                  var m = s.getMonth();
                  var y = s.getFullYear();
                  console.log('d' + d);
                  console.log('m' + m);
                  console.log('y' + y);
                  var e = new Date(enddatearray[i]);
                  endminarray = endtimearray[i].split(":");
                  var ed = e.getDate();
                  var em = e.getMonth();
                  var ey = e.getFullYear();
                  console.log('ed' + ed);
                  console.log('em' + em);
                  console.log('ey' + ey);
                  m++;
                  em++;
                  if (m < 10 && em < 10)
                    if (d > 9)
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-0' + m + '-' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] + '" type="time" name="starting_time' + i + '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-0' + em + '-' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '" value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                    else
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-0' + m + '-0' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] + '" type="time" name="starting_time' + i + '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-0' + em + '-0' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '" value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                  else if (m < 10 && em > 9)
                    if (d > 9)
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-0' + m + '-' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] +  '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-' + em + '-' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                    else
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-0' + m + '-0' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] +  '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-' + em + '-0' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                  else if (m > 9 && em < 10)
                    if (d > 9)
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-' + m + '-' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] + '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-0' + em + '-' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                    else
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-' + m + '-0' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] + '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-0' + em + '-0' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                  else
                    if (d > 9)
                      $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-' + m + '-' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] +  '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-' + em + '-' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                      else
                        $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" value="' + y + '-' + m + '-0' + d + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" value="' + startminarray[0] + ':' + startminarray[1] +  '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" value="' + ey + '-' + em + '-0' + ed + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '"  value="' + endminarray[0] + ':' + endminarray[1] +  '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
                }
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // DATE ET HEURES NON REMPLIES ------------------------------------------------------------------------------------------------------------------------------------------------------
                else
                  $('.assign_date' + transfer).append('<span class="remove">de <input id="starting_date' + i + '" type="date" name="starting_date' + i + '" class="timechange" style="width:60%;" required></input><input id="starting_time' + i + '" type="time" name="starting_time' + i + '" class="timechange" style="width:26%;" required></input><br />à &nbsp&nbsp&nbsp<input id="end_date' + i + '" type="date" name="end_date' + i + '" class="timechange" style="width:60%;" required></input><input id="end_time' + i + '" type="time" name="end_time' + i + '" class="timechange" style="width:26%;" required></input><br /><br /></span>');
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // CAPTURE DES DONNES ENTREE DANS LES CHAMPS INJECTES PREALABLEMENT CI DESSUS -------------------------------------------------------------------------------------------------------
                $('#starting_date' + i).change(function(){
                 startdatearray[$(this).attr('id').slice(13)] = $(this).val();
                 console.log(startdatearray[$(this).attr('id').slice(13)]);
                 console.log(startdatearray);
                 console.log($(this).attr('id').slice(13));
                });
                $('#starting_time' + i).change(function(){
                  console.log('coucou');
                 starttimearray[$(this).attr('id').slice(13)] = $(this).val();
                 console.log(starttimearray[$(this).attr('id').slice(13)]);
                 console.log(starttimearray);
                 console.log($(this).attr('id').slice(13));
                });
                $('#end_date' + i).change(function(){
                 enddatearray[$(this).attr('id').slice(8)] = $(this).val();
                 console.log(enddatearray[$(this).attr('id').slice(8)]);
                 console.log(enddatearray);
                 console.log($(this).attr('id').slice(8));
                });
                $('#end_time' + i).change(function(){
                 endtimearray[$(this).attr('id').slice(8)] = $(this).val();
                 console.log(endtimearray[$(this).attr('id').slice(8)]);
                 console.log(endtimearray);
                 console.log($(this).attr('id').slice(8));
                });
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // ALERTES D ERREURES INSTANTANEES --------------------------------------------------------------------------------------------------------------------------------------------------
                var advdone = [];
                var oflowdone = [];
                var datedone = [];
                var dateunderflow =[];
                  $('#end_time' + i).change(function(){
                    if (startdatearray[$(this).attr('id').slice(8)] != undefined && enddatearray[$(this).attr('id').slice(8)] != undefined && starttimearray[$(this).attr('id').slice(8)] != undefined && endtimearray[$(this).attr('id').slice(8)] != undefined)
                    {
                      var y = moment(enddatearray[$(this).attr('id').slice(8)]).locale('fr');
                      var x = moment(startdatearray[$(this).attr('id').slice(8)]).locale('fr');
                      if (!datedone[$(this).attr('id').slice(8)] && x <= moment())
                      {
                        datedone[$(this).attr('id').slice(8)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: darkorange;" id="datedone' + $(this).attr('id').slice(8) + '">attention, la journée du ' + x.format('dddd DD MMM') + ' est en cours ou déjà passée<br /></span>');
                      }
                      if (datedone[$(this).attr('id').slice(8)] && x > moment())
                      {
                        datedone[$(this).attr('id').slice(8)] = 0;
                        $('#datedone' + $(this).attr('id').slice(8)).remove();
                      }
                      if (startdatearray[$(this).attr('id').slice(8)] == enddatearray[$(this).attr('id').slice(8)])
                      {
                        startminarray = starttimearray[$(this).attr('id').slice(8)].split(":");
                        endminarray = endtimearray[$(this).attr('id').slice(8)].split(":");
                          //       var date = new Date(Date.parse(startdatearray[$(this).attr('id').slice(8)]).format("dd/MM/yyyy"));
                        console.log(endminarray[0] - startminarray[0]);
                        if (endminarray[0] - startminarray[0] > 9 && !oflowdone[$(this).attr('id').slice(8)])
                        {
                          oflowdone[$(this).attr('id').slice(8)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: red;" id="oflow' + $(this).attr('id').slice(8) + '">attention, votre journée du ' + x.format('dddd DD MMM') + ' est surchargée<br /></span>');
                        }
                        else if (oflowdone[$(this).attr('id').slice(8)] && (endminarray[0] - startminarray[0] < 10))
                        {
                          $('#oflow' + $(this).attr('id').slice(8)).remove();
                          oflowdone[$(this).attr('id').slice(8)] = 0;
                        }
                        if (!dateunderflow[$(this).attr('id').slice(8)] && y < x)
                        {
                          dateunderflow[$(this).attr('id').slice(8)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(8) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(8)] + '<br /></span>');
                        }
                        if (!dateunderflow[$(this).attr('id').slice(8)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(8)] < starttimearray[$(this).attr('id').slice(8)])
                        {
                          dateunderflow[$(this).attr('id').slice(8)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(8) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(8)] + '<br /></span>');
                        }
                        if (dateunderflow[$(this).attr('id').slice(8)] && y > x)
                        {
                          dateunderflow[$(this).attr('id').slice(8)] = 0;
                          $('#dateunderflow' + $(this).attr('id').slice(8)).remove(); 
                        }
                        if (dateunderflow[$(this).attr('id').slice(8)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(8)] >= starttimearray[$(this).attr('id').slice(8)])
                        {
                          dateunderflow[$(this).attr('id').slice(8)] = 0;
                          $('#dateunderflow' + $(this).attr('id').slice(8)).remove(); 
                        }
                      }
                    }
                  });
                  $('#starting_date' + i).change(function(){
                    if (startdatearray[$(this).attr('id').slice(13)] != undefined && enddatearray[$(this).attr('id').slice(13)] != undefined && starttimearray[$(this).attr('id').slice(13)] != undefined && endtimearray[$(this).attr('id').slice(13)] != undefined)
                    {
                      var y = moment(enddatearray[$(this).attr('id').slice(13)]).locale('fr');
                      var x = moment(startdatearray[$(this).attr('id').slice(13)]).locale('fr');
                      if (!datedone[$(this).attr('id').slice(13)] && x <= moment())
                      {
                        datedone[$(this).attr('id').slice(13)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: darkorange;" id="datedone' + $(this).attr('id').slice(13) + '">attention, la journée du ' + x.format('dddd DD MMM') + ' est en cours ou déjà passée<br /></span>');
                      }
                      if (datedone[$(this).attr('id').slice(13)] && x > moment())
                      {
                        datedone[$(this).attr('id').slice(13)] = 0;
                        $('#datedone' + $(this).attr('id').slice(13)).remove();
                      }
                      if (!dateunderflow[$(this).attr('id').slice(13)] && y < x)
                      {
                        dateunderflow[$(this).attr('id').slice(13)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(13) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(13)] + '<br /></span>');
                      }
                      if (dateunderflow[$(this).attr('id').slice(13)] && y > x)
                      {
                        dateunderflow[$(this).attr('id').slice(13)] = 0;
                        $('#dateunderflow' + $(this).attr('id').slice(13)).remove(); 
                      }
                      if (!dateunderflow[$(this).attr('id').slice(13)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(13)] <= starttimearray[$(this).attr('id').slice(13)])
                      {
                        dateunderflow[$(this).attr('id').slice(13)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(13) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(13)] + '<br /></span>');
                      }
                      if (dateunderflow[$(this).attr('id').slice(13)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(13)] > starttimearray[$(this).attr('id').slice(13)])
                      {
                        dateunderflow[$(this).attr('id').slice(13)] = 0;
                        $('#dateunderflow' + $(this).attr('id').slice(13)).remove(); 
                      }
                    }
                  });
                  $('#end_date' + i).change(function(){
                    if (startdatearray[$(this).attr('id').slice(8)] != undefined && enddatearray[$(this).attr('id').slice(8)] != undefined && starttimearray[$(this).attr('id').slice(8)] != undefined && endtimearray[$(this).attr('id').slice(8)] != undefined)
                    {
                      var y = moment(enddatearray[$(this).attr('id').slice(8)]).locale('fr');
                      var x = moment(startdatearray[$(this).attr('id').slice(8)]).locale('fr');
                      console.log(x);
                      console.log(y);
                      if (!dateunderflow[$(this).attr('id').slice(8)] && y < x)
                      {
                        dateunderflow[$(this).attr('id').slice(8)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(8) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(8)] + '<br /></span>');
                      }
                      if (!dateunderflow[$(this).attr('id').slice(8)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(8)] <= starttimearray[$(this).attr('id').slice(8)])
                      {
                        dateunderflow[$(this).attr('id').slice(8)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(8) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(8)] + '<br /></span>');
                      }
                      if (dateunderflow[$(this).attr('id').slice(8)] && y > x)
                      {
                        dateunderflow[$(this).attr('id').slice(8)] = 0;
                        $('#dateunderflow' + $(this).attr('id').slice(8)).remove(); 
                      }
                      if (dateunderflow[$(this).attr('id').slice(8)] && moment(y).isSame(x) && endtimearray[$(this).attr('id').slice(8)] > starttimearray[$(this).attr('id').slice(8)])
                      {
                        dateunderflow[$(this).attr('id').slice(8)] = 0;
                        $('#dateunderflow' + $(this).attr('id').slice(8)).remove(); 
                      }
                    }
                  });
                  $('#starting_time' + i).change(function(){
                    console.log('coucou');
                    if (startdatearray[$(this).attr('id').slice(13)] != undefined && enddatearray[$(this).attr('id').slice(13)] != undefined && starttimearray[$(this).attr('id').slice(13)] != undefined && endtimearray[$(this).attr('id').slice(13)] != undefined && startdatearray[$(this).attr('id').slice(13)] == enddatearray[$(this).attr('id').slice(13)])
                    {
                      var x = moment(startdatearray[$(this).attr('id').slice(13)]).locale('fr');
                      var y = moment(startdatearray[$(this).attr('id').slice(13)]).locale('fr');
                      startminarray = starttimearray[$(this).attr('id').slice(13)].split(":");
                      endminarray = endtimearray[$(this).attr('id').slice(13)].split(":");
                       //       var date = new Date(Date.parse(startdatearray[$(this).attr('id').slice(8)]).format("dd/MM/yyyy"));
                      console.log(endminarray[0] - startminarray[0]);
                      if (!datedone[$(this).attr('id').slice(13)] && x <= moment())
                      {
                        datedone[$(this).attr('id').slice(13)] = 1;
                        $('.assign_date' + transfer).append('<span style="color: darkorange;" id="datedone' + $(this).attr('id').slice(13) + '">attention, la journée du ' + x.format('dddd DD MMM') + ' est en cours ou déjà passée<br /></span>');
                      }
                      if (datedone[$(this).attr('id').slice(13)] && x > moment())
                      {
                        datedone[$(this).attr('id').slice(13)] = 0;
                        $('#datedone' + $(this).attr('id').slice(13)).remove();
                      }
                      if (startdatearray[$(this).attr('id').slice(13)] == enddatearray[$(this).attr('id').slice(13)])
                      {
                        if (endminarray[0] - startminarray[0] > 9 && !oflowdone[$(this).attr('id').slice(13)])
                        {
                          oflowdone[$(this).attr('id').slice(13)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: red;" id="oflow' + $(this).attr('id').slice(13) + '">attention, votre journée du ' + x.format('dddd DD MMM') + ' est surchargée<br /></span>');
                        }
                        else if (oflowdone[$(this).attr('id').slice(13)] && (endminarray[0] - startminarray[0] < 10))
                        {
                          $('#oflow' + $(this).attr('id').slice(13)).remove();
                          oflowdone[$(this).attr('id').slice(13)] = 0;
                        }
                        if (!dateunderflow[$(this).attr('id').slice(13)] && y < x)
                        {
                          dateunderflow[$(this).attr('id').slice(13)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(13) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(13)] + '<br /></span>');
                        }
                        if (!dateunderflow[$(this).attr('id').slice(13)] && endtimearray[$(this).attr('id').slice(13)] < starttimearray[$(this).attr('id').slice(13)])
                        {
                          dateunderflow[$(this).attr('id').slice(13)] = 1;
                          $('.assign_date' + transfer).append('<span style="color: green;" id="dateunderflow' + $(this).attr('id').slice(13) + '">attention, vous selectionez une date de fin qui précède le  ' + x.format('dddd DD MMM') + ' ' + starttimearray[$(this).attr('id').slice(13)] + '<br /></span>');
                        }
                        if (dateunderflow[$(this).attr('id').slice(13)] && y > x)
                        {
                          dateunderflow[$(this).attr('id').slice(13)] = 0;
                          $('#dateunderflow' + $(this).attr('id').slice(13)).remove(); 
                        }
                        if (dateunderflow[$(this).attr('id').slice(13)] && endtimearray[$(this).attr('id').slice(13)] >= starttimearray[$(this).attr('id').slice(13)])
                        {
                          dateunderflow[$(this).attr('id').slice(13)] = 0;
                          $('#dateunderflow' + $(this).attr('id').slice(13)).remove(); 
                        }
                      }
                    }
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                  });
                  }
              // FIN DE LA BOUCLE -----------------------------------------------------------------------------------------------------------------------------------------------------------------
                }

              // TRI DES DONNEES CAPTUREES PAR DATE QUAND L UTILISATEUR CLIQUE SUR SUIVANT --------------------------------------------------------------------------------------------------------
                $(".nextnew").click(function(){
                 $(".remove").remove();
                 var x = -1;
                 var y = -1;
                 var tmp = 0;
                 var tmpvalue = 0;
              // STOCKAGE DES ARRAYS NON TRIEES DANS DES VARIABLES TAMPON -------------------------------------------------------------------------------------------------------------------------
                  starttimearray2 = starttimearray;
                  endtimearray2 = endtimearray;
                  startdatearray2 = startdatearray;
                  enddatearray2 = enddatearray;
                  multiname2 = multiname;
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                 while (++y < startdatearray.length)
                 {
                  while (++x < startdatearray.length)
                  {
                    console.log('in');
                    if (startdatearray[x])
                    {
                      console.log('inif');
                      if (startdatearray[tmp] > startdatearray[x])
                      {
                        tmpvalue = startdatearray2[tmp];
                        startdatearray2[tmp] = startdatearray2[x];
                        startdatearray2[x] = tmpvalue;

                        tmpvalue = enddatearray2[tmp];
                        enddatearray2[tmp] = enddatearray2[x];
                        enddatearray2[x] = tmpvalue;

                        tmpvalue = starttimearray2[tmp];
                        starttimearray2[tmp] = starttimearray2[x];
                        starttimearray2[x] = tmpvalue;

                        tmpvalue = endtimearray2[tmp];
                        endtimearray2[tmp] = endtimearray2[x];
                        endtimearray2[x] = tmpvalue;

                        tmpvalue = multiname2[tmp];
                        multiname2[tmp] = multiname2[x];
                        multiname2[x] = tmpvalue;
                        console.log('swap');
                      }
                      tmp = x;
                    }
                   }
                   tmp = 0;
                   x = -1;
                  }
                  multiname2 = multiname.filter(function(f){return f!==''});
                  enddatearray2 = enddatearray.filter(function(f){return f!==0});
                  endtimearray2 = endtimearray.filter(function(f){return f!==0});
                  startdatearray2 = startdatearray.filter(function(f){return f!==0});
                  starttimearray2 = starttimearray.filter(function(f){return f!==0});
                  console.log(starttimearray2);
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

              // AFFICHAGE TRIE DES DATES ET HEURES DES FORMATIONS --------------------------------------------------------------------------------------------------------------------------------
                  var z = -1;
                  while (++z < multiname2.length)
                  {
                    if (multiname2[z])
                    {
                   //   var startdate = new Date(startdatearray2[z]).toLocaleDateString();
                      var startdate = moment(startdatearray2[z]).locale('fr');
                      startdate = startdate.format('dddd DD MMMM YYYY');
                   //   var enddate = new Date(enddatearray2[z]).toLocaleDateString();
                      var enddate = moment(enddatearray2[z]).locale('fr');
                      enddate = enddate.format('dddd DD MMMM YYYY');
                      $(".ordername2").append('<span class="remove">' + (z + 1) + '. ' + multiname2[z] + '<div style="height:3em"></div></span>');
                      $(".ordertime2").append('<span class="remove">du ' + startdate + ' à ' + starttimearray2[z] + ' au ' + enddate + ' à ' + endtimearray2[z] + '<div style="height:3em"></div></span>');
                    }
                  }
              $(".shadowimput").remove();
              $(".shadowinput").append('<span style="display: none"><input type="string" name="multiname" value="' + multiname2 + '" /></span>');
              $(".shadowinput").append('<span style="display: none"><input type="string" name="startdatearray" value="' + startdatearray2 + '" /></span>');
              $(".shadowinput").append('<span style="display: none"><input type="string" name="starttimearray" value="' + starttimearray2 + '" /></span>');
              $(".shadowinput").append('<span style="display: none"><input type="string" name="enddatearray" value="' + enddatearray2 + '" /></span>');
              $(".shadowinput").append('<span style="display: none"><input type="string" name="endtimearray" value="' + endtimearray2 + '" /></span>');
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                });

              // CAPTURE ET ENREGISTREMENT DU CHANGEMENT DE POSITION DU MULTISTEP -----------------------------------------------------------------------------------------------------------------

                $(".previousnew").click(function(){
                  pos--;
                  console.log('pos:' + pos);
                  if (!pos)
                  {
                    console.log('pos:' + pos);
                    $(".remove").remove();
                    $.multifunction();
                  }
                });
                $(".nextnew").click(function(){
                  pos++;
                  console.log('pos:' + pos);
                });
                 console.log(multiname);
                 loop = 1;
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
         },
         error: function(data){
             console.log(data);
         },
              // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      });
 };
 console.log('loop' + loop);
 if (!loop)
  $.multifunction();
 });
 $(".uncheck").click(function(){
    $('input[name=catnom]').removeAttr('checked');
    $('input[name=parent]').removeAttr('checked');
    $('input[name=on]').removeAttr('checked');
  });

  $(".nextnew").click(function(){
    console.log('in')
  var form = $("#form-addnew-" + transfer);
  //validation
    console.log(form)
  //$.validator.messages.required = '';
    /*  form.validate({
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
             }); */
    /*        messages: {
               "titre": "Vous devez saisir le tribunal d'immatriculation !",
               "starting_date": "Vous devez saisir correctement le numéro RSAC !",
               "end_date": "Vous devez saisir la date d'immatriculation RSAC !",
               "nb_max": "Vous devez saisir l'organisme d'assurance !",
           }*/
  //if (form.valid() == true){
  if(animating) return false;
      animating = true;
  
  currentnew_fs = $(this).parent();
  nextnew_fs = $(this).parent().next();
  currentnew_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 1 - (1 - now) * 0.2;
          left = (now * 50)+"%";
          opacity = 1 - now;
          currentnew_fs.css({
      'transform': 'scale('+scale+')',
    });
          nextnew_fs.css({'left': left, 'opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentnew_fs.hide();
          animating = false;
          nextnew_fs.show(); 
      }, 
      easing: 'easeInOutBack'
  });
  });
  
  $(".previousnew").click(function(){
  if(animating) return false;
  animating = true;
  
  currentnew_fs = $(this).parent();
  previousnew_fs = $(this).parent().prev();
  previousnew_fs.show();
  currentnew_fs.hide();
  currentnew_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 0.8 + (1 - now) * 0.2;
          left = ((1-now) * 50)+"%";
          opacity = 1 - now;
          currentnew_fs.css({'left': left});
          previousnew_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentnew_fs.hide();
          animating = false;
      }, 
      seasing: 'easeInOutBack'
  });
  });

  $(".changecatmulti").click(function(){

    setTimeout(function(){
     if($('input[name=on]').is(":checked")) // check if the radio is checked
        $('#showcatmulti').show();
     else
     {
        $('input[name=catnom]').removeAttr('checked');
        $('input[name=parent]').removeAttr('checked');
        $('#showcatmulti').hide();
        $('input[name=on]').removeAttr('checked');
     }
    }, 50);
  });

  $(".catparentmulti").click(function(){
      $('#byemulti').hide();
    setTimeout(function(){
          if (parentmulti)
            $("#subcatmulti-" + parentmulti).hide();
          parentmulti = $('input[name=parent]:checked').val();
          $('#selectedmulti').html(parentmulti);
          $('#colorassignmulti').removeClass();
          $('#colorassignmulti').attr('class', $('input[name=parent]:checked').attr('colortomenu'));
          $("#subcatmulti-" + parentmulti).show();
    }, 100);
  });
  $(".clicksubcatmulti").click(function(){
      $('.subbyemulti').hide();
    setTimeout(function(){
          subcatmulti = $('input[name=catnom]:checked').val();
          $('#subselectedmulti-' + parentmulti).html(subcatmulti);
          $('#subcolorassignmulti-' + parentmulti).removeClass();
          $('#subcolorassignmulti-' + parentmulti).attr('class', $('input[name=catnom]:checked').attr('subcolortomenu'));
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
         $("#visiomodel") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent3').hide();
                 }
             });
         $("#sallemodel") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.sallecontent3').show();
                 }
             });
         $("#formation-payante_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixmodify').show();
                 }
             });
         $("#formation-gratuite_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.divprixmodify').hide();
                 }
             });
         $(".acquis_actif_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('.acquissliderdivnew').show();
                   $('.acquisslider_new').ionRangeSlider({
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
         $(".presence_actif_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                   $('.validating').hide();
                   $('.continue').show();
                   $('.presencesliderdivnew').show();
                   $('.presenceslider_new').ionRangeSlider({
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
         $(".presence_inactif_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('.presencesliderdivnew').hide();
                  if ( $(".acquis_inactif_new").is(":checked")) {
                    $('.validating').show();
                    $('.continue').hide();
                  }
                 }
             });
         $(".acquis_inactif_new") // select the radio by its id
             .change(function(){ // bind a function to the change event
                 if( $(this).is(":checked") ){ // check if the radio is checked
                  $('.acquissliderdivnew').hide();
                  if ( $(".presence_inactif_new").is(":checked")) {
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
            $('[data-toggle="button"]').tooltip()
            $('#models').dataTable({
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
            title: '@lang('Vraiment supprimer DEFINITIVEMENT toute trace de cette formation ?')',
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
                'Cette formation a bien été supprimé.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'Pas de stress, cette formation n\'a pas été supprimée',
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
        })
</script>

<script>
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

$('[data-toggle="modal"]').tooltip();
$('[data-toggle="tooltip"]').tooltip();
$('#formations').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
});

            $('a.retrieve').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
			})

        swalWithBootstrapButtons({
            title: '@lang('Vraiment récuperer cette formation ? (elle sera sous forme de modèle)')',
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
                'Cette formation n\'a pas été récuperée',
                'error'
                )
            }
        })
    })
</script>

@endsection