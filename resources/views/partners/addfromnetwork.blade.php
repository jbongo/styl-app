@extends('layouts.main.dashboard')
@section('header_name')
    Ajouter des contacts via un réseau
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
                
                <div class="card-body">
                        <div class="table-responsive" style="overflow-x: inherit !important;">
                            <table  id="example" class=" table student-data-table  m-t-20 ">
                                <thead>
                                    <tr>
                                        <th>@lang('Role')</th>
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
                                @foreach ($data as $single)
                                    <tr>
                                        <td>
                                            @php($color = "default")
                                            <span class="badge badge-{{$color}}">{{$single->role}}</span>                                                  
                                        </td>
                                        <td>
                                        {{$single->civilite}}
                                        </td>
                                        <td>
                                        {{$single->nom}} 
                                        </td>
                                        <td>
                                        {{$single->prenom}}
                                        </td>
                                        <td>
                                        {{$single->email}} 
                                        </td>
                                        <td>
                                        {{$single->telephone}} 
                                        </td>
                                        <td>
                                        {{$single->ville}}   
                                        </td>
                                        <td>
                                        {{$single->adresse}} 
                                        </td>
                                        <td>
                                            <form action="{{route('partners.addfromnetwork',$single->id)}}" method="POST">
                                                @csrf
                                                    <button type="submit" class="btn btn-warning btn-flat btn-addon m-b-10 m-l-5"><i class="ti-plus"></i>Ajouter</button>
                                            </form>
                                               
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
       /* $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.ajax-add').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Voulez vous ajouter ce mandataire à votre liste ?')',
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
                'Ajouté!',
                'Le mandataire a été ajouté à vos contacts',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'Le mandataire n\'a pas été ajouté !',
                'error'
                )
            }
        })
            })
        })*/
    </script>
@endsection