@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
<div class="row">
<div class="col-lg-12">
   <div class="card">
      <div class="card-body">
         <div class="col-md-10 col-md-offset-1">
            <div class="panel lobipanel-basic panel-warning">
               <div class="panel-heading">
                  <div class="panel-title">Complément d'informations du mandataire</div>
               </div>
               <div class="panel-body"> 
                  L'annexe lié à votre contrat sera généré après validation de ces informations, vous pouvez en suite procéder à la signature définitive de votre contrat et commencer à exercer.
               </div>
            </div>
         </div>
         <div class="form-validation">
         <form class="form-valide2 form-horizontal" id="msform" enctype="multipart/form-data" action="{{route('contrat.annex5', Auth::user()->id)}}" method="POST">
               {{ csrf_field() }}
               <!-- progressbar -->
               <div class="col-md-12 col-md-offset-2">
                  <ul  id="progressbar">
                     <li class="active">Informations d'immatriculation</li>
                     <li>Pieces justificatives</li>
                  </ul>
                  </div
                  <!-- fieldsets -->
                  <fieldset>
                     <div class="col-lg-12">
                        <div class="panel lobipanel-basic panel-pink">
                           <div class="panel-heading">
                              <div class="panel-title">Informations d'immatriculation</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-gref">Tribunal d'immatriculation <span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" type="text" id="val-gref" name="val-gref" placeholder="Ex: Paris" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-rsac">Numéro d'immatriculation RSAC <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-rsac" name="val-rsac" placeholder="Ex: 78FT95862SD" required>  
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-date">Date d'immatriculation <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="date" id="val-date" class="form-control" name="val-date" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-care">Organisme d'assurance professionnelle <span class="text-danger">*</span></label>
                                 <div class="col-lg-6">
                                    <input type="text" id="val-care" class="form-control" name="val-care" placeholder="Ex: MMA" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-4 control-label" for="val-num">Numéro d'assurance <span class="text-danger">*</span></label>
                                 <div class="col-lg-3">
                                    <input type="text" class="form-control" id="val-num" name="val-num" placeholder="Ex: 799879878R5F545654" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="button" name="next" class="next action-button" value="Suivant" />
                  </fieldset>
                  <fieldset>
                     <div class="col-lg-12">
                        <div class="panel lobipanel-basic panel-info">
                           <div class="panel-heading">
                              <div class="panel-title">Pieces justificatives</div>
                           </div>
                           <div class="panel-body">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="file1">Attestation d'immatriculation RSAC<span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="file1" name="file1" type="file"  required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="file2">Attestation d'assurance<span class="text-danger">*</span></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" id="file2" name="file2" type="file"  required>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="button" name="previous" class="previous action-button" value="Précedent" />
                     <input type="submit" name="submit" id="submit" class="next action-button" value="Valider">
                  </fieldset>
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
   var left, opacity, scale; 
   var animating; 
   
   $(".next").click(function(){
   
   //validation
   var form = $(".form-valide2");
       form.validate({
               errorClass: "invalid-feedback animated fadeInDown",
               errorElement: "div",
               errorPlacement: function(e, a) {
                   jQuery(a).parents(".form-group > div").append(e)
               },
               highlight: function(e) {
                   jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
               },
               success: function(e) {
                   jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
               },
           rules: {
               "val-gref": {
                       required: !0
               },
               "val-rsac": {
                       required: !0
               },
               "val-date": {
                       required: !0
               },
               "val-care": {
                       required: !0
               },
               "val-num": {
                       required: !0
               },
               "file1": {
                    required: true,
                    extension: "pdf|jpeg|png"
               },
               "file2": {
                    required: true,
                    extension: "pdf|jpeg|png"
               }
           },
           messages: {
               "val-gref": "Vous devez saisir le tribunal d'immatriculation !",
               "val-rsac": "Vous devez saisir correctement le numéro RSAC !",
               "val-date": "Vous devez saisir la date d'immatriculation RSAC !",
               "val-care": "Vous devez saisir l'organisme d'assurance !",
               "val-num": "Vous devez saisir correctement le numéro d'assurance !",
               "file1": "Le fichier n'est pas valide !",
               "file2": "Le fichier n'est pas valide !"
           }
       });
       
   if (form.valid() == true){
   if(animating) return false;
       animating = true;
   
   current_fs = $(this).parent();
   next_fs = $(this).parent().next();
   $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
   next_fs.show(); 
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
       duration: 0, 
       complete: function(){
           current_fs.hide();
           animating = false;
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
       duration: 0, 
       complete: function(){
           current_fs.hide();
           animating = false;
       }, 
       seasing: 'easeInOutBack'
   });
   });
</script>
@endsection