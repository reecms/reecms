<!DOCTYPE html>
<html class="no-js" lang="{{ App::getLocale() }}">
<head>
    @include('shared.head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link rel="stylesheet"
          href="{{ app(\Ree\Services\CocktailService::class)->resolveThemeAsset('stylesheets/application.css') }}">

    @yield('head-scripts')

</head>
<body class="front auth {{ empty($bodyClasses) ? "" : implode(' ', $bodyClasses) }}">
@include('shared.top')

<div id='wrap0'>
    <div class='auth-box'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <h1 class='panel-title text-center'>
                    @yield('title')
                </h1>
            </div>
            <div class='panel-body'>
                {!! Alert::dump($errors->all()) !!}
                @yield('content')
            </div>
        </div>
    </div>
</div>

@include('shared.foot')
</body>
</html>