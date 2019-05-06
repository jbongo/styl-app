@extends('layouts.main.dashboard')
@section('header_name')
Ajouter un mandat
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="form-validation">
               <form class="form-valide777 form-horizontal" action="{{route('mandat.store')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                     <a type="button" href="{{route('mandat')}}" class="btn btn-dark btn-flat btn-addon"><i class="ti-arrow-left"></i>Retour au listing</a>
                     <div class="panel lobipanel-basic panel-info">
                        <div class="panel-heading">
                           <div class="panel-title">Ajouter un mandat</div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="objet">Objet du mandat<span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <select class="js-select2 form-control" id="objet" name="objet" required>
                                    @if(old('objet'))
                                    <option selected value="{{old('objet')}}">{{old('objet')}}</option>
                                    @endif
                                    <option value="mandat-vente">Mandat de vente</option>
                                    <option value="mandat-recherche">Mandat de recherche</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="type">Type du mandat<span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <select class="js-select2 form-control" id="type" name="type" required>
                                    @if(old('type'))
                                    <option selected value="{{old('type')}}">{{old('type')}}</option>
                                    @endif
                                    <option value="simple">Simple</option>
                                    <option value="exclusif">Exclusif</option>
                                    <option id="ty45g" value="semi-exclusif">Semi exclusif</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="role-mandant">Type du mandant<span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <select class="js-select2 form-control" id="role-mandant" name="role-mandant" required>
                                    @if(old('role-mandant'))
                                    <option selected value="{{old('role-mandant')}}">{{old('role-mandant')}}</option>
                                    @endif
                                    <option value="personne_seule">Personne simple</option>
                                    <option value="couple">Couple</option>
                                    <option value="personne_morale">Personne morale</option>
                                    <option value="groupe">Groupe de personnes</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row" id="fcf55">
                              <label class="col-sm-4 control-label" for="bien_id">Associer le bien<span class="text-danger">*</span></label>
                              <div class="col-lg-4">
                                 <select class="selectpicker col-lg-8" id="bien_id" name="bien_id" data-live-search="true" data-style="btn-default btn-rounded" required>
                                       <option></option>
                                    @foreach($biens as $dr)
                                    <option value="{{$dr->id}}" data-content="<img class='square-img' src='{{asset('images/photos_bien/'.$dr->photosbiens[0]->resized_name)}}' alt=''> {{$dr->titre_annonce}}" data-tokens="{{$dr->titre_annonce}} {{$dr->code_postal_prive_secteur}}"></option>
                                    @endforeach                                
                                 </select>
                              </div>
                           </div>
                           <div class="vnd">
                              <div class="form-group row" id="op1">
                                 <label class="col-sm-4 control-label" for="mandant_s_id">Associer le mandant (vendeur personne seul)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_s_id" name="mandant_s_id" data-live-search="true" data-style="btn-success btn-rounded" required>
                                       @foreach($mandants as $dr)
                                       @if(old('mandant_s_id') && $dr->id == old('mandant_s_id')) 
                                       <option selected value="{{old('mandant_s_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "personne_seule")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                                
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="op2">
                                 <label class="col-sm-4 control-label" for="mandant_c_id">Associer le mandant (vendeur couple)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_c_id" name="mandant_c_id" data-live-search="true" data-style="btn-primary btn-rounded" required>
                                       @foreach($mandants as $dr)
                                       @if(old('mandant_c_id') && $dr->id == old('mandant_c_id')) 
                                       <option selected value="{{old('mandant_c_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "couple")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                                 
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="op3">
                                 <label class="col-sm-4 control-label" for="mandant_m_id">Associer le mandant (vendeur personne morale)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_m_id" name="mandant_m_id" data-live-search="true" data-style="btn-pink btn-rounded" required>
                                       @foreach($mandants as $dr)
                                       @if(old('mandant_m_id') && $dr->id == old('mandant_m_id')) 
                                       <option selected value="{{old('mandant_m_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "personne_morale")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                                  
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="op4">
                                 <label class="col-sm-4 control-label" for="mandant_g_id">Associer le mandant (vendeur groupe)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_g_id" name="mandant_g_id" data-live-search="true" data-style="btn-warning btn-rounded" required>
                                       @foreach($groupemandants as $dr)
                                       @if(old('mandant_g_id') && $dr->id == old('mandant_g_id')) 
                                       <option selected value="{{old('mandant_g_id')}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                                       @endif
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                                       @endforeach                                
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="ach">
                              <div class="form-group row" id="df1">
                                 <label class="col-sm-4 control-label" for="mandant_aqs_id">Associer le mandant (acquéreur personne seule)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_aqs_id" name="mandant_aqs_id" data-live-search="true" data-style="btn-info btn-rounded" required>
                                       @foreach($acquereur as $dr)
                                       @if(old('mandant_aqs_id') && $dr->id == old('mandant_aqs_id')) 
                                       <option selected value="{{old('mandant_aqs_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "personne_seule")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                                
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="df2">
                                 <label class="col-sm-4 control-label" for="mandant_aqc_id">Associer le mandant (acquéreur couple)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_aqc_id" name="mandant_aqc_id" data-live-search="true" data-style="btn-warning btn-rounded" required>
                                       @foreach($acquereur as $dr)
                                       @if(old('mandant_aqc_id') && $dr->id == old('mandant_aqc_id')) 
                                       <option selected value="{{old('mandant_aqc_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "couple")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                                
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="df3">
                                 <label class="col-sm-4 control-label" for="mandant_aqm_id">Associer le mandant (acquéreur personne morale)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_aqm_id" name="mandant_aqm_id" data-live-search="true" data-style="btn-danger btn-rounded" required>
                                       @foreach($acquereur as $dr)
                                       @if(old('mandant_aqm_id') && $dr->id == old('mandant_aqm_id')) 
                                       <option selected value="{{old('mandant_aqm_id')}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @if($dr->type === "personne_morale")
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->code_postal}}">{{$dr->civilite}} {{$dr->nom}} {{$dr->prenom}}</option>
                                       @endif
                                       @endforeach                               
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row" id="df4">
                                 <label class="col-sm-4 control-label" for="mandant_aqg_id">Associer le mandant (acquéreur groupe)<span class="text-danger">*</span></label>
                                 <div class="col-lg-4">
                                    <select class="selectpicker col-lg-8" id="mandant_aqg_id" name="mandant_aqg_id" data-live-search="true" data-style="btn-pink btn-rounded" required>
                                       @foreach($groupeacquereur as $dr)
                                       @if(old('mandant_aqg_id') && $dr->id == old('mandant_aqg_id')) 
                                       <option selected value="{{old('mandant_aqg_id')}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                                       @endif
                                       <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_groupe}}">{{$dr->nom_groupe}}</option>
                                       @endforeach                                
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="numero">Numéro du mandat sur Protexa <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="text" id="numero" class="form-control {{$errors->has('numero') ? 'is-invalid' : ''}}" value="{{old('numero')}}" name="numero" placeholder="Ex: 99258... " required>
                                 @if ($errors->has('numero'))
                                 <br>
                                 <div class="alert alert-warning ">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{$errors->first('numero')}}</strong> 
                                 </div>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="date_debut">Date du début <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="date" id="date_debut" class="form-control {{$errors->has('date_debut') ? 'is-invalid' : ''}}" value="{{old('date_debut')}}" name="date_debut" required>
                                 @if ($errors->has('date_debut'))
                                 <br>
                                 <div class="alert alert-warning ">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{$errors->first('date_debut')}}</strong> 
                                 </div>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="date_fin">Date de fin <span class="text-danger">*</span></label>
                              <div class="col-lg-3">
                                 <input type="date" id="date_fin" class="form-control {{$errors->has('date_fin') ? 'is-invalid' : ''}}" value="{{old('date_fin')}}" name="date_fin" required>
                                 @if ($errors->has('date_fin'))
                                 <br>
                                 <div class="alert alert-warning ">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{$errors->first('date_fin')}}</strong> 
                                 </div>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 control-label" for="describe">Notes</label>
                              <div class="col-lg-3">
                                 <textarea rows="4" id="describe" class="form-control {{$errors->has('describe') ? 'is-invalid' : ''}}" value="{{old('describe')}}" name="describe" placeholder="..."></textarea>
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
       if($('#objet').val() === "mandat-vente") { 
           $('.vnd').show();
           $('.ach').hide();
           $('#ty45g').show();
           $('#fcf55').show();
           switch($('#role-mandant').val()){
                case 'personne_seule':
                    $('#op1').show();
                    $('#op2').hide();
                    $('#op3').hide();
                    $('#op4').hide();
                    break;
                case 'couple':
                    $('#op1').hide();
                    $('#op2').show();
                    $('#op3').hide();
                    $('#op4').hide();
                    break;
                case 'personne_morale':
                    $('#op1').hide();
                    $('#op2').hide();
                    $('#op3').show();
                    $('#op4').hide();
                    break;
                default:
                    $('#op1').hide();
                    $('#op2').hide();
                    $('#op3').hide();
                    $('#op4').show();
           }
           $('#role-mandant').change(function(e){
               switch($('#role-mandant').val()){
                case 'personne_seule':
                    $('#op1').show();
                    $('#op2').hide();
                    $('#op3').hide();
                    $('#op4').hide();
                    break;
                case 'couple':
                    $('#op1').hide();
                    $('#op2').show();
                    $('#op3').hide();
                    $('#op4').hide();
                    break;
                case 'personne_morale':
                    $('#op1').hide();
                    $('#op2').hide();
                    $('#op3').show();
                    $('#op4').hide();
                    break;
                default:
                    $('#op1').hide();
                    $('#op2').hide();
                    $('#op3').hide();
                    $('#op4').show();
           }
           });
       }
       else { 
           $('.vnd').hide();
           $('.ach').show();
           $('#ty45g').hide();
           $('#fcf55').hide();
           switch($('#role-mandant').val()){
                case 'personne_seule':
                    $('#df1').show();
                    $('#df2').hide();
                    $('#df3').hide();
                    $('#df4').hide();
                    break;
                case 'couple':
                    $('#df1').hide();
                    $('#df2').show();
                    $('#df3').hide();
                    $('#df4').hide();
                    break;
                case 'personne_morale':
                    $('#df1').hide();
                    $('#df2').hide();
                    $('#df3').show();
                    $('#df4').hide();
                    break;
                default:
                    $('#df1').hide();
                    $('#df2').hide();
                    $('#df3').hide();
                    $('#df4').show();
           }
           $('#role-mandant').change(function(e){
               switch($('#role-mandant').val()){
                case 'personne_seule':
                    $('#df1').show();
                    $('#df2').hide();
                    $('#df3').hide();
                    $('#df4').hide();
                    break;
                case 'couple':
                    $('#df1').hide();
                    $('#df2').show();
                    $('#df3').hide();
                    $('#df4').hide();
                    break;
                case 'personne_morale':
                    $('#df1').hide();
                    $('#df2').hide();
                    $('#df3').show();
                    $('#df4').hide();
                    break;
                default:
                    $('#df1').hide();
                    $('#df2').hide();
                    $('#df3').hide();
                    $('#df4').show();
            }
            });
       }
       
   });
</script>
<script>
   $('#objet').change(function(e){
       if($('#objet').val() === "mandat-vente") { 
          $('.vnd').show();
          $('.ach').hide();
          $('#ty45g').show();
          $('#fcf55').show();
          switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#op1').show();
                   $('#op2').hide();
                   $('#op3').hide();
                   $('#op4').hide();
                   break;
               case 'couple':
                   $('#op1').hide();
                   $('#op2').show();
                   $('#op3').hide();
                   $('#op4').hide();
                   break;
               case 'personne_morale':
                   $('#op1').hide();
                   $('#op2').hide();
                   $('#op3').show();
                   $('#op4').hide();
                   break;
               default:
                   $('#op1').hide();
                   $('#op2').hide();
                   $('#op3').hide();
                   $('#op4').show();
          }
          $('#role-mandant').change(function(e){
              switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#op1').show();
                   $('#op2').hide();
                   $('#op3').hide();
                   $('#op4').hide();
                   break;
               case 'couple':
                   $('#op1').hide();
                   $('#op2').show();
                   $('#op3').hide();
                   $('#op4').hide();
                   break;
               case 'personne_morale':
                   $('#op1').hide();
                   $('#op2').hide();
                   $('#op3').show();
                   $('#op4').hide();
                   break;
               default:
                   $('#op1').hide();
                   $('#op2').hide();
                   $('#op3').hide();
                   $('#op4').show();
          }
          });
       }
       else { 
          $('.vnd').hide();
          $('.ach').show();
          $('#ty45g').hide();
          $('#fcf55').hide();
          switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#df1').show();
                   $('#df2').hide();
                   $('#df3').hide();
                   $('#df4').hide();
                   break;
               case 'couple':
                   $('#df1').hide();
                   $('#df2').show();
                   $('#df3').hide();
                   $('#df4').hide();
                   break;
               case 'personne_morale':
                   $('#df1').hide();
                   $('#df2').hide();
                   $('#df3').show();
                   $('#df4').hide();
                   break;
               default:
                   $('#df1').hide();
                   $('#df2').hide();
                   $('#df3').hide();
                   $('#df4').show();
          }
          $('#role-mandant').change(function(e){
              switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#df1').show();
                   $('#df2').hide();
                   $('#df3').hide();
                   $('#df4').hide();
                   break;
               case 'couple':
                   $('#df1').hide();
                   $('#df2').show();
                   $('#df3').hide();
                   $('#df4').hide();
                   break;
               case 'personne_morale':
                   $('#df1').hide();
                   $('#df2').hide();
                   $('#df3').show();
                   $('#df4').hide();
                   break;
               default:
                   $('#df1').hide();
                   $('#df2').hide();
                   $('#df3').hide();
                   $('#df4').show();
           }
           });
      }
      });
</script>
<script>
   $('.submit').click(function(e){
       $('.form-valide777').validate();
       if ($('.form-valide777').valid() == true){
       if($('#objet').val() === "mandat-vente") { 
          $('.ach').remove();
          switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#op2').remove();
                   $('#op3').remove();
                   $('#op4').remove();
                   break;
               case 'couple':
                   $('#op1').remove();
                   $('#op3').remove();
                   $('#op4').remove();
                   break;
               case 'personne_morale':
                   $('#op1').remove();
                   $('#op2').remove();
                   $('#op4').remove();
                   break;
               default:
                   $('#op1').remove();
                   $('#op2').remove();
                   $('#op3').remove();
          }
       }
       else { 
          $('.vnd').remove();
          $('#ty45g').remove();
          $('#fcf55').remove();
          switch($('#role-mandant').val()){
               case 'personne_seule':
                   $('#df2').remove();
                   $('#df3').remove();
                   $('#df4').remove();
                   break;
               case 'couple':
                   $('#df1').remove();
                   $('#df3').remove();
                   $('#df4').remove();
                   break;
               case 'personne_morale':
                   $('#df1').remove();
                   $('#df2').remove();
                   $('#df4').remove();
                   break;
               default:
                   $('#df1').remove();
                   $('#df2').remove();
                   $('#df3').remove();
          }
      }
       }
      });
</script>
@endsection