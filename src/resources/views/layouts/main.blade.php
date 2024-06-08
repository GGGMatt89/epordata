<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EPORDATA sas website">
    <meta name="author" content="Mattia Fontana">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Epordata SAS') }}</title>
    @vite('resources/js/app.js')
    {{-- @vite('resources/css/app.css') --}}

    {{-- FULL CALENDAR --}}
        {{-- CSS --}}
        {{-- <link href='/lib/fullcalendar/core/main.css' rel='stylesheet' />
        <link href='/lib/fullcalendar/daygrid/main.css' rel='stylesheet' />
        <link href='/lib/fullcalendar/bootstrap/main.css' rel='stylesheet' /> --}}
        {{-- JS --}}
        {{-- <script src='/lib/fullcalendar/core/main.js'></script>
        <script src='/lib/fullcalendar/daygrid/main.js'></script>
        <script src='/lib/fullcalendar/bootstrap/main.js'></script>
        <script src='/lib/fullcalendar/core/locales/es.js'></script> --}}

    {{-- PLEASE WAIT --}}
      {{-- <link href="/lib/please-wait/please-wait.css" rel="stylesheet"> --}}

    {{-- SCRIPT SECTION  --}}
    {{-- Bootstrap core JavaScript --}}
      {{-- <script src="/lib/jquery/jquery.min.js"></script> --}}

    {{-- Plugin JavaScript --}}
      {{-- <script src="/lib/jquery-easing/jquery.easing.min.js"></script>
      <script type="text/javascript" src="/lib/please-wait/please-wait.min.js"></script> --}}


    {{-- FAVICON --}}
      <link rel="shortcut icon" type="image/png" href="/img/main_home/epordata.ico"/>
</head>

<body id="page-top">
  @yield ('main_content')
  @include('sweetalert::alert')

    {{-- Contact form JavaScript --}}
      {{-- <script src="/js/jqBootstrapValidation.js"></script> --}}
      {{-- <script src="/js/contact_me.js"></script> --}}

    {{-- Custom scripts --}}
      {{-- <script src="/js/calendar.js"></script> --}}
      {{-- <script src="/js/directContact.js"></script> --}}

</body>

</html>
