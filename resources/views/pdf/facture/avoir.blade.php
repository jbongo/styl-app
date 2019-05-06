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
                <strong>{{$tet->nom}}</strong>
                <br />
                {{$tet->adresse}}
                <br />
                {{$tet->code_postal}} {{$tet->ville}}
           </div>
           <div class="col-lg-6 col-md-3 col-sm-6">
              <h4>  <strong>Facture d'avoir</strong></h4>
              <strong>Facture N°</strong> #{{$new->id}}
              <br />
              <strong>N° de la facture originale</strong> #{{$tet->id}}
              <br />
              <strong>Date d'émission de l'avoir:</strong>  {{$time}}
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
                 <h5>  <strong>TOTAL DE LA FACTURE ORIGINALE H.T:</strong> {{$tet->montant_ht}} € </h5>
              </div>
              <hr />
              <div class="ttl-amts">
                 <h5>  <strong>TVA:</strong> 19.6 %</h5>
              </div>
              <hr />
              <div class="ttl-amts">
                 <h5> <strong>TOTAL DE LA FACTURE ORIGINALE TTC: {{$tet->montant_ttc}} €</strong> </h5>
              </div>
              <div class="ttl-amts">
                    <h5> <strong>MONTANT DE L'AVOIR TTC: {{$new->montant_ttc}} €</strong> </h5>
              </div>
              <div class="ttl-amts">
                    <h4> <strong>TOTAL TTC APRES DEDUCTION DE L'AVOIR: {{$tet->montant_ttc - $new->montant_ttc}} €</strong> </h4>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <br>  
              <h4>Raisons de l'avoir:</h4>
              <p>{{$msg}}</p>
           </div>
        </div>
        <div style="text-align: center; font-size: 9.5px; margin-right: 25%; margin-left: 25%; margin-top: 30px;">
           <p><strong>SARL V4F</strong> Capital de: 3000 euros RCS de Nime
              Code APE 947A <br> N° TVA Intracom. FR 77825896764000
           </p>
        </div>
     </div>
@endsection