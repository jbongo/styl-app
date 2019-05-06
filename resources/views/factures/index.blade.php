@extends('layouts.main.dashboard')
@section('header_name')
   Gérer les factures
@stop
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
            <h5 class="modal-title" id="exampleModalLabel"><strong>Encaisser le montant d'une facture</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               {{ csrf_field() }}
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="date">Date de paiement <span class="text-danger">*</span></label>
                  <div class="col-lg-3">
                     <input type="date" class="form-control" id="date" name="date" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="method">@lang('Moyen de paiement') <span class="text-danger">*</span></label>
                  <div class="col-lg-2">
                     <select class="js-select2 form-control" id="method" name="val-civilite" style="width: 100%;" required>
                        <option>Carte bancaire</option>
                        <option>Virement bancaire</option>
                        <option>Chèque</option>
                        <option>Espèce</option>
                     </select>
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
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="panel panel-warning m-t-15" id="cont">
               <div class="panel-heading">Listes de toutes les factures émmises.</div>
               <div class="panel-body">
                  <div class="table-responsive" style="overflow-x: inherit !important;">
                     <table  id="ex1" class=" table student-data-table  m-t-20 ">
                        <thead>
                           <tr>
                              <th>@lang('Numéro')</th>
                              <th>@lang('Client')</th>
                              <th>@lang('Paiement')</th>
                              <th>@lang('Date de paiement')</th>
                              <th>@lang('Méthode de paiement')</th>
                              <th>@lang('Montant HT')</th>
                              <th>@lang('Montant TTC')</th>
                              <th>@lang('Date d\'émmission')</th>
                              <th>@lang('Action')</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($fact as $direct)
                           <tr>
                              <td>
                                 #{{$direct->id}} 
                              </td>
                              <td>
                                 {{$direct->nom}} 
                              </td>
                              <td>
                                 @if($direct->paiement == 0)
                                 <span class="badge badge-danger">non</span> 
                                 @elseif($direct->paiement == 1)
                                 <span class="badge badge-success">oui</span> 
                                 @endif                                                  
                              </td>
                              <td>
                                 {{date('d-m-Y',strtotime($direct->date_paiement))}}
                              </td>
                              <td>
                                 {{$direct->mode}}
                              </td>
                              <td>
                                 {{$direct->montant_ht}} €
                              </td>
                              <td>
                                 {{$direct->montant_ttc}} €
                              </td>
                              <td>
                                 {{date('d-m-Y',strtotime($direct->created_at))}}
                              </td>
                              <td>
                                 @if($direct->paiement == 0)
                                 <a type="button" id="{{$direct->id}}" href="{{route('facture.paid', $direct->id)}}" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5 pay2" data-toggle="modal" data-target="#pend"><i class="ti-settings"></i>Encaisser</a>
                                 @endif
                                 @if($direct->paiement == 1)
                                 <a type="button" class="btn btn-default btn-flat btn-addon btn-sm m-b-10 m-l-5 disabled"><i class="ti-settings"></i>Encaisser</a>
                                 @endif
                                 @if($direct->role != NULL)
                                 <a type="button" href="{{route('facture.edit', $direct->id)}}" class="btn btn-danger btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Réctifier</a>
                                 @endif
                                 <a type="button" href="{{route('facture.download', $direct->id)}}" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-download"></i>PDF</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-4 text-center"> 
                     <a href="{{route('facture.add')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-file"></i>@lang('Ajouter une facture')</a>
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
       $('.pay2').on('click',function(){
       var id = $(this).attr('id') ;
       $('#push').click(function(){
           var ajaxdata = {date: $('#date').val(), method: $('#method').val()};
           $.ajaxSetup({
           headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
           //console.log(id);
           $.ajax({
               url: '/facture/pending/'+id,
               type: 'PUT',
               data:  ajaxdata,
               success: function(data, statut){
                   //console.log(data);
                   window.location.href = "{{route('facture')}}";
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