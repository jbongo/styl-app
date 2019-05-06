@extends('layouts.main.dashboard')
@section('header_name')
    Contacts
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
            <div class="card">
                <!-- table -->
            <a href="{{route('partners.add')}}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5"><i class="ti-user"></i>@lang('Ajouter un contact')</a>
                
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 ">
                                <thead>
                                    <tr>
                                        <th>@lang('Type')</th>
                                        <th>@lang('Civilité')</th>                                        
                                        <th>@lang('Nom')</th>
                                        <th>@lang('Prénom')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Téléphone')</th>
                                        <th>@lang('Ville')</th>
                                        <th>@lang('Adresse')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td>
                                            @php($color = "pink")
                                            <span class="badge badge-{{$color}}">{{$partner->type}}</span>                                                  
                                        </td>
                                        <td>
                                        {{$partner->civilite}}
                                        </td>
                                        <td>
                                        {{$partner->nom}} 
                                        </td>
                                        <td>
                                        {{$partner->prenom}}
                                        </td>
                                        <td>
                                        {{$partner->email}} 
                                        </td>
                                        <td>
                                        {{$partner->telephone}} 
                                        </td>
                                        <td>
                                        {{$partner->ville}}   
                                        </td>
                                        <td>
                                        {{$partner->adresse}} 
                                        </td>                                        
                                        <td>
                                            <span><a href="{{route('user.show',$partner->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $partner->nom }}"><i class="ti-eye color-default"></i></a></span>
                                            <span><a href="{{route('partners.edit',$partner->id)}}" data-toggle="tooltip" title="@lang('Modifier '){{ $partner->nom }}"><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href="#" class="delete" data-toggle="tooltip" title="@lang('Supprimer '){{ $partner->nom }}"><i class="btn ti-trash color-danger"></i></a></span>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                <!-- end table -->
            </div>
        </div>

    </div>

    
   
@endsection

@section('js-content')
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
            title: '@lang('Vraiment supprimer cet utilisateur  ?')',
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
                        type: 'DELETE'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Supprimé!',
                'L\'utilisateur a bien été supprimé.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'utlisateur n\'a pas été supprimé :)',
                'error'
                )
            }
        })
            })
        })
    </script>
@endsection