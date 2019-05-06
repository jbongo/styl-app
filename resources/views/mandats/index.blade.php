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
<div class="modal fade" id="pend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Annuler définitivement un mandat</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
                <div class="panel lobipanel-basic panel-danger">
                        <div class="panel-heading">
                           <div class="panel-title">Attention</div>
                        </div>
                        <div class="panel-body">
                           Cette action est irreversible, il s'agit ici d'un mandat non conclu par une vente, une fois le mandat annulé vous ne pourrez plus soumettre un autre mandat avec le meme numéro ni avec un autre numéro pour le meme bien, s'il s'agit d'une erreur de saisie, vous pouvez proceder à l'annulation
                           et contacter directement un administrateur pour pouvoir créer un autre mandat plus tard.
                        </div>
                     </div>
                     <br>
            <form>
               {{ csrf_field() }}
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="raison">@lang('Raison d\'annulation') <span class="text-danger">*</span></label>
                  <div class="col-lg-4">
                     <select class="js-select2 form-control" id="raison" name="raison" required>
                        <option>Erreur de saisie pendant la création du mandat.</option>
                        <option>Le bien a été vendu par le mandant.</option>
                        <option>Le bien a été vendu par un autre agent.</option>
                        <option>Le mandant a decidé d'annuler le mandat.</option>
                        <option>Le mandant ne veut pas prolonger le mandat après son expiration.</option>
                        <option>Autre.</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                    <label class="col-sm-4 control-label" for="describe">Commentaires <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                       <textarea rows="4" id="describe" class="form-control" name="describe" placeholder="Exemple: Suite à un désacord avec le mandant, ce dérnier a décidé d'annuler le mandat..." required></textarea>
                    </div>
                 </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            <button type="button" id="push" class="btn btn-pink">Valider</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="extend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Prolonger un mandat expiré.</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
                 <div class="panel lobipanel-basic panel-danger">
                         <div class="panel-heading">
                            <div class="panel-title">Attention</div>
                         </div>
                         <div class="panel-body">
                            La prolongation ou la reconduction tacite d'un mandat expiré implique l'accord du mandant, assurez vous d'avoir cet accord avant de prolonger le mandat.
                         </div>
                      </div>
                      <br>
             <form class="form-valide form-horizontal" action="{{route('mandat.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4 control-label" for="prolog">Durée de la prolongation (mois)<span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                       <input type="number" id="prolog" class="form-control" min="1" max="36" value="3" name="prolog" required>
                    </div>
                 </div>
             </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            <button type="button" id="extd" class="btn btn-pink">Valider</button>
          </div>
       </div>
    </div>
 </div>

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="panel panel-warning m-t-15" id="cont">
               <div class="panel-heading">Listes des mandats actifs.</div>
               <div class="panel-body">
                  <div class="table-responsive" style="overflow-x: inherit !important;">
                     <table  id="ex1" class=" table student-data-table  m-t-20 ">
                        <thead>
                           <tr>
                              <th>@lang('Numéro du mandat')</th>
                              <th>@lang('Objet du mandat')</th>
                              <th>@lang('Type')</th>
                              <th>@lang('Date de début')</th>
                              <th>@lang('Date de fin')</th>
                              <th>@lang('Status du mandat')</th>
                              <th>@lang('Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($mandat as $one)
                           <tr>
                              <td>
                                 {{$one->numero}} 
                              </td>
                              <td>
                                <span class="badge badge-info">{{$one->objet}}</span>
                             </td>
                              <td>
                                @if($one->type == "exclusif")
                                <span class="badge badge-success">{{$one->type}}</span> 
                                @elseif($one->type == "semi-exclusif")
                                <span class="badge badge-info">{{$one->type}}</span>
                                @elseif($one->type == "simple")
                                <span class="badge badge-warning">{{$one->type}}</span>  
                                @endif 
                              </td>
                              <td>
                                {{date('d-m-Y',strtotime($one->date_debut))}}
                              </td>
                              <td>
                                {{date('d-m-Y',strtotime($one->date_fin))}}
                              </td>
                              <td>
                                 @if($one->statut == "actif")
                                    <span class="badge badge-success">{{$one->statut}}</span> 
                                 @elseif($one->statut != "actif")
                                    <span class="badge badge-warning">{{$one->statut}}</span> 
                                 @endif                                                  
                              </td>
                              <td>
                                @if($one->statut == "expiré")
                                <a type="button" id="{{$one->id}}" class="btn btn-pink btn-flat btn-addon btn-sm m-b-10 m-l-5 protract" data-toggle="modal" data-target="#extend"><i class="ti-reload"></i>Prolonger</a>
                                @endif
                                <a type="button" href="{{Route('mandat.show', Crypt::encrypt($one->id))}}" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-eye"></i>Voir</a>
                                <a type="button" id="{{$one->id}}" href="{{Route('mandat.cancel', $one->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5 cancel" data-toggle="modal" data-target="#pend"><i class="ti-na"></i>Annuler</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-4 text-center"> 
                     <a href="{{Route('mandat.add')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-file"></i>@lang('Ajouter un mandat')</a>
                  </div>
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
        $(document).ready(function(){    
            $('.cancel').on('click',function(){
            var id = $(this).attr('id') ;
            $('#push').click(function(){
                var ajaxdata = {raison: $('#raison').val(), describe: $('#describe').val()};
                $.ajaxSetup({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: '/mandat/cancel/'+id,
                    type: 'POST',
                    data:  ajaxdata,
                    success: function(data, statut){
                        //console.log(data);
                        window.location.href = "{{route('mandat')}}";
                    },
                    error: function(data){
                        console.log(data);
                    }
                });              
            });
            });
        });
     </script>
     <script>
        $(document).ready(function(){    
            $('.protract').on('click',function(){
            var id = $(this).attr('id') ;
            $('#extd').click(function(){
                var ajaxdata = {extend: $('#prolog').val()};
                $.ajaxSetup({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: '/mandat/extend/'+id,
                    type: 'POST',
                    data:  ajaxdata,
                    success: function(data, statut){
                        console.log(data);
                        window.location.href = "{{route('mandat')}}";
                    },
                    error: function(data){
                        console.log(data);
                    }
                });              
            });
            });
        });
     </script>
@endsection