<div class="panel panel-pink m-t-15">
        <div class="panel-heading">Listes des agents ayant un profile complet, vous pouvez desormais proceder à la génération de leurs contrats.</div>
        <div class="panel-body">
           <div class="table-responsive" style="overflow-x: inherit !important;">
              <table  id="inactif" class=" table student-data-table  m-t-20 ">
                 <thead>
                    <tr>
                       <th>@lang('Agent')</th>
                       <th>@lang('Situation familliale')</th>
                       <th>@lang('Statut juridique')</th>
                       <th>@lang('Nationnalité')</th>
                       <th>@lang('Numéro siret')</th>
                       <th>@lang('Date d\'ajout')</th>
                       <th>@lang('Action')</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($inactif as $us)
                    <tr>
                       <td>
                          {{$us->nom}} {{$us->prenom}}
                       </td>
                       <td>
                            {{$us->situation_matrimoniale}}
                        </td>
                        <td>
                            {{$us->statut_juridique}}
                        </td>
                        <td>
                            {{$us->nationnalite}}
                        </td>
                        <td>
                            {{$us->numero_siret}}
                        </td>
                       <td>
                          {{date('d-m-Y',strtotime($us->created_at))}}
                       </td>
                       <td>
                            <a type="button" href="{{route('contrat.add',Crypt::encryptString($us->id))}}"class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i>Générer le contrat</a>
                       </td>
                    </tr>
                    @endforeach
                 </tbody>
              </table>
           </div>
        </div>
     </div>