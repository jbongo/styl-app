@extends('layouts.main.visiteurs')
@extends('compenents.visiteurs.navbar')
@extends('compenents.visiteurs.footer')
@section('content')
<!-- about-bottom -->
<div class="modal fade" id="mem1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel1">Détails du bien</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                 <img src="images/modal.jpg" alt="" class="img-fluid" />
                 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    @foreach ($bien->photosbiens as $item)
                    @if($item->image_position === 1)
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{asset("images/photos_bien/".$item->resized_name)}}">
                    </div>
                    @else
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset("images/photos_bien/".$item->resized_name)}}">
                      </div>
                    @endif
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                 <p><strong>Type: </strong>{{$bien->type_bien}}</p>
                 <p><strong>Surface habitable: </strong>{{$bien->surface_habitable}}m²</p>
                 <p><strong>Nombre de pieces: </strong>{{$bien->nombre_piece}}</p>
                 <p><strong>Code postal: </strong>{{$bien->code_postal}}</p>
                 <p><strong>Ville: </strong>{{$bien->ville}}</p>
                 <br>
              {{-- {{dd($bien->dpe_consommation_diagnostic)}} --}}
              @php($nopdf = 1)
                 
                 <div style="overflow-x:auto;">
                 <table class="table" style="overflow-x:auto;">
                  <tbody>
                    <tr>
                      <td>
                        <p>@include('layouts.dpe', [$nopdf])</p>
                      </td>
                      <td>
                          <p>@include('layouts.ges', [$nopdf])</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
           </div>
        </div>
     </div>
<section class="wthree-row pt-md-5 pt-0">
        <div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
           <h3 class="agile-title text-uppercase">Details du bien</h3>
           <span class="w3-line"></span>
        </div>
        <div class="row justify-content-center align-items-center no-gutters abbot-main">
           <div class="col-lg-6 p-0">
              <img src="{{asset($pict)}}" class="img-fluid" alt="" />
           </div>
           <div class="col-lg-6 p-0 abbot-right">
              <div class="card">
                 <div class="card-body px-sm-5 py-5 px-4">
                    <h3 class="stat-title card-title align-self-center">{{$bien->titre_annonce}}</h3>
                    <span class="w3-line"></span>
                    <p class="card-text align-self-center my-3">{{$bien->description_annonce}}</p>
                    <a data-toggle="modal" data-target="#mem1" class="btn btn-primary abt_card_btn bg-light scroll">Plus de détails</a>
                 </div>
              </div>
           </div>
        </div>
     </section>
    
     <!-- //about bottom -->
     <!--//services  -->
     <!-- services bottom -->
     <div class="serv_bottom py-5">
        <div class="container py-sm-3">
           <div class="d-sm-flex justify-content-around pb-4">
              <h4 class="agile-ser_bot text-capitalize text-white">Prix publique: {{$bien->prix_public}} €</h4>
           </div>
           <hr>
           <h5 class="text-center text-uppercase text-white pt-4">Code postal: {{$bien->code_postal}}</h5>
           <h5 class="text-center text-uppercase text-white pt-4">Ville: {{$bien->ville}}</h5>
        </div>
     </div>
     @guestmandant
     <br><br>
     <nav>
      <div class="nav nav-tabs agile-title text-uppercase" id="nav-tab" role="tablist" style="margin-left:20px;">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><h4>Liste des visites</h4></a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><h4>Liste des offres</h4></a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-profile" aria-selected="false"><h4>Liste des appels</h4></a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
         <section class="wthree-row pt-md-5 pt-0">
            <div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
               <h3 class="agile-title text-uppercase">Mes visites</h3>
               <span class="w3-line"></span>
            </div>
            <div class="row justify-content-center align-items-center no-gutters abbot-main">
               <div class="col-lg-12 p-0 abbot-right">
                  <div class="card">
                     <div class="card-body px-sm-5 py-5 px-4" style="overflow-x:auto;">
                            <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="color: magenta;"><h3>VISITEUR</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>ADRESSE</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>CODE POSTAL</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>VILLE</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>DATE DE VISITE</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>DATE D'AJOUT</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>COMMENTAIRES</h3></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($bien->visites as $one)
                                      <tr>
                                        <th scope="row">{{$one->nom_visiteur}}</th>
                                        <td>{{$one->adresse}}</td>
                                        <td>{{$one->code_postal}}</td>
                                        <td>{{$one->ville}}</td>
                                        <td>{{date('d-m-Y',strtotime($one->date_visite))}}</td>
                                        <td>{{date('d-m-Y',strtotime($one->created_at))}}</td>
                                        <td style="max-width: 100px">
                                            <a class="btn btn-primary" data-toggle="collapse" href="{{"#".$one->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Voir</a>
                                            <div class="row">
                                                <div class="col">
                                                  <div class="collapse multi-collapse" id="{{$one->id}}">
                                                    <div class="card card-body">
                                                        {{$one->commentaires}}
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
         <section class="wthree-row pt-md-5 pt-0">
            <div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
               <h3 class="agile-title text-uppercase">Mes offres d'achat</h3>
               <span class="w3-line"></span>
            </div>
            <div class="row justify-content-center align-items-center no-gutters abbot-main">
               <div class="col-lg-12 p-0 abbot-right">
                  <div class="card">
                     <div class="card-body px-sm-5 py-5 px-4" style="overflow-x:auto;">
                            <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="color: magenta;"><h3>MONTANT DE L'OFFRE</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>FRAIS D'AGENCE</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>STATUS</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>DATE D'AJOUT</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>DATE D'EXPIRATION</h3></th>
                                        <th scope="col" style="color: magenta;"><h3>ACTION</h3></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($offre as $one)
                                      <tr>
                                        <td>{{$one->montant_offre}} €</td>
                                        <td>{{$one->montant_commission}} €</td>
                                        <td>
                                            @if($one->status === "active")
                                            <span class="badge badge-info">{{$one->status}}</span>
                                          @elseif($one->status === "expirée")
                                            <span class="badge badge-warning">{{$one->status}}</span>
                                          @elseif($one->status === "refusée")
                                            <span class="badge badge-danger">{{$one->status}}</span>
                                        @elseif($one->status === "compromis")
                                            <span class="badge badge-success">{{$one->status}}</span>
                                        @endif
                                        </td>
                                        <td>{{date('d-m-Y',strtotime($one->created_at))}}</td>
                                        <td>{{date('d-m-Y',strtotime($one->date_fin))}}</td>
                                        <td>
                                                    <a type="button" href="{{Route('guest.offre.download', $one->id)}}" class="btn btn-info" style="background: magenta; !important">PDF</a>
                                                    @if($one->status === "active")
                                                      <a  type="button" href="{{Route('offre.accept', $one->id)}}" class="btn btn-success accept" style="background: green; !important">Accepter</a>
                                                      <a type="button" href="{{Route('offre.reject', $one->id)}}" class="btn btn-danger reject" style="background: red; !important">Rejeter</a>
                                                    @else
                                                    <button  type="button" class="btn btn-secondary" disabled>Accepter</button>
                                                    <button type="button"  class="btn btn-secondary" disabled>Rejeter</button>
                                                   @endif
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-profile-tab">
            <section class="wthree-row pt-md-5 pt-0">
               <div class="py-sm-5 pt-3 pb-4 bg-pricemain text-center">
                  <h3 class="agile-title text-uppercase">Mes appels</h3>
                  <span class="w3-line"></span>
               </div>
               <div class="row justify-content-center align-items-center no-gutters abbot-main">
                  <div class="col-lg-12 p-0 abbot-right">
                     <div class="card">
                        <div class="card-body px-sm-5 py-5 px-4" style="overflow-x:auto;">
                               <table class="table table-hover">
                                       <thead>
                                         <tr>
                                           <th scope="col" style="color: magenta;"><h3>SOURCE</h3></th>
                                           <th scope="col" style="color: magenta;"><h3>NOM DE L'APPELANT</h3></th>
                                           <th scope="col" style="color: magenta;"><h3>CODE POSTAL</h3></th>
                                           <th scope="col" style="color: magenta;"><h3>DATE D'APPEL</h3></th>
                                           <th scope="col" style="color: magenta;"><h3>COMMENTAIRES</h3></th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                         @foreach($bien->appels as $one)
                                         <tr>
                                           <td>
                                               @if($one->source === "passerelle")
                                               <span class="badge badge-danger">{{$one->source}}</span>
                                             @else
                                               <span class="badge badge-info">{{$one->source}}</span>
                                           @endif
                                           </td>
                                           <td>{{$one->nom_appelant}}</td>
                                           <td>{{$one->code_postal}}</td>
                                           <td>{{date('d-m-Y',strtotime($one->date))}}</td>
                                           <td style="max-width: 100px">
                                                <a class="btn btn-primary" data-toggle="collapse" href="{{"#".$one->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Voir</a>
                                                <div class="row">
                                                    <div class="col">
                                                      <div class="collapse multi-collapse" id="{{$one->id}}">
                                                        <div class="card card-body">
                                                            {{$one->commentaires}}
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </td>
                                         </tr>
                                         @endforeach
                                       </tbody>
                                     </table>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>

     
     
     @endguestmandant
@endsection
@section('js-content')
<script>
    $(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })
        $('[data-toggle="tooltip"]').tooltip()
        $('a.accept').click(function(e) {
            let that = $(this)
            e.preventDefault()
            const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
})

    swalWithBootstrapButtons({
        title: '@lang('Cette acceptation est définitive et va mettre le bien sous compromis et rejeter les autres offres voulez vous continuer ?')',
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
                    type: 'GET'
                })
                .done(function () {
                        that.parents('tr').remove()
                })

            swalWithBootstrapButtons(
            'Validé!',
            'L\'offre est acceptée et le proposant sera notifié dans les plus brefs delais.',
            'success'
            )
            
            .then(function(){
                   window.location.href = "{{route('guest.bien.index')}}";                    })
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
            'Annulé',
            'L\'action a été annulée !',
            'error'
            )
        }
    })
        })

        $('a.reject').click(function(e) {
            let that = $(this)
            e.preventDefault()
            const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
})

    swalWithBootstrapButtons({
        title: '@lang('Cette offre sera définitivement rejetée voulez vous continuer ?')',
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
                    type: 'GET'
                })
                .done(function () {
                        that.parents('tr').remove()
                })

            swalWithBootstrapButtons(
            'Validé!',
            'L\'offre est desormais rejetée.',
            'success'
            )
            
            .then(function(){
                   window.location.href = "{{route('guest.bien.index')}}";                    })
            
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
            'Annulé',
            'L\'action a été annulée !',
            'error'
            )
        }
    })
        })
    })
</script>
@endsection