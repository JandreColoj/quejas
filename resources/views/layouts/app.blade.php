<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BAM') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/library/nya-bs-select.css') }}">

   <!-- Bootstrap core CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/headers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body id="app" ng-app="app" ng-strict-di>

   @yield('content')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

   <script type="text/javascript" src="{{asset('js/core/angular.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/core/angularController.js')}}"></script>

   <script type="text/javascript" src="{{asset('js/Controller/Controllers.js')}}"></script>

   <script type="text/javascript" src="{{asset('js/library/ngMask.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/ng-infinite-scroll.min.js')}}"></script>

   <script type="text/javascript" src="{{asset('js/library/angular-js-xlsx.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/xlsx.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/export_excel/FileSaver.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/angular-local-storage.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/quill.js')}}"></script>

   {{-- <script type="text/javascript" src="{{asset('js/library/highcharts/highstock.js')}}"></script> --}}
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
   <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   <script type="text/javascript" src="{{asset('js/library/highcharts/exporting.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/highcharts/highcharts-more.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/highcharts/solid-gauge.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/highcharts/export-data.js')}}"></script>

   {{-- <script type="text/javascript" src="{{asset('js/library/chart/Chart.min.js')}}"></script> --}}




   <script type="text/javascript" src="{{asset('js/library/pdf/jspdf.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/pdf/html2canvas.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/flickity.pkgd.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/library/timepicker.min.js')}}"></script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('API_GOOGLE')}}&libraries=visualization"></script>

   <script src="https://use.fontawesome.com/2b92c0ad6d.js"></script>

   @stack('scripts')


</body>
</html>
