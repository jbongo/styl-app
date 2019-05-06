@component('mail::message')
# Annulation d' une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $usr->civilite }} {{ $usr->prenom }} {{ $usr->nom }}, <br />
L' emplacement de la formation {{ $formation->titre }} a été changé pour {{ $formation->lieu }} ( {{ $formation->postal }} ) , {{ $formation->st }}. <br />
Nous nous excusons pour toute inconvénience crée par cette décision. <br />
@endcomponent

Nous vous souhaitons tout de même une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent