@extends('layouts.main.pdf')
@section('content')
@php
	function printData($libelle, $valeur, $compare_valeur, $unite){
		if($valeur !=$compare_valeur){
			echo "<li> $libelle : <strong> $valeur $unite</strong> </li>";
		}
	}
@endphp
<style>
	.space {
	padding:  0px;
	border: 2px solid black;
}

.title{
	background-color: #00ccff;
	color: #ffffff;
}
body{
	font-family: 'Courier New', Courier, monospace;
	font-size: 12px;
}
</style>

	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<span><img src="images/logo.png" alt="Logo Stylimmo"></span>
		</div>
		<div class="col-sm-8 col-md-8 col-lg-8">
			<span style="font-weight:bold; font-size:15px;">{{$bien->prix_public}} €</span> <br>
			<span>{{$bien->titre_annonce}}</span><br>
			<span>{{$bien->adresse_bien_secteur}} {{$bien->code_postal_public_secteur}}, {{$bien->ville_publique_secteur}}</span> <br>
		</div>
	</div>
<br><br>


	<div class="row">

		<div class="col-sm-6 col-md-6 col-lg-6 ">				
            @if(isset($bien->photosbiens[0]))   <p class="space"><img src="images/photos_bien/{{$bien->photosbiens[0]->resized_name}}" width="100%" height="150px" alt="Logo Stylimmo"></p>@endif
            @if(isset($bien->photosbiens[1]))   <p class="space"><img src="images/photos_bien/{{$bien->photosbiens[1]->resized_name}}" width="100%" height="150px" alt="Logo Stylimmo"></p>@endif
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <p class="title">DESCRIPTION</p>
            <p> {{$bien->description_annonce}} </p>
        </div>
	</div>

	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6 ">
            <p class="title">SECTEUR ET COMMODITES</p>
            <p>
                <ul>
                    @php
						printData("Adresse ",$bien->adresse_bien_secteur, null," " );						
						printData("Complément d'adresse ",$bien->complement_adresse_secteur, null," " );						
						printData("Secteur",$bien->secteur_secteur,null," " );						
						printData("Transports à proximité ",$bien->transport_a_proximite_secteur, null," " );									
					@endphp		
                    
                </ul>
            </p>
		</div>
		
		<div class="col-sm-6 col-md-6 col-lg-6">
			<p class="title">NOTES</p>
			<p>
				<ul>
                    	
					
				</ul>
			</p>

		</div>
	</div>

	<div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 ">
                <p class="title">DESCRIPTION </p>
                <p>
                    <ul>
                        @php
						//maison appart
						printData("Nombre de pièces ",$bien->nombre_piece, null," " );
						printData("Nombre de chambres ",$bien->nombre_chambre, null," " );
						printData("Nombre de salles d'eau ",$bien->nb_salle_eau_agencement_interieur, null," " );
						printData("Nombre de salles de bain ",$bien->nb_salle_bain_agencement_interieur, null," " );
						printData("Nombre de WC",$bien->nb_wc_agencement_interieur, null," " );
						printData("nombre de garage ",$bien->nombre_garage, null," " );
						printData("Jardin ",$bien->jardin, null," " );
						printData("Piscine ",$bien->piscine, null," " );
						//terrain
						printData("Raccordement eau ",$bien->raccordement_eau_terrain, "Non précisé", " " );
						printData("Raccordement gaz ",$bien->raccordement_gaz_terrain, "Non précisé", " " );
						printData("Raccordement électricité ",$bien->raccordement_electricite_terrain, "Non précisé", " " );
						printData("Raccordement téléphone ",$bien->raccordement_telephone_terrain, "Non précisé", " " );
						printData("Constructible ",$bien->constructible_terrain, "Non précisé", " " );
						printData("Viabilisé ",$bien->viabilise_terrain, "Non précisé", " " );
						printData("Raccordement eau ",$bien->raccordement_eau_terrain, "Non précisé", " " );
						printData("Raccordement gaz ",$bien->raccordement_gaz_terrain, "Non précisé", " " );
						printData("Raccordement électricité ",$bien->raccordement_electricite_terrain, "Non précisé", " " );
						printData("Raccordement téléphone ",$bien->raccordement_telephone_terrain, "Non précisé", " " );
						printData("Constructible ",$bien->constructible_terrain, "Non précisé", " " );
						printData("Viabilisé ",$bien->viabilise_terrain, "Non précisé", " " );printData("Raccordement eau ",$bien->raccordement_eau_terrain, "Non précisé", " " );
					@endphp		
                        
                    </ul>
                </p>
            </div>
            
            <div class="col-sm-6 col-md-6 col-lg-6">
                <p class="title">INFORMATIONS </p>
                <p>
                    <ul>
                        @php
						printData("Année de construction ",$bien->annee_construction_diagnostic, null," " );						
						printData("Etat extérieur ",$bien->etat_exterieur_diagnostic, "Non défini"," " );						
						printData("Etat intérieur ",$bien->etat_interieur_diagnostic, "Non défini"," " );						
						printData("Surface annexe ",$bien->surface_annexe_diagnostic, null,"m²" );						
												
					    @endphp		
                        
                    </ul>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 ">
                <p class="title">INFORMATIONS FINANCIERES</p>
                <p>
                    <ul>
                        @php						
						printData("Prix net vendeur ",$bien->prix_net_info_fin, null,"€" );						
						printData("Prix public ",$bien->prix_public_info_fin, null,"€" );						
						printData("Honoraires charge Acquéreur ",$bien->honoraire_acquereur_info_fin, null," " );						
						printData("Honoraires charge Vendeur ",$bien->honoraire_vendeur_info_fin, null," " );						
						printData("Estimation ",$bien->estimation_valeur_info_fin, null,"€" );						
						printData("Montant foncier total ",$bien->taxe_fonciere_info_fin, null,"€" );						
						printData("Charges Mensuelles ",$bien->charge_mensuelle_total_info_fin, null,"€" );						
						printData("Travaux à prévoir ",$bien->travaux_a_prevoir_info_fin, null," " );						
						printData("Dépôt de garantie ",$bien->depot_garanti_info_fin, null,"€" );						
						printData("Taxe d'habitation ",$bien->taxe_habitation_info_fin, null,"€" );						
						printData("Taxe foncière ",$bien->taxe_fonciere_info_fin, null,"€" );						
						
					    @endphp			
                        
                    </ul>
                </p>
            </div>
            
            <div class="col-sm-6 col-md-6 col-lg-6">
                <p class="title">MANDAT ET DISPONIBILITE</p>
                <p>
                    <ul>
                        @php						
						printData("N° de dossier",$bien->numero_dossier, null,"" );						
						printData("Type d'offre",$bien->type_offre, null,"" );						
						printData("Disponiblité immédiate",$bien->disponibilite_immediate_dossier_dispo, null,"" );						
												
												
												
						
					    @endphp	
                        
                    </ul>
                </p>
            </div>
        </div>
      
	<div class="row m-t-25 ">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p class="title">VOTRE AGENCE</p>
			<span><img src="images/logo.png" alt=""></span> <strong> Jeremy BOISSON</strong> <br>
			Adresse <strong> 81 rue de la république Décines-charpieu 69150</strong> <br>
			Tél : <strong>+33 (0)6 61 06 11 98 </strong> <br>
			Mail : <strong>j_boisson@hotmail.fr </strong> 
			
		</div>
	</div>

@endsection