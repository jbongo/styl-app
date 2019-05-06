<div class="panel panel-pink m-t-15">
   <div class="panel-heading">Listes des contrats contrats actifs et générés.</div>
   <div class="panel-body">
      <div class="table-responsive" style="overflow-x: inherit !important;">
         <table  id="actif" class=" table student-data-table  m-t-20 ">
            <thead>
               <tr>
                  <th>@lang('Mandataire')</th>
                  <th>@lang('Numéro du contrat')</th>
                  <th>@lang('Immatriculation RSAC')</th>
                  <th>@lang('Numéro RSAC')</th>
                  <th>@lang('Date d\'entrée')</th>
                  <th>@lang('Début d\'activité')</th>
                  <th>@lang('Action')</th>
               </tr>
            </thead>
            <tbody>
               @foreach($contrat as $ab)
               <tr>
                  @foreach($user as $us)
                  @if($us->id == $ab->user_id) 
                  <td>
                     {{$us->nom}} {{$us->prenom}}
                  </td>
                  @endif
                  @endforeach    
                  <td>
                     {{$ab->numero_contrat}}
                  </td>
                  @foreach($user as $us)
                  @if($us->id == $ab->user_id)
                  @if($us->bool_annex_5 == 0)
                  <td>
                     <span class="badge badge-danger">non</span>                                                  
                  </td>
                  @endif
                  @if($us->bool_annex_5 == 1 && $ab->verif_rsac == 0)
                  <td>
                     <span class="badge badge-warning">oui</span>
                     <a type="button" href="https://www.infogreffe.fr" target="_blanc" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-link"></i>Infogreffe</a>                                                 
                  </td>
                  @endif
                  @if($us->bool_annex_5 == 1 && $ab->verif_rsac == 1)
                  <td>
                     <span class="badge badge-success">oui</span>
                  </td>
                  @endif
                  @endif
                  @endforeach
                  
                  @foreach($user as $us)
                  @if($us->id == $ab->user_id)
                  <td>
                     {{$us->numero_carte_pro}}                                                
                  </td>
                  @endif
                  @endforeach
                  
                  <td>
                     {{date('d-m-Y',strtotime($ab->date_entree))}}
                  </td>
                  <td>
                     {{date('d-m-Y',strtotime($ab->date_debut_activitee))}}
                  </td>
                  <td>
                     <span><a class="det1" id="{{$ab->id}}" href="{{route('contrat.show',$ab->id)}}" title="@lang('Détails de '){{$ab->id}}"><i class="large material-icons color-primary">visibility</i></a></span>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>