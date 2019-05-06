<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Avenant au contrat</title>
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
    <h1 style="text-align: center;">AVENANT AU CONTRAT D’AGENT COMMERCIAL</h1>
        <p> </p>
        <p><u>Entre les soussignés </u>:</p>
        <p><strong>La société {{$society->nom_entreprise}} , </strong><strong>{{$society->raison_sociale}}</strong> au capital de <strong>{{$society->capital}}</strong> € inscrite au R.C.S. de <strong>{{$society->RCS}}</strong>, sous le numéro <strong>{{$society->siret}}</strong>, titulaire de la carte professionnelle « Agent Immobilier » n° <strong>{{$society->numero_carte_professionnelle}}</strong> (transactions sur immeubles et fonds de commerce), délivrée le <strong>{{$society->date_delivrance}}</strong> par <strong>{{$society->organisme_delivrant}}</strong> (organisme de garantie : <strong>{{$society->nom_garant}}</strong> – <strong>{{$society->adresse_garant}}</strong>), dont le siège est <strong>{{$society->adresse_siege_sociale}}</strong>, légalement représentée par <strong>{{$society->nom_prenom_gerant}}</strong>, gérant(e).</p>
        <p>Ci-après dénommé « LE MANDANT » D’une part</p>
        <p> </p>
    <p>Et</p>
        <p> </p>
        <p> </p>
        <p>NOM : <strong>{{$user->nom}}</strong>                                                 Prénom : <strong>{{$user->prenom}}</strong></p>
        <p>Demeurant au : <strong>{{$user->adresse}}</strong> </p>
        <p>Code postal et ville : <strong>{{$user->code_postal}}  {{$user->ville}}</strong> </p>
        <p>Né(e) le:  <strong>{{$user->date_naissance}}</strong>  à : <strong>{{$user->ville_naissance}}</strong> </p>
        <p>Pays de nationalité : <strong>{{$user->nationnalite}}</strong> </p>
        <p>Situation familiale : <strong>{{$user->situation_matrimoniale}}</strong> </p>
        <p> </p>
        <p>Ci-après dénommé(e) « LE MANDATAIRE » D’autre part</p>
        <p> </p>
        <h2><strong><sub>Il est convenu de modifier les dispositions suivantes : </sub></strong></h2>
        <p> </p>
        <p> </p>
        <p> </p>
        @yield('append')
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