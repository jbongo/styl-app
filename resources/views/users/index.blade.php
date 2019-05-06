@extends('layouts.main.dashboard')
@section('header_name')
    Gestion des utilisateurs
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
            <a href="{{route('users.add')}}" class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-user"></i>@lang('Nouvel utilisateur')</a>
                
                <div class="card-body">
                        <div class="panel panel-info m-t-15" id="cont">
                                <div class="panel-heading">Listes des utilisateurs.</div>
                                <div class="panel-body">
                                        <div class="col-lg-4">
                                                <div class="card bg-pink">
                                                   <div class="stat-widget-six">
                                                      <div class="stat-icon">
                                                         <i class="material-icons">person_pin</i>
                                                      </div>
                                                      <div class="stat-content">
                                                         <div class="text-left dib">
                                                            <div class="stat-heading"><strong>Tous les utilisateurs</strong></div>
                                                            <div class="stat-text"><strong>Total: 22</strong></div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="card bg-danger">
                                                   <div class="stat-widget-six">
                                                      <div class="stat-icon">
                                                            <i class="material-icons">person_pin</i>
                                                      </div>
                                                      <div class="stat-content">
                                                         <div class="text-left dib">
                                                            <div class="stat-heading"><strong>Mandataires</strong></div>
                                                            <div class="stat-text"><strong>Total: 22</strong></div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="card bg-warning">
                                                   <div class="stat-widget-six">
                                                      <div class="stat-icon">
                                                         <i class="material-icons">check_circle</i>
                                                      </div>
                                                      <div class="stat-content">
                                                         <div class="text-left dib">
                                                            <div class="stat-heading"><strong>Autres</strong></div>
                                                            <div class="stat-text"><strong>Total: 22</strong></div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <br><br>
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 "  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('Avatar')</th>                                        
                                        <th>@lang('Nom')</th>
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
                                                <img class="img-thumbnail" style="object-fit: cover; width: 100px; height: 100px; border: 2px solid #8ba2ad; border-style: solid; border-radius: 20px; padding: 3px;" src="{{asset('/images/photo_profile/'.(($user->photo_profile) ? $user->photo_profile : (($user->civilite ==="M.") ? "user.png" : "user_f.png")))}}" alt="" />
                                        </td>
                                        <td>
                                        {{$user->nom}} {{$user->prenom}}
                                        </td>
                                        <td style="color: #32ade1; text-decoration: underline;">
                                        <strong>{{$user->email}}</strong> 
                                        </td>
                                        <td style="color: #e05555;; text-decoration: underline;">
                                            <strong> {{$user->telephone}}</strong> 
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
                                            @elseif($user->role == "formateur" || $user->role == "intervenant")
                                                @php($color = "pink")
                                            @elseif($user->role == "prospect_plus")
                                                @php($color = "default")
                                            @endif
                                        <span class="badge badge-{{$color}}">{{$user->role}}</span>
                                          
                                        </td>
                                        <td>
                                            <span><a href="{{route('user.show',$user->id)}}" data-toggle="tooltip" title="@lang('Détails de ') {{ $user->nom }}"><i class="large material-icons color-info">visibility</i></a> </span>
                                            <span><a href="{{route('user.edit',$user->id)}}" data-toggle="tooltip" title="@lang('Modifier ') {{ $user->nom }}"><i class="large material-icons color-warning">edit</i></a></span>
        
                                        <span><a  href="{{route('user.archive',[$user->id,1])}}" class="delete" data-toggle="tooltip" title="@lang('Archiver ') {{ $user->nom }}"><i class="large material-icons color-danger">delete</i> </a></span>
                                        </td>
                                    </tr>
                            @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
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
            title: '@lang('Vraiment archiver cet utilisateur  ?')',
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
                'Archivé!',
                'L\'utilisateur a bien été archivé.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'L\'utlisateur n\'a pas été archivé :)',
                'error'
                )
            }
        })
            })
        })
    </script>
@endsection