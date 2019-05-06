            <!-- Modal -->
      <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                       
                <div class="col-md-6">
                        <div class="panel panel-primary m-t-4">
                                <div class="panel-heading">Details du model</div>
                                <div class="panel-body">
                                    <strong>Pourcentage de départ: </strong><span  id="init-percent"></span> %
                                <br>
                                    <strong>Gratuit pendant: </strong><span id="free-duration"></span> mois
                                <br>
                                    <span id="starter"><strong>Durée du pack starter: </strong><span id="duration"></span> mois</span>
                                <br>
                                <br>
                                    <div class="well" id="expert"><h4>Détails supplémentaires pack expert</h4>
                                <br>
                                    <strong>Minumum de vente: </strong><span id="min-vnt"></span> 
                                <br>
                                    <strong>Minimum de fileuls: </strong><span id="min-fll"></span>
                                <br>
                                    <strong>Chiffre d'affaire minimum: </strong><span id="min-chf"></span> €
                                <br>
                                    <strong>Pourcentage à déduire du départ: </strong><span id="dd-prct"></span> %
                                <br>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="card p-0">
                                    <div class="media">
                                        <div class="p-20 bg-warning media-left media-middle">
                                            <i class="ti-layout f-s-48 color-white"></i>
                                        </div>
                                        <div class="p-20 media-body">
                                            <h4><strong id="pkg-type"></strong></h4>
                                            <h5 id="nom"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>

            <div classe ="row" id="palier-container">
                <div class="col-sm table-responsive">
                <h3>Paliers</h3>
                <br>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Niveau du palier</th>
                            <th scope="col">Gain en pourcentage %</th>
                            <th scope="col">Chiffre d'affaire min</th>
                            <th scope="col">Chiffre d'affaire max</th>
                          </tr>
                        </thead>
                        <tbody class="data-palier">
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
<div class="panel panel-danger m-t-15">
        <div class="panel-heading">Models de rémunération directe applicables pendant la génération des contrats de mandataires.</div>
        <div class="panel-body">
   
   <div class="table-responsive" style="overflow-x: inherit !important;">
    <table  id="ex1" class=" table student-data-table  m-t-20 ">
        <thead>
            <tr>
                <th>@lang('Type du plan')</th>
                <th>@lang('Nom')</th>                                        
                <th>@lang('Pourcentage de départ')</th>
                <th>@lang('Système de paliers')</th>
                <th>@lang('Durée de la gratuitée')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($direct as $direct)
            <tr>
                <td>
                @if($direct->pack_type == "Starter")
                    @php($color = "pink")
                @elseif($direct->pack_type == "Expert")
                    @php($color = "primary")
                @endif 
                <span class="badge badge-{{$color}}">{{$direct->pack_type}}</span>                                                  
                </td>
                <td>
                        {{$direct->nom}}
                </td>
                <td>
                        {{$direct->pourcentage_depart}}%
                </td>
                @if($direct->palier == 1)
                    @php($palier = "success")
                    <td>
                            <span class="badge badge-{{$palier}}">Oui</span> 
                    </td>
                @elseif($direct->palier == 0)
                    @php($palier = "danger")
                    <td>
                            <span class="badge badge-{{$palier}}">Non</span> 
                        </td>
                @endif
                
                <td>
                        {{$direct->duration_gratuitee}} mois
                </td>                                       
                <td>
                    <span><a class="show1" id="{{$direct->id}}" href="#" data-toggle="modal" data-target="#modal1" title="@lang('Détails de '){{$direct->nom}}"><i class="large material-icons color-primary">visibility</i></a></span>
                    <span><a href="{{route('direct.edit',$direct->id)}}" data-toggle="tooltip" title="@lang('Modifier '){{$direct->nom}}"><i class="large material-icons color-success">edit</i></a></span>
                    <span><a href="{{route('direct.delete',$direct->id)}}" class="delete-direct" data-toggle="tooltip" title="@lang('Supprimer '){{$direct->nom}}"><i class="large material-icons color-danger">delete</i></a></span>
                </td>
            </tr>
            @endforeach
      </tbody>
    </table>
</div>
<div class="col-md-4 text-center"> 
        <a href="{{route('direct')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-file"></i>@lang('Ajouter un model')</a>
    </div>

</div>
</div>