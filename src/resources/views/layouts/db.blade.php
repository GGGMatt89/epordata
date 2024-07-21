<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EPORDATA sas website">
    <meta name="author" content="Mattia Fontana @ Flumens Techlab">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Epordata SAS') }}</title>
    @vite('resources/js/app.js')
    @vite('resources/js/db_app.js')

    {{-- FULL CALENDAR --}}
    <link href='/lib/fullcalendar/core/main.css' rel='stylesheet' />
    <link href='/lib/fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href='/lib/fullcalendar/timegrid/main.css' rel='stylesheet' />
    <link href='/lib/fullcalendar/bootstrap/main.css' rel='stylesheet' />
    <script src='/lib/fullcalendar/core/main.js'></script>
    <script src='/lib/fullcalendar/daygrid/main.js'></script>
    <script src='/lib/fullcalendar/timegrid/main.js'></script>
    <script src='/lib/fullcalendar/bootstrap/main.js'></script>
    <script src='/lib/fullcalendar/core/locales/es.js'></script>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" href="/img/main_home/epordata.ico"/>
</head>

<body id="page-top">


    @include('sweetalert::alert')

<!-- SCRIPT SECTION  -->
  <!-- Plugin JavaScript -->
  <script type="module" src="/lib/jquery-easing/jquery.easing.min.js"></script>
  {{-- Template scripts --> clean and integrate in main file --}}
  <script src="/js/db_main.js"></script>

  {{-- Custom scripts --}}
    {{-- <script src="/js/calendar.js"></script> --}}
    <script src="/js/clock.js" defer></script>
    <script src="/js/delete_confirmation.js"></script>

    {{-- @yield('navbar') --}}
    @include('db_views.shared.db-nav')
    {{-- main container --}}
    <div class='main-container' id='main-container'>
        <div class='row'>
            <div class='col-sm-12 col-lg-10'>{{-- main page column --}}
                @yield ('main_content_page')
            </div>{{-- end main page column --}}
            <div class='col-sm-4 col-lg-2'>{{-- sidebar column --}}
                @include('db_views.shared.db-sidebar')
            </div>{{-- end sidebar column --}}
        </div> {{-- end row --}}
    </div>

    {{-- end main container --}}

    {{-- @yield('footerbar') --}}
    @include('shared_views.footerbar')

  </body>

</html>
