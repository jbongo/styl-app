@component('mail::message')
# Annulation d' une formation

@component('mail::panel')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
{{ $me->civilite }} {{ $me->prenom }} {{ $me->nom }}, <br />
Vous avez annulé la formation {{ $formation->titre }}, <br />
Merci de rapporter les raisons pour lesquelles vous avez prit cette décision. <br />
@endcomponent

Nous vous souhaitons une excellente journée,<br />
L' équipe Stylimmo.
{{-- {{ config('app.name') }} --}}
@endcomponent