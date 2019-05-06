@extends('layouts.main.dashboard')
@section('header_name')
    Liste des notifications
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('pageActuelle')
Mes notifications
@endsection
@section('content')

                <div class="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card alert">
                                    <div class="product-2-details">
                                        <table class="table" id="example" style="width:100%">
                                            <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                    
                                                 @foreach (auth()->user()->Notifications as $notification)
                                                 {{$notification->markAsRead()}}

                                                
                                                 <li>
                                                 <tr>                                                    
                                           
                                                    
                                                    <td>
                                                      
                                                        <div class="product-2-img ">
                                                            <img height="55px" width="60px" src="{{asset('/images/photo_profile/'.$notification->data['photo'])}}" alt="" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="" >
                                                            <div class="product_name">
                                                                <h4>{{$notification->data['nom_user']}} {{$notification->data['prenom_user']}}</h4>
                                                            </div>
                                                            <div class="product_des">
                                                                <p>{{$notification->data['message']}}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td  >
                                                        <div class="">
                                                                 @lang('le')  {{$notification->data['date']}}
                                                        </div>
                                                      
                                                    </td>
                                                    <td>
                                                        <div class="button">
                                                            <div class="prdt_add_to_cart">

                                                            <a  id="{{$notification->id}}" class="del-notif btn btn-danger btn-btn btn-rounded m-b-10 m-l-5">@lang('Supprimer')</a>
                                                            @if(Auth::user()->role == "admin" || Auth::user()->role == "personnel")
                                                                <a href="{{route('user.show',$notification->data['id_user'])}}" class="btn btn-primary btn-lg btn-rounded m-b-10 m-l-5">@lang('Voir')</a>
                                                            @endif
                                                            @if(Auth::user()->role == "prospect_plus" || Auth::user()->role == "mandataire")
                                                                <a href="{{route('user.profile')}}" class="btn btn-primary btn-lg btn-rounded m-b-10 m-l-5">@lang('Voir')</a>
                                                            @endif
                                                        </div>
                                                        </div>
                                                    </td>
                                                
                                                 </tr>
                                                 @endforeach

                                               
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    
                                                </tr>
                                            </tfoot>
                                        </table>

                                       
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>                                
                
                    </div>


                    <!-- /# main content -->
@endsection

@section('js-content')

<script>
        $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })

            $('a.del-notif').click(function(e) {
                let that = $(this)
                e.preventDefault()
                const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
})

        swalWithBootstrapButtons({
            title: '@lang('Voulez-vous vraiment supprimer cette notif  ?')',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '@lang('Oui')',
            cancelButtonText: '@lang('Non')',
            
        }).then((result) => {
            if (result.value) {
                // $('[data-toggle="tooltip"]').tooltip('hide')
                    $.ajax({                        
                        url:   'notif/'+that.attr('id')+'/delete',
                        type: 'GET'
                    })
                    .done(function () {
                            that.parents('tr').remove()
                    })

                swalWithBootstrapButtons(
                'Supprimé!',
                'La notif a bien été supprimé.',
                'success'
                )
                
                
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                'Annulé',
                'La notif n\'a pas été supprimé :)',
                'error'
                )
            }
        })
            })
        })
</script>

@endsection