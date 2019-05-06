@extends('layouts.main.visiteurs')
@extends('compenents.visiteurs.navbar')
@extends('compenents.visiteurs.footer')
@section('content')
<div class="container pt-5">
    <h3 class="stat-title card-title align-self-center">Les parties impliquées</h3>
    <span class="w3-line"></span>
    <div class="row">
        <div class="col-md-4 col-sm-6 view-testi">
            <div class="block-text rel zmin">
                <p class="pb-3"><strong>Adresse: </strong>29 Rue de la Loi 30200 Nowhere</p>
                <p class="pb-3"><strong>Téléphone: </strong>0600112233</p>
                <p class="pb-3"><strong>Email: </strong>totodusud@haha.com</p>
                <h6 class="py-2">Mandataire</h6>
            </div>
            <div class="person-text rel">
                <img src="{{asset('images/visiteurs/m.png')}}" alt="">
                <h5>Mr Thomas DUBELIN</h5>
                <i>Orange</i>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 hidden-xs">
            <div class="block-text rel zmin">
                <p class="pb-3"><strong>Adresse: </strong>29 Rue de la Loi 30200 Nowhere</p>
                <p class="pb-3"><strong>Téléphone: </strong>0600112233</p>
                <p class="pb-3"><strong>Email: </strong>totodusud@haha.com</p>
                <h6 class="py-2">Mandant</h6>
            </div>
            <div class="person-text rel">
                <img src="{{asset('images/visiteurs/m.png')}}" alt="">
                <h5>Mme Lesley CARASCO</h5>
                <i>Avignon</i>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
            <div class="block-text rel zmin">
                <p class="pb-3"><strong>Adresse: </strong>29 Rue de la Loi 30200 Nowhere</p>
                <p class="pb-3"><strong>Téléphone: </strong>0600112233</p>
                <p class="pb-3"><strong>Email: </strong>totodusud@haha.com</p>
                <h6 class="py-2">Acquéreur</h6>
            </div>
            <div class="person-text rel">
                <img src="{{asset('images/visiteurs/m.png')}}" alt="">
                <h5>Mr Tristan MANDELBROT</h5>
                <i>Aix-En-Province</i>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
            <div class="block-text rel zmin">
                <p class="pb-3"><strong>Adresse de l'office: </strong>29 Rue de la Loi 30200 Nowhere</p>
                <p class="pb-3"><strong>Téléphone: </strong>0600112233</p>
                <p class="pb-3"><strong>Email: </strong>totodusud@haha.com</p>
                <h6 class="py-2">Notaire du mandant</h6>
            </div>
            <div class="person-text rel">
                <img src="{{asset('images/visiteurs/m.png')}}" alt="">
                <h5>Maitre Celine MALAFOSSE</h5>
                <i>Bagnols Sur Cèze</i>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
            <div class="block-text rel zmin">
                <p class="pb-3"><strong>Adresse de l'office: </strong>29 Rue de la Loi 30200 Nowhere</p>
                <p class="pb-3"><strong>Téléphone: </strong>0600112233</p>
                <p class="pb-3"><strong>Email: </strong>totodusud@haha.com</p>
                <h6 class="py-2">Notaire de l'Acquéreur</h6>
            </div>
            <div class="person-text rel">
                <img src="{{asset('images/visiteurs/m.png')}}" alt="">
                <h5>Maitre Celine MALAFOSSE</h5>
                <i>Bagnols Sur Cèze</i>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container pt-5">
                <h3 class="stat-title card-title align-self-center">Timeline</h3>
                <span class="w3-line"></span>
                <ul class="timeline">
                    <li class="timeline-item">
                        <div class="timeline-badge success"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Diffusion du bien</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>En diffusion sur 10 sites d'annonces</small></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge warning"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Offre d'achat</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Le bien a reçu 10 offres d'achat</small></p>
                                <button type="button" class="btn btn-outline-success">Voir</button>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Bien sous compromis</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Une offre est acceptée</small></p>
                                <button type="button" class="btn btn-outline-success">Voir</button>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Rendez-vous signature du compromis</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Rendez-vous fixé le: 05-12-2018 à 11h30</small></p>
                                <button type="button" class="btn btn-outline-success">Details</button>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Compromis signé</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Signature le: 12-10-2018</small></p>
                                <button type="button" class="btn btn-outline-success">Télécharger</button>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Dossier complet</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>Toutes les pieces sont réunies</small></p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Rendez-vous signature de l'acte de vente</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Rendez-vous fixé le: 05-12-2018 à 11h30</small></p>
                                <button type="button" class="btn btn-outline-success">Details</button>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-off"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Bien vendu</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Acte signé le: 12-10-2018</small></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-badge danger"><i class="glyphicon glyphicon-check"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Affaire close</h4>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>L'affaire est close avec la vente du bien</small></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection