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

	<div class="row space m-b-2">
		<div class="col-sm-12 col-md-12 col-lg-12">

			<p>Offre de : <span style="font-weight:bold; font-size:15px;">{{$bien->type_offre}}</span> <br></p>
			<p>Mandat n° :****************</p>

		</div>
	</div>

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

		<div class="col-sm-4 col-md-4 col-lg-4  m-r-20">
	
			@if(isset($bien->photosbiens[0]))	<p class="space"><img src="images/photos_bien/{{$bien->photosbiens[0]->resized_name}}" width="100%" height="150px" alt="Logo Stylimmo"></p> @endif
			
			@if(isset($bien->photosbiens[1])) <span ><img class="space" src="images/photos_bien/{{$bien->photosbiens[1]->resized_name}}" width="47%" height="100%" alt="Logo Stylimmo"></span> @endif
		
			@if(isset($bien->photosbiens[2]))<span ><img class="space" src="images/photos_bien/{{$bien->photosbiens[2]->resized_name}}" width="47%" height="100%" alt="Logo Stylimmo"></span>@endif
			
		</div>
		<div class="col-sm-8 col-md-8 col-lg-8">
			<p class="title">DESCRIPTIF</p>
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
			<p class="title">INFORMATIONS</p>
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
			<p class="title">SECTEUR</p>
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
	</div>



	<div class="row">
		<div class="col-sm-6 col-md-6 col-lg-6">
			<p class="title">DESCRIPTION</p>
			<p >
				{{$bien->description_annonce}}
			</p>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6">
			<p class="title">SURFACES</p>
			<p>
				<ul>
					@php
						printData("Surface habitable ",$bien->surface_habitable,null,"m²" );
						printData("Surface du terrain ",$bien->surface_terrain,null,"m²" );
						printData("Surface carrez ",$bien->nombre_piece,null,"m²" );
						printData("Garages ",$bien->nombre_piece,null,"m²" );
						printData("Garages ",$bien->nombre_piece,null,"m²" );
						printData("Garages ",$bien->nombre_piece,null,"m²" );

					@endphp

						
				</ul>
			</p>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<p>@include('layouts.dpe')
			</p>
			
			
		</div>
		<div class="col-sm-8 col-md-8 col-lg-8">
			<p class="title">VOTRE AGENCE</p>
			<span><img src="images/logo.png" alt=""></span> <strong>{{$bien->user->prenom}}  {{$bien->user->nom}}</strong> <br>
			Adresse <strong>{{$bien->user->adresse}} {{$bien->user->code_postal}}, {{$bien->user->ville}}</strong> <br>
			Tél : <strong>{{$bien->user->telephone}}</strong> <br>
			Mail : <strong>{{$bien->user->email}} </strong> 
			
		</div>
	</div>

@endsection