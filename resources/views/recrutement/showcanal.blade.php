@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
                    <div class="row">
                            <div class="col-md-4 p-r-0">
                                <div class="card text-center border-right">
                                    <div class="m-t-10">
                                        <h3>Appels</h3>
                                        <h4 class="f-s-36">{{$array[0]}}</h4>
                                    </div>
                                    <div class="widget-card-circle pr m-t-40 m-b-30" id="primary-circle-card">
                                        <i class="material-icons pa">phone_forwarded</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-l-0 p-r-0">
                                <div class="card text-center border-right">
                                    <div class="m-t-10">
                                        <h3>Emails</h3>
                                        <h4 class="f-s-36">{{$array[1]}}</h4>
                                    </div>
                                    <div class="widget-card-circle pr m-t-40 m-b-30" id="danger-circle-card">
                                        <i class="material-icons pa">mail</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-l-0">
                                <div class="card text-center">
                                    <div class="m-t-10">
                                        <h3>Rencontres</h3>
                                        <h4 class="f-s-36">{{$array[2]}}</h4>
                                    </div>
                                    <div class="widget-card-circle pr m-t-40 m-b-30" id="info-circle-card">
                                            <i class="material-icons pa">weekend</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-6">
                            <div class="card">
                                    <h4 class="card-title" style="color: #32ade1; text-decoration: underline;">Recrutement et prospects professionnels</h4>
                                    <br>
                                    <ul class="list-inline text-right">
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5 text-inverse" style="color: #ff7019;"></i>Total Prospects du canal</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5 text-info" style="color: #8b67c9;"></i>Prospects profesionnels</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5 text-success" style="color: #2eace0;"></i>Prospects recrutés</h5>
                                            </li>
                                        </ul>
                                    <div class="card-body">
                                    <div id="morris-donut-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="card">
                                        <h4 class="card-title" style="color: #32ade1; text-decoration: underline;">Prospects mensuel du canal</h4>
                                        <br>
                                        <ul class="list-inline text-right">
                                                <li>
                                                    <h5><i class="fa fa-circle m-r-5 text-inverse" style="color:#7a92a3;"></i>Toutes les sources</h5>
                                                </li>
                                                <li>
                                                    <h5><i class="fa fa-circle m-r-5 text-info" style="color:#0b62a4;"></i>Canal</h5>
                                                </li>
                                            </ul>
                                    <div class="card-body">
                                            <div id="morris-area-chart"></div>
                                        </div>
                                    </div>
                                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('js-content')
<script>
        $(function () {
            Morris.Donut({
                element: 'morris-donut-chart',
                data: [{
                    label: "Total prospects du canal",
                    value: '{{$canal->leads->count()}}',
        
                }, {
                    label: "Recrutements définitifs",
                    value: '{{$array[4]}}'
                }, {
                    label: "Prospects professionnels",
                    value: '{{$array[3]}}'
                }],
                resize: true,
                colors:['#ff7019', '#2eace0', '#8b67c9']
            });
         });
         
         var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

Morris.Line({
  element: 'morris-area-chart',
  data: [
      @foreach($line_c as $tmp)
        {
        m: '{{$tmp[0]}}',
        a: {{$tmp[1]}},
        b: {{$tmp[2]}}
        },
      @endforeach
 ],
  xkey: 'm',
  ykeys: ['a', 'b'],
  labels: ['Prospects du canal', 'Tous les prospects'],
  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
  dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
});
        </script>
@endsection