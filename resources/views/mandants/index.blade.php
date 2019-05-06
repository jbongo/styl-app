@extends('layouts.main.dashboard')
@section('header_name')
    Gestion des mendants
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    <div class="row"> 
       
        <div class="col-lg-12">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
             @endif       
            <div class="card alert">
                <!-- table -->
            <a href="{{route('mandant.add')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-user"></i>@lang('Ajouter un mandant')</a>
            <br>
            <br>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-info media-left media-middle">
                                    <i class="ti-user f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Liste des personnes seules') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example2" class=" table student-data-table  m-t-20 "  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('Civilité')</th>                                        
                                        <th>@lang('Nom')</th>
                                        <th>@lang('Prénom')</th>
                                        <th>@lang('Email')</th>
                                     
                                        <th>@lang('Ville')</th>
                                        <th>@lang('Pays')</th>
                                        <th>@lang('création')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($mandants_seuls as $mandant_seul)
                                    <tr>
                                        <td>
                                        {{$mandant_seul->civilite}}
                                        </td>
                                        <td>
                                        {{$mandant_seul->nom}} 
                                        </td>
                                        <td>
                                        {{$mandant_seul->prenom}}
                                        </td>
                                        <td>
                                        {{$mandant_seul->email}} 
                                        </td>
                                        <td>
                                        {{$mandant_seul->ville}}   
                                        </td>
                                        <td>
                                        {{$mandant_seul->pays}} 
                                        </td>                                        
                                        <td>
                                        le {{$mandant_seul->created_at->format('d-m-y')}}                                      
                                        </td>
                                        <td>
                                            <span><a href="{{route('mandant.show',$mandant_seul->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $mandant_seul->nom}} "><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href="{{route('mandants.edit',$mandant_seul->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $mandant_seul->nom}} "><i class="ti-pencil-alt color-success"></i></a></span>
        
                                        <span><a  href="{{route('mandants.delete', $mandant_seul->id)}}" class="delete" data-toggle="tooltip" title="@lang('Supprimer ') {{ $mandant_seul->nom }}"><i class="btn ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                <!-- end table1 -->

            <br>
            <br>
            {{-- table2 --}}
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-success media-left media-middle">
                                    <i class="ti-user f-s-28 color-white"></i><i class="ti-user f-s-28 color-danger"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Liste des couples') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 "  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('Civilité')</th>                                        
                                        <th>@lang('Nom')</th>                                        
                                        <th>@lang('Email')</th>
                                        <th>@lang('Civilité Partenaire')</th>                                        
                                        <th>@lang('Nom Partenaire')</th>                                        
                                        <th>@lang('Email Partenaire')</th>
                                        <th>@lang('création')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($mandants_couples as $mandant_couple)
                                    <tr>
                                        <td>
                                        {{$mandant_couple->civilite}}
                                        </td>
                                        <td>
                                        {{$mandant_couple->nom}} {{$mandant_couple->prenom}}
                                        </td>                                        
                                        <td>
                                        {{$mandant_couple->email}} 
                                        </td>

                                        <td>
                                        {{$mandant_couple->civilite_partenaire}}
                                        </td>
                                        <td>
                                        {{$mandant_couple->nom_partenaire}} {{$mandant_couple->prenom_partenaire}}
                                        </td>                                        
                                        <td>
                                        {{$mandant_couple->email_partenaire}} 
                                        </td>                                                             
                                        <td>
                                        le {{$mandant_couple->created_at->format('d-m-y')}}                                      
                                        </td>
                                        <td>
                                            <span><a href="{{route('mandant.show',$mandant_couple->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $mandant_seul->nom}} "><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href="{{route('mandants.edit',$mandant_couple->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $mandant_couple->nom}} "><i class="ti-pencil-alt color-success"></i></a></span>
        
                                            <span><a  href="{{route('mandants.delete', $mandant_couple->id)}}" class="delete" data-toggle="tooltip" title="@lang('Supprimer ') {{ $mandant_couple->nom }}"><i class="btn ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                <!-- end table2 -->
                

                <br>
            <br>
            {{-- table2 --}}
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-0">
                            <div class="media">
                                <div class="p-5 bg-warning media-left media-middle">
                                    <i class="ti-home f-s-28 color-white"></i>
                                </div>
                                <div class="p-10 media-body">
                                    <h4 class="color-warning m-r-10">@lang('Liste des personnes morales') </h4>
                                    
                                    <div class="progress progress-sm m-t-10 m-b-0">
                                        <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example3" class=" table student-data-table  m-t-20 "  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('Forme juridique')</th>                                        
                                        <th>@lang('Raison sociale')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Adresse')</th>
                                        <th>@lang('Pays')</th>
                                        <th>@lang('Siret')</th>
                                        <th>@lang('création')</th>
                                        <th>@lang('Nombre de contact associés')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($mandants_morales as $mandant_morale)
                                    <tr>
                                        <td>
                                        {{$mandant_morale->forme_juridique}}
                                        </td>
                                        <td>
                                        {{$mandant_morale->raison_sociale}} 
                                        </td>
                                        <td>
                                        {{$mandant_morale->email}}
                                        </td>
                                        <td>
                                        {{$mandant_morale->adresse}},  {{$mandant_morale->code_postal}},  {{$mandant_morale->ville}}
                                        </td>
                                        <td>
                                        {{$mandant_morale->pays}}   
                                        </td>
                                        <td>
                                        {{$mandant_morale->siret}} 
                                        </td>                                        
                                        <td>
                                        le {{$mandant_morale->created_at->format('d-m-y')}}                                      
                                        </td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-dark m-l-10 m-b-10"> <span class="badge">{{$mandant_morale->mandants_associe->count()}}</span></button>
                                        </td>
                                        <td>
                                            <span><a href="{{route('mandant.show',$mandant_morale->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $mandant_seul->nom}} "><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href="{{route('mandants.edit',$mandant_morale->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $mandant_morale->raison_sociale}} "><i class="ti-pencil-alt color-success"></i></a></span>
        
                                            <span><a  href="{{route('mandants.delete', $mandant_morale->id)}}" class="delete" data-toggle="tooltip" title="@lang('Supprimer ') {{ $mandant_morale->raison_sociale }}"><i class="btn ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                <!-- end table3 -->
                
            </div>
        </div>

        <br>
        <br>
        {{-- table4 --}}
        <div class="row">
                <div class="col-lg-12">
                    <div class="card p-0">
                        <div class="media">
                            <div class="p-5 bg-warning media-left media-middle">
                                <i class="ti-home f-s-28 color-white"></i>
                            </div>
                            <div class="p-10 media-body">
                                <h4 class="color-warning m-r-10">@lang('Liste de groupes de personnes') </h4>
                                
                                <div class="progress progress-sm m-t-10 m-b-0">
                                    <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <br>
            <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit !important;">
                        <table  id="example4" class=" table student-data-table  m-t-20 "  style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('Nom du groupe')</th>                                        
                                    <th>@lang('nombre de membres')</th>
                                    <th>@lang('Date de création')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupes as $groupe)
                            
                                    <tr>
                                        <td>
                                            {{$groupe->nom_groupe}}    
                                        </td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-dark m-l-10 m-b-10"> <span class="badge">{{$groupe->mandants->count()}}</span></button>

                                        </td>                                        
                                        <td>
                                        {{$groupe->created_at->format('d-m-y')}} 
                                        </td>                                                           
                                        <td>
                                            <span><a href="{{route('groupemandant.show',$groupe->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $groupe->nom}} "><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href="{{route('groupemandant.edit',$groupe->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $groupe->nom}} "><i class="ti-pencil-alt color-success"></i></a></span>
        
                                            <span><a  href="{{route('groupemandant.delete', $groupe->id)}}" class="delete" data-toggle="tooltip" title="@lang('Supprimer ') {{ $groupe->nom }}"><i class="btn ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                   
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            <!-- end table4 -->
            
        </div>
    </div>

</div>

    
   
@endsection

@section('js-content')

<script>
    $(document).ready(function() {
       $('#example4').DataTable( {
           "language": {
               "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
           }
       } );
   } );
</script>

<script>
        $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.delete').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Voulez-vous vraiment supprimer cette ligne  ?')',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '@lang('Oui')',
            cancelButtonText: '@lang('Non')',
            
        }).then((result) => {
            if (result.value) {
                $('[data-toggle="tooltip"]').tooltip('hide')
                    $.ajax({                        
                        url: that.attr('href'),
                        type: 'POST'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Supprimé!',
                'Cette ligne a bien été supprimé.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'Cette ligne n\'a pas été supprimé :)',
                'error'
                )
            }
        })
            })
        })
    </script>
@endsection