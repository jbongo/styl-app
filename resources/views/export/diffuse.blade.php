@extends('layouts.main.dashboard')
@section('header_name')
    Exporter ou Retirer des annonces sur les portails
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
            <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit !important;">
                        <table  id="example" class=" table student-data-table  m-t-20 "  style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('#')</th>                                        
                                    <th>@lang('')</th>                
                                    <th>@lang('')</th>                
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($biens as $bien)
                                <tr>
                                    <td width="20%">

                                    @foreach($bien->photosbiens as $photos)
                                      
                                    <img src="{{asset("imagesxx/".$photos->resized_name)}}" width="200px" height="150px" alt="">  
                                        @break
                                    @endforeach
                                   

                                    </td>
                                    <td  width="60%">
                                   
                                        <h4>
                                            <b> {{$bien->type_type_bien}}</b>  
                                            @if($bien->type_type_bien != "terrain")
                                            - {{$bien->nombre_piece}} @lang('pièces') 
                                            @endif
                                            - {{$bien->surface_habitable}} @lang('m²')
                                        </h4>
                                        
                                        <h5> {{$bien->ville}} ({{$bien->code_postal}})</h5><br><br>
                                        <h6> {{$bien->titre_annonce}}</h6>
                                    </td>
                                                    
                                    <td>
                                        <h4><b> <span style="color:blue">{{$bien->prix_public}} @lang('€')</b> </span> </h4>
                                        <h6>@lang('Ajouté le '){{$bien->created_at->format("d-m-y")}} </h6>
                                        </h5>
                                        <h6>
                                            @if(isset($bien->numero_dossier))
                                                @lang('Dossier n° '){{$bien->numero_dossier}} 
                                            @else
                                            @lang('Pas de n° de dossier ')
                                            @endif
                                        </h6>

                                    </td>
                                    <td>
                                        @php
                                             $bien_id = Crypt::encrypt($bien->id);
                                        @endphp
                                        <span><a href="{{route('bien.show',$bien_id)}}" data-toggle="tooltip" title="@lang('Détails') {{ $bien->nom }}">
                                        <img src="{{asset("images/fleche-direction.jpg")}}" width="70px" height="150px" alt="">  

                                        </a> </span>
    
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
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