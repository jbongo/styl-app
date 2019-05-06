@extends('layouts.main.dashboard')
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
            <div class="panel panel-danger m-t-15">
               <div class="panel-heading"><strong>Modification d'un model de rémunération directe</strong></div>
               <div class="panel-body">
                  Si vous voulez modifier les paliers et le pourcentage de départ vous devez les reinitialiser, Le nouveau système de palier prendra effet et remplacera les informations déja enregistrées.
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide3" action="{{ route('contrat.starter.update', $model->id) }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <div class="col-lg-6">
                       <label class="col-lg-8 col-form-label" for="reset">Reinitialiser les palier et le pourcentage de départ<span class="text-danger">*</span></label>
                       <input type="checkbox" unchecked data-toggle="toggle" id="reset" name="reset" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                    </div>
                 </div>

                  <div class="form-group row">
                     <div class="col-lg-4">
                        <label class="col-lg-3 col-form-label" for="plan-name">Nom du plan <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" id="plan-name" name="plan-name" value="{{$model->nom}}" readonly>
                     </div>
                  </div>
                  <div class="form-group row" id="toto">
                     <div class="col-lg-10">
                        <div class="card alert nestable-cart">
                           <div class="card-header">
                              <h5>Pourcentage de départ du mandataire</h5>
                           </div>
                           <div class="rangeslider">
                              <div>
                                 <input type="text" id="range_01" value="{{$model->pourcentage_depart}}" name="range_01" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row" id="toto2">
                     <div class="col-lg-4">
                        <label class="col-lg-8 col-form-label" for="check-palier">Paliers<span class="text-danger">*</span></label>
                        <input type="checkbox" unchecked data-toggle="toggle" id="check-palier" name="check-palier" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                     </div>
                  </div>
                  <div class="col-lg-11" id="palier">
                     <div class="panel panel-pink m-t-15">
                        <div class="panel-heading"><strong>Paliers</strong></div>
                        <div class="panel-body">
                           <div class="input_fields_wrap">
                              <button class="btn btn-warning add_field_button" style="margin-left: 53px;">Ajouter un niveau</button>
                              <div class="form-inline field1">
                                 <div class="form-group">
                                    <label for="level1">Niveau: </label>
                                    <input class="form-control" type="text" value="1" id="level1" name="level1" readonly>
                                 </div>
                                 <div class="form-group">
                                    <label for="percent1">Pourcentage en plus (%): </label>
                                    <input class="form-control" type="number" min="0" max="0" step="0.10" value="0" id="percent1" name="percent1" readonly>
                                 </div>
                                 <div class="form-group">
                                    <label for="min1">Chiffre d'affaire minimum (€): </label>
                                    <input class="form-control" type="number" value="0" id="min1" name="min1" readonly>
                                 </div>
                                 <div class="form-group">
                                    <label for="max1">Chiffre d'affaire maximum (€): </label> 
                                    <input class="form-control" type="number" min="0" value="50000" id="max1" name="max1"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row" id="max-starter-parrent">
                     <div class="col-lg-4">
                        <label class="col-lg-8 col-form-label" for="max-starter">Durée maximum du pack Starter (mois)<span class="text-danger">*</span></label>
                     <input type="number"  class="form-control"  id="max-starter" name="max-starter" min="1" max="48" value="{{$model->duration_starter}}" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-lg-4">
                        <label class="col-lg-8 col-form-label" for="free-duration">Durée de la gratuitée (mois)<span class="text-danger">*</span></label>
                     <input type="number"  class="form-control"  id="free-duration" name="free-duration" min="0" max="48" value="{{$model->duration_gratuitee}}" required>
                     </div>
                  </div>
                  <div class="form-group row" style="text-align: center; margin-top: 50px;">
                     <div class="col-lg-8 ml-auto">
                        <button class="btn btn-primary btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-pencil"></i>Modifier</button>
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
<!--slider range-->
<script>
$(document).ready(function() {
    $('#palier').hide();
    $('#toto').hide();
    $('#toto2').hide();
    $('#reset').change(function(e){
        e.preventDefault();
        $('#reset').is(':unchecked') ? $('#toto').hide() : $('#toto').show();
        $('#reset').is(':unchecked') ? $('#toto2').hide() : $('#toto2').show();
    });
    $('#check-palier').change(function(e){
        e.preventDefault();
        $('#check-palier').is(':unchecked') ? $('#palier').hide() : $('#palier').show();
    });    
});
</script>

<script>
   $(function () {
   "use strict";
   
   $("#range_01").ionRangeSlider({
       grid: true,
       min: 50,
       max: 100,
       from: {{$model->pourcentage_depart}},
       step: 0.1,
       prefix: "%",
       disable: false
   });
   var slider = $("#range_01").data("ionRangeSlider");
   $('#check-palier').change(function(e){
        e.preventDefault();
        slider.update({
            grid: true,
            min: 50,
            max: 100,
            step: 0.1,
            prefix: "%",
            disable: true
        });
    });   
});
</script>
<!--enable palier-->

<!--paliers-->
<script>
   var x = 1;
   $(document).ready(function() {
   var max_fields      = 15;
   var wrapper         = $(".input_fields_wrap");
   var add_button      = $(".add_field_button"); 
   $(add_button).click(function(e){
       e.preventDefault();      
       if(x < max_fields){
           var min_chiffre = parseInt($("#max"+x+'').change().val()) + 1;
           var percent_diff = ((95 * 10) - (parseFloat($("#range_01").change().val() * 10))) / 10;
           var i = 1;           
           while (i <= x)
           {
               let tmp = parseFloat($("#percent"+i+'').change().val() * 10) / 10;
               percent_diff = (percent_diff * 10 - tmp * 10) / 10;
               i++;
           }
           if(x > 1 && percent_diff > 0) 
                $("#pal"+x+'').hide();
           if(percent_diff > 0)
                x++;
           if(percent_diff < 0)
            {
                percent_diff = 0;
        
            }
            var val_chiffre = parseInt(min_chiffre) + 19999;
            if (percent_diff > 5)
                $(wrapper).append('<div class = "form-inline field'+x+'"><div class="form-group"><label for="level'+x+'">Niveau: </label> <input class="form-control" type="text" value="'+x+'" id="level'+x+'" name="level'+x+'"/ readonly></div> <div class="form-group"><label for="percent'+x+'">Pourcentage en plus (%): </label> <input class="form-control" type="number" step="0.10" min="0" max="'+percent_diff+'" value="'+percent_diff+'" id="percent'+x+'" name="percent'+x+'"/> </div> <div class="form-group"><label for="min'+x+'">Chiffre d\'affaire minimum (€): </label> <input class="form-control" type="number" value="'+min_chiffre+'" id="min'+x+'" name="min'+x+'" readonly></div> <div class="form-group"><label for="max'+x+'">Chiffre d\'affaire maximum (€): </label> <input class="form-control" type="number" min="'+min_chiffre+'" value="'+val_chiffre+'" id="max'+x+'" name="max'+x+'"/></div>  <button href="#" id="pal'+x+'" class="btn btn-danger remove_field">Enlever</button></br></div>'); //add input box
            else if(percent_diff <= 5 && percent_diff > 0)
                $(wrapper).append('<div class = "form-inline field'+x+'"><div class="form-group"><label for="level'+x+'">Niveau: </label> <input class="form-control" type="text" value="'+x+'" id="level'+x+'" name="level'+x+'"/ readonly></div> <div class="form-group"><label for="percent'+x+'">Pourcentage en plus (%): </label> <input class="form-control" type="number" step="0.10" min="0" max="'+percent_diff+'" value="'+percent_diff+'" id="percent'+x+'" name="percent'+x+'"/> </div> <div class="form-group"><label for="min'+x+'">Chiffre d\'affaire minimum (€): </label> <input class="form-control" type="number" value="'+min_chiffre+'" id="min'+x+'" name="min'+x+'" readonly></div> <div class="form-group"><label for="max'+x+'">Chiffre d\'affaire maximum (€): </label> <input class="form-control" type="number" min="'+min_chiffre+'" value="'+val_chiffre+'" id="max'+x+'" name="max'+x+'"/></div>  <button href="#" id="pal'+x+'" class="btn btn-danger remove_field">Enlever</button></br></div>'); //add input box
            else
            {
                swal(
                'Ajout impossible!',
                'Le maximum de 95% en pourcentage est atteint, vous ne pouvez pas ajouter d\'avantages de paliers!',
                'error'
                );
            }
       }  
   });
   
   $(wrapper).on("click",".remove_field", function(e){ 
       e.preventDefault(); 
       if(x > 2) $("#pal"+(x-1)+'').show();
       $(this).parent('div').remove(); 
       x--;
   })
});
</script>
<!--validate and ajax push-->
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
              ".plan-name": {
                   required: !0
              }
          },
          messages: {
              ".plan-name": "Veillez saisir un nom !"
          }
      });
      $('.plan-type').on("select2:close", function (e) {  
        $(this).valid(); 
    });
      if (form.valid() === true){
        var check = $('#check-palier').is(':unchecked') ? "off" : "on";
        var reset = $('#reset').is(':unchecked') ? "off" : "on";
        var level = $('#palier input').serialize();
        var planname = $('#plan-name').val();
          $.ajax({
              type: "POST",
              url: ("{{ route('contrat.starter.update', $model->id)}}"),
              beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
                },
              data: {
                  resetpalier: reset, planname: $('#plan-name').val(), range01: $('#range_01').val(),
                  checkpalier: check, palierdata: level,
                  maxstarter: $('#max-starter').val(), freeduration: $('#free-duration').val()
                  },
              success: function(data){
                console.log(data);
                swal(
                'Modifié',
                'Le model '+planname+' est modifié avec succées!',
                'success'
                )
                .then(function(){
                    window.location.href = "{{route('contrat.index')}}";
                })
              },
              error: function(data){
                console.log(data);
                swal(
                'Echec',
                'Le model '+planname+' n\'a pas été modifié!',
                'danger'
                );
              }
          });
      }
   });
</script>
@endsection