@extends('layouts.main.pdf')
@section('content')
<div class="container">
        <div  class="row pad-top-botm client-info">
           <div class="col-lg-6 col-md-6 col-sm-6">
              <img src="images/logo.png"> 
           </div>
           <div class="col-lg-6 col-md-3 col-sm-6">
              <h4>  <strong>SARL V4F</strong></h4>
              115 Avenue de la Roquette
              <br />
              30200 BAGNOLE SUR CEZE
              <br />
              <strong>N° Siret:</strong> 800 738 478
           </div>
        </div>
        <div  class="row text-center contact-info">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <hr />
              <span>
              <strong>Email : </strong>  contact@stylimmo.com 
              </span>
              <span>
              <strong>Tél : </strong>  +33666421502
              </span>
              <span>
              <strong>Fax : </strong>  +33142365412 
              </span>
              <hr />
           </div>
        </div>
        <div  class="row pad-top-botm client-info">
           <div class="col-lg-6 col-md-6 col-sm-6">
              <h4>  <strong>Client</strong></h4>
              @if($token == 0)
                <strong>{{$nom}}</strong>
                <br />
                {{$user->adresse}}
                <br />
                {{$user->code_postal}} {{$user->ville}}
              @endif
              @if($token == 1)
                <strong>{{$nom}}</strong>
                <br />
                {{$addr}}
                <br />
                {{$zip}} {{$ville}}
              @endif
           </div>
           <div class="col-lg-6 col-md-3 col-sm-6">
              <h4>  <strong>Details de la facture</strong></h4>
              <strong>Facture N°</strong> #{{$tet->id}}
              <br />
              <strong>Date d'émission:</strong>  {{$time}}
              <br />
              <strong>Paiement sous:</strong> 30 jours maximum.
           </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover">
                    <thead>
                       <tr>
                          <th>Désignation</th>
                          <th>Quantité</th>
                          <th>Prix unitaire H.T</th>
                          <th>Sous-total H.T</th>
                       </tr>
                    </thead>
                    <tbody>
                       @foreach($prod as $one)
                       <tr>
                          <td>{{$one->description}}</td>
                          <td>{{$one->quantite}}</td>
                          <td>{{$one->prix_unitaire_ht}} €</td>
                          <td>{{$one->quantite * $one->prix_unitaire_ht}} €</td>
                       </tr>
                       @endforeach                                  
                    </tbody>
                 </table>
              </div>
              <hr />
              <div class="ttl-amts">
                 <h5>  <strong>TOTAL H.T:</strong> {{$tet->montant_ht}} € </h5>
              </div>
              <hr />
              <div class="ttl-amts">
                 <h5>  <strong>TVA:</strong> 19.6 %</h5>
              </div>
              <hr />
              <div class="ttl-amts">
                 <h4> <strong>TOTAL TTC: {{$tet->montant_ttc}} €</strong> </h4>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <br>  
              <h4>Conditions de paiement:</h4>
              <p>Paiement à réception de facture, à 30 jours...
                 Aucun escompte consenti pour règlement anticipé
                 Tout incident de paiement est passible d'intérêt de retard. Le montant des pénalités résulte de l'application aux sommes restant dues d'un taux d'intérêt légal en vigueur au moment de l'incident.
                 Indemnité forfaitaire pour frais de recouvrement due au créancier en cas de retard de paiement: 40€
              </p>
           </div>
        </div>
        <div style="text-align: center; font-size: 9.5px; margin-right: 25%; margin-left: 25%; margin-top: 30px;">
           <p><strong>SARL V4F</strong> Capital de: 3000 euros RCS de Nime
              Code APE 947A <br> N° TVA Intracom. FR 77825896764000
           </p>
        </div>
     </div>
@endsection