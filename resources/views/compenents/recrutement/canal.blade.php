<!--canal add-->
<div class="modal fade" id="canaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter un canal</strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                 <div class="panel lobipanel-basic panel-warning">
                    <div class="panel-heading">
                       <div class="panel-title">Attention</div>
                    </div>
                    <div class="panel-body">
                       Remplissez correctement les champs de la fiche, tous les champs finissant par <span class="text-danger">*</span> sont obligatoires et vous devez disposer de toutes les informations, une saisie incorrecte entrainera la non validation de la fiche.
                    </div>
                 </div>
                 <br>
                 <form class="form-validy8745hgf form-horizontal" action="{{ route('canal.add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row" id="bouboule2">
                            <label class="col-sm-4 control-label" for="type">Type du canal <span class="text-danger">*</span></label>
                            <div class="col-lg-4">
                               <select class="js-select2 form-control" id="type" name="type" required>
                                  <option value="canal_virtuel">Canal virtuel</option>
                                  <option value="canal_physique">Canal physique</option>
                               </select>
                            </div>
                         </div>
                    <div class="form-group row">
                       <label class="col-sm-4 control-label" for="nom_canal">Nom du canal<span class="text-danger">*</span></label>
                       <div class="col-lg-4">
                          <input type="text" id="nom_canal" class="form-control {{$errors->has('nom_canal') ? 'is-invalid' : ''}}" value="{{old('nom_canal')}}" name="nom_canal" placeholder="Ex: Salon immobilier Avignon..." required>
                          @if ($errors->has('nom_canal'))
                          <br>
                          <div class="alert alert-warning ">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>{{$errors->first('nom_canal')}}</strong> 
                          </div>
                          @endif
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-sm-4 control-label" for="site_web">Site web</label>
                       <div class="col-lg-4">
                          <input type="url" id="site_web" class="form-control {{$errors->has('site_web') ? 'is-invalid' : ''}}" value="{{old('site_web')}}" name="site_web" placeholder="Ex: http//wwww.facebook.fr">
                          @if ($errors->has('site_web'))
                          <br>
                          <div class="alert alert-warning ">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>{{$errors->first('site_web')}}</strong> 
                          </div>
                          @endif
                       </div>
                    </div>
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                 <button type="submit" class="btn btn-success">valider</button>
              </div>
              </form>
           </div>
        </div>
     </div>
<!--canal add-->

<div class="panel panel-pink m-t-15" id="cont">
    <div class="panel-heading">Listes des cannaux de recrutement.</div>
    <div class="panel-body">
       <!--lead-->
       <div class="col-lg-12">
          <div class="col-lg-4">
            <div class="card">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-magnet f-s-48 color-danger"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h4>{{$canal->count()}}</h4>
                        <h6><strong>Tous les cannaux</strong></h6>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-anchor f-s-48 color-success"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h4>{{$canal->where('type', "canal_physique")->count()}}</h4>
                        <h6><strong>Cannaux Physiques</strong></h6>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="ti-control-shuffle f-s-48 color-primary"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h4>{{$canal->where('type', "canal_virtuel")->count()}}</h4>
                        <h6><strong>Cannaux virtuels</strong></h6>
                    </div>
                </div>
            </div>
          </div>
       </div>
       <!--lead-->
       <br>
       <div class="table-responsive" style="overflow-x: inherit !important;">
          <table  id="canaltab" class=" table student-data-table  m-t-20 ">
             <thead>
                <tr>
                   <th>@lang('Type du canal')</th>
                   <th>@lang('Nom du canal')</th>
                   <th>@lang('Nombre de prospects')</th>
                   <th>@lang('Site web')</th>
                   <th>@lang('Action')</th>
                </tr>
             </thead>
             <tbody>
                @foreach($canal as $one)
                <tr>
                   <td>
                    <span class="badge badge-warning">{{$one->type}}</span>
                   </td>
                   <td>
                      {{$one->nom_canal}}
                   </td>
                   <td>
                      <strong style="color: brown;">{{$one->leads->count()}}</strong>
                   </td>
                   <td>
                    <span><a href="{{$one->site_web}}" target="_blanc"><i class="large material-icons color-danger">visibility</i></a></span>
                   </td>
                   <td>
                        <span><a href="{{ route('canal.show', $one->id) }}" title="@lang('Détails de '){{$one->nom_canal}}"><i class="large material-icons color-primary">donut_small</i></a></span>
                   </td>
                </tr>
                @endforeach
             </tbody>
          </table>
       </div>
       <div class="col-md-4 text-center"> 
          <a data-toggle="modal" data-target="#canaladd" class="btn btn-warning btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Nouveau canal')</a>
       </div>
    </div>
 </div>