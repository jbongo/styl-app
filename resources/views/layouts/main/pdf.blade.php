<!doctype html>
<html lang="fr">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Facturation</title>
      <link href="css/lib/bootstrap-pdf.css" rel="stylesheet">
      <link href="css/lib/unix.css" rel="stylesheet">
      <style>
         body {
         font-family: 'Open Sans', sans-serif;
         font-size:16px;
         line-height:20px;
         }
         .pad-top-botm {
         padding-bottom:40px;
         padding-top:15px;
         }
         h4 {
         text-transform:uppercase;
         }
         .contact-info span {
         font-size:14px;
         padding:0px 50px 0px 50px;
         }
         .contact-info hr {
         margin-top: 0px;
         margin-bottom: 0px;
         }
         .client-info {
         font-size:15px;
         }
         .ttl-amts {
         text-align:right;
         padding-right:50px;
         }
      </style>
   </head>
   <body>
      @yield('content')
   </body>