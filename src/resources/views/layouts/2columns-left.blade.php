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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="http://laravel.localhost" class="navbar-brand">
                Jakub Żurawa
            </a></div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12 messages">
            @if(Session::has('success'))

                <div class="alert alert-success">
                    {{ Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error')}}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 sidebar">
            @component('product-frontend::layouts.2columns-left.sidebar')
            @endcomponent
        </div>
        <div class="col-md-9 content">
            @yield('content')
        </div>
    </div>
</div>


</div>
</body>
</html>
