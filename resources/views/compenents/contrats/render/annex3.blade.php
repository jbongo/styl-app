<div class="col-md-6" >
                <div class="panel panel-danger m-t-8 scrollbar scrollbar-lady-lips">
                                <div class="panel-heading">Contenus du contrat</div>
                                <div class="panel-body scrollbar-near-moon" style="max-height: 1100px; overflow-y:scroll;">
        <div >
                <h1><strong>ANNEXE 3</strong><strong>            Engagement à payer</strong></h1>
                <p> </p>
                <p><strong><u>FORFAIT D’ENTREE</u></strong><strong> :</strong>    <strong>{{$contrat->forfait_entree}}</strong> € H.T.</p>
                <p>Ouverture des comptes administratifs internes et externes (attestation de négociateur immobilier etc.).</p>
                @if($contrat->forfait_remboursable == 1)
                <p>Remboursé sur la première vente qui devra être effectuée dans les <strong>{{$contrat->premiere_vente_pour_remboursement}}</strong> mois suivant le début d’activité.</p>
                @endif
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
                <li>Du 1<sup>er</sup> au <strong>{{$dr_starter->duration_gratuitee}}</strong>è mois inclus* : gratuit</li>
                <li>Au dela du <strong>{{$dr_starter->duration_gratuitee + 1}}</strong>é mois : <strong>{{$abn_starter->tarif}}</strong> € H.T.</li>
                </ul>
                <p>Le forfait STARTER est valable au maximum les <strong>{{$dr_starter->duration_starter}}</strong> premiers mois*.</p>
                <p>Au <strong>{{$dr_starter->duration_starter + 1}}</strong>è mois* le mandataire passe automatiquement au forfait EXPERT .</p>
                <p>Le passage au forfait EXPERT peut cependant se faire avant le <strong>{{$dr_starter->duration_starter + 1}}</strong>è mois à tout moment d’un commun accord.</p>
                <p><em>* : mois suivant la date de début d’activité inscrite dans le contrat.</em></p>
                <p> </p>
                @endif
        
                <ul>
                <li><strong><u>FORFAIT MENSUEL « EXPERT »</u></strong><strong>rémunération à {{$dr_expert->pourcentage_depart}}% : </strong></li>
                </ul>
                <p>Ce forfait comprend : suivi/conseil + formations + outils informatiques + outils publicitaires.</p>
                <p>Prix mensuel du forfait EXPERT (à compter du démarrage d’activité) :</p>
                <ul>
                <li>Du 1<sup>er</sup> au <strong>{{$dr_expert->duration_gratuitee}}</strong>è mois inclus* : gratuit</li>
                <li>Au dela du <strong>{{$dr_expert->duration_gratuitee + 1}}</strong>è mois inclus* : <strong>{{$abn_expert->tarif}}</strong> € H.T.</li>
                </ul>
                <p><em>* : mois suivant la date de début d’activité inscrite dans le contrat.</em></p>
                <p>La rémunération à <strong>{{$dr_expert->pourcentage_depart}}</strong>% est acquise pour les 12 premiers mois d’activité. Pour la suite elle est soumise à conditions :</p>
                <ul>
                <li>Le mandataire a réalisé au moins <strong>{{$dr_expert->minimum_vente}}</strong> ventes. à N-1.</li>
                <li>Il a parrainé au moins <strong>{{$dr_expert->minimum_fileuls}}</strong> filleul avec signature d'un contrat à N-1.</li>
                <li>Il a réalisé un chiffre d'affaire d'au moins <strong>{{$dr_expert->minimum_chiffre_affaire}}</strong>€ H.T à N-1.</li>
                </ul>
                <p>À défaut, le pourcentage de rémunération sera de <strong>{{$dr_expert->pourcentage_depart - $dr_expert->sub_pourcentage}}</strong>% pour l’année N.</p>
                <p> </p>
                <ul>
                <li><span style="text-decoration: underline;"><strong>| Outils Informatiques </strong></span></li>
                </ul>
                <p>Logiciel de transaction immobilière, logiciel de pige, logiciel de registre des mandats.</p>
                <p> </p>
                <ul>
                <li><span style="text-decoration: underline;"><strong>| Outils Publicitaires </strong></span></li>
                </ul>
                <p>Les annonces sont diffusées sur les passerelles suivantes (liste qui peut être amenée à varier en fonction des négociations avec nos fournisseurs et des changements imposés par ceux-ci) :</p>
                <p>SE LOGER | OFFRE SPIR Puissance Trois : LE BON COIN - TOP ANNONCES - LOGIC IMMO</p>
                <p>LES CLES DU MIDI | PARU VENDU | GREEN-ACRES | BIEN ICI</p>
                <p> </p>
                <p>Le paiement sera effectué par prélèvement le 5 du mois en cours. En cas de rejet de prélèvement, de non-règlement et/ou d’impayé, un forfait de 20 € H.T. par incident pour frais bancaires et de gestion associés sera facturé en sus au mandataire.</p>
                <p>Le mandant se réserve le droit de suspendre ses prestations en cas de non-paiement du forfait.</p>
                <p>Tout mois entamé est dû entièrement. Les frais payés par le mandataire restent acquis à la société, dans tous les cas, aucun remboursement ne sera effectué, pour aucun motif que ce soit, même en cas de suspension prévue au paragraphe précédent.</p>
                <p>Notre entreprise s’évertue à obtenir des tarifs préférentiels auprès de ses partenaires ; néanmoins, les tarifs des packs peuvent être amenés à être modifiés à tout moment en fonction des négociations avec nos fournisseurs et des changements imposés par ceux-ci.</p>
                <p> </p>
                <p>Accord particulier :                                                                                                                    </p>
                <p><u>                                                                                                                                                     </u></p>
                <p><u>                                                                                                                                                     </u></p>
                <p><u>                                                                                                                                                     </u></p>
                <p><u>                                                                                                                                                    . </u></p>
                <p> </p>
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
</div>