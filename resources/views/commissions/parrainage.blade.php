/*
*@author : Belkacem
*@Controller: ParrainageController
*@description : formulaire d'ajout d'un model de parrainage
*/

@extends('layouts.main.dashboard')
@section('header_name')
    Modification de l' étalonnage des commissions par parainage
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@if (session('ok'))
<div class="alert alert-success alert-dismissible fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong> {{ session('ok') }}</strong>
</div>
@endif
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="col-lg-10">
            <div class="panel panel-info m-t-15">
               <div class="panel-heading"><strong>Models de rémunération indirecte</strong></div>
               <div class="panel-body">
                  Ici vous pouvez créer des models de rémunération indirecte pour les mandataires du réseau en tant que parrains, 
                  pour un gain de temps et de productivité, vous pouvez prédefinir des models réutilisables que vous pouvez appliquer à plusieurs mandataire, ou tout simplement créer un model de rémunération unique par utilisateur.
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide3" action="{{ route('parrainage.add') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group row">
                     <div class="col-lg-4">
                        <label class="col-lg-3 col-form-label" for="plan-name">Nom du plan <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" id="plan-name" name="plan-name" placeholder="Nom..." required>
                     </div>
                  </div>
                  <div class="form-group row" id="max-starter-parrent">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="max-forfait">Prime forfitaire si le parrain est à 100% (€)<span class="text-danger">*</span></label>
                           <input type="number"  class="form-control"  id="max-forfait" name="max-forfait" min="1" value="200" required>
                        </div>
                    </div>
                    <div class="form-group row" id="yr00">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="annee1">Pourcentage de la premiere année<span class="text-danger">*</span></label>
                           <input type="number"  class="form-control"  id="annee1" name="annee1" min="0" max="100" step="0.10" value="5" required>
                        </div>
                    </div>
                  <div class="form-group row" id="max-starter-parrent">
                        <div class="col-lg-4">
                           <label class="col-lg-8 col-form-label" for="nb-years">Nombre d'années<span class="text-danger">*</span></label>
                           <input type="number"  class="form-control"  id="nb-years" name="nb-years" min="1" max="48" value="4" readonly>
                        </div>
                    </div>

                  <div class="col-lg-11" id="palier">
                     <div class="panel panel-pink m-t-15">
                        <div class="panel-heading"><strong>Rémunération par année</strong></div>
                        <div class="panel-body">
                           <div class="input_fields_wrap">
                              <div class="form-inline field1">
                                 <div class="form-group">
                                    <label for="year1">Année </label>
                                    <input class="form-control" type="text" value="1" id="year1" name="year1" readonly>
                                 </div>
                                 <div class="form-group">
                                    <label for="min-percent1">Pourcentage minimum(%) </label>
                                    <input class="form-control" type="number" min="0" max="100" step="0.10" value="2.5" id="min-percent1" name="min-percent1" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="max-percent1">Pourcentage maximum(%) </label>
                                    <input class="form-control" type="number" min="0" max="100" step="0.10" value="5" id="max-percent1" name="max-percent1" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="chiffre1">Chiffre d'affaire requis pour maximum (€)</label>
                                    <input class="form-control" type="number" min="0" value="27500" id="chiffre1" name="chiffre1" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row" style="text-align: center; margin-top: 50px;">
                     <div class="col-lg-8 ml-auto">
                        <button class="btn btn-primary btn-flat btn-addon btn-lg m-b-10 m-l-5 submit"><i class="ti-plus"></i>Ajouter</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('js-content')
<!--paliers-->
<script>
   var x = 2;
   
   $(document).ready(function() {
    

    var max_fields      = parseInt($('#nb-years').val()); //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        
        while(x <= max_fields){ //max input box allowed
            if(x < max_fields)
                $(wrapper).append('<div class = "form-inline field'+x+'"><div class="form-group"><label for="year'+x+'">Année </label> <input class="form-control" type="text" value="'+x+'" id="year'+x+'" name="year'+x+'"/ readonly></div> <div class="form-group"><label for="min-percent'+x+'">Pourcentage minimum(%) </label> <input class="form-control" type="number" step="0.10" min="0" max="100" value="2.5" id="min-percent'+x+'" name="min-percent'+x+'" required> </div> <div class="form-group"><label for="max-percent'+x+'">Pourcentage maximum(%)</label> <input class="form-control" type="number" min="0" max="100" step="0.10" value="5" id="max-percent'+x+'" name="max-percent'+x+'" required></div> <div class="form-group"><label for="chiffre'+x+'">Chiffre d\'affaire requis pour maximum (€)</label> <input class="form-control" type="number" min="0" value="27500" id="chiffre'+x+'" name="chiffre'+x+'" required></div></br></div>');
            if(x == max_fields)
            $(wrapper).append('</br></br><strong>Au dela de l\'année '+x+'</br></br></strong><div class = "form-inline field'+x+'"><div class="form-group"><label for="year'+x+'">Année </label> <input class="form-control" type="text" value="'+x+'" id="year'+x+'" name="year'+x+'"/ readonly></div> <div class="form-group"><label for="min-percent'+x+'">Pourcentage(%) </label> <input class="form-control" type="number" step="0.10" min="0" max="100" value="2.5" id="min-percent'+x+'" name="min-percent'+x+'" required> </div></br></div>');
        x++;
        } 
    
   });   
</script>
<!--validate-->
<script>
   $('.submit').click(function(e){ 
         e.preventDefault();
         var form = $(".form-valide3");
          form.validate({
              errorClass: "invalid-feedback animated fadeInDown",
              errorElement: "div",
              errorPlacement: function(e, a) {
                  jQuery(a).parents(".form-group > div").append(e)
              },
              highlight: function(e) {
                  jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid");
              },
              success: function(e) {
                  jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove();
              },
              rules: {
              "plan-name": {
                  required: !0
              },
              "nb-years": {
                  required: !0
              }
          },
          messages: {
              "plan-name": "Veuillez saisir un nom !",
              "nb-years": "Veuillez choisir une valeure !"
          }
      });
      if (form.valid() == true){
        var level = $('#palier input').serialize();
        var name = $('#plan-name').val();

        $.ajax({
            type: "POST",
            url: ("{{ route('parrainage.add') }}"),
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
            data: {
                  planname: $('#plan-name').val(), maxforfait: $('#max-forfait').val(),
                  annee1: $('#annee1').val(), nbyears: $('#nb-years').val(), palierdata: level
            },
            success: function(data){
                swal(
                'Ajouté',
                'Le model '+name+' est ajouté avec succées!',
                'success'
                )
                .then(function(){
                    window.location.href = "{{route('commissions')}}";
                })
              },
              error: function(data){
                swal(
                'Echec',
                'Le model '+name+' n\'a pas été ajouté!',
                'danger'
                );
              }
        });
      }
   });
</script>
@endsection