<div class="panel panel-warning m-t-15">
<div class="panel-heading"> {{ strtoupper($bien->type_offre) }} | {{strtoupper($bien->type_bien)}} | {{strtoupper($bien->ville)}} ({{$bien->code_postal}})</div>
        <div class="panel-body">
                @if($bien->type_bien != "terrain")
                 {{$bien->nombre_piece}} @lang('pièces') 
                @endif
                 {{$bien->surface_habitable}} @lang('m²')

                 {{$bien->titre_annonce}}
        </div>
</div>
<hr>

{{-- Informations sur le bien  && Prix public   --}}
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-8">
        <h4> <strong>@lang('Informations')</strong> @lang('sur le bien')</h4>
        <h6>@lang('récapitulatif concernant votre bien immobilier')</h6>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-4 " style="background: #5c96b3; color: white;">
            <h4> <strong>@lang('Prix public')</strong> </h4>
            <h3>{{$bien->prix_public}} @lang('€')</h3>

    </div>
    <div class="col-md-12 col-lg-12 col-sm-12">
        <p><strong>@lang('Dossier n °') {{$bien->numero_dossier}} </strong></p>
        <p> {{$bien->description_annonce}} </p>
    </div>
</div>
<hr>

{{-- Informations principales && Equipements du bien --}}
<div class="row">
        <div class="col-md-5 col-lg-5 col-sm-5 " style="background: #5c96b3; color: white;">
        <h4> <strong>@lang('Informations')</strong> @lang('principales')</h4>
            
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1" style="background: #5c96b3; color: white;">
        <h4> <strong>@lang('Equipements')</strong> @lang('du bien')</h4>
    
        </div>
       
</div>

<div class="row">
        <div class="col-md-5 col-lg-5 col-sm-5 ">
                <br><p> {{$bien->type_type_bien}},  
                        @if($bien->type_bien != "terrain")
                                {{$bien->nombre_piece}} @lang('pièce(s)'), 
                        @endif 
                        @lang('situé dans la commune de : ') {{ucfirst(strtolower($bien->ville)) }}
                </p>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
               <br> <p> 
                @if($bien->piscine !="Non précisé" && $bien->piscine !="")
                        @lang('Piscine'), 
                @endif

                @if($bien->nombre_chambre > 0 && $bien->nombre_chambre !="")
                        {{$bien->nombre_chambre}} @lang('chambre(s)'),
                @endif

                @if($bien->terrasse_agencement_exterieur !="Non précisé" && $bien->terrasse_agencement_exterieur !="")
                        @lang('Terrasse'),
                @endif
                @if($bien->jardin !="Non précisé" && $bien->jardin !="")
                        @lang('Jardin'),
                @endif

                @if($bien->nombre_garage > 0 && $bien->nombre_garage !="")
                        {{$bien->nombre_garage}} @lang('garage(s)')
                @endif ...
                </p>
        </div>
</div>



{{-- Historique de l'annonce && Taxe foncière du bien --}}
<hr>
<div class="row">
        <div class="col-md-5 col-lg-5 col-sm-5 " style="background: #5c96b3; color: white;">
        <h4> <strong>@lang('Historique')</strong> @lang('de l\'annonce' )</h4>
            
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1" style="background: #5c96b3; color: white;">
        <h4> <strong>@lang('Taxe foncière')</strong> @lang('du bien' )</h4>
    
        </div>
       
</div>
<div class="row">
        <div class="col-md-5 col-lg-5 col-sm-5 ">
                <p>
                @lang('Ajouté le : ') {{$bien->created_at->format('d-m-y à h:m')}}
                </p>    
                <p>
                @lang('Modifié le : ') {{$bien->updated_at->format('d-m-y à h:m')}}      
                </p>            
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                <br><p>
                @if($bien->taxe_fonciere_info_fin > 0 && $bien->taxe_fonciere_info_fin !="")
                <strong>{{$bien->taxe_fonciere_info_fin}} </strong>
                @else
                <strong>0 </strong>
                @endif
                    @lang('€ / ans')   
                </p>        

        </div>
        
</div>
<hr>

{{-- Bien diffusable ou non --}}
<div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 "style="background: #5c96b3; color: white;">
                <h4> <strong>@lang('Ce bien')</strong> @lang('n\'est pas diffusable')</h4>                          
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12">
                <br><p>
                @lang('Ce bien n\'est pas présent à l\'export. ') 
                </p>        

        </div>
        
</div>
        