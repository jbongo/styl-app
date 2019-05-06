/*
*@author : Belkacem
*@controller: NotaireController
*@description : formulaire d'ajout d'une étude de notaires
*/
@extends('layouts.main.dashboard')
@section('header_name')
    Assigner une étude de notaire(s)
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="modal fade" id="pend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Verifier la présence d'une étude.</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-validation">
               <form class="form-valide89 form-horizontal">
                  <div class="form-group row" id="op1">
                     <label class="col-sm-4 control-label" for="user">Verifier la présence<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <select class="selectpicker col-lg-8" id="user" name="user" data-live-search="true" data-style="btn-pink btn-rounded" >
                           <option></option>
                           @foreach($not as $dr)
                           <option  value="{{$dr->id}}" data-content="<img class='avatar-img' src='http://127.0.0.1:8000/images/photo_profile/user.png' alt=''><span class='user-avatar'> Nom: {{$dr->nom}} email: {{$dr->email}} Téléphone: {{$dr->telephone}}</span>" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->telephone}} {{$dr->code_postal}}"></option>
                           @endforeach                                
                        </select>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="panel lobipanel-basic panel-danger">
               <div class="panel-heading">
                  <div class="panel-title">Verification de présence.</div>
               </div>
               <div class="panel-body">
                  Assurez-vous de la non présence du notaire ou du cabinet dans la base, il se peut que le notaire soit déja ajouté par un autre agent, vous pouvez utiliser ce champs de recherche pour verifier soit par code postal, nom, email et numéro de téléphone. 
                  <br><br>
                  <a type="button" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5 pay2" data-toggle="modal" data-target="#pend"><i class="ti-settings"></i>Verification</a>
               </div>
            </div>
            <div class="form-validation">
               <form class="form-valide2 form-horizontal" id="msform" enctype="multipart/form-data" action="{{route('notaire.store')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                     <div class="panel lobipanel-basic panel-info">
                        <div class="panel-heading">
                           <div class="panel-title">AJOUTER UNE ETUDE</div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="role">Type de l'étude <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <select class="js-select2 form-control" id="role" name="role" required>
                                    <option value="autre">Autre</option>
                                    <option value="scp">Societé civile professionnelle (SCP)</option>
                                    <option value="sel">Societé d'exercice libérale (SEL)</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="nom">Nom ou raison sociale <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="text" id="nom" class="form-control" name="nom" placeholder="Ex: SCP Dupond... " required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="adresse">Adresse <span class="text-danger">*</span></label>
                              <div class="col-lg-4">
                                 <input type="text" id="adresse" class="form-control" name="adresse" placeholder="Ex: 115 Avenue de la Republique..." required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="code_postal">Code postal <span class="text-danger">*</span></label>
                              <div class="col-lg-1">
                                 <input type="number" id="code_postal" class="form-control" name="code_postal" min="0" placeholder="Ex: 30200" required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="ville">Ville <span class="text-danger">*</span></label>
                              <div class="col-lg-2">
                                 <input type="text" id="ville" class="form-control" name="ville" placeholder="Ex: Avignon..." required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="telephone">Téléphone <span class="text-danger">*</span></label>
                              <div class="col-lg-2">
                                 <input type="text" id="telephone" class="form-control" name="telephone" placeholder="Ex: 0600060006" required>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="email" id="email" class="form-control" name="email" placeholder="Ex: dest@mail.com..." required>
                              </div>
                           </div>
                           <div class="col-lg-10" id="associate">
                              <div class="panel panel-warning m-t-15">
                                 <div class="panel-heading"><strong>Notaires et clercs associés à l'étude</strong></div>
                                 <div class="panel-body">
                                    <button class="btn btn-warning add_field_button">Ajouter</button>  
                                    <div class="input_fields_wrap">
                                       <div class="col-lg-6">
                                          <div class="card p-0">
                                             <div class="media">
                                                <div class="p-20 media-body">
                                                   <h4 class="color-primary">Fiche 1</h4>
                                                   <br>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="rl1">Role <span class="text-danger">*</span></label>
                                                      <div class="col-lg-4">
                                                         <select class="js-select2 form-control" id="rl1" name="rl1" required>
                                                            <option value="notaire">Notaire</option>
                                                            <option value="clerc">Clerc de notaire</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="name1">Nom et prénom<span class="text-danger">*</span></label>
                                                      <div class="col-lg-8">
                                                         <input type="text" id="name1" class="form-control" name="name1" placeholder="Ex: Mme Rosa MIRALES..." required>
                                                      </div>
                                                   </div>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="tel1">Téléphone<span class="text-danger">*</span></label>
                                                      <div class="col-lg-8">
                                                         <input type="text" id="tel1" class="form-control" name="tel1" placeholder="Ex: 0600060006" required>
                                                      </div>
                                                   </div>
                                                   <div class="form-group row">
                                                      <label class="col-sm-4 control-label" for="mail1">Email<span class="text-danger">*</span></label>
                                                      <div class="col-lg-8">
                                                         <input type="email" id="mail1" class="form-control" name="mail1" placeholder="Ex: dest@mail.com" required>
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
       var x = 2;
       var max_fields      = 15;
       var wrapper         = $(".input_fields_wrap");
       var add_button      = $(".add_field_button");
       $(add_button).click(function(e){
           e.preventDefault();
           if(x < max_fields){
               $(wrapper).append('<div class="col-lg-6"> <div class="card p-0"> <div class="media"> <div class="p-20 media-body"> <h4 class="color-primary">Fiche '+x+'</h4> <br><div class="form-group row"> <label class="col-sm-4 control-label" for="rl'+x+'">Role <span class="text-danger">*</span></label> <div class="col-lg-4"> <select class="js-select2 form-control" id="rl'+x+'" name="rl'+x+'" required> <option value="notaire">Notaire</option> <option value="clerc">Clerc de notaire</option> </select> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="name'+x+'">Nom et prénom<span class="text-danger">*</span></label> <div class="col-lg-8"> <input type="text" id="name'+x+'" class="form-control" name="name'+x+'" placeholder="Ex: Mme Rosa MIRALES..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="tel'+x+'">Téléphone<span class="text-danger">*</span></label> <div class="col-lg-8"> <input type="text" min="0" id="tel'+x+'" class="form-control" name="tel'+x+'" placeholder="Ex: 0600060006..." required> </div></div><div class="form-group row"> <label class="col-sm-4 control-label" for="mail'+x+'">Email<span class="text-danger">*</span></label> <div class="col-lg-8"> <input type="email" id="mail'+x+'" class="form-control" name="mail'+x+'" placeholder="Ex: dest@mail.com" required> </div></div></div></div><a class="btn btn-danger remove_field_button" style="margin-bottom: 20px;">Supprimer</a> </div></div>'); //add input box
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
           var associate = $('#associate').find('select, input').serialize();
           var ajaxData = {
           role: $('#role').val(), nom: $('#nom').val(), adresse: $('#adresse').val(), code_postal: $('#code_postal').val(), 
               ville: $('#ville').val(),email: $('#email').val(), telephone: $('#telephone').val(), assoc: associate
           }
           $.ajax({
               type: "POST",
               url: ("{{ route('notaire.store') }}"),
               beforeSend: function(xhr, type) {
                   if (!type.crossDomain) {
                       xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                   }
               },
               data: ajaxData,
               success: function(data){  
                   swal(
                       'Ajouté',
                       'L\'Etude a été ajoutée à la base !',
                       'success'
                   )
                   .then(function(){
                       window.location.href = "{{route('notaire')}}";
                   })
               },
               error: function(data){
                   swal(
                       'Echec',
                       'Vérifiez votre saisie, données invalides ou doublon detecté !',
                       'error'
                   );
                   .then(function(){
                       window.location.href = "{{route('notaire')}}";
                   })
               }
           });
       }
   });
       
</script>
@endsection