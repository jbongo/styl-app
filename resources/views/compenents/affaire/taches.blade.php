<!--nestable-->
<div class="panel lobipanel-basic panel-danger">
        <div class="panel-heading">
           <div class="panel-title">Liste des taches à complèter</div>
        </div>
        <div class="panel-body">
           @if($mandat->dossiervente->status === "debut" || $mandat->dossiervente->status === "offre")
           <ul class="list-group">
              @if(count($bien->appels) > 0)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Ajouter des appels.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Ajouter des appels.</li>
              @endif
              @if(count($bien->visites) > 0)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Ajouter des visites.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Ajouter des visites.</li>
              @endif
              @if(count($offre) > 0)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Ajouter des offres d'achat.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Ajouter des offres d'achat.</li>
              @endif
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Acceptation d'une offre par le mandant.</li>
           </ul>
           @endif
           @if($mandat->dossiervente->status === "compromis" || $mandat->dossiervente->status === "compromis_signe")
           <ul class="list-group">
              @if($mandat->dossiervente->notaire_acq_id !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Attacher un notaire à l'acquéreur.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Attacher un notaire à l'acquéreur.</li>
              @endif
              @if($mandat->dossiervente->notaire_mdn_id !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Attacher un notaire au mandant.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Attacher un notaire au mandant.</li>
              @endif
              @if($mandat->dossiervente->serialize_doc_mandant !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Définir la liste des documents mandant.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Définir la liste des documents mandant.</li>
              @endif
              @if($mandat->dossiervente->serialize_doc_acquereur !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Définir la liste des documents acquéreur.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Définir la liste des documents acquéreur.</li>
              @endif
              @if($mandat->dossiervente->serialize_doc_bien !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Définir la liste des documents du bien.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Définir la liste des documents du bien.</li>
              @endif
              @if($mandat->dossiervente->dossier_acquereur == 100 && $mandat->dossiervente->dossier_mandant == 100 && $mandat->dossiervente->dossier_bien == 100)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Rassembler et valider tous les documents.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Rassembler et valider tous les documents.</li>
              @endif
              @if($mandat->dossiervente->rendez_vous_compromis !== NULL && $mandat->dossiervente->heure_compromis !== NULL && $mandat->dossiervente->adresse_compromis !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Fixer le rendez-vous pour le compromis.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Fixer le rendez-vous pour le compromis.</li>
              @endif
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Valider la signature du compromis.</li>
           </ul>
           @endif
           @if($mandat->dossiervente->status === "acte_signe")
           <ul class="list-group">
              @if($mandat->dossiervente->rendez_vous_acte !== NULL && $mandat->dossiervente->heure_acte !== NULL && $mandat->dossiervente->adresse_acte !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Fixer le rendez-vous pour l'acte de vente.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Fixer le rendez-vous pour l'acte de vente.</li>
              @endif
              @if($mandat->dossiervente->pdf_facture_stylimmo !== NULL)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Génerer la facture de la commission.</li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Génerer la facture de la commission.</li>
              @endif
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span>Valider la signature de l'acte.</li>
           </ul>
           @endif
           @if($mandat->dossiervente->status === "cloture")
           <ul class="list-group">
              @if($mandat->dossiervente->vente == 1)
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span><strong>Bien vendu.</strong></li>
              @else
              <li class="list-group-item list-group-item-danger"><span class="badge" style="background-color: red;"><span class="ti-close"></span></span><strong>Bien vendu.</strong></li>
              @endif
              <li class="list-group-item list-group-item-success"><span class="badge" style="background-color: green;"><span class="ti-check"></span></span>Cloture du dossier.</li>
           </ul>
           @endif
        </div>
     </div>
     <!--nestable-->