@component('mail::message')
# Annulation d' une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $me->civilite }} {{ $me->prenom }} {{ $me->nom }}, <br />
Vous avez replanifié la formation {{ $formation->titre }} pour le {{ strftime("%a %d %B", strtotime($formation->starting_date)) }} à {{ strftime("%H:%M", strtotime($formation->starting_date)) }}, <br />
ainsi que l' emplacement: {{ $formation->lieu }} ( {{ $formation->postal }} ) , {{ $formation->st }}, <br />
Merci de rapporter les raisons pour lesquelles vous avez prit cette décision. <br />
@endcomponent

Nous vous souhaitons une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent