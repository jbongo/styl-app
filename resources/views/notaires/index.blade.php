@extends('layouts.main.dashboard')
@section('header_name')
    Portail des notaires
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="modal fade" id="import-fls" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="import"><strong>Importer des notaires depuis un fichier .JSON</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-validation">
               <form class="form-valide777 form-horizontal" action="{{ route('notaire.import') }}" enctype="multipart/form-data" method="post">
                  @csrf
                  <div class="form-group row">
                     <div class="col-lg-8 col-sm-12">
                            <div class="form-control file-input">
                                    <label for="fls">
                                            <span class="btn btn-warning btn-outline btn-rounded dark-input-button">
                                                <input type="file" id="fls" name="fls" onchange="this.parentNode.parentNode.nextElementSibling.value = this.value">
                                                <i class="ti-save"></i>
                                            </span>
                                </label>
                                    <input class="file-name input-flat" type="text" readonly="readonly" placeholder="Choisir le fichier .JSON">
                                </div>
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
<div class="modal fade" id="pend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter un notaire associé à une étude</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="panel lobipanel-basic panel-danger">
               <div class="panel-heading">
                  <div class="panel-title">INSTRUCTIONS</div>
               </div>
               <div class="panel-body">
                  Le notaire doit faire partie d'une étude ou association, assurez vous de choisir correctement l'étude à laquelle il appartient ou la cas echeant la créer si elle n'existe pas, les informations
                  doivent étre saisies correctement, autrement le notaire ne sera pas ajouté et vous serez redirigé vers la page précédente et vous devrez recommencer pour corriger les erreurs de saisie.
               </div>
            </div>
            <div class="form-validation">
               <form class="form-valide89 form-horizontal" action="{{ route('notaireassocie.store') }}" method="post">
                  <div class="form-group row" id="op1">
                     <label class="col-sm-4 control-label" for="scp">Associer une étude<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <select class="selectpicker col-lg-8" id="scp" name="scp" data-live-search="true" data-style="btn-pink btn-rounded" >
                           @foreach($scp as $dr)
                           <option  value="{{$dr->id}}" data-tokens="{{$dr->nom}} {{$dr->adresse}} {{$dr->email}} {{$dr->telephone}} {{$dr->code_postal}}">{{$dr->nom}}</option>
                           @endforeach                                
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     {{ csrf_field() }}
                     <label class="col-sm-4 control-label" for="role">Role <span class="text-danger">*</span></label>
                     <div class="col-lg-4">
                        <select class="js-select2 form-control" id="role" name="role" required>
                           <option value="notaire">Notaire</option>
                           <option value="clerc">Clerc de notaire</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-4 control-label" for="nom">Nom et prénom<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <input type="text" id="nom" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{old('nom')}}" name="nom" placeholder="Ex: Mme Rosa MIRALES..." required>
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
                     <label class="col-sm-4 control-label" for="telephone">Téléphone<span class="text-danger">*</span></label>
                     <div class="col-lg-8">
                        <input type="text" id="telephone" class="form-control {{$errors->has('telephone') ? 'is-invalid' : ''}}" value="{{old('telephone')}}" name="telephone" placeholder="Ex: 0600060006..." required>
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
                     <div class="col-lg-8">
                        <input type="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}" name="email" placeholder="Ex: dest@mail.com" required>
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
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="panel panel-info m-t-15" id="cont">
               <div class="panel-heading">Liste de tous les notaires actifs.</div>
               <div class="panel-body">
                     <div class="col-lg-4">
                           <div class="card bg-dark">
                              <div class="stat-widget-six">
                                 <div class="stat-icon">
                                    <i class="material-icons">domain</i>
                                 </div>
                                 <div class="stat-content">
                                    <div class="text-left dib">
                                       <div class="stat-heading"><strong>Nombre d'études</strong></div>
                                       <div class="stat-text"><strong>Total: {{count($scp)}}</strong></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="card bg-primary">
                              <div class="stat-widget-six">
                                 <div class="stat-icon">
                                       <i class="material-icons">person_pin</i>
                                 </div>
                                 <div class="stat-content">
                                    <div class="text-left dib">
                                       <div class="stat-heading"><strong>Notaires actifs</strong></div>
                                       <div class="stat-text"><strong>Total: {{$not->where('role', "notaire")->count()}}</strong></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="card bg-pink">
                              <div class="stat-widget-six">
                                 <div class="stat-icon">
                                    <i class="material-icons">group</i>
                                 </div>
                                 <div class="stat-content">
                                    <div class="text-left dib">
                                       <div class="stat-heading"><strong>Clercs de notaire</strong></div>
                                       <div class="stat-text"><strong>Total: {{$not->where('role', "clerc")->count()}}</strong></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <br><br>
                  <div class="table-responsive" style="overflow-x: inherit !important;">
                     <table  id="ex1" class=" table student-data-table m-t-20 table-hover">
                        <thead>
                           <tr>
                                 <th></th>
                              <th>@lang('Role')</th>
                              <th>@lang('Nom')</th>
                              <th>@lang('Etude')</th>
                              <th>@lang('Email')</th>
                              <th>@lang('Téléphone')</th>
                              <th>@lang('Adresse')</th>
                              <th>@lang('Zip')</th>
                              <th>@lang('Ville')</th>
                              <th style="width:50px;">@lang('Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($not as $one)
                           <tr>
                              <td style=" min-width: 120px; border-top: 4px solid #b8c7ca;">
                                    <img class="img-thumbnail" style="object-fit: cover; width: 100px; height: 100px; border: 2px solid #8ba2ad;background: #f0f0f0; border-style: solid; border-radius: 20px; padding: 3px;" src="{{asset('/images/components/'."justice.png")}}" alt="" />
                              </td >
                              <td style="border-top: 4px solid #b8c7ca;">
                                 <span class="badge badge-info">{{$one->role}}</span>                                                
                              </td>
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$one->nom}} 
                              </td>
                              @foreach ($scp as $sc)
                              @if($sc->id == $one->notaire_id)
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$sc->nom}} 
                              </td>
                              @endif
                              @endforeach
                              @if($one->notaire_id == null)
                              <td style="border-top: 4px solid #b8c7ca;">_____</td>
                              @endif
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$one->email}} 
                              </td>
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$one->telephone}}
                              </td>
                              @foreach ($scp as $sc)
                              @if($sc->id == $one->notaire_id)
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$sc->adresse}}
                              </td>
                              @endif
                              @endforeach
                              @if($one->notaire_id == null)
                              <td style="border-top: 4px solid #b8c7ca;">_____</td>
                              @endif
                              @foreach ($scp as $sc)
                              @if($sc->id == $one->notaire_id)
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$sc->code_postal}}
                              </td>
                              @endif
                              @endforeach
                              @if($one->notaire_id == null)
                              <td style="border-top: 4px solid #b8c7ca;">_____</td>
                              @endif
                              @foreach ($scp as $sc)
                              @if($sc->id == $one->notaire_id)
                              <td style="border-top: 4px solid #b8c7ca;">
                                 {{$sc->ville}}
                              </td>
                              @endif
                              @endforeach
                              @if($one->notaire_id == null)
                              <td style="border-top: 4px solid #b8c7ca;">_____</td>
                              @endif
                              <td style="border-top: 4px solid #b8c7ca;">
                                 @if($one->notaire_id != NULL)
                                 <span><a class="show1" href="{{Route('notaire.show', $one->notaire_id)}}" title="@lang('Détails')"><i class="large material-icons color-info">visibility</i></a></span>
                                 @endif
                                 <span><a href="{{Route('notaire.archivesolo', $one->id)}}" class="archive_notaire" data-toggle="tooltip" title="@lang('Archiver')"><i class="large material-icons color-danger">delete</i></a></span>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-4 text-center"> 
                     <a href="{{route('notaire.add')}}" class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Ajouter une étude')</a>
                  </div>
                  <div class="col-md-4 text-center"> 
                     <a class="btn btn-pink btn-rounded btn-addon btn-sm m-b-10 m-l-5" data-toggle="modal" data-target="#pend"><i class="ti-plus"></i>@lang('Ajouter un notaire')</a>
                  </div>
                  @admin
                  <div class="col-md-4 text-center"> 
                     <a class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5" data-toggle="modal" data-target="#import-fls"><i class="ti-server"></i>@lang('Alimenter la base')</a>
                  </div>
                  @endadmin
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js-content')
<script>
   $(document).ready(function() {
   $('#ex1').DataTable( {
       "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
       }
   });
   });
</script>
<script>
   $(function(e) {
       $.ajaxSetup({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
       })
       $('[data-toggle="tooltip"]').tooltip()
       $('a.archive_notaire').click(function(e) {
           let that = $(this);
           e.preventDefault();
           const swalWithBootstrapButtons = swal.mixin({
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
   })
   
   swalWithBootstrapButtons({
       title: '@lang('Voulez vous vraiment archiver le notaire ?')',
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
                   type: 'GET'
               })
               .done(function () {
                       that.parents('tr').remove()
               })
   
           swalWithBootstrapButtons(
           'Archivé!',
           'Le notaire a bien été archivé et n\'apparaitra plus dans le tableau.',
           'success'
           )
           .then(function(){
                   window.location.href = "{{route('notaire')}}";
                })
       } else if (
           result.dismiss === swal.DismissReason.cancel
       ) {
           swalWithBootstrapButtons(
           'Action annulée',
           'Le notaire n\'a pas été archivé.',
           'error'
           )
       }
   })
       })
   })
</script>
@endsection