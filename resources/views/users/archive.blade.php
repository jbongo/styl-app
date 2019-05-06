@extends('layouts.main.dashboard')
@section('header_name')
    Modification des archives
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('pageActuelle')
 @lang('utilisateurs archivés')
@endsection
@section('content')
    <div class="row"> 
       
        <div class="col-lg-12 col-md-12">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
             @endif       
            <div class="card alert">
                <!-- table -->
            
                
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 "  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('Civilité')</th>                                        
                                        <th>@lang('Nom')</th>
                                        <th>@lang('Prénom')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Téléphone')</th>
                                        <th>@lang('Ville')</th>
                                        <th>@lang('Adresse')</th>
                                        <th>@lang('Role')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                        {{$user->civilite}}
                                        </td>
                                        <td>
                                        {{$user->nom}} 
                                        </td>
                                        <td>
                                        {{$user->prenom}}
                                        </td>
                                        <td>
                                        {{$user->email}} 
                                        </td>
                                        <td>
                                        {{$user->telephone}} 
                                        </td>
                                        <td>
                                        {{$user->ville}}   
                                        </td>
                                        <td>
                                        {{$user->adresse}} 
                                        </td>                                        
                                        <td>
                                            @if($user->role =="admin")
                                                @php($color = "danger")
                                            @elseif($user->role =="mandataire")
                                                @php($color = "success")
                                            @elseif($user->role =="personnel")
                                                @php($color = "warning")
                                            @elseif($user->role =="prospect")
                                                @php($color = "info")
                                            @elseif($user->role =="prospect_plus")
                                                @php($color = "default")
                                            @endif
                                        <span class="badge badge-{{$color}}">{{$user->role}}</span>
                                          
                                        </td>
                                        <td>
                                            <span><a href="{{route('user.show',$user->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $user->nom }}"><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href="{{route('user.edit',$user->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $user->nom }}"><i class="ti-pencil-alt color-success"></i></a></span>
        
                                        <span><a  href="{{route('user.archive',[$user->id,0])}}" class="delete" data-toggle="tooltip" title="@lang('Restaurer ') {{ $user->nom }}"><i class="btn ti-reload color-danger"></i> </a></span>
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
            title: '@lang('Voulez-vous vraiment restaurer cet utilisateur  ?')',
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
                        type: 'PUT'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Restauré!',
                'L\'utilisateur a bien été restauré.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'utlisateur n\'a pas été restauré :)',
                'error'
                )
            }
        })
            })
        })
    </script>
@endsection