/*
*@author : Belkacem
*@controller: FacturationController
*@description : formulaire d'ajout d'une facture
*/
@extends('layouts.main.dashboard')
@section('header_name')
    Ajouter des factures
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide2 form-horizontal" id="msform" enctype="multipart/form-data" action="{{route('facture.store')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                        <a type="button" href="{{route('facture')}}" class="btn btn-dark btn-flat btn-addon"><i class="ti-arrow-left"></i>Retour au listing des factures</a>
                     <div class="panel lobipanel-basic panel-danger">
                        <div class="panel-heading">
                           <div class="panel-title">Ajouter une facture</div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="dest">Type du destinataire <span class="text-danger">*</span></label>
                              <div class="col-lg-4">
                                 <select class="js-select2 form-control" id="dest" name="dest" required>
                                    <option value="Agent Stylimmo">Agent Styl'immo</option>
                                    <option value="Contact partenaire">Contact partenaire</option>
                                    <option value="Autre">Autre</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row" id="op1">
                              <label class="col-sm-4 control-label" for="user">Choisir l'agent du réseau<span class="text-danger">*</span></label>
                              <div class="col-lg-8">
                                 <select class="selectpicker col-lg-6" id="user" name="user" data-live-search="true" data-style="btn-primary btn-rounded" >
                                    @foreach($user as $dr)
                                    <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->prenom}} {{$dr->email}}">{{$dr->nom}} {{$dr->prenom}}</option>
                                    @endforeach                                
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row" id="op2">
                              <label class="col-sm-4 control-label" for="partner">Choisir le contact partenaire <span class="text-danger">*</span></label>
                              <div class="col-lg-8">
                                 <select class="selectpicker col-lg-6" id="partner" name="partner" data-live-search="true" data-style="btn-dark btn-rounded" >
                                    @foreach($partner as $dr)
                                    <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->prenom}} {{$dr->email}}">{{$dr->nom}} {{$dr->prenom}}</option>
                                    @endforeach                                
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="bool-mail">Envoi par email<span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="checkbox" unchecked data-toggle="toggle" id="bool-mail" name="bool-mail" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                              </div>
                           </div>
                           <div id="op3">
                           </div>
                           <div class="col-lg-10" id="products">
                              <div class="panel panel-pink m-t-15">
                                 <div class="panel-heading"><strong>Produits et montants</strong></div>
                                 <div class="panel-body">
                                    <button class="btn btn-warning add_field_button">Ajouter</button>  
                                    <div class="input_fields_wrap">
                                       <div class="col-lg-6">
                                          <div class="card p-0">
                                             <div class="media">
                                                <div class="p-20 media-body">
                                                   <h4 class="color-primary">Produit 1</h4>
                                                   <br>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="nbr1">Quantité <span class="text-danger">*</span></label>
                                                      <div class="col-lg-4">
                                                         <input type="number" id="nbr1" class="form-control" min="1" value="1" name="nbr1" required>
                                                      </div>
                                                   </div>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="describe1">Description <span class="text-danger">*</span></label>
                                                      <div class="col-lg-8">
                                                         <input type="text" id="describe1" class="form-control" name="describe1" placeholder="Ex: Pack 200 cartes de visite" required>
                                                      </div>
                                                   </div>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="val1">Prix unitaire H.T (€)<span class="text-danger">*</span></label>
                                                      <div class="col-lg-4">
                                                         <input type="number" id="val1" class="form-control" min="0" value="0" step="0.01" name="val1" required>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <a class="btn btn-danger disabled" style="margin-bottom: 20px;">Supprimer</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row" style="text-align: center; margin-top: 50px;">
                              <div class="col-lg-8 ml-auto">
                                 <button class="btn btn-primary btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-plus"></i>Ajouter</button>
                              </div>
                           </div>
                        </div>
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
   $(document).ready(function() {
       $('#op1').show();
       $('#op2').hide();
       $('#op3').hide();
       $('#dest').change(function(){
           if($('#dest').val() === 'Agent Stylimmo'){
               $('#op1').show();
               $('#op2').hide();
               $('#op3').html('');
               $('#op3').hide();
           }
           if($('#dest').val() === 'Contact partenaire'){
               $('#op1').hide();
               $('#op2').show();
               $('#op3').html('');
               $('#op3').hide();
           }
           if($('#dest').val() === 'Autre'){
               $('#op1').hide();
               $('#op2').hide();
               $('#op3').html('<div class="form-group row"> <label class="col-sm-4 control-label" for="name">Nom <span class="text-danger">*</span></label> <div class="col-sm-3"> <input class="form-control" type="text" id="name" name="name" placeholder="Ex: SARL Nexitic..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="addr">Adresse <span class="text-danger">*</span></label> <div class="col-lg-5"> <input type="text" id="addr" class="form-control" name="addr" placeholder="Ex: 25 Rue Carnot..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="zip">Code postal<span class="text-danger">*</span></label> <div class="col-lg-3"> <input type="number" id="zip" class="form-control" name="zip" placeholder="Ex: 75008..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="ville">Ville <span class="text-danger">*</span></label> <div class="col-lg-3"> <input type="text" id="ville" class="form-control" name="ville" placeholder="Ex: Paris..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="mail">Email pour l\'envoi de la facture <span class="text-danger">*</span></label> <div class="col-lg-4"> <input type="text" id="mail" class="form-control" name="mail" placeholder="Ex: dest@gmail.fr..." required> </div></div>');
               $('#op3').show();
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
               $(wrapper).append('<div class="col-lg-6"> <div class="card p-0"> <div class="media"> <div class="p-20 media-body"> <h4 class="color-primary">Produit '+x+'</h4> <br> <div class="form-group row"> <label class="col-sm-4 control-label" for="nbr'+x+'">Quantité <span class="text-danger">*</span></label> <div class="col-lg-4"> <input type="number" id="nbr'+x+'" class="form-control" name="nbr'+x+'" value="1" min"1" required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="describe'+x+'">Description <span class="text-danger">*</span></label> <div class="col-lg-8"> <input type="text" id="describe'+x+'" class="form-control" name="describe'+x+'" placeholder="Ex: Pack 200 cartes de visite" required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="val'+x+'">Prix unitaire H.T (€)<span class="text-danger">*</span></label> <div class="col-lg-4"> <input type="number" id="val'+x+'" class="form-control" value="0" min="0" step="0.01" name="val'+x+'" required> </div></div></div></div><button class="btn btn-danger remove_field_button" style="margin-bottom: 20px;">Supprimer</button> </div></div>'); //add input box
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
<!--ajax post-->
<script>
   $('.submit').click(function(e){ 
       e.preventDefault();
       $(".form-valide2").validate({
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
                 }
             });
       if($(".form-valide2").valid() == true){
       var mailbool = $('#bool-mail').is(':unchecked') ? "off" : "on";
       var prod = $('#products input').serialize();
       if ($('#dest').val() === "Agent Stylimmo"){
           var ajaxData = {
               dest: $('#dest').val(), user: $('#user').val(), mail: mailbool, produit: prod
           };
       }
       if ($('#dest').val() === "Contact partenaire"){
           var ajaxData = {
               dest: $('#dest').val(), partner: $('#partner').val(), mail: mailbool, produit: prod
           };
       }
       if ($('#dest').val() === "Autre"){
           var ajaxData = {
               dest: $('#dest').val(), name: $('#name').val(), addr: $('#addr').val(), zip: $('#zip').val(), 
               ville: $('#ville').val(),email: $('#mail').val(), mail: mailbool, 
               produit: prod
           };
       }
       $.ajax({
           type: "POST",
           url: ("{{ route('facture.store') }}"),
           beforeSend: function(xhr, type) {
               if (!type.crossDomain) {
                   xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
               }
           },
           data: ajaxData,
           success: function(data){  
            swal(
                   'Ajouté',
                   'La facture est ajouté avec succées!',
                   'success'
               )
               .then(function(){
                   window.location.href = "{{route('facture')}}";
               })
           },
           error: function(data){
               swal(
                   'Echec',
                   'La facture n\'a pas été ajoutée!',
                   'error'
               );
           }
       });
   }
   });
</script>
@endsection