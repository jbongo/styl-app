<div class="panel lobipanel-basic panel-pink">
        <div class="panel-heading">
           <div class="panel-title">Details de l'affaire</div>
        </div>
        <div class="panel-body">
            @if($mandat->statut === "actif" || ($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre"))
           <div class="dropdown">
              <button class="btn btn-pink btn-rounded btn-addon btn-sm m-b-10 m-l-5 dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="ti-settings"></i>Paramètres
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="background: #ececec;">
                 <li class="dropdown-header" style="color: orange; text-decoration: underline;">AFFAIRE</li>
                 <li class="divider"></li>
                 @if($mandat->dossiervente->status === "debut" || $mandat->dossiervente->status === "offre")
                  <li><a href="#" class="bfm0"><i class="ti-archive"></i> Cloturer l'affaire</a></li>
                 @endif
                 <li><a href="#" class="bfm1"><i class="ti-close"></i> Suspendre le compromis</a></li>
              </ul>
           </div>
           @endif
           <br>
           <!--status affaire-->
           @include("compenents.affaire.statusaffaire")
           <!--status affaire end-->
           <br>
           <div class="card alert nestable-cart">
              <div class="card-header">
                 <h4><strong style="color:#2cabe0;">Details du dossier de vente</strong></h4>
                 <p>
                 <h5><strong>Numéro du dossier: </strong>{{$mandat->dossiervente->numero}}</h5>
                 </p>
                 <p>
                 <h5><strong>Type du mandat: </strong><span class="badge badge-info">{{strtoupper($mandat->type)}}</span></h5>
                 </p>
                 <p>
                 <h5><strong>Numéro du mandat: </strong>{{$mandat->numero}}</h5>
                 </p>
                 <p>
                 <h5><strong>Date de début du mandat: </strong>{{date('d/m/Y',strtotime($mandat->date_debut))}}</h5>
                 </p>
                 <p>
                 <h5><strong>Date de fin du mandat: </strong>{{date('d/m/Y',strtotime($mandat->date_fin))}}</h5>
                 </p>
                 <p>
                 <h5><strong>Status du mandat: </strong><span class="badge badge-warning">{{strtoupper($mandat->statut)}}</span></h5>
                 </p>
              </div>
           </div>
           <br>
           @if($mandat->statut === "actif" || ($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre"))
           @if($mandat->dossiervente->status != "cloture")
           <div class="card alert nestable-cart">
              <div class="card-header">
                 <p>
                 <h4><strong style="color:#2cabe0;">Suivi des visites et offres d'achat du bien</strong></h4>
                 <br>
                 @if($mandat->dossiervente->status === "offre" || $mandat->dossiervente->status === "debut")
                 <a type="button" data-toggle="modal" data-target="#offer" class="btn btn-warning btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-bookmark-alt"></i>Nouvelle offre</a>
                 <a type="button" data-toggle="modal" data-target="#visite" class="btn btn-success btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-key"></i>Nouvelle visite</a>
                 <a type="button" data-toggle="modal" data-target="#appel" class="btn btn-pink btn-rounded btn-outline btn-addon btn-sm m-b-10 m-l-5"><i class="ti-headphone-alt"></i>Nouveau appel</a>
                 @endif
                 <a type="button" data-toggle="modal" data-target="#offrelist" class="btn btn-warning btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-list"></i>Liste offres</a>
                 <a type="button" data-toggle="modal" data-target="#visitelist" class="btn btn-success btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-list"></i>Liste visites</a>
                 <a type="button" data-toggle="modal" data-target="#appellist" class="btn btn-pink btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-list"></i>Liste appels</a>
                 </p>
              </div>
           </div>
           @if($mandat->dossiervente->status != "offre" && $mandat->dossiervente->status != "debut")
           <div class="card alert nestable-cart">
              <div class="card-header">
                 <p>
                 <h4><strong style="color:#2cabe0;">Documents justificatifs</strong></h4>
                 <br>
                 <a type="button"  data-toggle="modal" data-target="#doc_acquereur" class="btn btn-primary btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-file"></i>Acquéreur</a>
                 <a type="button"  data-toggle="modal" data-target="#doc_mandant" class="btn btn-pink btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-file"></i>Mandant</a>
                 <a type="button"  data-toggle="modal" data-target="#doc_bien" class="btn btn-warning btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-file"></i>Bien</a>
                 @if($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "compromis_signe")
                 <a type="button"  class="btn btn-danger btn-rounded btn-addon btn-outline btn-sm m-b-10 m-l-5"><i class="ti-folder"></i>Dossier compromis</a>
                 @endif
                 @if($mandat->dossiervente->status === "acte_signe")
                 <a type="button"  class="btn btn-danger btn-rounded btn-addon btn-outline btn-sm m-b-10 m-l-5"><i class="ti-folder"></i>Dossier acte vente</a>
                 @endif
                 </p>
              </div>
           </div>
           <div class="card alert nestable-cart">
              <div class="card-header">
                 <p>
                 <h4><strong style="color:#2cabe0;">Rendez-vous signatures et notaires</strong></h4>
                 <br>
                 <a type="button"  data-toggle="modal" data-target="#notaire_mdn" class="btn btn-default btn-outline btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-stamp"></i>Notaire mandant @if($mandat->dossiervente->notaire_mdn_id !== NULL)<span class="badge" style="background-color: green;"><span class="ti-check"></span></span>@endif</a>
                 <a type="button"  data-toggle="modal" data-target="#notaire_acq" class="btn btn-default btn-outline btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-stamp"></i>Notaire acquéreur @if($mandat->dossiervente->notaire_acq_id !== NULL)<span class="badge" style="background-color: green;"><span class="ti-check"></span></span>@endif</a>
                 @if($mandat->dossiervente->notaire_acq_id !== NULL && $mandat->dossiervente->notaire_mdn_id !== NULL)
                 @if($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "compromis_signe")
                 <a type="button"  data-toggle="modal" data-target="#rdv_compromis" class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-calendar"></i>Compromis</a>
                 @endif
                 @if($mandat->dossiervente->status === "acte_signe")
                 <a type="button"  data-toggle="modal" data-target="#rdv_acte" class="btn btn-danger btn-rounded btn-addon btn-sm m-b-10 m-l-5"><i class="ti-calendar"></i>Acte de vente</a>
                 @endif
                 @endif
                 </p>
              </div>
           </div>
           @endif
           @endif
           @endif
        </div>
     </div>