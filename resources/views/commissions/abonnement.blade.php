/*
*@author : Belkacem
@controller: Abonnement
*@description : formulaire d'ajout d'une modele d'abonnement
*/

@extends('layouts.main.dashboard')
@section('header_name')
    Ajout d' un model d' abonnement pour mendataires
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
            <div class="panel panel-danger m-t-15">
               <div class="panel-heading"><strong>Models pour tarifs d'abonnement mandataires</strong></div>
               <div class="panel-body">
                  Ici vous pouvez ajouter des pack d'abonnement individuels que vous pouvez ratacher directement à tous les packs d'un meme type soit starter
                 ou expert, un abonnement comprend un tarif mensuel, un nombre d'annonces et un nom ainsi que le type de pack auquel il est attaché.
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide3" action="{{ route('abonnement.add') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group row">
                        <div class="col-lg-4">
                           <label class="col-lg-5 col-form-label" for="pack">Rataché à un type de pack<span class="text-danger">*</span></label>
                           <div class="col-sm-4">
                                <select class="js-select2 form-control" id="pack" name="pack" style="width: 100%;" data-placeholder="Choose one.." required>
                                  <option></option>
                                        <option value="Starter">Starter</option>
                                        <option value="Expert">Expert</option>
                                </select>
                        </div>
                        </div>
                     </div>
                  <div class="form-group row">
                     <div class="col-lg-4">
                        <label class="col-lg-3 col-form-label" for="plan-name">Nom de l'abonnement<span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" id="plan-name" name="plan-name" placeholder="Nom..." required>
                     </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-4">
                       <label class="col-lg-8 col-form-label" for="price">Tarifs mensuel (€)<span class="text-danger">*</span></label>
                       <input type="number"  class="form-control"  id="price" name="price" min="0" value="7" required>
                    </div>
                 </div>
                  <div class="form-group row">
                    <div class="col-lg-4">
                       <label class="col-lg-8 col-form-label" for="annonces">Nombre d'annonces<span class="text-danger">*</span></label>
                       <input type="number"  class="form-control"  id="annonces" name="annonces" min="0" value="7" required>
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
             "pack": {
                 required: !0
             },
             "plan-name": {
                 required: !0
             }
         },
         messages: {
             "pack": "Veillez choisir un type !",
             "plan-name": "Veillez saisir un nom !"
         }
     });
     $('.pack').on("select2:close", function (e) {  
        $(this).valid(); 
    });
     if (form.valid() == true){
         form.submit();
     }
  });
</script>
@endsection