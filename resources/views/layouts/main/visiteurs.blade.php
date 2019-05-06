<!DOCTYPE HTML>
<html lang="fr">
   <head>
      <title>Suivi du dossier</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta charset="utf-8">
      <script>
         addEventListener("load", function () {
             setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
             window.scrollTo(0, 1);
         }
      </script>
      <link href="{{asset('css/visiteurs/bootstrap.css')}}" rel='stylesheet' type='text/css' />
      <!-- Custom CSS -->
      <link href="{{asset('css/visiteurs/style.css')}}" rel='stylesheet' type='text/css' />
      <!-- font-awesome icons -->
      <link href="{{asset('css/visiteurs/fontawesome-all.min.css')}}" rel="stylesheet">
      <!-- //Custom Theme files -->
      <!-- side nav css file -->
      <link href="{{asset('css/visiteurs/SidebarNav.min.css')}}" media='all' rel='stylesheet' type='text/css' />
      <!-- //side nav css file -->

      <link href="{{ asset('css/lib/data-table/jquery.dataTables.min.css') }}" rel="stylesheet">
      <!-- web fonts -->
      <!-- logo -->
      <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
      <!-- titles -->
      <link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
      <!-- body -->
      <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
   </head>
   <body class="cbp-spmenu-push">
      <div class="main-content">
         <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--navbar-->
            @yield('navbar')
         </div>
      </div>
      <header class="header-section">
         <div class="header-left  clearfix">
            <!--logo start-->
            <div class="brand">
               <button id="showLeftPush">
               <i class="fas fa-bars"></i>
               </button>
            </div>
            <!--logo end-->
         </div>
         <div class="header-right">
         </div>
      </header>
      <div id="page-wrapper">
         <div class="inner-bc">
            <div class="container">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                     </li>
                     <li class="breadcrumb-item active text-capitalize" aria-current="page">services</li>
                  </ol>
               </nav>
            </div>
         </div>
         <!--content-->
         @yield('content')
         <!--footer-->
         @yield('footer')
      </div>
      <script src="{{asset('js/visiteurs/jquery-2.2.3.min.js')}}"></script>
      <script src="{{asset('js/visiteurs/classie.js')}}"></script>
      <script>
         var menuLeft = document.getElementById('cbp-spmenu-s1'),
             showLeftPush = document.getElementById('showLeftPush'),
             body = document.body;
         
         showLeftPush.onclick = function () {
             classie.toggle(this, 'active');
             classie.toggle(body, 'cbp-spmenu-push-toright');
             classie.toggle(menuLeft, 'cbp-spmenu-open');
             disableOther('showLeftPush');
         };
         
         
         function disableOther(button) {
             if (button !== 'showLeftPush') {
                 classie.toggle(showLeftPush, 'disabled');
             }
         }
      </script>
      <script src='{{asset('js/visiteurs/SidebarNav.min.js')}}'></script>
      <script src="{{asset('js/visiteurs/move-top.js')}}"></script>
      <script src="{{asset('js/visiteurs/easing.js')}}"></script>
      <script>
         jQuery(document).ready(function ($) {
             $(".scroll ").click(function (event) {
                 event.preventDefault();
         
                 $('html,body').animate({
                     scrollTop: $(this.hash).offset().top
                 }, 1000);
             });
         });
      </script>
      <script>
         $(document).ready(function () {
             $().UItoTop({
                 easingType: 'easeOutQuart'
             });
         
         });
      </script> 
      <script>
            $(document).ready(function () {
                $('treeview').onclick() function(e)({
                    preventDefault();
                    this.add
                });
                });
            
            });
         </script>
      <script src="{{asset('js/visiteurs/SmoothScroll.min.js')}}"></script>
      <script src="{{asset('js/visiteurs/bootstrap.js')}}"></script>
      <script src="{{asset('js/sweetalert2.js')}}"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
      @yield('js-content')
   </body>
</html>