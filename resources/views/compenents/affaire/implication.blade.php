<div class="panel lobipanel-basic panel-success">
        <div class="panel-heading">
           <div class="panel-title">Les parties impliquées</div>
        </div>
        <div class="panel-body">
           <div class="card p-0">
              <div class="media bg-default">
                 <div class="p-20 bg-default-dark media-left media-middle">
                     <img style="border-radius: 10px;width: 185px;position: relative;height: 155px;object-fit: cover;" src='{{asset('images/photos_bien/'.$bien->photosbiens[0]->resized_name)}}' alt=''>
                 </div>
                 <div class="p-20 media-body">
                     <h4><strong style="color:#2cabe0;">Bien</strong></h4>
                    <h4>{{$bien->titre_annonce}}</h4>
                    <h5>{{$bien->code_postal}} {{$bien->ville}}</h5>
                    <a type="button" href="{{Route('bien.show', Crypt::encrypt($bien->id))}}" target="blanc" class="btn btn-warning btn-outline btn-rounded m-b-10 m-l-5">Voir</a>
                 </div>
              </div>
           </div>
           <div class="card p-0">
              <div class="media bg-default">
                 <div class="p-20 bg-info-dark media-left media-middle">
                    <i class="ti-user f-s-48 color-white"></i>
                 </div>
                 <div class="p-20 media-body">
                     <h4><strong style="color:#2cabe0;">Mandant</strong></h4>
                    @if($mandat->groupemandant_id == NULL)  
                    <h4>{{$mandant->civilite}} {{$mandant->nom}} {{$mandant->prenom}}</h4>
                    <h5>{{$mandant->code_postal}} {{$mandant->ville}}</h5>
                    <a type="button" href="{{Route('mandant.show', $mandant->id)}}" target="blanc" class="btn btn-info btn-outline btn-rounded m-b-10 m-l-5">Voir</a>
                    @endif
                    @if($mandat->mandant_id == NULL)  
                    <h4>{{$mandant->nom_groupe}}</h4>
                    <a type="button" href="{{Route('groupemandant.show', $mandant->id)}}" target="blanc" class="btn btn-info btn-outline btn-rounded m-b-10 m-l-5">Voir</a>
                    @endif
                 </div>
              </div>
           </div>
           @if($mandat->dossiervente->status !== "debut" && $mandat->dossiervente->status !== "offre" && (!($mandat->dossiervente->status === "cloture" && $mandat->dossiervente->vente == 0)))
           <div class="card p-0">
              <div class="media bg-default">
                 <div class="p-20 bg-warning-dark media-left media-middle">
                    <i class="ti-user f-s-48 color-white"></i>
                 </div>
                 <div class="p-20 media-body">
                     <h4><strong style="color:#2cabe0;">Acquéreur</strong></h4>
                    @if($mandat->dossiervente->acquereurs_type === "App\Models\Acquereur")
                    <h4>{{$acheteur->civilite}} {{$acheteur->nom}} {{$acheteur->prenom}}</h4>
                    <h5>{{$acheteur->code_postal}} {{$acheteur->ville}}</h5>
                    <a type="button" href="{{Route('acquereur.show', $acheteur->id)}}" target="blanc" class="btn btn-danger btn-outline btn-rounded m-b-10 m-l-5">Voir</a>
                    @else  
                    <h4>{{$acheteur->nom_groupe}}</h4>
                    <a type="button" href="{{Route('groupeacquereur.show', $acheteur->id)}}" target="blanc" class="btn btn-danger btn-outline btn-rounded m-b-10 m-l-5">Voir</a>
                    @endif
                 </div>
              </div>
           </div>
           @endif
        </div>
     </div>