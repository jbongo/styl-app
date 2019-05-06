<div class="modal fade" id="leadadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"><strong>Ajouter une fiche contact</strong></h5>
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
                   Remplissez correctement les champs de la fiche contact, tous les champs finissant par <span class="text-danger">*</span> sont obligatoires et vous devez disposer de toutes les informations, une saisie incorrecte entrainera la non validation de la fiche.
                </div>
             </div>
             <br>
             <form class="form-validy8745hgf form-horizontal" action="{{ route('lead.add') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="canal">Choisir le canal source<span class="text-danger">*</span></label>
                   <div class="col-lg-4">
                      <select class="selectpicker col-lg-8" id="canal" name="canal" data-live-search="true" data-style="btn-pink btn-rounded" required>
                         @foreach($canal as $dr)
                         <option  value="{{$dr->id}}" data-tokens="{{$dr->nom_canal}} {{$dr->role}} {{$dr->site_web}}">{{$dr->nom_canal}}</option>
                         @endforeach                                
                      </select>
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="nom">Nom<span class="text-danger">*</span></label>
                   <div class="col-lg-4">
                      <input type="text" id="nom" class="form-control {{$errors->has('nom') ? 'is-invalid' : ''}}" value="{{old('nom')}}" name="nom" placeholder="Ex: Jean Marc..." required>
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
                   <label class="col-sm-4 control-label" for="prenom">Prénom<span class="text-danger">*</span></label>
                   <div class="col-lg-4">
                      <input type="text" id="prenom" class="form-control {{$errors->has('prenom') ? 'is-invalid' : ''}}" value="{{old('prenom')}}" name="prenom" placeholder="Ex: Charle..." required>
                      @if ($errors->has('prenom'))
                      <br>
                      <div class="alert alert-warning ">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>{{$errors->first('prenom')}}</strong> 
                      </div>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="email">Email<span class="text-danger">*</span></label>
                   <div class="col-lg-2">
                      <input type="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}" name="email" placeholder="Ex: test@gmail.com..." required>
                      @if ($errors->has('email'))
                      <br>
                      <div class="alert alert-warning ">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>{{$errors->first('email')}}</strong> 
                      </div>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="telephone">Téléphone<span class="text-danger">*</span></label>
                   <div class="col-lg-2">
                      <input type="text" id="telephone" class="form-control {{$errors->has('telephone') ? 'is-invalid' : ''}}" value="{{old('telephone')}}" name="telephone" placeholder="Ex: 0600030200..." required>
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
                   <label class="col-sm-4 control-label" for="adresse">Adresse</label>
                   <div class="col-lg-4">
                      <input type="text" id="adresse" class="form-control {{$errors->has('adresse') ? 'is-invalid' : ''}}" value="{{old('adresse')}}" name="adresse" placeholder="Ex: 25 Rue Carnot..." required>
                      @if ($errors->has('adresse'))
                      <br>
                      <div class="alert alert-warning ">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>{{$errors->first('adresse')}}</strong> 
                      </div>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="code_postal">Code postal<span class="text-danger">*</span></label>
                   <div class="col-lg-2">
                      <input type="text" id="code_postal" class="form-control {{$errors->has('code_postal') ? 'is-invalid' : ''}}" value="{{old('code_postal')}}" name="code_postal" placeholder="Ex: 30200..." required>
                      @if ($errors->has('code_postal'))
                      <br>
                      <div class="alert alert-warning ">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>{{$errors->first('code_postal')}}</strong> 
                      </div>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="ville">Ville<span class="text-danger">*</span></label>
                   <div class="col-lg-3">
                      <input type="text" id="ville" class="form-control {{$errors->has('ville') ? 'is-invalid' : ''}}" value="{{old('ville')}}" name="ville" placeholder="Ex: Avignon..." required>
                      @if ($errors->has('ville'))
                      <br>
                      <div class="alert alert-warning ">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>{{$errors->first('ville')}}</strong> 
                      </div>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label class="col-sm-4 control-label" for="b_pro">Contact professionnel ?</label>
                   <div class="col-lg-2">
                      <input type="checkbox" unchecked data-toggle="toggle" id="b_pro" name="b_pro" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="default">
                   </div>
                   <div class="bouboule1">
                      <label class="col-sm-4 control-label" for="b_pro_immo">Professionnel de l'immobilier ?</label>
                      <div class="col-lg-2">
                         <input type="checkbox" unchecked data-toggle="toggle" id="b_pro_immo" name="b_pro_immo" data-off="Non" data-on="Oui" data-onstyle="success" data-offstyle="default">
                      </div>
                   </div>
                </div>
                <div class="form-group row" id="bouboule2">
                   <label class="col-sm-4 control-label" for="type_immo">Type immobilier <span class="text-danger">*</span></label>
                   <div class="col-lg-4">
                      <select class="js-select2 form-control" id="type_immo" name="type_immo" required>
                         <option value="agence">Agence</option>
                         <option value="mandataire">Mandataire</option>
                         <option value="autre">Autre</option>
                      </select>
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

 <div class="panel panel-warning m-t-15" id="cont">
    <div class="panel-heading">Listes des contacts.</div>
    <div class="panel-body">
       <!--lead-->
       <div class="col-lg-12">
          <div class="col-lg-4">
             <div class="card bg-success">
                <div class="stat-widget-six">
                   <div class="stat-icon">
                      <i class="material-icons">person_pin</i>
                   </div>
                   <div class="stat-content">
                      <div class="text-left dib">
                         <div class="stat-heading"><strong>Tous les prospects</strong></div>
                         <div class="stat-text"><strong>Total: {{$leads->count()}}</strong></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="card bg-danger">
                <div class="stat-widget-six">
                   <div class="stat-icon">
                      <i class="material-icons">phone_forwarded</i>
                   </div>
                   <div class="stat-content">
                      <div class="text-left dib">
                         <div class="stat-heading"><strong>Prospects contactés</strong></div>
                         <div class="stat-text"><strong>Total: {{$leads->where('contact_etabli', 1)->count()}}</strong></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="card bg-pink">
                <div class="stat-widget-six">
                   <div class="stat-icon">
                      <i class="material-icons">check_circle</i>
                   </div>
                   <div class="stat-content">
                      <div class="text-left dib">
                         <div class="stat-heading"><strong>Prospects qualifiés</strong></div>
                         <div class="stat-text"><strong>Total: {{$leads->where('qualification', 1)->count()}}</strong></div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!--lead-->
       <br>
       <div class="table-responsive" style="overflow-x: inherit !important;">
          <table  id="leadtab" class=" table student-data-table  m-t-20 ">
             <thead>
                <tr>
                   <th>@lang('Nom et prénom')</th>
                   <th>@lang('Canal source')</th>
                   <th>@lang('Téléphone')</th>
                   <th>@lang('Email')</th>
                   <th>@lang('Professionnel')</th>
                   <th>@lang('Contact établi')</th>
                   <th>@lang('Code postal')</th>
                   <th>@lang('Action')</th>
                </tr>
             </thead>
             <tbody>
                @foreach($leads as $one)
                <tr>
                   <td>
                      {{$one->nom}} {{$one->prenom}}
                   </td>
                   <td>
                      <span class="badge badge-pink">{{$one->canalprospection->nom_canal}}</span>
                   </td>
                   <td>
                      {{$one->telephone}}
                   </td>
                   <td>
                      {{$one->email}}
                   </td>
                   <td>
                      @if($one->professionnel == 1)
                      <span class="badge badge-success">oui</span>
                      @else
                      <span class="badge badge-danger">non</span>
                      @endif
                   </td>
                   <td>
                      @if($one->contact_etabli == 1)
                      <span class="badge badge-success">oui</span>
                      @else
                      <span class="badge badge-danger">non</span>
                      @endif                                              
                   </td>
                   <td>
                      {{$one->code_postal}}
                   </td>
                   <td>
                         <span><a class="show1" href="{{ route('lead.show', $one->id) }}" title="@lang('Détails de '){{$one->nom}}"><i class="large material-icons color-primary">visibility</i></a></span>
                      <span><a class="delete_lead"  href="{{ route('lead.delete', $one->id) }}"  title="@lang('Supprimer')"><i class="large material-icons color-danger">delete_sweep</i></a></span>
                   </td>
                </tr>
                @endforeach
             </tbody>
          </table>
       </div>
       <div class="col-md-4 text-center"> 
          <a data-toggle="modal" data-target="#leadadd" class="btn btn-success btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>@lang('Nouvelle fiche')</a>
          <a href="#" class="btn btn-pink btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-server"></i>@lang('Importer')</a>
       </div>
    </div>
 </div>