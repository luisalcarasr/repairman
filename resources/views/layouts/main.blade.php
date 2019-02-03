<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16"
          href="">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar has-background-light" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <strong>{{ config('app.name') }}</strong>
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
           data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-start">
            <a href="{{route('dashboard.index')}}" class="navbar-item">Home</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Resources</a>
                <div class="navbar-dropdown">
                    <a href="{{route('area.index')}}" class="navbar-item">Areas</a>
                    <a href="{{route('file.index')}}" class="navbar-item">Files</a>
                    <a href="{{route('machine.index')}}" class="navbar-item">Machines</a>
                    <a href="{{route('maintenance.index')}}" class="navbar-item">Maintenances</a>
                    <a href="{{route('maintenance-type.index')}}" class="navbar-item">Maintenance Types</a>
                    <a href="{{route('user.index')}}" class="navbar-item">Users</a>
                </div>
            </div>
        </div>
        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                <div class="navbar-dropdown">
                    <a onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();"
                       href="{{route('logout')}}" class="navbar-item">
                        Sign out
                    </a>
                    <form id="sign-out-form" class="is-hidden" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="app" class="container is-fullheight">
    @yield('content')
</div>
<footer class="footer">
    <div class="content has-text-centered">
        {{ \Carbon\Carbon::now()->format('Y') }} &copy;
        <a href="http://luisalcarasr.ml">Luis Adrian Alcaras Rubalcava</a>
    </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
