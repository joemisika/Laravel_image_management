<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Site Title</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-static-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Image Management</a>
        </div>
        <ul class="nav navbar-nav">
            <li @if(Request::is('Galleries')) class="active" @endif>
                <a href="{{ route('galleries.index') }}">Galleries</a>
            </li>
            <li @if(Request::is('Images')) class="active" @endif>
                <a href="{{ route('images.index') }}">Images</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>

            @include('common.errors')

            @include('common.status')

            @yield('content')

        </div>
    </div>
</div>
</body>
</html>