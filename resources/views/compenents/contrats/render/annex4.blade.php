<div class="col-md-6" style="max-height: 1100px; overflow-y:scroll;">
        <div class="panel panel-danger m-t-8 scrollbar scrollbar-lady-lips">
                <div class="panel-heading">Contenus du contrat</div>
                <div class="panel-body scrollbar-near-moon" style="max-height: 1100px; overflow-y:scroll;">
                        <h1><strong>ANNEXE 4</strong><strong>            Barème d'honoraires</strong></h1>
                        <p> </p>
                        <div class="table-responsive">
                                <table class="table table-striped">
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
                        <p style="text-align: center;">De: <strong>{{$first_bareme[0]}}</strong>€                 à               <strong>{{$first_bareme[1]}}</strong>€</p>
                        </td>
                        <td>
                        <p style="text-align: center;">Forfait de <strong>{{$first_bareme[2]}}</strong>€ </p>
                        </td>
                        </tr>
                
                        @foreach($palier_bareme as $pl)
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
                                        <p style="text-align: center;">De: <strong>{{$last_bareme[0]}}</strong>€                 et               <strong>plus</strong></p>
                                        </td>
                                        <td>
                                            <p style="text-align: center;">Pourcentage Maximum de <strong>{{$last_bareme[1]}}</strong>% </p>
                                        </td>
                                        </tr>
                
                        </tbody>
                        </table>
                    </div>
                </br>
                    <p> </p>
                        <p>Le MANDATAIRE s'engage à ne pas dépasser ou modifier ce barème à la hausse mais pourra cependant accorder des remises à la clientèle sur le montant des commissions prévues au dit barème.</p>
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