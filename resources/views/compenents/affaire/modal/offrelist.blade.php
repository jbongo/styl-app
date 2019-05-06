<div class="modal fade" id="offrelist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Liste des offres</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-pink">
                <div class="panel-heading">
                   <div class="panel-title">Liste des offres d'achat</div>
                </div>
                <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                                <table  id="listoffres" class=" table student-data-table  m-t-20 ">
                                   <thead>
                                      <tr>
                                         <th>@lang('Acquéreur')</th>
                                         <th>@lang('Status')</th>
                                         <th>@lang('Montant offre')</th>
                                         <th>@lang('Montant commission')</th>
                                         <th>@lang('Date de fin')</th>
                                         <th>@lang('Action')</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach($offre as $one)
                                      <tr>
                                          <td>
                                              @if($one->acquereur_type === "App\Models\Acquereur")
                                                <a type="button" href="{{Route('acquereur.show', $one->acquereur->id)}}" target="_blanc" class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel"><i class="ti-eye"></i>voir</a>
                                              @else
                                                <a type="button" href="{{Route('groupeacquereur.show', $one->acquereur_id)}}" target="_blanc" class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel"><i class="ti-eye"></i>voir</a>
                                              @endif
                                          </td>
                                          <td>
                                              @if($one->status === "active")
                                                <span class="badge badge-info">{{$one->status}}</span>
                                              @elseif($one->status === "expirée")
                                                <span class="badge badge-default">{{$one->status}}</span>
                                              @elseif($one->status === "refusée")
                                                <span class="badge badge-danger">{{$one->status}}</span>
                                            @elseif($one->status === "compromis")
                                                <span class="badge badge-success">{{$one->status}}</span>
                                            @endif
                                          </td>
                                         <td>
                                            {{$one->montant_offre}} €
                                         </td>
                                         <td>
                                                {{$one->montant_commission}} € 
                                             </td>
                                         <td>
                                           {{date('d-m-Y',strtotime($one->date_fin))}}
                                         </td>
                                         <td>
                                           <a type="button" href="{{Route('offre.download', $one->id)}}" class="btn btn-primary btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel"><i class="ti-file"></i>PDF</a>
                                         </td>
                                      </tr>
                                      @endforeach
                                   </tbody>
                                </table>
                             </div>
                </div>
             </div>
 
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                   </div>
          </div>
       </div>
    </div>
 </div>