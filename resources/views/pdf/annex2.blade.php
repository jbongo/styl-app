<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>annex2</title>
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
        <h1><strong>ANNEXE 2</strong><strong>            Barème du parrainage</strong></h1>
        <p> </p>
        <p><strong><u>Rémunération associée aux agents (filleuls) présentés au réseau</u></strong> </p>
        <p> </p>
        <p>Elle correspond à un pourcentage sur le chiffre d’affaires H.T. (honoraires d’agence) réalisé par un nouvel agent (le filleul) que le mandataire parrain a présenté au réseau. Le droit à ce commissionnement est soumis aux barème suivant:</p>
        <ul>
        <li>Pour la premiere année le pourcentage est de: <strong>{{$parrainage->pourcentage_annee1}}</strong>%</li>
        <li>Après la premiere année le pourcentage est soumis à une condition sur le chiffre d'affaire de l'année précedente (N-1), si le chiffre minimum est atteint ce sera le pourcentage maximum pour l'année en cours, sinon c'est le pourcentage minimum qui sera retenu.</li>
        </ul>
        <table>
        <tbody>
        <tr>
        <td style="text-align: center;"><strong>Année</strong></td>
        <td style="text-align: center;"><strong>Pourcentage minimum</strong></td>
        <td style="text-align: center;"><strong>Pourcentage maximum</strong></td>
        <td style="text-align: center;"><strong>chiffre d'affaire minimum à N-1</strong></td>
        </tr>
        
        @foreach($palier as $pl)
        <tr>
        <td style="text-align: center;">N+{{$pl[0]}}</td>
        <td style="text-align: center;">{{$pl[1]}}%</td>
        <td style="text-align: center;">{{$pl[2]}}%</td>
        <td style="text-align: center;">{{$pl[3]}}€</td>
        </tr>
        @endforeach
        
        </tbody>
        </table>
        <ul>
        <li>Au dela de l'année <strong>N+{{$last[0]}} </strong>le pourcentage sera fixé à : <strong>{{$last[1]}}</strong>%</li>
        </ul>
        <!--
        <p> </p>
        <p><strong><u>Liste et suivi des agents présentés au réseau</u></strong></p>
        <p> </p>
        <p>Le MANDATAIRE a présenté au réseau à ce jour :</p>
        <p>            NOM :                                    Prénom :                                 Le :     </p>
        <p>            NOM :                                    Prénom :                                 Le :</p>
        <p>            NOM :                                    Prénom :                                 Le :</p>
        -->
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