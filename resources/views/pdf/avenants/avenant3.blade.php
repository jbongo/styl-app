@extends('pdf.avenants.container')
@section('append')
<h2><strong>ANNEXE 3</strong><strong>            Engagement à payer</strong></h2>
        <p> </p>
        <p><strong><u>FORFAIT MENSUEL</u></strong> :</p>
        <p> </p>
        @if($bool_starter == 1)
        <ul>
        <li><strong><u>FORFAIT MENSUEL « STARTER »</u></strong><strong>rémunération à {{$dr_starter->pourcentage_depart}}%</strong> :</li>
        </ul>
        <p>Ce forfait comprend : suivi/conseil + formations + outils informatiques + outils publicitaires.</p>
        <p>Le prix mensuel du forfait STARTER est de :</p>
        <ul>
        <li><strong>{{$abn_starter->tarif}}</strong> € H.T.</li>
        </ul>
        <p>Le forfait STARTER est valable au maximum les <strong>{{$dr_starter->duration_starter}}</strong> premiers mois suivant la date début d’activité.</p>
        <p>Au <strong>{{$dr_starter->duration_starter + 1}}</strong>è mois le mandataire passe automatiquement au forfait EXPERT .</p>
        <p> </p>
        @endif
        <ul>
        <li><strong><u>FORFAIT MENSUEL « EXPERT »</u></strong><strong>rémunération à {{$dr_expert->pourcentage_depart}}% : </strong></li>
        </ul>
        <p>Ce forfait comprend : suivi/conseil + formations + outils informatiques + outils publicitaires.</p>
        <p>Prix mensuel du forfait EXPERT (à compter du démarrage d’activité) :</p>
        <ul>
        <li><strong>{{$abn_expert->tarif}}</strong> € H.T.</li>
        </ul>
        <p>La rémunération à <strong>{{$dr_expert->pourcentage_depart}}</strong>% est acquise pour les 12 premiers mois d’activité. Pour la suite elle est soumise à conditions :</p>
        <ul>
        <li>Le mandataire a réalisé au moins <strong>{{$dr_expert->minimum_vente}}</strong> ventes. à N-1.</li>
        <li>Il a parrainé au moins <strong>{{$dr_expert->minimum_fileuls}}</strong> filleul avec signature d'un contrat à N-1.</li>
        <li>Il a réalisé un chiffre d'affaire d'au moins <strong>{{$dr_expert->minimum_chiffre_affaire}}</strong>€ H.T à N-1.</li>
        </ul>
        <p>À défaut, le pourcentage de rémunération sera de <strong>{{$dr_expert->pourcentage_depart - $dr_expert->sub_pourcentage}}</strong>% pour l’année N.</p>
@endsection