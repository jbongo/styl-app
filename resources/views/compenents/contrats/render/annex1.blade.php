<div class="col-md-6" >
    <div class="panel panel-danger m-t-8 scrollbar scrollbar-lady-lips">
        <div class="panel-heading">Contenus du contrat</div>
        <div class="panel-body scrollbar-near-moon" style="max-height: 1100px; overflow-y:scroll;">
                <h1><strong>ANNEXE 1</strong><strong>       Commissionnement direct</strong></h1>
              <p> </p>
              </br>
              <p>La commission du mandataire est calculée en pourcentage du montant des honoraires d’agence H.T. générés par le mandataire. Ce pourcentage de bases est défini selon le choix effectué ci-dessous (STARTER ou EXPERT).</p>
              <p> </p>
              <p><strong><u>A – Pourcentage de base choisi</u></strong></p>
              @if($bool_starter == 1)
              <p>Démarrage en tant que :</p>
              <p><strong>    STARTER </strong>(max. <strong>{{$dr_starter->duration_starter}}</strong> mois)<strong> :           {{$dr_starter->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
              <p> </p>
              <p>Basculement sur le pack :</p>
              <p><strong>    EXPERT :                                    </strong><strong>{{$dr_expert->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
              <p> </p>
              @if($dr_starter->palier == 1 && (count($palier_starter) || $last_starter != NULL))
              <p><strong><u>B - 1 Progression du commissionnement STARTER</u></strong></p>
              <p> </p>
              <p>Le pourcentage de base en vigueur sera augmenté en fonction des résultats du mandataire selon les paliers suivants :</p>
              <p> </p>
              @foreach($palier_starter as $pl)
              <p>De                     <strong>{{$pl[2]}}</strong> €                             à             <strong>{{$pl[3]}}</strong> € HT de commissions annuelles</p>
              <p><strong>Pourcentage en vigueur + {{$pl[1]}} </strong>%</p>
              @endforeach
              @if($last_starter != NULL)
              <p>De                     <strong>{{$last_starter[2]}}</strong> €                             et            PLUS</p>
              <p><strong>Pourcentage en vigueur + {{$last_starter[1]}} </strong>%</p>
              <p> </p>
              @endif
              @endif
              @endif
              @if($bool_starter == 0)
              <p>Démarrage en tant que :</p>
              <p><strong>    EXPERT :                                    </strong><strong>{{$dr_expert->pourcentage_depart}} %   </strong>(des honoraires d’agence H.T.)</p>
              <p> </p>
              @endif
              @if($dr_expert->palier == 1 && (count($palier_expert) || $last_expert != NULL))
              <p><strong><u>B - 2 Progression du commissionnement EXPERT</u></strong></p>
              <p> </p>
              <p>Le pourcentage de base en vigueur sera augmenté en fonction des résultats du mandataire selon les paliers suivants :</p>
              <p> </p>
              @foreach($palier_expert as $pl1)
              <p>De                     <strong>{{$pl1[2]}}</strong> €                             à             <strong>{{$pl1[3]}}</strong> € HT de commissions annuelles</p>
              <p><strong>Pourcentage en vigueur + {{$pl1[1]}} </strong>%</p>
              @endforeach
              @if($last_expert != NULL)
              <p>De                     <strong>{{$last_expert[2]}}</strong> €                             et            PLUS</p>
              <p><strong>Pourcentage en vigueur + {{$last_expert[1]}} </strong>%</p>
              <p> </p>
              @endif
              @endif
              <p> </p>
              <div class="table-responsive">
                 <table class="table table-striped">
                    <tbody>
                       <tr>
                          <td>
                             <p>Fait en deux exemplaires    à : BAGNOLS SUR CEZE</p>
                             <p>Gérant(e) <strong>{{$society->nom_prenom_gerant}}</strong> </p>
                             <p>LE MANDANT (paraphe) :</p>
                          </td>
                          </td>
                          <td style="width: 80px;">
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