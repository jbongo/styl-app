<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>annex5</title>
</head>
<body>
        <h1><strong>ANNEXE 5</strong><strong>            Immatriculation RSAC</strong></h1>
        <p> </p>
        <p><strong><u>IMMATRICULATION RSAC</u></strong> :</p>
        <p>Les articles R 134-6 à R 134-17 et A 134-1 à A 134-5 du Code de commerce font obligation à l’agent commercial de s’inscrire au registre spécial des agents commerciaux.<br class="autobr" />Il s’agit d’une mesure de police professionnelle assurant à l’égard des tiers la publicité des informations relatives à l’activité de l’agent.</p>
        <p>Le registre spécial des agents commerciaux est tenu par les greffes des tribunaux de commerce. L’agent doit s’inscrire auprès du greffe dans le ressort duquel il a son domicile professionnel.</p>
        <p><strong>{{$user->nom}} {{$user->prenom}} </strong>déclare étre immatriculé(e) au Registre spécial des agents commercieaux tenu au greffe du tribunal de commerce de <strong>{{$user->nom_organisme_delivrant_carte_pro}}</strong></p>
        <ul>
        <li>Numéro d'immatriculation: <strong>{{$user->numero_carte_pro}}</strong></li>
        <li>Date d'immatriculation: <strong>{{$user->date_delivrance_carte_pro}}</strong></li>
        </ul>
        <p> </p>
        <p><strong><u>ASUURANCE RESPONSABILITE CIVILE PROFESSIONNELLE</u></strong> :</p>
        <p>La Loi ALUR a introduit dans la Loi HOGUET, en 2014, de nouvelles dispositions concernant l’obligation de souscrire une assurance RCP pour les agents commerciaux.</p>
        <p>Une assurance Responsabilité Civile Professionnelle Immobilier est destinée aux professionnels de l’immobilier. Elle permet de garantir les conséquences financières découlant d’un préjudice causé volontairement ou involontairement par un agent immobilier.</p>
        <p><strong>{{$user->nom}} {{$user->prenom}} </strong>déclare avoir contracté une assurance de responsabilité civile </p>
        <ul>
        <li>Numéro d'assurance: <strong>{{$user->numero_assurance}}</strong></li>
        <li>Garant: <strong>{{$user->nom_organisme_assurance}}</strong></li>
        </ul>
        <p> </p>
        <table>
        <tbody>
        <tr>
        <td>
        <p> </p>
        <p>Fait en deux exemplaires    à : BAGNOLS SUR CEZE</p>
        <p>Gérant(e) <strong>{{$society->nom_prenom_gerant}}</strong> </p>
        <p>LE MANDANT (paraphe) :</p>
        <p> </p>
        </td>
        <td style="width: 60px;">
        </td>
    </td>
    <td style="width: 80px;">
    </td>
        <td>
        <p style="text-align: left;">le : <strong>{{$timetamps}}</strong></p>
        <p style="text-align: left;">M(Mme):<strong> {{$user->nom}} {{$user->prenom}}</strong></p>
        <p style="text-align: left;">LE MANDATAIRE (paraphe) :</p>
        </td>
        </tr>
        </tbody>
        </table>
</body>