@extends('layouts.main.dashboard')
@section('header_name')
    Dans quel(s) portail(s) souhaitez-vous afficher cette annonce?
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    <div class="row">
        <br />
        <div>
            Portails accessibles par abonnement
        </div>
        <div class="col-lg-12">
                @if (session('ok'))
       
                <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
                </div>
                @endif       
            <div class="card-body">
                <img src="{{asset("images/passerelles/bienicidirect.png")}}" >
                <img src="{{asset("images/passerelles/immofrance.png")}}" >
                <img src="{{asset("images/passerelles/leboncoin.png")}}" >
                <img src="{{asset("images/passerelles/lesclesdumidi.png")}}" >
                <img src="{{asset("images/passerelles/logicimmo.png")}}" >
                <img src="{{asset("images/passerelles/paruvendu.png")}}" >
                <img src="{{asset("images/passerelles/seloger.png")}}" >
            </div>
        </div>
    </div>
        <br />
        <div>
            Portails sans abonnement
        </div>
            <div class="col-lg-12">
            @if (session('ok'))
   
            <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <a href="#" class="alert-link"><strong> {{ session('ok') }}</strong></a> 
            </div>
             @endif       
            <div class="card-body">
                <img src="{{asset("images/passerelles/alliancehabitat.png")}}" >
                <img src="{{asset("images/passerelles/acquereur.png")}}" >
                <img src="{{asset("images/passerelles/nidski.png")}}" >
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