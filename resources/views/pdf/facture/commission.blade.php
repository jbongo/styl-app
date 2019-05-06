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
              <strong>Fax : </strong>  +33442365412 
              </span>
              <hr />
           </div>
        </div>
        <div  class="row pad-top-botm client-info">
           <div class="col-lg-6 col-md-6 col-sm-6">
              <h4>  <strong>Client</strong></h4>
                <strong>{{$user->nom.' '.$user->prenom}}</strong>
                <br />
                {{$user->adresse}}
                <br />
                {{$user->code_postal}} {{$user->ville}}
           </div>
           <div class="col-lg-6 col-md-3 col-sm-6">
              <h4>  <strong>Details de la facture</strong></h4>
              <strong>Facture N°</strong> #{{$facture->id}} <strong style="color: red">(Réf à rappeler)</strong>
              <br />
              <strong>Date d'émission:</strong>  {{$time}}
              <br />
              <strong>Paiement le:</strong> Jour de la signature de l'acte.
           </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <h4>TRANSACTION VENTE</h4>
              <hr />
              <p>En l'Etude de: <strong>{{$notaire->notaire->nom}}</strong> rendez-vous le : <strong>{{date('d-m-Y',strtotime($mandat->dossiervente->rendez_vous_acte))}}</strong> Mandat N° <strong>{{$mandat->numero}}</strong> Affaire suivie par: <strong>{{$auth->civilite}} {{$auth->nom}} {{$auth->prenom}}</strong></p>
              <p>Vendeur: <strong>{{$mandant->civilite}} {{$mandant->nom}} {{$mandant->prenom}}</strong></p>
              <p>Acquéreur: <strong>{{$offre->acquereur->civilite}} {{$offre->acquereur->nom}} {{$offre->acquereur->prenom}}</strong></p>
              <div class="ttl-amts" style="height: 14px">
                 <h5>  <strong>TOTAL H.T:</strong> {{$facture->montant_ht}} € </h5>
              </div>
              <hr />
              <div class="ttl-amts" style="height: 14px">
                 <h5>  <strong>TVA:</strong> 20.00 %</h5>
              </div>
              <hr />
              <div class="ttl-amts" style="height: 14px">
                 <h5> <strong>TOTAL TTC: {{$facture->montant_ttc}} €</strong> </h5>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
              <br>  
              <h4>Conditions de paiement:</h4>
              <p>
                  Au plus tard le jour de la signature de l'acte athentique, par virement à la SARL
                  V4F, en rappelant au moins sur l'objet du virement les références de la facture.
              </p>
              <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="width: 632px;">
                            <thead>
                            <tr style="height: 18px;">
                            <th style="height: 18px;">DOMICILIATION BANCAIRE: Credit Mutuel</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="height: 18px;">
                            <th style="height: 18px;">RIB: 10278 7941 00020227203 08</th>
                            </tr>
                            <tr style="height: 18px;">
                            <th>IBAN: FR76102 78079 41000 2022 720308</th>
                            </tr>
                            <tr style="height: 8px;">
                            <th style="height: 8px;">BIC: CMCIFR2A</th>
                            </tr>
                            </tbody>
                            </table>
                 </div>
           </div>
        </div>
        <div style="text-align: center; font-size: 9.5px; margin-right: 25%; margin-left: 25%; margin-top: 30px;">
           <p><strong>SARL V4F</strong> Capital de: 3000 euros RCS de Nime
              Code APE 947A <br> N° TVA Intracom. FR 77825896764000
           </p>
        </div>
     </div>
@endsection