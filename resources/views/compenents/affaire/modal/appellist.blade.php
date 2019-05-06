<div class="modal fade" id="appellist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Liste des appels</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-danger">
                <div class="panel-heading">
                   <div class="panel-title">Liste des appels</div>
                </div>
                <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                                <table  id="listappel" class=" table student-data-table  m-t-20 ">
                                   <thead>
                                      <tr>
                                         <th>@lang('Source')</th>
                                         <th>@lang('Nom de l\'appelant')</th>
                                         <th>@lang('Code postal')</th>
                                         <th>@lang('Date de l\'appel')</th>
                                         <th>@lang('Commentaires')</th>
                                         <th>@lang('Action')</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach($bien->appels as $one)
                                      <tr>
                                         <td>
                                             @if($one->source === "passerelle")
                                                <span class="badge badge-danger">{{$one->source}}</span>
                                             @else
                                                <span class="badge badge-info">{{$one->source}}</span>
                                            @endif
                                         </td>
                                         <td>
                                          {{$one->nom_appelant}} 
                                       </td>
                                       <td>
                                          {{$one->code_postal}} 
                                       </td>
                                         <td>
                                           {{date('d-m-Y',strtotime($one->date))}}
                                         </td>
                                         <td style="max-width: 100px;">
                                                <button class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel" data-toggle="collapse" data-target="{{"#".$one->id}}"><i class="ti-eye"></i>Voir</button>
                                                <div id="{{$one->id}}" class="collapse">
                                                {{$one->commentaires}}
                                                    </div>

                                        </td>
                                         <td>
                                           <a type="button" href="{{Route('appels.destroy', $one->id)}}" class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel"><i class="ti-trash"></i>Supprimer</a>
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