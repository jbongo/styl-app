<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>annex4</title>
    <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even) {
                background-color: #dddddd;
            }
    </style>
</head>
<body>
        <h1><strong>ANNEXE 4</strong><strong>            Barème d'honoraires</strong></h1>
        <p> </p>
        <table>
        <tbody>
        <tr>
        <td>
        <p  style="text-align: center;"><strong>Prix de vente</strong></p>
        </td>
        <td>
        <p  style="text-align: center;"><strong>Honnoraires</strong></p>
        </td>
        </tr>
        <tr>
        <td>
        <p style="text-align: center;">De: <strong>{{$first[0]}}</strong>€                 à               <strong>{{$first[1]}}</strong>€</p>
        </td>
        <td>
        <p style="text-align: center;">Forfait de <strong>{{$first[2]}}</strong>€ </p>
        </td>
        </tr>

        @foreach($palier as $pl)
        <tr>
                <td>
                <p style="text-align: center;">De: <strong>{{$pl[0]}}</strong>€                 à               <strong>{{$pl[1]}}</strong>€</p>
                </td>
                <td>
                @if($pl[2] == 0)
                    <p style="text-align: center;">Pourcentage Maximum de <strong>{{$pl[3]}}</strong>% </p>
                @endif
                @if($pl[3] == 0)
                    <p style="text-align: center;">Forfait Maximum de <strong>{{$pl[2]}}</strong>€</p>
                @endif
                </td>
                </tr>
                @endforeach
                <td>
                        <p style="text-align: center;">De: <strong>{{$last[0]}}</strong>€                 et               <strong>plus</strong></p>
                        </td>
                        <td>
                            <p style="text-align: center;">Pourcentage Maximum de <strong>{{$last[1]}}</strong>% </p>
                        </td>
                        </tr>

        </tbody>
        </table>
        <p> </p>
                        <p>Le MANDATAIRE s'engage à ne pas dépasser ou modifier ce barème à la hausse mais pourra cependant accorder des remises à la clientèle sur le montant des commissions prévues au dit barème.</p>
                        <p> </p>
        <p> </p>
        <table>
        <tbody>
        <tr>
        <td style="margin-right: 40px;">
        <p> </p>
        <p>Fait en deux exemplaires    à : BAGNOLS SUR CEZE</p>
        <p>Gérant(e) <strong>{{$society->nom_prenom_gerant}}</strong> </p>
        <p>LE MANDANT (paraphe) :</p>
        <p> </p>
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