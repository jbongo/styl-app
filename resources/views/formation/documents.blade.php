@extends('layouts.main.dashboard')
@section('header_name')
Documents publiques des formations
@stop
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
@php setlocale(LC_TIME, "fr_FR.UTF-8"); header('Content-Type: text/html; charset=UTF-8') @endphp
<div class="row">
  <div class="col-lg-12">
    <div class="card">
    </div>
  </div>
</div>
@endsection