@extends('layouts.main.dashboard')
@section('header_name')
Paramètres suivi d'affaire
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      @endforeach
   </ul>
</div>
@endif
<!--modal-->
<div class="modal fade" id="doclist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Liste des documents</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="panel lobipanel-basic panel-pink">
               <div class="panel-heading">
                  <div class="panel-title">Liste des documents juridiques</div>
               </div>
               <div class="panel-body">
                  <div class="table-responsive" style="overflow-x: inherit !important;">
                     <table  id="lstdoc" class=" table student-data-table  m-t-20 ">
                        <thead>
                           <tr>
                              <th>@lang('Intitulé du document')</th>
                              <th>@lang('Déstinataire')</th>
                              <th>@lang('Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                        @if($stack != NULL)
                        @foreach($stack as $key=>$el)
                           <tr>
                              <td>{{$el[0]}}</td>
                              <td><span class="badge badge-info">{{$el[1]}}</span></td>
                              <td><a type="button" href="{{Route('params.affaire.removedoc', $key)}}" class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-trash"></i>Supprimer</a></td>
                           </tr>
                        @endforeach
                        @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="docadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter des documents</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-validation">
               <form class="form-valide89 form-horizontal">
                  @csrf
                  <button class="btn btn-warning add_field_button">Ajouter une ligne</button>
                  <br>
                  <div class="input_fields_wrap">
                     <div class="form-inline field">
                        <div class="form-group col-lg-6">
                           <label for="title">Intitulé du document: </label>
                           <input class="form-control" type="text" id="title" name="title" required>
                        </div>
                        <div class="form-group col-lg-6">
                           <label for="role">Destinataire: </label>
                           <select class="js-select2 form-control" id="role" name="role" required>
                              <option ></option>
                              <option value="document-commun">Document commun</option>
                              <option value="acquéreur">Acquéreurs</option>
                              <option value="mandant">Mandants</option>
                              <option value="bien">Biens</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-primary push">valider</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--modal-->
<div class="panel lobipanel-basic panel-danger">
   <div class="panel-heading">
      <div class="panel-title">Documents juridiques</div>
   </div>
   <div class="panel-body">
      Vous pouvez ici definir les documents possible à réunir aupres des mandants et des acquéreurs ainsi que les justificatifs pour les biens, cette meme liste servira
      au mandataire et leurs permettera de choisir les document aduéquats en fonction de la situation de chaque partie pendant la gestion d'affaire, si un doublon est detecté il sera ignoré.
      <br><br>
      <a type="button"  data-toggle="modal" data-target="#docadd" class="btn btn-primary btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>Ajouter des document</a>
      <a type="button"  data-toggle="modal" data-target="#doclist" class="btn btn-pink btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-list"></i>Liste des documents</a>
   </div>
</div>
<div class="panel lobipanel-basic panel-primary">
   <div class="panel-heading">
      <div class="panel-title">Autres paramètres pour affaires</div>
   </div>
   <div class="panel-body">
      <div class="form-validation">
         <form class="form-valide2 form-horizontal" id="msform" enctype="multipart/form-data" action="{{route('params.affaire.other')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
               <label class="col-sm-4 control-label"  for="percent_partner">Pourcentage du mandataire partenaire<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="number" id="percent_partner" class="form-control" min="0" max="50" value="{{$params->pourcentage_partenaire}}" step="0.01" name="percent_partner" required>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="max_offre">Maximum d'offres par dossier<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="number" id="max_offre" class="form-control" min="1" value="{{$params->max_offre}}" step="1" name="max_offre" required>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="notif_mdn">Si une offre ajoutée notifier le mandant ?<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="checkbox" @if($params->notif_mandant == 0) unchecked @else checked @endif data-toggle="toggle" id="notif_mdn" name="notif_mdn" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="notif_acq">Si une offre est acceptée notifier l'acquéreur ?<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="checkbox" @if($params->notif_acquereur == 0) unchecked @else checked @endif data-toggle="toggle" id="notif_acq" name="notif_acq" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="archive_bn">Archiver automatiquement le bien après une vente ?<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="checkbox" @if($params->archive_bien == 0) unchecked @else checked @endif data-toggle="toggle" id="archive_bn" name="archive_bn" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="archive_mdn">Archiver automatiquement le mandant après une vente ?<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="checkbox" @if($params->archive_mandant == 0) unchecked @else checked @endif data-toggle="toggle" id="archive_mdn" name="archive_mdn" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="archive_acq">Archiver automatiquement l'acquéreur après une vente ?<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="checkbox" @if($params->archive_acquereur == 0) unchecked @else checked @endif data-toggle="toggle" id="archive_acq" name="archive_acq" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-4 control-label" for="max_notaire">Durée maximum en jours de l'accès aux documents pour les notaires<span class="text-danger">*</span></label>
               <div class="col-lg-2">
                  <input type="number" id="max_notaire" class="form-control" min="1" value="{{$params->max_jour_notaire}}" step="1" name="max_notaire" required>
               </div>
            </div>
            <div class="form-group row" style="text-align: center; margin-top: 50px;">
               <div class="col-lg-8 ml-auto">
                  <button class="btn btn-primary btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-save"></i>Enregistrer</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('js-content')
<script>
   $(document).ready(function() {
       $('#lstdoc').DataTable( {
           "language": {
           "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
           }
       });
   }); 
</script>
<script>
   $(document).ready(function() {
       var x = 2;
       var max_fields      = 15;
       var wrapper         = $(".input_fields_wrap");
       var add_button      = $(".add_field_button");
       $(add_button).click(function(e){
           e.preventDefault();
           if(x < max_fields){
               $(wrapper).append('<div class="form-inline field'+x+'"> <div class="form-group col-lg-6"> <label for="title'+x+'">Intitulé du document: </label> <input class="form-control" type="text" id="title'+x+'" name="title'+x+'" required> </div><div class="form-group col-lg-6"> <label for="role'+x+'">Destinataire: </label> <select class="js-select2 form-control" id="role'+x+'" name="role'+x+'" required> <option ></option> <option value="document-commun">Document commun</option> <option value="acquéreur">Acquéreurs</option> <option value="mandant">Mandants</option> <option value="bien">Biens</option> </select> </div></div>'); //add input box
               x++;
           }  
       });
       
       $(wrapper).on("click",".remove_field_button", function(e){ 
           e.preventDefault(); 
           $(this).parent('div').remove();
           if (x > 2)
               x -= 1;
       })
    });
    
</script>

<!--ajax push data-->
<script>
 $('.push').click(function(e){
         e.preventDefault();
         var form = $(".form-valide89");
      if (form.valid() === true){
        var level = $('.input_fields_wrap select, .input_fields_wrap input').serialize();
        $('#docadd').modal('toggle');
          $.ajax({
              type: "POST",
              url: ("{{Route('params.affaire.doc')}}"),
              beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
                },
              data: {
                  list_doc: level
                  },
              success: function(data){
                swal(
                'Effectué',
                'Les documents ont été ajoutés',
                'success'
                )
                .then(function(){
                    window.location.href = "{{route('params.affaire.index')}}";
                })
              },
              error: function(data){
                console.log(data);
                swal(
                'Echec',
                'Une erreur est survenue vérifiez votre saisie.',
                'error'
                );
              }
          });
      }
   });
</script>

@endsection