@extends('layouts.main.dashboard')
@section('header_name')
    Utilisateurs
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('pageActuelle')
@lang('Paramètre des utilisateurs')
@endsection
@section('content')
<div class="row"> 

    <div class="col-lg-12">
                    <div class="card p-0">
                        <div class="media">
                            <div class="p-20 bg-warning media-left media-middle">
                                <i class="ti-pencil f-s-48 color-white"></i>
                            </div>
                            <div class="p-20 media-body">
                                <h4 class="color-warning m-r-10">@lang('Modifier le rôle des utilisateurs') </h4>
                                
                                <div class="progress progress-sm m-t-10 m-b-0">
                                    <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
       
    <div class="col-lg-12">
            @if (session('ok'))
   
            <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
            </div>
         @endif       
        <div class="card alert">
            <!-- table -->
                    
            <div class="card-body" id="contenu">
                    <div class="table-responsive" style="overflow-x: inherit !important;">
                        <table  id="example" class=" table student-data-table  m-t-20 "  style="width:100%">
                            <thead>
                                <tr>                                     
                                    <th>@lang('Nom')</th>
                                    <th>@lang('Prénom')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Role')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
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
                                        <span>
                                            <a class="btn btn-lg testo" href="#" id="{{$user->id}}"  data-toggle="modal"  data-target="#add-category" title="@lang('Modifier le rôle de  ') {{ $user->nom }}">
                                                    <i class="ti-pencil-alt color-success"></i>
                                            </a>
                                        </span>
                                   
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

<!-- BEGIN MODAL -->

<!-- Modal Add Category -->
<div class="modal fade none-border" id="add-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>@lang('Modifier un rôle') </strong></h4>
            </div>
            <div class="modal-body">
                <form id="formRole">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">@lang('Utilisateur')</label>
                            <p id="nomPrenom" ></p>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">@lang('Choisissez un rôle')</label>
                            <span > </span>
                            <select class="form-control form-white" data-placeholder="choisir un role." name="role">
                        <option value="admin">Administrateur </option>
                        <option value="personnel">Personnel</option>
                        <option value="mandataire">Mandataire</option>
                        <option value="prospect_plus">Prospect plus</option>
                        <option value="prospect">Prospect</option>
                    </select>
                        </div>
                    </div>
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="user_id" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('Fermer')</button>
                <button type="button" id="sauvegarder" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">@lang('Sauvegarder')</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->



{{-- <div class="row"> 

        <div class="col-lg-12">
            <div class="card p-0">
                <div class="media">
                    <div class="p-20 bg-danger media-left media-middle">
                        <i class="ti-pencil f-s-48 color-white"></i>
                    </div>
                    <div class="p-20 media-body">
                        <h4 class="color-warning m-r-10">@lang('Modifier les permissions des rôles') </h4>
                        
                        <div class="progress progress-sm m-t-10 m-b-0">
                            <div class="progress-bar boxshadow-none  bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           
        <div class="col-lg-10 col-md-10">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
             @endif       
            <div class="card alert">
                <!-- table -->
                        
    
                <!-- end table -->
            </div>
        </div>
    
    </div> --}}


@endsection

@section('js-content')

<script>

$(document).ready(function(){

    $('.testo').on('click',function(){
        
        var id = $(this).attr('id') ;
        $.ajax({
            url: '/role_update/'+id,
            type: 'GET',
            dataType: 'text',
            success: function(data, statut){
                var user = JSON.parse(data);
                $('#nomPrenom').html(user[0].nom+' '+user[0].prenom);
                $('#user_id').attr('value',user[0].id);
            },
            error: function(resultat,statut,erreur){
                console.log(resultat+'le statut'+statut);
                
            }

        });

    });

 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        $('#sauvegarder').click(function(){

            var user_id = $('#user_id').attr('value') ;
            var data = $('#formRole').serialize();
            console.log(data);
                $.ajax({
                    url: '/role_update/'+user_id,
                    type: 'PATCH',
                    // data: 'role=admin',
                    data:  data,
                    success: function(data, statut){
                        console.log(data);
                    $('#contenu').load(" #contenu");
                        
                       
                    },
                    error: function(resultat,statut,erreur){
                        console.log(resultat+'le statut'+erreur);
                        
                    }

                });
                
        });
    });
</script>
@endsection