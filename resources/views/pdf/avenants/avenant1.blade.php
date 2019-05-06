@extends('pdf.avenants.container')
@section('append')
<p> </p>
<p> </p>
<p> </p>
<h2><strong>ANNEXE 1</strong><strong>            </strong><sub>Commissionnement direct</sub></h2>
        <p> </p>
        @if($bool_starter == 1)
        <p><strong>    STARTER </strong>(max. <strong>{{$dr_starter->duration_starter}}</strong> mois)<strong> :           {{$dr_starter->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
        <p> </p>
        <p><strong>    EXPERT :                                    </strong><strong>{{$dr_expert->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
        <p> </p>
        @if($dr_starter->palier == 1 && (count($palier_starter) || $last_starter != NULL))
        <p><strong><u>B - 1 Progression du commissionnement STARTER</u></strong></p>
        <p> </p>
        <p>Le pourcentage de base en vigueur sera augmenté en fonction des résultats du mandataire selon les paliers suivants :</p>
        <p> </p>
        
        @foreach($palier_starter as $pl)
        <p>De                     <strong>{{$pl[2]}}</strong> €                             à             <strong>{{$pl[3]}}</strong> € HT de commissions annuelles</p>
        <p><strong>Pourcentage en vigueur + {{$pl[1]}} </strong>%</p>
        @endforeach
        @if($last_starter != NULL)
        <p>De                     <strong>{{$last_starter[2]}}</strong> €                             et            PLUS</p>
        <p><strong>Pourcentage en vigueur + {{$last_starter[1]}} </strong>%</p>
        <p> </p>
        @endif
        @endif
        @endif
        @if($bool_starter == 0)
        <p><strong>    EXPERT :                                    </strong><strong>{{$dr_expert->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
        <p> </p>
        @endif
        @if($dr_expert->palier == 1 && (count($palier_expert) || $last_expert != NULL))
        <p><strong><u>B - 2 Progression du commissionnement EXPERT</u></strong></p>
        <p> </p>
        <p>Le pourcentage de base en vigueur sera augmenté en fonction des résultats du mandataire selon les paliers suivants :</p>
        <p> </p>
        @foreach($palier_expert as $pl1)
        <p>De                     <strong>{{$pl1[2]}}</strong> €                             à             <strong>{{$pl1[3]}}</strong> € HT de commissions annuelles</p>
        <p><strong>Pourcentage en vigueur + {{$pl1[1]}} </strong>%</p>
        @endforeach
        @if($last_expert != NULL)
        <p>De                     <strong>{{$last_expert[2]}}</strong> €                             et            PLUS</p>
        <p><strong>Pourcentage en vigueur + {{$last_expert[1]}} </strong>%</p>
        <p> </p>
        @endif
        @endif
@endsection