@extends('layouts.main.dashboard')
@section('header_name')
    Index des Formations
@stop
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')
<div class="row">   
  <div class="col-lg-12">
  	<div class="card">
  	@php $cnt = 1; @endphp
    	@foreach ($formationcategories as $category)
  	@if (!($category->parent))
  		@php $subcnt = 1; @endphp
  		<h2> {{ $cnt++ }} - {{ $category->nom }} <strong class="badge badge-pill badge-{{$category->tag_color}}" style="font-size: large">{{$category->tag}}</strong></h2>
  		<div style="height: 1em;"></div>
    		@foreach ($formationcategories as $subcategory)
    		@if ($subcategory->parent == $category->nom)
    		<h4 style="margin-left: 5em;"> {{ $subcnt++ }} - {{ $subcategory->nom }} <strong class="badge badge-pill badge-{{$category->tag_color}}" style="font-size: x-small">{{$category->tag}}</strong> <strong class="badge badge-pill badge-{{$subcategory->soustag_color}}" style="font-size: x-small">{{$subcategory->soustag}}</strong></h4>
    		    <div style="height: .5em;"></div>
    		    @foreach ($formations as $formation)
    		    @if ($formation->category_id == $subcategory->id)
    		    <span style="margin-left: 9em; font-size: small">{{ $formation->titre }} @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</span>
    		    <div style="height: 1em;"></div>
    		    @endif
    		    @endforeach
    		    <div style="height: 2em;"></div>
    		@endif
    		@endforeach
    		@foreach ($formations as $formation)
    		@if ($formation->category_id == $category->id && $formation->is_model)
    		<span style="margin-left: 5em;">{{ $formation->titre }} @if ($formation->hierarchie == 'complementaire') <span class="badge badge-pill badge-warning" style="font-size: xx-small;">COMPLEMENTAIRE</span>@else <span class="badge badge-pill badge-danger" style="font-size: small;">OBLIGATOIRE</span> @endif</span></span>
  		<div style="height: 2em;"></div>
    		@endif
    		@endforeach
  	@endif
  	@endforeach
  	</div>
  </div>
</div>
@endsection