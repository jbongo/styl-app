@component('mail::message')
Bonjour {{$nom}}

Vous avez ci-joint une facture à régler de la part de Styl'immo, le montant de cette facture doit etre réglé sous 30 jours 
@component('mail::panel')

Tout incident de paiement est passible d'intérêt de retard. Le montant des pénalités résulte de l'application aux sommes restant dues d'un taux d'intérêt légal en vigueur au moment de l'incident.
Indemnité forfaitaire pour frais de recouvrement due au créancier en cas de retard de paiement: 40€ .
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent