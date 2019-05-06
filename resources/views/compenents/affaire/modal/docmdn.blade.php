<div class="modal fade" id="doc_mandant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><strong>Définir les documents justificatif pour le mandant.</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
               <div class="panel lobipanel-basic panel-success">
                     <div class="panel-heading">
                        <div class="panel-title">Suivi des documents</div>
                     </div>
                     <div class="panel-body">
                        Simplifiez vous la vie en réunissant et verifiant tous les documents du dossier, une fois les documents validés 
                        vous pouvez les envoyer au notaire en un seul clique ce qui accelère considérablement le traitement du dossier 
                        et la signature du compromis et de l'acte de vente.
                     </div>
                  </div>
            <ul class="nav nav-pills">
               <li class="active"><a data-toggle="pill" href="#mdn1">@lang("Ajout de documents")</a></li>
               <li><a data-toggle="pill" href="#mdn2">@lang("Suivi des documents")</a></li>
            </ul>
            <div class="tab-content">
               <div id="mdn1" class="tab-pane fade in active">
                  <div class="form-validation">
                     <form class="form-valide77 form-horizontal" action="{{Route('affaire.docmdn.store', $mandat->dossiervente->id)}}" method="post">
                        @csrf
                        <div class="table-responsive util">
                           <table class=" table student-data-table  m-t-20 ">
                              <tbody>
                                 @if($listdoc != NULL)
                                 @if($tab != NULL)
                                 @foreach($listdoc as $one)
                                 @if(($one[1] === "mandant" || $one[1] === "document-commun") && check($tab, $one) == 1)
                                 @php($det1 = 1)
                                 <tr>
                                    <td style="line-height:0px;">
                                       <label class="col-sm-4 control-label" for="archive_mdn"><strong>{{$one[0]}}</strong></label>
                                    </td>
                                    <td style="line-height:0px;">
                                       <div class="col-lg-2">
                                          <input type="checkbox" unchecked data-toggle="toggle" id="{{$one[0]}}" name="{{$one[0]}}" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                                       </div>
                                    </td>
                                 </tr>
                                 @endif
                                 @endforeach
                                 @else
                                 @foreach($listdoc as $one)
                                 @if(($one[1] === "mandant" || $one[1] === "document-commun"))
                                 @php($det1 = 1)
                                 <tr>
                                    <td style="line-height:0px;">
                                       <label class="col-sm-4 control-label" for="archive_mdn"><strong>{{$one[0]}}</strong></label>
                                    </td>
                                    <td style="line-height:0px;">
                                       <div class="col-lg-2">
                                          <input type="checkbox" unchecked data-toggle="toggle" id="{{$one[0]}}" name="{{$one[0]}}" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="danger">
                                       </div>
                                    </td>
                                 </tr>
                                 @endif
                                 @endforeach
                                 @endif
                                 @endif
                                 @if($det1 == 1)
                                 <tr>
                                    <td></td>
                                    <td style="text-align:center;"><button type="submit" class="btn btn-success push88 btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-folder"></i>valider</button></td>
                                 <tr>
                                 @else
                                 <p style="text-align: center; margin-top: 50px; color:red;">Aucun document disponible, contactez l'administrateur pour ajouter des documents types !</p>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </form>
                  </div>
               </div>
               <div id="mdn2" class="tab-pane fade">
                  <div class="panel lobipanel-basic panel-pink">
                     <div class="panel-heading">
                        <div class="panel-title">Suivi des documents du mandant</div>
                     </div>
                     <div class="panel-body">
                        <h4><strong>Progression du dossier</strong></h4>
                        <br>
                        <div class="progress">
                           <div class="progress-bar progress-bar-success progress-bar-striped w-{{$mandat->dossiervente->dossier_mandant - ($mandat->dossiervente->dossier_mandant % 10)}}" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                              {{$mandat->dossiervente->dossier_mandant}} %
                           </div>
                        </div>
                        <br>
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                           <table  id="listdocmdn" class=" table student-data-table  m-t-20 ">
                              <thead>
                                 <tr>
                                    <th>@lang('Intitulé du document')</th>
                                    <th>@lang('Date d\'ajout')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($tab != NULL)
                                 @foreach($tab as $key=>$one)
                                 <tr>
                                    <td style="padding: 3px 10px;">
                                       {{$one[0]}} 
                                    </td>
                                    <td style="padding: 3px 10px;">
                                       {{$one[1]}}
                                    </td>
                                    <td style="padding: 3px 10px;">
                                       @if($one[2] === "non ajouté")
                                       <span class="badge badge-info">{{$one[2]}}</span>
                                       @elseif($one[2] === "en traitement")
                                       <span class="badge badge-default">{{$one[2]}}</span>
                                       @elseif($one[2] === "rejeté")
                                       <span class="badge badge-danger">{{$one[2]}}</span>
                                       @elseif($one[2] === "validé")
                                       <span class="badge badge-success">{{$one[2]}}</span>
                                       @endif
                                    </td>
                                    <td style="padding: 3px 10px;">
                                       @if($one[2] === "en traitement" || $one[2] === "validé")
                                          <span><a class="show1"  href="#"  title="@lang('Voir')"><i class="large material-icons color-primary">visibility</i></a></span>
                                       @endif   
                                       @if($one[2] === "en traitement")
                                       <span><a class="reject"  href="{{route('affaire.doc.reject',[$mandat->dossiervente->id, $key, $role1])}}"  title="@lang('Rejeter')"><i class="large material-icons color-warning">cancel</i></a></span>
                                          <span><a class="accept"  href="{{route('affaire.doc.accept',[$mandat->dossiervente->id, $key, $role1])}}"  title="@lang('Valider')"><i class="large material-icons color-success">done_outline</i></a></span>
                                       @endif
                                       <span><a class="show1"  href="#"  title="@lang('Supprimer')"><i class="large material-icons color-danger">delete_sweep</i></a></span>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
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