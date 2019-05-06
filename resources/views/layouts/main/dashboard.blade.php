<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Stylimmo') }}</title>
      <!-- Styles -->
      <!--material design-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--material design-->
      <link href="{{ asset('css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/rangSlider/ion.rangeSlider.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/rangSlider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/themify-icons.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/unix.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/menubar/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/owl.theme.default.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/select2/select2.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/toastr/toastr.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('css/lib/data-table/jquery.dataTables.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      {{-- 
      <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
      --}}
      <!--calendar-->
      <link rel="stylesheet" href="{{asset('css/lib/calendar/fullcalendar.css')}}">
      <!--calendar-->
      <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
      <link rel="stylesheet" href="{{asset('css/dropzone-custom.css')}}">
      {{-- 
      <link href="{{ asset('css/jquery.datatable.min.css') }}" rel="stylesheet">
      --}}
      <!-- Fonts -->
      <!-- cdn -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
      <link rel="dns-prefetch" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="{{asset('css/lib/bootstrap-select.min.css')}}">
      @yield('css')
   </head>
   <body>
      @yield('navbar')
      @yield('header')
      <div class="content-wrap">
         <div class="main">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-8 p-r-0 title-margin-right">
                     <div class="page-header">
                        <div class="page-title">
                           <h1>
                              <strong style="color: #32ade1; text-decoration: underline;">
                                 @yield('header_name')
                              </strong>
                           </h1>
                        </div>
                     </div>
                  </div>
                  <!-- /# column -->
                  <!-- choix de langue avec drapeaux? -->  
                  <div class="col-lg-4 p-l-0 title-margin-left">
                     <div class="page-header">
                        <div class="page-title">
                           <ol class="breadcrumb text-right">
                              <li><a href="#">Dashboard</a></li>
                              <li class="active">UI-Blank</li>
                           </ol>
                        </div>
                     </div>
                  </div>
                  <!-- /# column -->
               </div>
               <div id="main-content">
                  @yield('content')
               </div>
               <div class="zoom">
                  <a class="zoom-fab zoom-btn-large" id="zoomBtn"><i class="fa fa-question" style="font-size: xx-large; margin-top: 15px; color: #ffffff;"></i></a>
               </div>
               <div id="main-content">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="footer">
                           <p>Page générée le <span id="date-time" class="color-info"> </span> par Styl'immo LTD<a href="#" class="page-refresh" title="@lang('Actualiser')"> <span class="color-danger"><strong> Actualiser</strong></span></a></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="search">
         <button type="button" class="close">×</button>
         <form>
            <input type="search" value="" placeholder="Que voulez vous chercher ?" />
            <button type="submit" class="btn btn-primary">Rechercher</button>
         </form>
      </div>
      <!-- jquery vendor -->
      <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
      <script src="{{ asset('js/lib/jquery.nanoscroller.min.js') }}"></script>
      <script src="{{ asset('js/lib/menubar/sidebar.js') }}"></script>
      <script src="{{ asset('js/lib/preloader/pace.min.js') }}"></script>
      <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
      <script src="{{ asset('js/lib/circle-progress/circle-progress.min.js') }}"></script>
      <script src="{{ asset('js/lib/circle-progress/circle-progress-init.js') }}"></script>
      <script src="{{ asset('js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
      <script src="{{ asset('js/lib/select2/select2.full.min.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <!--range sliders-->
      <script src="{{ asset('js/lib/rangeSlider/ion.rangeSlider.min.js') }}"></script>
      <script src="{{ asset('js/lib//rangeSlider/rangeslider.init.js') }}"></script>
      <!--range sliders end-->
      <!--charts-->
      <script src="{{ asset('js/lib/morris-chart/raphael-min.js') }}"></script>
      <script src="{{ asset('js/lib/moment/moment.js') }}"></script>
      <script src="{{ asset('js/lib/moment/locale/fr.js') }}"></script>
      <!-- moment.js (gestion des dates) -->
      <script src="{{ asset('js/lib/morris-chart/morris.js') }}"></script>
      <!--chartsend-->
      <!--toastr-->
      <script src="{{ asset('js/lib/toastr/toastr.min.js') }}"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
      <!-- (Optional) Latest compiled and minified JavaScript translation files -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-fr_FR.min.js"></script>
      {{-- dropzone --}}
      <script src="{{ asset('js/dropzone.js') }}"></script>
      <script src="{{ asset('js/dropzone-config.js') }}"></script>
      <!--chartjs-->
      <script src="{{ asset('js/lib/chart-js/Chart.bundle.js') }}"></script>
      <!--depot-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
      <!--stack tables-->
      <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/stacktable.js"></script>
      <!--calendar-->
      <script src="{{ asset('js/lib/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/fr.js"></script>
      <script>
         /*$(document).ready(function() {
             $('table').stacktable();
             });*/
      </script>
      <script>
         var event = new Date();
         var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
         document.getElementById("date-time").innerHTML = event.toLocaleDateString('fr-FR', options);

         $('.page-refresh').on("click", function() {
             location.reload();
         });
      </script>
      <!-- /*  Auto date in footer and refresh-->
      <script>
         $('a[href="#search"]').on('click', function(event) {
                 event.preventDefault();
                 $('#search').addClass('open');
                 $('#search > form > input[type="search"]').focus();
             });
             
             $('#search, #search button.close').on('click keyup', function(event) {
                 if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                     $(this).removeClass('open');
                 }
             });        
      </script>
      <script>
         $('#verticalCarousel').carousel({
            interval: 2000
         })
         $(window).bind("resize", function() {
         if ($(this).width() < 680) {
             $('.logo').addClass('hidden')
             $('.hide_stuff').addClass('hidden')
             $('.sidebar').removeClass('sidebar-shrink')
             $('.sidebar').removeClass('sidebar-shrink, sidebar-gestures')
         }
         else {
             $('.logo').removeClass('hidden')
             $('.hide_stuff').removeClass('hidden')
             $('.sidebar').addClass('sidebar-shrink')
             $('.sidebar').addClass('sidebar-shrink, sidebar-gestures')
         }
         }).trigger('resize');
         $('.header li, .sidebar li').on('click', function() {
         $(".header li.active, .sidebar li.active").removeClass("active");
         $(this).addClass('active');
         });
         
         $(".header li").on("click", function(event) {
            event.stopPropagation();
         });
         
         $(document).on("click", function() {
            $(".header li").removeClass("active");
         });
         
         $(".hamburger").on('click', function() {
            $(this).toggleClass("is-active");
         });
         
      </script>
      <script>
         $(document).ready(function() {
             $('#example').DataTable( {
                 "language": {
                     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                 }
             } );
         } );
         
         $(document).ready(function() {
             $('#example2').DataTable( {
                 "language": {
                     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                 }
             } );
         } );
         
         $(document).ready(function() {
             $('#example3').DataTable( {
                 "language": {
                     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                 }
             } );
         } );
         
      </script>
      <!--toastr-->
      @if (session('ok'))
      <script>
         $(document).ready(function() {
            toastr.success('{{ session('ok') }}','Effectué',{
                "positionClass": "toast-top-right",
                timeOut: 55000,
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
         
            })
            });
      </script>
      @endif
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <script>
         $(document).ready(function() {
             toastr.error('{{$error}}','Erreur',{
         "positionClass": "toast-top-right",
         timeOut: 55000,
         "closeButton": true,
         "debug": false,
         "newestOnTop": true,
         "progressBar": true,
         "preventDuplicates": true,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "1000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut",
         "tapToDismiss": false
         
         })
            });
      </script>
      @endforeach
      @endif
      <script>
         $('#zoomBtn').click(function() {
            $('.zoom-btn-sm').toggleClass('scale-out');
            if (!$('.zoom-card').hasClass('scale-out')) {
               $('.zoom-card').toggleClass('scale-out');
            }
         });
         
         $('.zoom-btn-sm').click(function() {
            var btn = $(this);
            var card = $('.zoom-card');
         
         if ($('.zoom-card').hasClass('scale-out')) {
            $('.zoom-card').toggleClass('scale-out');
         }
         if (btn.hasClass('zoom-btn-person')) {
            card.css('background-color', '#d32f2f');
         } else if (btn.hasClass('zoom-btn-doc')) {
            card.css('background-color', '#fbc02d');
         } else if (btn.hasClass('zoom-btn-tangram')) {
            card.css('background-color', '#388e3c');
         } else if (btn.hasClass('zoom-btn-report')) {
            card.css('background-color', '#1976d2');
         } else {
            card.css('background-color', '#7b1fa2');
         }
         });
         
      </script>
      <!--fonction sweet alert confirmation oui/non avec ajax, on peut l'appeler partout-->
      <script>
            function processAjaxSwal(route, warning, reload) {
               $.ajaxSetup({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
               })
               $('[data-toggle="tooltip"]').tooltip()
               const swalWithBootstrapButtons = swal.mixin({
                  confirmButtonClass: 'btn btn-success btn-rounded',
                  cancelButtonClass: 'btn btn-danger btn-rounded',
                  buttonsStyling: false,
               })
               swalWithBootstrapButtons({
                  title: warning,
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: '@lang('Oui')',
                  cancelButtonText: '@lang('Non')',
               }).then((result) => {
                  if (result.value) {
                     $('[data-toggle="tooltip"]').tooltip('hide')
                     $.ajax({
                           url: route,
                           type: 'GET'
                        })
                     swalWithBootstrapButtons(
                           'Effectué !',
                           'L\'action demandée a été validée',
                           'success'
                        )
                        .then(function () {
                           if (reload == 1)
                              location.reload();
                        })
                  } else if (
                     result.dismiss === swal.DismissReason.cancel
                  ) {
                     swalWithBootstrapButtons(
                        'Annulé',
                        'L\'action a été annulée !',
                        'error'
                     )
                  }
               })
            }
            </script>
      @yield('js-home')
      @yield('js-content')
      @yield('js-mb')
   </body>
</html>