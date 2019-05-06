@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <ul class="nav nav-pills nav-tabs" id="zobi">
               <li class="active"><a data-toggle="pill" href="#home"><i class="ti-agenda"></i> @lang('Agenda')</a></li>
               <li><a data-toggle="pill" href="#leadrtt"><i class="ti-user"></i> @lang('Prospects')</a></li>
               <li><a data-toggle="pill" href="#can"><i class="ti-magnet"></i> @lang('Canneaux')</a></li>
               <li><a data-toggle="pill" href="#stat"><i class="ti-bar-chart"></i> @lang('Statistiques')</a></li>
            </ul>
            <br><br>
            <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                        @include('compenents.recrutement.agenda')
                  </div>
               <div id="leadrtt" class="tab-pane fade">
                  @include('compenents.recrutement.lead')
               </div>
               <div id="can" class="tab-pane fade">
                  @include('compenents.recrutement.canal')
               </div>
               <div id="stat" class="tab-pane fade">
                     @include('compenents.recrutement.stat')
               </div>
           </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js-content')

<script>
   $(document).ready(function() {
       $('#leadtab').DataTable( {
           "language": {
           "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
           }
       });
       $('#canaltab').DataTable( {
           "language": {
           "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
           }
       });
   });
</script>
<script>
   $(document).ready(function() {
      $('.bouboule1').hide();
      $('#bouboule2').hide();
      $('#b_pro').change(function(e){
            e.preventDefault();
            $('#b_pro').is(':unchecked') ? $('.bouboule1').hide() : $('.bouboule1').show();
            if ($('#b_pro').is(':unchecked'))
               $('#bouboule2').hide();
            else if(!($('#b_pro_immo').is(':unchecked')))
               $('#bouboule2').show();
      });
      $('#b_pro_immo').change(function(e){
            e.preventDefault();
            $('#b_pro_immo').is(':unchecked') ? $('#bouboule2').hide() : $('#bouboule2').show();
      });
      $('a.check_agenda').click(function(e) {
      e.preventDefault();   
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Valider dans le cas ou la tache plannifié a été réussie, continuer ?';
      processAjaxSwal(route, warning, reload);
   })

   $('a.uncheck_agenda').click(function(b) {
      b.preventDefault();       
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Valider dans le cas ou la tache n\'a pas abouti ou annulée, continuer ?';
      processAjaxSwal(route, warning, reload);
   })

   $('a.delete_lead').click(function(b) {
      b.preventDefault();       
      let that = $(this);
      var route = that.attr('href');
      var reload = 1;
      var warning = 'Le prospect sera definitivement supprimé ainsi que tous son suivi, continuer ?';
      processAjaxSwal(route, warning, reload);
   })
   });
</script>
<script>
   (function ($) {
    "use strict";

    //Team chart 2 eme en haut droite
    var ctx = document.getElementById("team-chart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: ['$cannaux[0][1]}}', '{{$cannaux[1][1]}}', '{{$cannaux[2][1]}}', '{{$cannaux[3][1]}}', '{{$cannaux[4][1]}}', '{{$cannaux[5][1]}}', '{{$cannaux[6][1]}}', '{{$cannaux[7][1]}}', '{{$cannaux[8][1]}}', '{{$cannaux[9][1]}}', '{{$cannaux[10][1]}}', '{{$cannaux[11][1]}}'],
                label: "Cannaux physiques",
                backgroundColor: 'rgba(255,46,68,.75)',
                borderColor: 'rgba(255,46,68,.75)',
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#ed7f7e',
                    }, {
                label: "Cannaux virtuels",
                data: ['$cannaux[0][0]}}', '{{$cannaux[1][0]}}', '{{$cannaux[2][0]}}', '{{$cannaux[3][0]}}', '{{$cannaux[4][0]}}', '{{$cannaux[5][0]}}', '{{$cannaux[6][0]}}', '{{$cannaux[7][0]}}', '{{$cannaux[8][0]}}', '{{$cannaux[9][0]}}', '{{$cannaux[10][0]}}', '{{$cannaux[11][0]}}'],
                backgroundColor: 'rgba(135,222,117,.75)',
                borderColor: 'rgba(135,222,117,.75)',
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#87de75',
                    }]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                        }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Nombre'
                    }
                        }]
            },
            title: {
                display: false,
            }
        }
    });


    //Sales chart 1er avec 3 lignes
    var ctx = document.getElementById("sales-chart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                label: "Tous les prospects",
                data: ['{{$prospects[0][0]}}', '{{$prospects[1][0]}}', '{{$prospects[2][0]}}', '{{$prospects[3][0]}}', '{{$prospects[4][0]}}', '{{$prospects[5][0]}}', '{{$prospects[6][0]}}', '{{$prospects[7][0]}}', '{{$prospects[8][0]}}', '{{$prospects[9][0]}}', '{{$prospects[10][0]}}', '{{$prospects[11][0]}}'],
                backgroundColor: 'transparent',
                borderColor: '#e6a1f2',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#e6a1f2',

                    }, {
                label: "Non contactés",
                data: ['{{$prospects[0][1]}}', '{{$prospects[1][1]}}', '{{$prospects[2][1]}}', '{{$prospects[3][1]}}', '{{$prospects[4][1]}}', '{{$prospects[5][1]}}', '{{$prospects[6][1]}}', '{{$prospects[7][1]}}', '{{$prospects[8][1]}}', '{{$prospects[9][1]}}', '{{$prospects[10][1]}}', '{{$prospects[11][1]}}'],
                backgroundColor: 'transparent',
                borderColor: '#ed7f7e',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#ed7f7e',
                    }, {
                label: "Contactés",
                data: ['{{$prospects[0][2]}}', '{{$prospects[1][2]}}', '{{$prospects[2][2]}}', '{{$prospects[3][2]}}', '{{$prospects[4][2]}}', '{{$prospects[5][2]}}', '{{$prospects[6][2]}}', '{{$prospects[7][2]}}', '{{$prospects[8][2]}}', '{{$prospects[9][2]}}', '{{$prospects[10][2]}}', '{{$prospects[11][2]}}'],
                backgroundColor: 'transparent',
                borderColor: '#87de75',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#87de75',
                    }]
        },
        options: {
            responsive: true,

            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                        }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Nombre'
                    }
                        }]
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });
    //line chart
    var ctx = document.getElementById("lineChart");
    ctx.height = 60;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
            datasets: [
                {
                    label: "Professionnels",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: ['{{$prospects[0][4]}}', '{{$prospects[1][4]}}', '{{$prospects[2][4]}}', '{{$prospects[3][4]}}', '{{$prospects[4][4]}}', '{{$prospects[5][4]}}', '{{$prospects[6][4]}}', '{{$prospects[7][4]}}', '{{$prospects[8][4]}}', '{{$prospects[9][4]}}', '{{$prospects[10][4]}}', '{{$prospects[11][4]}}']
                            },
                {
                    label: "Professionnels de l'immobilier",
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(24, 168, 255, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: ['{{$prospects[0][5]}}', '{{$prospects[1][5]}}', '{{$prospects[2][5]}}', '{{$prospects[3][5]}}', '{{$prospects[4][5]}}', '{{$prospects[5][5]}}', '{{$prospects[6][5]}}', '{{$prospects[7][5]}}', '{{$prospects[8][5]}}', '{{$prospects[9][5]}}', '{{$prospects[10][5]}}', '{{$prospects[11][5]}}']
                            }
                        ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });


    //bar chart 3eme ligne gauche
    var ctx = document.getElementById("barChart");
//    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
            datasets: [
                {
                    label: "Tous les contacts",
                    data: ['{{$prospects[0][0]}}', '{{$prospects[1][0]}}', '{{$prospects[2][0]}}', '{{$prospects[3][0]}}', '{{$prospects[4][0]}}', '{{$prospects[5][0]}}', '{{$prospects[6][0]}}', '{{$prospects[7][0]}}', '{{$prospects[8][0]}}', '{{$prospects[9][0]}}', '{{$prospects[10][0]}}', '{{$prospects[11][0]}}'],
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(24, 168, 255, 0.5)"
                            },
                {
                    label: "Recrutements réussis",
                    data: ['{{$prospects[0][3]}}', '{{$prospects[1][3]}}', '{{$prospects[2][3]}}', '{{$prospects[3][3]}}', '{{$prospects[4][3]}}', '{{$prospects[5][3]}}', '{{$prospects[6][3]}}', '{{$prospects[7][3]}}', '{{$prospects[8][3]}}', '{{$prospects[9][3]}}', '{{$prospects[10][3]}}', '{{$prospects[11][3]}}'],
                    borderColor: "rgba(0,0,0,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0,0,0,0.07)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                                }]
            }
        }
    });

    //radar chart
    var ctx = document.getElementById("radarChart");
    ctx.height = 160;
    var myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ["Appels", "Email", "Contactés", "Rencontres", "Recrutements réussi", "Professionnels", "Professionnels immobilier"],
            datasets: [
                {
                    label: "Cannaux physique",
                    data: ['{{$radar[4][1]}}', '{{$radar[5][1]}}', '{{$radar[0][1]}}', '{{$radar[6][1]}}', '{{$radar[1][1]}}', '{{$radar[2][1]}}', '{{$radar[3][1]}}'],
                    borderColor: "rgba(55, 160, 0, 0.6)",
                    borderWidth: "1",
                    backgroundColor: "rgba(160, 0, 13, 0.4)"
                            },
                {
                    label: "Cannaux virtuels",
                    data: ['{{$radar[4][0]}}', '{{$radar[5][0]}}', '{{$radar[0][0]}}', '{{$radar[6][0]}}', '{{$radar[1][0]}}', '{{$radar[2][0]}}', '{{$radar[3][0]}}'],
                    borderColor: "rgba(55, 160, 0, 0.7",
                    borderWidth: "1",
                    backgroundColor: "rgba(24, 168, 255, 0.5)"
                            }
                        ]
        },
        options: {
            legend: {
                position: 'top'
            },
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });

    // single bar chart

})(jQuery);
   </script>

   <script>
       !function($) {

    var CalendarApp = function() {
        this.$calendar = $('#calendar'),
        this.$calendarObj = null
    };
    /* Initializing */
    CalendarApp.prototype.init = function() {
        var defaultEvents =  [
            @foreach($calendar as $one)
            {
                title: '{{$one->role.' '.$one->leads->nom.' '.$one->leads->prenom}}',
                start: new Date('{{date('Y-m-d',strtotime($one->date)).'T'.$one->heure.':'.'00'}}') ,
                @if($one->role ==="appel")
                    className: "bg-success"
                @elseif($one->role ==="email")
                    className: "bg-warning"
                @else
                    className: "bg-pink"
                @endif
            },
            @endforeach
        ];

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00',
            minTime: '00:00:00',
            local: 'fr',
            maxTime: '23:59:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: false,
            droppable: false,
            eventLimit: true,
            selectable: false,
        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    $.CalendarApp.init()
}(window.jQuery);

       </script>
@endsection