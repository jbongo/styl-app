@extends('layouts.main.dashboard')
@section('header_name')
    Tableau de bord
@stop
@extends('compenents.header')
@prospect

@else
    @include('compenents.navbar')
@endprospect

@section('content')
@php
    $user = auth::user();
@endphp


    @if($user->role =="prospect")       
        @include('homeProspect')
    @elseif($user->role =="prospect_plus" && $user->bool_annex_5 == 0)
        @include('contrats.annex5')
    @else
        @include('homeOther')
    @endif

@stop
@section('js-home')
<script>
$(function () {
Morris.Area({
        element: 'morris-area-chart',
         data: [{
            period: '2001',
            smartphone: 0,
            windows: 0,
            mac: 0
        }, {
            period: '2002',
            smartphone: 90,
            windows: 60,
            mac: 25
        }, {
            period: '2003',
            smartphone: 40,
            windows: 80,
            mac: 35
        }, {
            period: '2004',
            smartphone: 30,
            windows: 47,
            mac: 17
        }, {
            period: '2005',
            smartphone: 150,
            windows: 40,
            mac: 120
        }, {
            period: '2006',
            smartphone: 25,
            windows: 80,
            mac: 40
        }, {
            period: '2007',
            smartphone: 10,
            windows: 10,
            mac: 10
        }


        ],
        xkey: 'period',
        ykeys: ['smartphone', 'windows', 'mac'],
        labels: ['Leboncoin', 'LogicImmo', 'Styl\'immo'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#55ce63', '#009efb', '#8b67c9'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#55ce63', '#009efb', '#8b67c9'],
        resize: true
        
    });

// LINE CHART
 // Morris donut chart
        
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Nouveaux prospects",
            value: 12,

        }, {
            label: "En ligne",
            value: 30
        }, {
            label: "En attente de validation",
            value: 20
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#8b67c9']
    });
 });  
</script>
@endsection
