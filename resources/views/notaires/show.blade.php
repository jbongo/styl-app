/*
*@author : Belkacem
*@controller: NotaireController
*@description : Listing d'une étude et de ses notaires associés
*/
@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@if (session('ok'))
<div class="alert alert-success alert-dismissible fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
</div>
@endif
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
<div class="modal fade" id="editetude" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Modifier les informations d'une étude</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-validation">
               <form class="form-valide89 form-horizontal" action="{{ route('notaire.updateetude', $etd->id) }}" method="post">
                  <div class="form-group row">
                     {{ csrf_field() }}
                     <label class="col-sm-4 control-label" for="role">Type de l'étude <span class="text-danger">*</span></label>
                     <div class="col-lg-4">
                        <select class="js-select2 form-control" id="role" name="role" required>
                           <option></option>
                           <option value="autre">Autre</option>
                           <option value="scp">Societé civile professionnelle (SCP)</option>
                           <option value="sel">Societé d'exercice libérale (SEL)</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="nom">Nom ou raison sociale<span class="text-danger">*</span></label>
                     <div class="col-lg-5">
                        <input type="text" id="nom" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{$errors->has('nom') ? old('nom'): $etd->nom}}" name="nom" placeholder="Ex: Mme Rosa MIRALES..." required>
                        @if ($errors->has('nom'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('nom')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="adresse">Adresse <span class="text-danger">*</span></label>
                     <div class="col-lg-4">
                        <input type="text" id="adresse" class="form-control {{$errors->has('adresse') ? 'is-invalid' : ''}}" value="{{$errors->has('adresse') ? old('adresse'): $etd->adresse}}" name="adresse" placeholder="Ex: 115 Avenue de la Republique..." required>
                        @if ($errors->has('adresse'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('adresse')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="code_postal">Code postal <span class="text-danger">*</span></label>
                     <div class="col-lg-2">
                        <input type="text" id="code_postal" class="form-control {{$errors->has('code_postal') ? 'is-invalid' : ''}}" value="{{$errors->has('code_postal') ? old('code_postal'): $etd->code_postal}}" name="code_postal" min="0" placeholder="Ex: 30200" required>
                        @if ($errors->has('code_postal'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('code_postal')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="ville">Ville <span class="text-danger">*</span></label>
                     <div class="col-lg-2">
                        <input type="text" id="ville" class="form-control {{$errors->has('ville') ? 'is-invalid' : ''}}" value="{{$errors->has('ville') ? old('ville'): $etd->ville}}" name="ville" placeholder="Ex: Avignon..." required>
                        @if ($errors->has('ville'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('ville')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="telephone">Téléphone<span class="text-danger">*</span></label>
                     <div class="col-lg-3">
                        <input type="text" id="telephone" class="form-control {{$errors->has('telephone') ? 'is-invalid' : ''}}" value="{{$errors->has('telephone') ? old('telephone'): $etd->telephone}}" name="telephone" placeholder="Ex: 0600060006..." required>
                        @if ($errors->has('telephone'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('telephone')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="email">Email<span class="text-danger">*</span></label>
                     <div class="col-lg-3">
                        <input type="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$errors->has('email') ? old('email'): $etd->email}}" name="email" placeholder="Ex: dest@mail.com" required>
                        @if ($errors->has('email'))
                        <br>
                        <div class="alert alert-warning ">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{$errors->first('email')}}</strong> 
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-primary">valider</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="attache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Associer un notaire à une étude.</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-validation">
               <form class="form-valide77 form-horizontal" action="{{ route('notaire.associate', $etd->id) }}" method="post">
                  @csrf
                  <div class="form-group row" id="op1">
                     <label class="col-sm-4 control-label" for="user">Choisir le notaire à associer<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <select class="selectpicker col-lg-8" id="user" name="user" data-live-search="true" data-style="btn-pink btn-rounded" required>
                           @foreach($null as $dr)
                           <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->telephone}} {{$dr->code_postal}}">Nom: {{$dr->nom}} email: {{$dr->email}} Téléphone: {{$dr->telephone}}</option>
                           @endforeach                                
                        </select>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                     <button type="submit" class="btn btn-primary">valider</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <a type="button" href="{{Route('notaire')}}" class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-arrow-left"></i>Retour au listing</a>
         <div class="card-body">
            <div class="col-lg-8">
               <div class="card alert">
                  <div class="card-header">
                     <h4>Liste des notaires et clercs associés à l'étude</h4>
                  </div>
                  <br>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>Nom</th>
                                 <th>Role</th>
                                 <th>Email</th>
                                 <th>Téléphone</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($not as $one)
                              <tr>
                                 <td>{{$one->nom}}</td>
                                 <td><span class="badge badge-primary">{{$one->role}}</span></td>
                                 <td>{{$one->email}}</td>
                                 <td class="color-primary">{{$one->telephone}}</td>
                                 <td>
                                    <span><a href="{{Route('notaire.edit', $one->id)}}" class="archive_notaire" data-toggle="tooltip" title="@lang('Modifier')"><i class="large material-icons color-success">edit</i></a></span>
                                    <a type="button" href="{{Route('notaire.cut', $one->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-cut"></i>Dissocier</a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card alert">
                  <div class="card-body">
                     <div class="panel lobipanel-basic panel-warning">
                        <div class="panel-heading">
                           <div class="panel-title">Details de l'étude</div>
                        </div>
                        <div class="panel-body">
                           <p>
                           <h5><strong>Type de l'étude: </strong>{{$etd->role}}</h5>
                           </p>
                           <p>
                           <h5><strong>Nom ou raison sociale: </strong>{{$etd->nom}}</h5>
                           </p>
                           <p>
                           <h5><strong>Adresse: </strong>{{$etd->adresse}}</h5>
                           </p>
                           <p>
                           <h5><strong>Code postal: </strong>{{$etd->code_postal}}</h5>
                           </p>
                           <p>
                           <h5><strong>Ville: </strong>{{$etd->ville}}</h5>
                           </p>
                           <p>
                           <h5><strong>Téléphone: </strong>{{$etd->telephone}}</h5>
                           </p>
                           <p>
                           <h5><strong>Email: </strong>{{$etd->email}}</h5>
                           </p>
                           <br>
                           <a type="button" data-toggle="modal" data-target="#attache" class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>Associer un notaire existant</a>
                           <a type="button" data-toggle="modal" data-target="#editetude" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-pencil"></i>Modifier</a>
                           <a type="button" href="{{Route('notaire.archiveetude', $one->notaire_id)}}" id="archive-etude" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-trash"></i>Archiver</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('js-content')
<script>
   $(function(e) {
       $.ajaxSetup({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
       })
       $('[data-toggle="tooltip"]').tooltip()
       $('#archive-etude').click(function(e) {
           let that = $(this);
           e.preventDefault();
           const swalWithBootstrapButtons = swal.mixin({
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
   })
   
   swalWithBootstrapButtons({
       title: '@lang('Voulez vous vraiment archiver cette étude ?')',
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
                   type: 'get'
               })
               .done(function () {
                       that.parents('tr').remove()
               })
   
           swalWithBootstrapButtons(
           'Archivé!',
           'Tous les notaire attachés à cette étude ont été dissociés.',
           'success'
           )
           .then(function(){
                   window.location.href = "{{route('notaire')}}";                    })
           
           
       } else if (
           result.dismiss === swal.DismissReason.cancel
       ) {
           swalWithBootstrapButtons(
           'Action annulée',
           'L\'étude n\'a pas été archivé.',
           'error'
           )
       }
   })
       })
   })
</script>
@endsection