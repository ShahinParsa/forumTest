<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shahin@Tjuna') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

<!-- Styles -->
    <link href="https://bootswatch.com/4/superhero/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">

</head>
<body style="width: 80%; margin-left: 10%;">
{{--NAVBAR--}}
@include('layouts.partials.navbar')

<div class="container" style="margin-top: 3%;">
    <div class="row">
        @yield('heading')
    </div>

    <div class="row">
        @yield('content')
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@section('js')
</body>
</html>