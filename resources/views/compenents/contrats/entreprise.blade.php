<div class="card-body">
                   
    <div class="form-validation">
    <form class="form-valide" action="{{ route('contrat.settingentreprise') }}" method="post">
        {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="raison">Raison sociale<span class="text-danger">*</span></label>
                <div class="col-lg-4">
                <input type="text" class="form-control" value="{{$ret2->raison_sociale}}" id="raison" name="raison" required>
                </div>
            </div>
            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="nom">Nom de l'entreprise <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                    <input type="text"  class="form-control" value="{{$ret2->nom_entreprise}}" id="nom" name="nom" required>
                </div>
            </div>
            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="adresse-siege">Adresse du siege social<span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{$ret2->adresse_siege_sociale}}" id="adresse-siege" name="adresse-siege" required>  
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" value="" for="nom-gerant">Nom et prénom du gérant(e) <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" id="val-compl_adress" class="form-control" value="{{$ret2->nom_prenom_gerant}}" id="nom-gerant" name="nom-gerant" required>
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="capital">Capital (€)<span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                    <input type="number" class="form-control" min="1" value="{{$ret2->capital}}" id="capital" name="capital" required>
                    </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="siret">Siret<span class="text-danger">*</span></label>
                <div class="col-lg-3">
                <input type="text" class="form-control" value="{{$ret2->siret}}" id="siret" name="siret"  required>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="rcs">RCS de<span class="text-danger">*</span></label>
            <div class="col-lg-3">
            <input type="text" class="form-control" value="{{$ret2->RCS}}" id="rcs" name="rcs"  required>
            </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="tva">Numéro de TVA<span class="text-danger"></span></label>
        <div class="col-lg-3">
        <input type="text" class="form-control" value="{{$ret2->TVA}}" id="tva" name="tva" >
        </div>
</div>
            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="num-carte">Numéro de carte professionnelle<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" value="{{$ret2->numero_carte_professionnelle}}" id="num-carte" name="num-carte" required>
                    </div>
            </div>
            <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="date-delivrance">Date de délivrance <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="date" class="form-control" value="{{$ret2->date_delivrance}}" id="date-delivrance" name="date-delivrance" required>                    
                    </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="organisme">Organisme délivrant<span class="text-danger">*</span></label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" value="{{$ret2->organisme_delivrant}}" id="organisme" name="organisme" required>
                </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="garant">Nom du garant<span class="text-danger">*</span></label>
            <div class="col-lg-4">
                <input type="text" class="form-control" value="{{$ret2->nom_garant}}" id="garant" name="garant" required>
            </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="adresse-garant">Adresse du garant<span class="text-danger">*</span></label>
        <div class="col-lg-6">
            <input type="text" class="form-control" value="{{$ret2->adresse_garant}}" id="adresse-garant" name="adresse-garant" required>
        </div>
</div>
<div class="form-group row" style="text-align: center; margin-top: 50px;">
    <div class="col-lg-8 ml-auto">
       <button class="btn btn-warning btn-flat btn-addon btn-lg m-b-10 m-l-5 submit" id="ajouter"><i class="ti-pencil"></i>Modifier</button>
    </div>
 </div>
        </form>
    </div>
</div>