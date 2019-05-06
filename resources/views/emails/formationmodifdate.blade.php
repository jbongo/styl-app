@component('mail::message')
# Annulation d' une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, <br />
La formation {{ $formation->titre }} a été replanifié pour le {{ strftime("%a %d %B", strtotime($formation->starting_date)) }} à {{ strftime("%H:%M", strtotime($formation->starting_date)) }}. <br />
Nous nous excusons pour toute inconvénience crée par cette décision. <br />
@endcomponent

Nous vous souhaitons tout de même une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent