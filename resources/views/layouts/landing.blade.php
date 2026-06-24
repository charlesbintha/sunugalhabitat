<!DOCTYPE html>
<html lang="fr-SN" @yield('html_attribute')>

<head>

    @include('layouts.partials.title-meta')

    <!--===== CSS LINK =======-->
    @vite(['resources/scss/main.scss'])

    @yield('css')

    @yield('schema')

</head>

<body class="homepage3-body @yield('body_attribute')">

    @include('layouts.partials.loader')
    @if (request()->routeIs('home'))
        @include('layouts.partials.world-cup-popup')
    @endif

    @include('layouts.partials.header.navbar')


    @yield('content')


    @include('layouts.partials.footer')

    @yield('scripts')

    @vite(['resources/js/main.js'])

</body>

</html>
