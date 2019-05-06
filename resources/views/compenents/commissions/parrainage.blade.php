            <!-- Modal -->
            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                
                            <div class="row">
                                   
                            <div class="col-md-12">
                                    <div class="panel panel-primary m-t-4">
                                            <div class="panel-heading">Details du model</div>
                                            <div class="panel-body">
                                                <strong>Non du plan: </strong><span  id="pln-name"></span>
                                            </br>
                                                <strong>Si mandataire à 100% Prime forfitaire: </strong><span id="pln-100"></span> €
                                            </br>
                                                <strong>Pourcentage de la premiere année: </strong><span id="yr0"></span> %
                                            </br>
                                                <span><strong>Nombres d'années d'évolution: </strong><span id="pln-duration"></span> ans</span>
                                            </br>
                                            </br>
                                            </div>
                                        </div>
                                    </div>

                        </div>
            
                        <div classe ="row" id="palier-container-pln">
                            <div class="col-sm table-responsive">
                            <h3>Plan de rémunération par année</h3>
                            Au dela du nombre d'années d'évolution, le pourcentage de rémuneration indirecte est fixé à une valeure définitive.
                        </br></br>    
                            <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Année</th>
                                        <th scope="col">Pourcentage minimum %</th>
                                        <th scope="col">Pourcentage maximum %</th>
                                        <th scope="col">Chiffre d'affaire requis €</th>
                                      </tr>
                                    </thead>
                                    <tbody class="data-palier-1">
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
            <!--modal-->

<div class="panel panel-info m-t-15">
        <div class="panel-heading">Models de parrainage applicables pendant la génération des contrats de mandataires.</div>
        <div class="panel-body">
   

<div class="table-responsive" style="overflow-x: inherit !important;">
    <table  id="ex2" class=" table student-data-table  m-t-20 ">
        <thead>
            <tr>
                <th>@lang('Nom du plan')</th>                                        
                <th>@lang('Nombre d\'années')</th>
                <th>@lang('Prime mandataire 100 %')</th>
                <th>@lang('Pourcentage premiere année')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($parrainage as $parrainage)
            <tr>
                <td>
                    {{$parrainage->nom}}
                </td>
                <td>
                    {{$parrainage->nombre_annee}}
                </td>
                <td>
                    {{$parrainage->forfait_100percent}} €
                </td>
                <td>
                    {{$parrainage->pourcentage_annee1}} %
                </td>                                    
                <td>
                        <span><a class="show2" id="{{$parrainage->id}}" href="#" data-toggle="modal" data-target="#modal2" title="@lang('Détails de '){{$parrainage->nom}}"><i class="large material-icons color-primary">visibility</i></a></span>
                        <span><a href="{{route('parrainage.edit',$parrainage->id)}}" data-toggle="tooltip" title="@lang('Modifier ')toto"><i class="large material-icons color-success">edit</i></a></span>
                        <span><a href="{{route('parrainage.delete',$parrainage->id)}}" class="prng-delete" data-toggle="tooltip" title="@lang('Supprimer ')toto"><i class="large material-icons color-danger">delete</i></a></span>
                </td>
            </tr>
            @endforeach
      </tbody>
    </table>
</div>
<div class="col-md-4 text-center"> 
        <a href="{{route('parrainage')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-file"></i>@lang('Ajouter un model')</a>
    </div>
</div>
</div>