<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/codebase.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed">
        @include('layouts.sidebar')
        @include('layouts.header')
        <main id="main-container">
            <div class="content">
                @yield('content')
            </div>
        </main>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/codebase.js') }}"></script>
</body>
</html>
