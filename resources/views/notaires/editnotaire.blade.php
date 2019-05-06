/*
*@author : Belkacem
*@controller: NotaireController
*@description : formulaire de modification d'un notaire
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
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide2 form-horizontal" id="msform" action="{{route('notaire.update', $notaire->id)}}" method="POST">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                     <div class="panel lobipanel-basic panel-info">
                        <div class="panel-heading">
                           <div class="panel-title">Mettre à jour les informations d'un notaire</div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="role">Role <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <select class="js-select2 form-control" id="role" name="role" required>
                                    <option value="notaire">Notaire</option>
                                    <option value="clerc">Clerc de notaire</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="nom">Nom ou raison sociale <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="text" id="nom" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{$errors->has('nom') ? old('nom'): $notaire->nom}}" name="nom" placeholder="Ex: SCP Dupond... " required>
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
                              <label class="col-sm-4 control-label" for="telephone">Téléphone <span class="text-danger">*</span></label>
                              <div class="col-lg-2">
                                 <input type="text" id="telephone" class="form-control {{$errors->has('telephone') ? 'is-invalid' : ''}}" value="{{$errors->has('telephone') ? old('telephone'): $notaire->telephone}}" name="telephone" placeholder="Ex: 0600060006" required>
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
                              <label class="col-sm-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$errors->has('email') ? old('email') : $notaire->email}}" name="email" placeholder="Ex: dest@mail.com..." required>
                                 @if ($errors->has('email'))
                                 <br>
                                 <div class="alert alert-warning ">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{$errors->first('email')}}</strong> 
                                 </div>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group row" style="text-align: center; margin-top: 50px;">
                              <div class="col-lg-8 ml-auto">
                                 <button class="btn btn-warning btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-plus"></i>Modifier</button>
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
@endsection