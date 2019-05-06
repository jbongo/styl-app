@section('navbar')
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
        @php($current = Route::current()->getName())
        <ul>
			<li class="label">Main</li>
                    <li class="encour @if($current == '/') active @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">desktop_mac</i> Vue d'ensemble <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Tableau de bord</a></li>
                            <li><a href="#">Actualité du réseau</a></li>
                            <li><a href="#">Système et performances</a></li>
                        </ul>
                    </li>
                    @admin
                    <li class="label">Administration</li>
                    <li class="encour @if($current == 'users' || $current == 'users.archive' || $current == 'users.params') active open @else NULL @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">account_circle</i>Utilisateurs<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                        <li class="encour"><a @if($current == 'users')style="color: #ce4c02;"@endif href="{{route('users')}}">Gestion</a></li>
                        <li class="encour"><a @if($current == 'users.archive')style="color: #ce4c02;"@endif href="{{route('users.archive')}}">Archives</a></li>
                        <li><a href="{{route('lead.index')}}">Recrutement</a></li>
                        <li class="encour"><a @if($current == 'users.params')style="color: #ce4c02;"@endif href="{{route('users.params')}}">Paramètres</a></li>
                        </ul>
                    </li>
                    <li class="encour @if($current == 'contrat.index' || $current == 'commissions' || $current == 'contrat.setting') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">business_center</i>Contrats<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>

                                <li><a @if($current == 'contrat.index')style="color: #ce4c02;"@endif href="{{route('contrat.index')}}">Gestion</a></li>
                                <li class="encour"><a @if($current == 'commissions')style="color: #ce4c02;"@endif href="{{route('commissions')}}">Commissions</a></li>
                                <li class="encour"><a @if($current == 'contrat.setting')style="color: #ce4c02;"@endif href="{{route('contrat.setting')}}">Paramètres</a></li>
                        </ul>
                    </li>
                    @endadmin
                    <li class="encour @if($current == 'mandants.index' || $current == 'mandant.add') active open @endif" ><a class="sidebar-sub-toggle"><i class="large material-icons">supervisor_account</i>@lang('Mandants')<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>

                        <li class="encour" > <a @if($current == 'mandants.index')style="color: #ce4c02;"@endif href="{{route('mandants.index')}}">Gestion</a></li>
                        <li class="encour"><a @if($current == 'mandant.add')style="color: #ce4c02;"@endif href="{{route('mandant.add')}}">Ajouter</a></li>
                                <li><a href="#">Archives</a></li>
                                <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>
                    <li class="encour @if($current == 'bien.index') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">home</i>Biens<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if($current == 'bien.index')style="color: #ce4c02;"@endif href="{{route('bien.index')}}">Gestion</a></li>
                            <li><a href="#">Archives</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>
                    <li class="encour @if($current == 'mandat') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">gavel</i>Mandats<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if($current == 'mandat')style="color: #ce4c02;"@endif href="{{route('mandat')}}">Gestion</a></li>
                            <li><a href="#">Archives</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>

                    <li class="encour @if($current == 'notaire') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">vertical_split</i>Suivi d'affaires<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if($current == 'notaire')style="color: #ce4c02;"@endif href="{{route('notaire')}}">Gestion</a></li>
                            <li><a href="{{Route('params.affaire.index')}}">Paramètres</a></li>
                        </ul>
                    </li>

                    <li class="encour @if($current == 'acquereurs.index' || $current == 'acquereurs.add') active open @endif" ><a class="sidebar-sub-toggle"><i class="large material-icons">loyalty</i>Acquéreurs<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>

                                <li class="encour"> <a @if($current == 'acquereurs.index')style="color: #ce4c02;"@endif href="{{route('acquereurs.index')}}">Gestion</a></li>
                                <li class="encour"><a @if($current == 'acquereurs.add')style="color: #ce4c02;"@endif href="{{route('acquereurs.add')}}">Ajouter</a></li>
                                <li><a href="#">Archives</a></li>
                                <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>

                    <li class="encour @if($current == 'notaire') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">account_balance</i>Notaires<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if($current == 'notaire')style="color: #ce4c02;"@endif href="{{route('notaire')}}">Gestion</a></li>
                        </ul>
                    </li>
                    @admin
                    <li class="encour @if($current == 'facture') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">credit_card</i>Facturation<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if($current == 'facture')style="color: #ce4c02;"@endif href="{{route('facture')}}">Gestion</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>
                    @endadmin
                    {{-- <li><a class="sidebar-sub-toggle"><i class="large material-icons">shopping_cart</i>Boutique<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>

                                <li><a href="#">Commandes</a></li>
                                <li><a href="#">Gestion</a></li>
                                <li><a href="#">Ajout produits</a></li>
                                <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li> --}}

                         <li class="encour @if($current == 'formation.apply' || $current == 'formation.done' || $current == 'formation.documents' || $current == 'formation.plan' || $current == 'formation.cat' || $current == 'formation.index' || $current == 'formation.archives') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">school</i>Formations<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a @if ($current == 'formation.apply')style="color: #ce4c02;" @endif href="{{route('formation.apply')}}">Portail</a></li>
                            @admin_or_formateur
                            <li><a @if ($current == 'formation.cat')style="color: #ce4c02;" @endif href="{{route('formation.cat')}}">Catégories</a></li>
                            @endadmin_or_formateur
                            @admin_or_intervenant
                            <li><a @if ($current == 'formation.plan')style="color: #ce4c02;" @endif href="{{route('formation.plan')}}">Planifier</a></li>
                            @endadmin_or_intervenant
                            <li><a @if ($current == 'formation.done')style="color: #ce4c02;" @endif href="{{route('formation.done')}}">Effectuées</a></li>
                            <li><a @if ($current == 'formation.documents')style="color: #ce4c02;" @endif href="{{route('formation.documents')}}">Documents</a></li>
                            <li><a @if ($current == 'formation.index')style="color: #ce4c02;" @endif href="{{route('formation.index')}}">Index</a></li>
                            @admin
                            <li><a @if ($current == 'formation.archives')style="color: #ce4c02;" @endif href="{{route('formation.archives')}}">Archives</a></li>
                            @endadmin
                        </ul>
                    </li>

                    {{-- <li><a class="sidebar-sub-toggle"><i class="large material-icons">folder</i>Documents<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Gestion</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="label">Applications</li>
                    <li><a class="sidebar-sub-toggle"><i class="large material-icons">mail</i>  Messagerie  <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Mes messages</a></li>
                            <li><a href="#">Envoyer un message</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li> --}}

                    {{-- <li><a class="sidebar-sub-toggle"><i class="large material-icons">calendar_today</i>Plannification<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Mes planning</a></li>
                            <li><a href="#">Planning des utilisateurs</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li> --}}

                    <li class="encour @if($current == 'partners' || $current == 'partners.add') active open @endif"><a class="sidebar-sub-toggle"><i class="large material-icons">contacts</i>Contacts<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li class="encour"><a @if($current == 'partners')style="color: #ce4c02;"@endif href="{{route('partners')}}">Mes contacts</a></li>
                            <li class="encour"><a @if($current == 'partners.add')style="color: #ce4c02;"@endif href="{{route('partners.add')}}">Ajouter</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>

                    <li class="encour"><a class="sidebar-sub-toggle"><i class="large material-icons">call_split</i>@lang('Diffusion')<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                        <li class="encour"><a href="{{route('diffusion_auto.index')}}">@lang('Diffusion automatique') </a></li>
                        <li class="termine"><a href="{{route('diffusion_prog.index')}}"> @lang('Planifier la diffusion') </a></li>
                        <li class="encour"><a href="{{route('users.params')}}">@lang('Reporting d\'export')</a></li>
                        </ul>
                    </li>

                    <li class="encour"><a class="sidebar-sub-toggle"><i class="large material-icons">cast_connected</i>@lang('Passerelles')<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                        <li class="encour"><a href="{{route('passerelle.index')}}">@lang('Gestion') </a></li>
                        <li class="termine"><a href="{{route('users.archive')}}"> @lang('Archive') </a></li>
                        </ul>
                    </li>

                    {{-- <li><a class="sidebar-sub-toggle"><i class="large material-icons">pie_chart</i>Statistiques<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Vue globale</a></li>
                            <li><a href="#">Paramètres</a></li>
                        </ul>
                    </li>
                    <li class="label">Système et configuration</li> --}}
                    {{-- <li><a class="sidebar-sub-toggle"><i class="large material-icons">settings</i> Paramètres métier <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Applications</a></li>
                            <li><a href="#">Thème et apparence</a></li>
                            <li><a href="#">Droits et accés</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="large material-icons">settings_input_composite</i> Paramètres avancés <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Sécurité</a></li>
                            <li><a href="#">Fichiers et stockage</a></li>
                            <li><a href="#">Performances</a></li>
                            <li><a href="#">Base de données</a></li>
                            <li><a href="#">API et services</a></li>
                            <li><a href="#">Taches plannifiées</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="large material-icons">help</i> Aide et support <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Conditions d'utilisation</a></li>
                            <li><a href="#">Foire aux questions</a></li>
                            <li><a href="#">Confidentialité</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
@section('js-content')
<script>

</script>
@endsection
@endsection