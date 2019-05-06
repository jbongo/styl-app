<div class="panel panel-pink m-t-15">
        <div class="panel-heading">Abonnements rattachés aux packs et applicables pendant la génération des contrats.</div>
        <div class="panel-body">

<div class="table-responsive" style="overflow-x: inherit !important;">
    <table  id="ex3" class=" table student-data-table  m-t-20 ">
        <thead>
            <tr>
                <th>@lang('Rattaché au plan')</th>
                <th>@lang('Nom')</th>                                        
                <th>@lang('Tarif mensuel')</th>
                <th>@lang('Nombre d\'annonces')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ab as $ab)
            <tr>
                    <td>
                            @if($ab->pack_type == "Starter")
                                @php($color = "pink")
                            @elseif($ab->pack_type == "Expert")
                                @php($color = "primary")
                            @endif 
                            <span class="badge badge-{{$color}}">{{$ab->pack_type}}</span>                                                  
                            </td>
                <td>
                        {{$ab->nom}}
                </td>
                <td>
                        {{$ab->tarif}}€
                </td>
                <td>
                        {{$ab->nombre_annonces}}
                </td>                                       
                <td>
                        <span><a href="{{route('abonnement.edit',$ab->id)}}" data-toggle="tooltip" title="@lang('Modifier '){{$ab->nom}}"><i class="large material-icons color-success">edit</i></a></span>
                        <span><a href="{{route('abonnement.delete',$ab->id)}}" class="abn-delete" data-toggle="tooltip" title="@lang('Supprimer '){{$ab->nom}}"><i class="large material-icons color-danger">delete</i></a></span>
                    </td>
            </tr>
            @endforeach
      </tbody>
    </table>
</div>
<div class="col-md-4 text-center"> 
        <a href="{{route('abonnement')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-file"></i>@lang('Ajouter un abonnement')</a>
    </div>
</div>
</div>