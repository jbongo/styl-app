@extends('layouts.main.pdf')
@section('content')
<div class="container">
   <div  class="row ">
      <img style="display: inline-block; margin-bottom:43px;" src="images/logo.png"> 
      <div class="col-lg-3" style="font-size: 13px; display: inline-block; margin-left:2px;">
         <h4> <strong>SARL V4F</strong></h4>
         115 Avenue de la Roquette
         <br />
         30200 BAGNOLE SUR CEZE
         <br />
         <strong>N° Siret:</strong> 800 738 478
      </div>
      <div class="col-lg-3" style="font-size: 13px; display: inline-block;width: 200px; margin-left:15px;">
         <h4><strong>{{$auth->civilite}} {{$auth->nom}} {{$auth->prenom}}</strong></h4>
         {{$auth->adresse}}
         <br />
         {{$auth->code_postal}} {{$auth->ville}}
         <br />
         <strong>N° RSAC:</strong> {{$auth->numero_carte_pro}}
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
   <!--core-->
   <div>
      <div>
         <div>
            <br>
            <h1 style="text-align: center;"><strong>OFFRE D’ACHAT</strong></h1>
            <p> </p>
            <br><br>
            <p style="font-size: 13px;"><em>Conformément à l'article 6-2 de la loi du 2 janvier 1970, le titulaire de la carte professionnelle informe le soussigné que ce document lui est présenté par une personne habilitée par lui et exerçant sous le statut d'agent commercial ou de consultant immobilier.</em></p>
         </div>
      </div>
      <div role="main">
         <div tabindex="-1">
            <div tabindex="0" role="document">
               <div>
                  <p> </p>
                  <br><br>
                  <p>Dossier N° : <strong>{{$dossier->numero}} </strong> <br>Affaire suivie par : <strong>{{$auth->civilite}} {{$auth->nom}} {{$auth->prenom}}</strong></p>
                  <p> </p>
                  <br><br>
                  <p><span style="text-decoration: underline; color: #000000;"><strong>Le(s) soussigné(s)</strong></span></p>
                  @if($offre->acquereur_type === "App\Models\Acquereur")
    @if($acquereur->type === "personne_seule")
        <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$acquereur->nom}}</strong>    Prénoms : <strong>{{$acquereur->prenom}}</strong></p>
        <p style="padding-left: 30px;">Adresse : <strong>{{$acquereur->adresse}} {{$acquereur->code_postal}} {{$acquereur->ville}}</strong></p>
        <p style="padding-left: 30px;">Date et lieu de naissance : <strong>{{date('d-m-Y',strtotime($acquereur->date_naissance))}}</strong> à <strong>{{$acquereur->lieu_naissance}}</strong></p>
        <p style="padding-left: 30px;"> </p>
    @endif
    @if($acquereur->type === "couple")
        <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$acquereur->nom}}</strong>    Prénoms : <strong>{{$acquereur->prenom}}</strong></p>
        <p style="padding-left: 30px;">Adresse : <strong>{{$acquereur->adresse}} {{$acquereur->code_postal}} {{$acquereur->ville}}</strong></p>
        <p style="padding-left: 30px;">Date et lieu de naissance : <strong>{{date('d-m-Y',strtotime($acquereur->date_naissance))}}</strong></p>
        <p style="padding-left: 30px;"><strong>et</strong></p>
        <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$acquereur->nom_partenaire}}</strong>    Prénoms : <strong>{{$acquereur->prenom_partenaire}}</strong></p>
        <p style="padding-left: 30px;">Adresse : <strong>{{$acquereur->adresse_partenaire}} {{$acquereur->code_postal_partenaire}} {{$acquereur->ville_partenaire}}</strong></p>
        <p style="padding-left: 30px;">Date et lieu de naissance : <strong>{{date('d-m-Y',strtotime($acquereur->date_naissance_partenaire))}}</strong> à <strong>{{$acquereur->lieu_naissance_partenaire}}</strong></p>
    @endif
    @if($acquereur->type === "personne_morale")
        <p style="padding-left: 30px;">Raison sociale : <strong>{{$acquereur->forme_juridique}}</strong> nom: <strong>{{$acquereur->raison_sociale}}</strong>    Adresse légale: <strong>{{$acquereur->adresse_morale}} {{$acquereur->code_postal_morale}} {{$acquereur->ville_morale}}</strong></p>
        <p style="padding-left: 30px;"><span style="text-decoration: underline;">Membres de l'organisation:</span></p>
        @foreach($acquereur->acquereurs_associe as $one)
            <p style="padding-left: 90px;">Mr(Mme) : <strong>{{$one->civilite}} {{$one->nom}}</strong>     Prénoms : <strong>{{$one->prenom}}</strong></p>
        @endforeach
    @endif
@else
    <p style="padding-left: 30px;">Groupe de personnes suivantes :</p>
    <p style="padding-left: 30px;"><span style="text-decoration: underline;">Membres de l'organisation:</span></p>
    @foreach($acquereur->acquereurs as $one)
        <p style="padding-left: 90px;">Mr(Mme) : <strong>{{$one->civilite}} {{$one->nom}}</strong>     Prénoms : <strong>{{$one->prenom}}</strong></p>
        @endforeach
@endif
                  <p> </p>
                  <p><em><strong>dénommé(s) le (les) promettant(s),</strong></em></p>
                  <p>Reconnait (reconnaissent) avoir visité, avec le concours de STYL'IMMO, et votre intervention et s’engage(nt) à acheter, en cas d’acceptation de la présente offre, de façon ferme et irrévocable le bien désigné ci- dessous :</p>
                  <p> </p>
                  <br><br>
                  <h3 style="text-align: center;"><strong><span style="color: #0000ff;">LE BIEN</span></strong></h3>
                  <p style="padding-left: 30px;"><span style="text-decoration: underline;"><strong>Mandat et emplacement:</strong></span></p>
                  <p style="padding-left: 30px;">Cadastré section : <strong>{{$bien->reference_cadastrale_terrain}}</strong>   Adresse : <strong>{{$bien->adresse_bien_secteur}} {{$bien->code_postal}} {{$bien->ville}} </strong>   Surface habitable: <strong>{{$bien->surface_habitable}} M² </strong></p>
                  <p style="padding-left: 30px;">Surface terrain : <strong>{{$bien->surface_terrain}} M²</strong>    Numéro du mandat : <strong>{{$mandat->numero}} </strong>   Type du bien :<strong> {{$bien->type_bien}}</strong></p>
                  <p style="padding-left: 30px;"> </p>
                  <p style="padding-left: 30px;"><span style="text-decoration: underline;"><strong>Description du bien :</strong></span></p>
                  <p style="padding-left: 30px;">{{$bien->description_annonce}}</p>
                  <br><br>
                  @if($pict1 != NULL && $pict2 != NULL)<p style="padding-left: 30px;"><img src="{{$pict1}}" alt="" width="347" height="230" /><img src="{{$pict2}}" width="347" height="230" /></p>@endif
                  <p style="padding-left: 30px;"> </p>
                  <p> </p>
                  <p style="padding-left: 30px;"><strong>Bien appartenant à :</strong></p>
                  @if($mandat->role_mandant === "personne_seule")
                  <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$mandant->nom}}</strong>    Prénoms : <strong>{{$mandant->prenom}}</strong></p>
                  <p style="padding-left: 30px;">Adresse : <strong>{{$mandant->adresse}} {{$mandant->code_postal}} {{$mandant->ville}}</strong></p>
                  <p style="padding-left: 30px;">Date et lieu de naissance : <strong>{{date('d-m-Y',strtotime($mandant->date_naissance))}} à {{$mandant->lieu_naissance}}</strong></p>
                  <p style="padding-left: 30px;"> </p>
                  @endif
                  @if($mandat->role_mandant === "couple")
                  <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$mandant->nom}}</strong>    Prénoms : <strong>{{$mandant->prenom}}</strong></p>
                  <p style="padding-left: 30px;">Adresse : <strong>{{$mandant->adresse}} {{$mandant->code_postal}} {{$mandant->ville}}</p>
                  <p style="padding-left: 30px;">Date et lieu de naissance : {{date('d-m-Y',strtotime($mandant->date_naissance))}}</strong></p>
                  <p style="padding-left: 30px;"><strong>et</strong></p>
                  <p style="padding-left: 30px;">Mr(Mme) : <strong>{{$mandant->nom_partenaire}}</strong>    Prénoms : <strong>{{$mandant->prenom_partenaire}}</strong></p>
                  <p style="padding-left: 30px;">Adresse : <strong>{{$mandant->adresse_partenaire}} {{$mandant->code_postal_partenaire}} {{$mandant->ville_partenaire}}</strong></p>
                  <p style="padding-left: 30px;">Date et lieu de naissance : <strong>{{date('d-m-Y',strtotime($mandant->date_naissance_partenaire))}}</strong> à <strong>{{$mandant->lieu_naissance_partenaire}}</strong></p>
                  @endif
                  @if($mandat->role_mandant === "personne_morale")
                  <p style="padding-left: 30px;">Raison sociale : <strong>{{$mandant->forme_juridique}}</strong> nom: <strong>{{$mandant->raison_sociale}}</strong>    Adresse légale: <strong>{{$mandant->adresse_morale}}</strong></p>
                  <p style="padding-left: 30px;"><span style="text-decoration: underline;">Membres de l'organisation:</span></p>
                  @foreach($mandant->mandants_associe as $one)
                    <p style="padding-left: 90px;">Mr(Mme) : <strong>{{$one->civilite}} {{$one->nom}}</strong>     Prénoms : <strong>{{$one->prenom}}</strong></p>
                  @endforeach
                  @endif
                  @if($mandat->role_mandant === "groupe")
                  <p style="padding-left: 30px;">Groupe de personnes suivantes :</p>
                  <p style="padding-left: 30px;"><span style="text-decoration: underline;">Membres de l'organisation:</span></p>
                  @foreach($mandant->mandants as $one)
                    <p style="padding-left: 90px;">Mr(Mme) : <strong>{{$one->civilite}} {{$one->nom}}</strong>     Prénoms : <strong>{{$one->prenom}}</strong></p>
                  @endforeach
                  @endif
                  <p> </p>
                  <p><em><strong>dénommé(s) le (les) vendeur(s),</strong></em></p>
                  <p> </p>
                  <p><strong>Prix :</strong></p>
               </div>
               <div>
                  <p>L’offre d’achat est faite au prix de <strong>{{$offre->montant_offre}}</strong> € (FAI) soit: <strong>{{$letter_offre}}</strong> euros frais d'agence inclus qui sera payé intégralement le jour de la signature de l’acte authentique de vente.</p>
                  <p> </p>
                  <p>Le montant des frais d'agence est fixé à <strong>{{$offre->montant_commission}}</strong> € (TTC) soit: <strong>{{$letter_commission}}</strong> euros, les frais d'agence seront à la charge de: <strong>{{$offre->charge_commission}}</strong></p>
                  <br><br>
                  <h3 style="text-align: center;"><span style="color: #0000ff;"><strong>CONDITIONS SUSPENSIVES</strong></span></h3>
                  <p>Cette offre est faite sous conditions suspensives :</p>
                  <p>{{$offre->conditions_suspensives}}</p>
                  <p>- absence de servitude susceptible d’affecter l’usage et la propriété du bien vendu.</p>
                  <p>- le promettant devra être vivant au jour de la signature de l’acte authentique.</p>
                  <p> </p>
                  <br><br>
                  <h3 style="text-align: center;"><span style="color: #0000ff;"><strong>EXTINCTION DE L'OFFRE:</strong></span></h3>
                  <p>En l’absence d’acceptation de la présente offre, celle-ci s’éteindra le <strong>{{date('d-m-Y',strtotime($offre->date_fin))}}</strong> à minuit.</p>
                  <p> </p>
                  <br><br>
                  <p> </p>
                  <br><br>
                  <p> </p>
                  <br><br>
                  <table>
                     <tbody>
                        <tr>
                           <td style="width: 420px;">
                              <p> </p>
                              <p>Fait à : <strong>BAGNOLS SUR CEZE</strong></p>
                              <p>Le proposant</p>
                              <p style="font-size: 13px;"><em>Lu et approuvé, bon pour achat.</em></p>
                              <p> </p>
                           </td>
                           </td>
                           <td>
                           </td>
                           <td style="width: 480px;">
                              <p style="text-align: left;"><strong>{{$timetamps}}</strong></p>
                              <p style="text-align: left;">Le vendeur</p>
                              <p style="text-align: left;font-size: 13px;"><em>Lu et approuvé, bon pour vente.</em></p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div aria-live="polite" aria-atomic="true"> </div>
   <!--end-->
   <div style="text-align: center; font-size: 9.5px; margin-right: 25%; margin-left: 25%; margin-top: 30px;">
      <p> </p>
      <br><br>
      <p> </p>
      <br><br>
      <p><strong>SARL V4F</strong> Capital de: 3000 euros RCS de Nime
         Code APE 947A <br> N° TVA Intracom. FR 77825896764000
      </p>
   </div>
</div>
@endsection