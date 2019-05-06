<div class="modal fade" id="visitelist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Liste des visites</strong></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="panel lobipanel-basic panel-pink">
                <div class="panel-heading">
                   <div class="panel-title">Liste des visites</div>
                </div>
                <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                                <table  id="listvisit" class=" table student-data-table  m-t-20 ">
                                   <thead>
                                      <tr>
                                         <th>@lang('Nom du visiteur')</th>
                                         <th>@lang('Adresse')</th>
                                         <th>@lang('Code postal')</th>
                                         <th>@lang('Ville')</th>
                                         <th>@lang('Date de visite')</th>
                                         <th>@lang('Commentaire')</th>
                                         <th>@lang('Action')</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach($bien->visites as $one)
                                      <tr>
                                         <td>
                                            {{$one->nom_visiteur}} 
                                         </td>
                                         <td>
                                          {{$one->adresse}} 
                                       </td>
                                       <td>
                                          {{$one->code_postal}} 
                                       </td>
                                       <td>
                                          {{$one->ville}} 
                                       </td>
                                         <td>
                                           {{date('d-m-Y',strtotime($one->date_visite))}}
                                         </td>
                                         <td style="max-width: 100px;">
                                                <button class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel" data-toggle="collapse" data-target="{{"#".$one->id}}"><i class="ti-eye"></i>Voir</button>
                                                <div id="{{$one->id}}" class="collapse">
                                                {{$one->commentaires}}
                                                    </div>

                                        </td>
                                         <td>
                                           <a type="button" href="{{Route('visites.destroy', $one->id)}}" class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5 cancel"><i class="ti-trash"></i>Supprimer</a>
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