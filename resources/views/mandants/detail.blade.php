@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
    @section('pageActuelle')
    @lang('Modification d\'mandants')
    @endsection
    
        <div class="card alert">
            
           
            <h2>@lang('Modifier un mandant')</h2>
            
            
            @if($mandant->type == "personne_seule")
                @include('compenents.mandants.detailPersonneSeule')
            @elseif($mandant->type == "couple")            
                @include('compenents.mandants.detailCouple')
            @elseif($mandant->type == "personne_morale")            
                @include('compenents.mandants.detailPersonneMorale')
            @endif
          
            
        </div>

    
        
@endsection

@section('js-content')    




@endsection