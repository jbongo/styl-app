@extends('layouts.main.visiteurs')
@extends('compenents.visiteurs.navbar')
@extends('compenents.visiteurs.footer')
@section('content')
<section class="wthree-row py-sm-5 py-3 slide-bg">
		<div class="container py-md-5 py-3">
			<div class="py-lg-5 bg-pricemain">
				<h3 class="agile-title text-uppercase text-white">Suivi d'une vente</h3>
				<span class="w3-line"></span>
				<h5 class="agile-title text-capitalize pt-4"> Tous le suivi d'une transaction depuis le meme espace</h5>
				<p class="text-light py-4">STYL'IMMO met à disposition de ses clients vendeurs et aqcuéreurs un suivi 100% en ligne afin de leurs faciliter
					la realisation d'une transaction immobiliere et tous ce que cela implique, en effet de la signature du mandat jusqu'à l'acte de vente
					nos agents vous accompagne dans vos démarches.
				</p>
			</div>
		</div>
	</section>
	<div class="container pt-5">
			<h3 class="stat-title card-title align-self-center">LISTE DES SERVICES</h3>
			<span class="w3-line"></span>
			<div class="row">
				<div class="col-md-4 col-sm-6 view-testi">
						<div class="cardif transition">
								<h2 >Informations du bien<br><small>Toutes les informations du bien à vendre</small></h2>
								<div class="cta-container transition"><a href="#" class="cta">Voir</a></div>
								<div class="cardif_circle transition"></div>
							  </div>
				</div>
				<div class="col-md-4 col-sm-6 hidden-xs">
						<div class="cardif transition">
								<h2 >Documents et dossier<br><small>Réunir les pieces necessaires pour le notaire</small></h2>
								<div class="cta-container transition"><a href="#" class="cta">Voir</a></div>
								<div class="cardif_circle transition"></div>
							  </div>
				</div>
				<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
						<div class="cardif transition">
								<h2 >Avancement de la transaction<br><small>Suivi des rendez-vous et de l'avancement</small></h2>
								<div class="cta-container transition"><a href="#" class="cta">Voir</a></div>
								<div class="cardif_circle transition"></div>
							  </div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
@endsection