@extends('layouts.main.dashboard')
@section('header_name')
Gestion des catégories de Formations
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<?php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <a href="#addcat" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5" data-toggle="modal"><i class="ti-plus"></i>@lang('Créer une catégorie')</a>
      <a href="#add2cat" class="btn btn-pink btn-flat btn-addon m-b-10 m-l-5" data-toggle="modal"><i class="ti-plus"></i>@lang('Créer une sous-catégorie')</a>
      <a href="{{ route('formation.apply') }}" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5" style="float: right;" data-toggle="modal"><i class="ti-back-left"></i>@lang('Portail des formations')</a>
      <a href="{{ route('formation.plan') }}" class="btn btn-info btn-flat btn-addon m-b-10 m-l-5" style="float: right;" data-toggle="modal"><i class="ti-calendar"></i>@lang('Planifier une formation à partir d\'un modèle préconçu')</a>
      <div class="card-body">
        <div class="table-responsive" style="overflow-x: inherit !important;">
          <table  id="categories" class=" table student-data-table  m-t-20 "  style="width:100%;">
            <thead>
              <tr>
                <th>Type</th>
                <th>Nom de la catégorie</th>
                <th>Appartient à</th>
                <th>Code de réference</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="font-size: small;">
              @admin
              @foreach ($formationcategories as $category)
              <!-- si la formation n' a pas commencé -->
              <tr>
                <td>
                  @if ($category->parent)
                  <strong class="color badge badge-pill badge-pink">sous-catégorie</strong>
                  @else
                  <strong class="color badge badge-pill badge-success">catégorie</strong>
                  @endif
                </td>
                <td>                                   
                  {{ $category->nom }}
                </td>
                <td>
                  @if ($category->parent)
                    {{ $category->parent }}
                    <strong class="color badge badge-pill badge-{{ $category->tag_color }}">{{ $category->tag }}</strong>
                  @else
                    @lang('est une catégorie principale')
                  @endif
                </td>
                <td>
                  <strong class="badge badge-pill badge-{{$category->tag_color}}" data-toggle="tooltip" @if($category->parent) title="{{$category->parent}}" @else title="{{$category->nom}}" @endif style="font-size: x-small">{{$category->tag}}</strong>
                  <strong class="badge badge-pill badge-{{$category->soustag_color}}" data-toggle="tooltip" title="{{$category->nom}}" style="font-size: x-small">{{$category->soustag}}</strong>
                </td>
                <td>
                  <a data-toggle="modal" title="Modifier" href="#edit-{{ $category->id }}" class="modify_modal_trigger" transfer="#form-add-{{ $category->id }}">@if ($category->parent)<i class="material-icons color-pink hovergray">edit</i>@else<i class="material-icons color-success hovergray">edit</i>@endif</a>
                  <a  href="/formation/category/delete/{{ $category->id }}" class="delete" id="{{ $category->id }}" data-toggle="tooltip" title="Supprimer la catégorie"><i class="material-icons color-danger hovergray">delete</i></a>
                </td>
              </tr>
              @endforeach
              @endadmin
              @formateur
              @foreach ($formationcategories as $category)
              <!-- si la formation n' a pas commencé -->
              <tr>
                <td>
                  @if ($category->parent)
                  <strong class="color badge badge-pill badge-pink">sous-catégorie</strong>
                  @else
                  <strong class="color badge badge-pill badge-success">catégorie</strong>
                  @endif
                </td>
                <td>                                   
                  {{ $category->nom }}
                </td>
                <td>
                  @if ($category->parent)
                    {{ $category->parent }}
                    <strong class="color badge badge-pill badge-{{ $category->tag_color }}">{{ $category->tag }}</strong>
                  @else
                    @lang('est une catégorie principale')
                  @endif
                </td>
                <td>
                  <strong class="badge badge-pill badge-{{$category->tag_color}}" data-toggle="tooltip" @if($category->parent) title="{{$category->parent}}" @else title="{{$category->nom}}" @endif style="font-size: x-small">{{$category->tag}}</strong>
                  <strong class="badge badge-pill badge-{{$category->soustag_color}}" data-toggle="tooltip" title="{{$category->nom}}" style="font-size: x-small">{{$category->soustag}}</strong>
                </td>
                <td>
                  @if (Auth::user()->id === $category->maker_id)
                  <a data-toggle="modal" title="Modifier" href="#edit-{{ $category->id }}" class="modify_modal_trigger" transfer="#form-add-{{ $category->id }}">@if ($category->parent)<i class="material-icons color-pink hovergray">edit</i>@else<i class="material-icons color-success hovergray">edit</i>@endif</a>
                  <a  href="/formation/category/delete/{{ $category->id }}" class="delete" id="{{ $category->id }}" data-toggle="tooltip" title="Supprimer la catégorie"><i class="material-icons color-danger hovergray">delete</i></a>
                  @endif
                </td>
              </tr>
              @endforeach
              @endformateur
            </tbody>
          </table>
          @foreach ($formationcategories as $category)
          @if (!($category->parent))
          <div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left; font-size: small;" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><strong style="color: darkgreen;">Modifier la catégorie</strong> &nbsp {{ $category->nom }}</h4>
                </div>
                <div class="modal-body">
                  <div class="form-validation" style="display: block;">
                    <form id="form-add-{{ $category->id }}" class="row justify-content-start" action="{{ route('formation.catupdate') }}" method="POST">
                      @csrf
                      <fieldset>
                        <div class="form-group col-sm-2" style="font-size: small;">
                          <label>Nom<span class="text-danger">*</span></label>
                          <div style="height: 1.35em;"></div>
                          <label>Code de réference à 3 ou moins caractère(s)<span class="text-danger">*</span></label>
                          <div style="height: 1.35em;"></div>
                        </div>
                        <div class="form-group col-sm-10">
                          <input id="nomedit" type="text" name="nomedit" style="width:95%;" value="{{ $category->nom }}" required></input><br /><br />
                          <input id="tagedit" type="text" name="tagedit" style="width:95%; text-transform: uppercase;" maxlength="3" value="{{ $category->tag }}" required></input><br /><br />
                        </div>
                      <input id="id" type="number" name="id" value="{{ $category->id }}" style="visibility: hidden;"></input>
                      <input type="submit" name="submit" id="submit" class="nextmodify btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
                      </fieldset>
                      <fieldset style="display: none;">
                        <div id="quizz_presence_setup">
                          Mise à jour de la catégorie {{ $category->nom }}...
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
            @else
            <div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left; font-size: small;" data-backdrop="static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><strong style="color: violet;">Modifier la sous-catégorie</strong> &nbsp {{ $category->nom }}</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-validation" style="display: block;">
                      <form id="form-add-{{ $category->id }}" class="row justify-content-start" action="{{ route('formation.catupdate') }}" method="POST">
                        @csrf
                      <fieldset>
                        <div class="form-group col-sm-2" style="font-size: small;">
                          <label>Nom de la catégorie parente<span class="text-danger">*</span></label>
                          <div style="height: 1.35em;"></div>
                        </div>
                        <div class="form-group col-sm-10">
                          <input id="parent" type="text" name="parentedit" style="width:95%;" value="{{ $category->parent }}" required></input><br /><br />
                        </div>
                        <input type="button" name="next" class="nextmodify btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
                      </fieldset>
                      <fieldset style="display: none;">
                        <div class="form-group col-sm-2" style="font-size: small;">
                          <label>Nom<span class="text-danger">*</span></label>
                          <div style="height: 1.35em;"></div>
                          <label>Code de réference à 3 ou moins caractère(s)<span class="text-danger">*</span></label>
                          <div style="height: 1.35em;"></div>
                        </div>
                        <div class="form-group col-sm-10">
                          <input id="nomedit" type="text" name="nomedit" style="width:95%;" value="{{ $category->nom }}" required></input><br /><br />
                          <input id="soustagedit" type="text" name="soustagedit" style="width:95%; text-transform: uppercase;" maxlength="3" value="{{ $category->soustag }}" required></input><br /><br />
                        </div>
                        <input id="id" type="number" name="id" value="{{ $category->id }}" style="visibility: hidden;"></input>
                        <input type="submit" name="submit" id="submit" class="nextmodify btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
                        <input type="button" name="previous" class="previousmodify btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
                      </fieldset>
                      <fieldset style="display: none;">
                        <div id="quizz_presence_setup">
                          Mise à jour de la catégorie {{ $category->nom }}...
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
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left;" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center; color: green;"><strong>Ajouter une catégorie</strong></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-16" style="text-align: center;">
          <ul  id="progressbar">
            <li class="active">Nom et code de réference</li>
            <li>Couleur de filiation</li>
            <li>Envoi des données</li>
          </ul>
        </div>
        <div class="form-validation" style="display: block">
          <form class="form-add row justify-content-start" id="prevententer" action="{{ route('formation.catstore') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <fieldset>
              <div class="form-group col-sm-2" style="font-size: small;">
                <label>Nom<span class="text-danger">*</span></label>
                <div style="height: 1.35em;"></div>
                <label>Code de réference à 3 ou moins caractère(s)<span class="text-danger">*</span></label>
                <div style="height: 1.35em;"></div>
              </div>
              <div class="form-group col-sm-10">
                <input id="nom" type="text" name="nom" style="width:95%;" placeholder="Nom de la catégorie" required></input><br /><br />
                <input id="tag" type="text" name="tag" style="width:95%; text-transform: uppercase;" maxlength="3" placeholder="Ce code sera utilisé pour identifier cette catégorie" required></input><br /><br />
              </div>
              <input type="button" name="next" class="next btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <!--              <fieldset style="display: none;">
              </fieldset> -->
            <fieldset style="display: none;">
              <div style="text-align: center; font-size: large; color: darkred; ">Affilier un badge de couleur à la catégorie</div>
              <div style="height: 3em;"></div>
              <div id="append">
              </div>
              <div style="height: 2em;"></div>
              <input type="submit" name="submit" id="submit" class="next btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
              <input type="button" name="previous" class="previous btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <fieldset style="display: none;">
              <div id="quizz_presence_setup">
                Catégorie en cours de création...
              </div>
            </fieldset>
            <!--                            </fieldset> --> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="add2cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: left;" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center; color: darkblue;"><strong>Ajouter une sous-catégorie</strong></h4>
      </div>
      <div class="modal-body">
        <div class="col-md-16" style="text-align: center;">
          <ul  id="progressbar">
            <li class="active">Nom et code de réference</li>
            <li>Couleur de filiation</li>
            <li>Envoi des données</li>
          </ul>
        </div>
        <div class="form-validation" style="display: block">
          <form class="form-subadd row justify-content-start" id="prevententer" action="{{ route('formation.catstore') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <fieldset>
              <div class="form-group col-sm-2" style="font-size: small;">
                <label>Nom du parent<span class="text-danger">*</span></label>
                <div style="height: 3.3em;"></div>
                <label>Nom de la sous-catégorie<span class="text-danger">*</span></label>
                <div style="height: 1.35em;"></div>
                <label>Code a 3 lettres de la sous-catégorie<span class="text-danger">*</span></label>
                <div style="height: 1.35em;"></div>
              </div>
              <div class="form-group col-sm-10">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" id="colorassign" type="button" data-toggle="dropdown" style="width: 95%;"><span id="bye">Choisir le nom de la catégorie parente</span><span id="selected"></span>
                  <span class="caret"></span></button>
                  <div class="dropdown-menu" style="margin: 0 auto; width: 95%;">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%;">
                      @foreach ($formationcategories as $category)
                      @if (!($category->parent))
                      <label class="btn btn-secondary-romain catparent" style="width: 100%;"><input type="radio" name="parent" autocomplete="off" value="{{$category->nom}}" colortomenu="btn btn-{{$category->tag_color}} dropdown-toggle"><strong class="badge badge-pill badge-{{$category->tag_color}}">{{$category->tag}}</strong> {{$category->nom}}</input></label>
                      @endif
                      @endforeach
                    </div>
                  </div>
                </div>
                <br /><br />
                <input id="nomsub" type="text" name="nom" style="width:95%;" placeholder="Nom de la sous-catégorie" required></input><br /><br />
                <input id="soustagsub" type="text" name="soustag" style="width:95%; text-transform: uppercase;" maxlength="3" placeholder="Ce code sera utilisé pour identifier cette catégorie" required></input><br /><br />
              </div>
              <input type="button" name="next" class="nextsub btn btn-success" value="Suivant" style="float: right; margin-right: .5em;" />
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; margin-right: .8em;" >Fermer</button>
            </fieldset>
            <!--              <fieldset style="display: none;">
              </fieldset> -->
            <fieldset style="display: none;">
              <div style="text-align: center; font-size: large; color: darkred; ">Affilier un badge de couleur à la catégorie</div>
              <div style="height: 3em;"></div>
              <div id="appendsub">
              </div>
              <div style="height: 2em;"></div>
              <input type="submit" name="submit" id="submit" class="nextsub btn btn-primary validating"  style="float: right; margin-right: .5em;" value="Valider"/>
              <input type="button" name="previous" class="previoussub btn btn-success" value="Précedent" style="float: right; margin-right: 1em;"/>
            </fieldset>
            <fieldset style="display: none;">
              <div id="quizz_presence_setup">
                Sous-catégorie en cours de création...
              </div>
            </fieldset>
            <!--                            </fieldset> --> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js-content')
<script>
  var current_fs, next_fs, previous_fs;
  var currentsub_fs, nextsub_fs, previoussub_fs;
  var currentmodify_fs, nextmodify_fs, previousmodify_fs;
  var left, opacity, scale; 
  var animating;
  var tag;
  var soustag;
  var transfer;

   $(".hovergray").hover(function(){
      $(this).css("color", "gray");
    }, function(){
      $(this).css("color", "");
      });
  $(".catparent").click(function(){
      $("#bye").hide();
    setTimeout(function(){
          var sel = $('input[name=parent]:checked').val();
          $("#selected").html(sel);
          $("#colorassign").removeClass();
          $("#colorassign").attr('class', $('input[name=parent]:checked').attr('colortomenu'));
    }, 100);
  });
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
  console.log(tag);
 if ($('input[name=tag]').val() != tag)
  {
    tag = $('input[name=tag]').val();
    $('#remove').remove();
    $('#append').append('<div id="remove" class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%; text-transform: uppercase;"><label class="btn btn-secondary-romain active" style="width: 18%;" checked><input type="radio" autocomplete="off" value="primary" name="tag_color" checked><strong class="color badge badge-pill badge-primary"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="success" name="tag_color"><strong class="color badge badge-pill badge-success"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="danger" name="tag_color"><strong class="color badge badge-pill badge-danger"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="warning" name="tag_color"><strong class="color badge badge-pill badge-warning"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="dark" name="tag_color"><strong class="color badge badge-pill badge-dark"></strong></label><label class="btn btn-secondary-romain" style="width: 18%;" checked><input type="radio" autocomplete="off" value="pink" name="tag_color"><strong class="color badge badge-pill badge-pink"></strong></label></div>');
    $('.color').html(tag);
  }
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

  $(".nextsub").click(function(){
  
  //validation
  var form = $(".form-subadd");
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
  
  currentsub_fs = $(this).parent();
  nextsub_fs = $(this).parent().next();
  $("#progressbar li").eq($("fieldset").index(nextsub_fs)).addClass("active");
  currentsub_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 1 - (1 - now) * 0.2;
          left = (now * 50)+"%";
          opacity = 1 - now;
          currentsub_fs.css({
      'transform': 'scale('+scale+')',
    });
          nextsub_fs.css({'left': left, 'opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentsub_fs.hide();
          animating = false;
          nextsub_fs.show(); 
      }, 
      easing: 'easeInOutBack'
  });
 if ($('input[name=soustag]').val() != soustag)
  {
    console.log('coucou');
    soustag = $('input[name=soustag]').val();
    $('#removesub').remove();
    $('#appendsub').append('<div id="removesub" class="btn-group btn-group-toggle" data-toggle="buttons" style="display: table; margin: 0 auto; width: 100%; text-transform: uppercase;"><label class="btn btn-secondary-romain active" style="width: 18%;" checked><input type="radio" autocomplete="off" value="primary" name="soustag_color" checked><strong class="colorsub badge badge-pill badge-primary"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="success" name="soustag_color"><strong class="colorsub badge badge-pill badge-success"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="danger" name="soustag_color"><strong class="colorsub badge badge-pill badge-danger"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="warning" name="soustag_color"><strong class="colorsub badge badge-pill badge-warning"></strong></label><label class="btn btn-secondary-romain" style="width: 16%;" checked><input type="radio" autocomplete="off" value="dark" name="soustag_color"><strong class="colorsub badge badge-pill badge-dark"></strong></label><label class="btn btn-secondary-romain" style="width: 18%;" checked><input type="radio" autocomplete="off" value="pink" name="soustag_color"><strong class="colorsub badge badge-pill badge-pink"></strong></label></div>');
    $('.colorsub').html(soustag);
  }
  }
  });
  
  $(".previoussub").click(function(){
  if(animating) return false;
  animating = true;
  
  currentsub_fs = $(this).parent();
  previoussub_fs = $(this).parent().prev();
  $("#progressbar li").eq($("fieldset").index(currentsub_fs)).removeClass("active");
  previoussub_fs.show();
  currentsub_fs.hide();
  currentsub_fs.animate({opacity: 0}, {
      step: function(now, mx) {
          scale = 0.8 + (1 - now) * 0.2;
          left = ((1-now) * 50)+"%";
          opacity = 1 - now;
          currentsub_fs.css({'left': left});
          previoussub_fs.css({'transform': 'scale('+scale+')','opacity': opacity});
      }, 
      duration: 400, 
      complete: function(){
          currentsub_fs.hide();
          animating = false;
      }, 
      seasing: 'easeInOutBack'
  });
  });

  $(".modify_modal_trigger").click(function(){
    transfer = $(this).attr('transfer');
    console.log(transfer);
  });
  $(".nextmodify").click(function(){
    //validation
  var form = $(transfer);
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
  
  $(document).ready(function() {
             $('#categories').dataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                            }
              });

          $('[data-toggle="tooltip"]').tooltip();
          $('[data-toggle="modal"]').tooltip();

          $('a.delete').click(function(e) {
               let that = $(this)
               e.preventDefault()
               const swalWithBootstrapButtons = swal.mixin({
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
  })
  
       swalWithBootstrapButtons({
           title: '@lang('Vraiment supprimer cette catégorie définitivement ?')',
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
               'Cette catégorie a bien été supprimé.',
               'success'
               )
               
               
           } else if (
               // Read more about handling dismissals
               result.dismiss === swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons(
               'Annulé',
               'Pas de stress, cette catégorie n\'a pas été supprimée',
               'error'
               )
           }
       })
           })
  });
</script>
@endsection