<div class="col-md-6">
        <div class="panel panel-danger m-t-8 scrollbar scrollbar-lady-lips">
                <div class="panel-heading">Contenus du contrat</div>
                <div class="panel-body scrollbar-near-moon" style="max-height: 1100px; overflow-y:scroll;">
                        <h1><strong>ANNEXE 2</strong><strong>            Barème du parrainage</strong></h1>
                        <p> </p>
                 <p> </p>
                 <p><strong><u>Rémunération associée aux agents (filleuls) présentés au réseau</u></strong> </p>
                 <p> </p>
                 <p>Elle correspond à un pourcentage sur le chiffre d’affaires H.T. (honoraires d’agence) réalisé par un nouvel agent (le filleul) que le mandataire parrain a présenté au réseau. Le droit à ce commissionnement est soumis aux barème suivant:</p>
                 <ul>
                    <li>- Pour la premiere année le pourcentage est de: <strong>{{$parrainage->pourcentage_annee1}}</strong>%</li>
                    <li>- Après la premiere année le pourcentage est soumis à une condition sur le chiffre d'affaire de l'année précedente (N-1), si le chiffre minimum est atteint ce sera le pourcentage maximum pour l'année en cours, sinon c'est le pourcentage minimum qui sera retenu.</li>
                 </ul>
                </br>
                 <div class="table-responsive">
                    <table class="table table-striped">
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
                </div>
            </br>
                    <ul>
                       <li>- Au dela de l'année <strong>N+{{$last[0]}} </strong>le pourcentage sera fixé à : <strong>{{$last[1]}}</strong>%</li>
                    </ul>
                       <p><strong><u>Liste et suivi des agents présentés au réseau</u></strong></p>
                       <p>Le MANDATAIRE a présenté au réseau à ce jour :</p>
                       @foreach($fileuls as $fl)
                        <p>NOM :&nbsp;<strong>{{$fl->nom}}</strong>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;PRENOM :&nbsp;<strong>{{$fl->prenom}}</strong></p>
                    @endforeach
                       
                    <p> </p>
                    </br>
                    <div class="table-responsive">
                            <table class="table table-striped">
                       <tbody>
                          <tr>
                             <td style="margin-right: 40px;">
                                <p> </p>
                                <p>Fait en deux exemplaires    à : BAGNOLS SUR CEZE</p>
                                <p>Gérant(e) <strong>{{$society->nom_prenom_gerant}}</strong> </p>
                                <p>LE MANDANT (paraphe) :</p>
                                <p> </p>
                             </td>
                             <td>
                                <p style="text-align: left;">le : <strong>{{$timetamps}}</strong></p>
                                <p style="text-align: left;">M(Mme):<strong> {{$user->nom}} {{$user->prenom}}</strong></p>
                                <p style="text-align: left;">LE MANDATAIRE (paraphe) :</p>
                             </td>
                          </tr>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>