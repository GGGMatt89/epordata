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

    {{-- PLEASE WAIT --}}
      {{-- <link href="/lib/please-wait/please-wait.css" rel="stylesheet"> --}}
      {{-- <script type="text/javascript" src="/lib/please-wait/please-wait.min.js"></script> --}}

    {{-- FAVICON --}}
      <link rel="shortcut icon" type="image/png" href="/img/main_home/epordata.ico"/>
</head>

<body id="page-top">
  @yield ('main_content')
  @include('sweetalert::alert')

    {{-- Contact form JavaScript --}}
      <script type="module" src="/js/jqBootstrapValidation.js"></script>
      <script type="module" src="/js/contact_me.js"></script>

    {{-- Custom scripts --}}
      {{-- <script src="/js/directContact.js"></script> --}}

</body>

</html>
