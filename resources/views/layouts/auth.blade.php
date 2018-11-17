<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="👨🏾‍🔧 System for the maintenance control made with Laravel Framework.">
    <meta name="author" content="Luis Alcaras">
    <link rel="icon" type="image/png" sizes="16x16"
          href="http://rodasports.com.mx/www/wp-content/uploads/2015/06/ICON_RDSPRTS_TTR.jpg">
    <title>{{ config('app.name') }} - Sign In</title>
    <!-- CSS Application -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<main>
    @yield('content')
</main>
<!-- JavaScript Application -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>