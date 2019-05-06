@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    @section('pageActuelle')
    @lang('Modification d\'acquereurs')
    @endsection
    
        <div class="card alert">
            
           
            <h2>@lang('Modifier un acquereur')</h2>
            
            
            @if($acquereur->type == "personne_seule")
                @include('compenents.acquereurs.detailPersonneSeule')
            @elseif($acquereur->type == "couple")            
                @include('compenents.acquereurs.detailCouple')
            @elseif($acquereur->type == "personne_morale")            
                @include('compenents.acquereurs.detailPersonneMorale')
            @endif
          
            
        </div>

    
        
@endsection

@section('js-content')    




@endsection