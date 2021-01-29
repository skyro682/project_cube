<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



</head>

<body class="position-relative" style="min-height: 100%;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    (Re)sources Relationnelles
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Jeux</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('ressources.add')}}">Ajouter une ressource</a> <!-- si connecté -->
                        </li>
                        @auth
                            @if ( Auth::user()->isAdmin())
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administration</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Statistiques</a>
                                        <a class="dropdown-item" href="{{ Route('users.home') }}">Gestion des utilisateurs</a>
                                    <div class="dropdown-menu">
                                </div> 
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="padding-left: .6em;">
                        <li class="nav-item mr-3 my-auto">
                            <form action="{{ Route('search') }}">
                                <input type="text" class="form-control form-control-sm" id="query" name="query" placeholder="Rechercher..." />
                            </form>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ Route('profile') }}">Mon compte</a>
                                    <a class="dropdown-item" href="{{ Route('favorite.viewFavorite') }}">Afficher mes favoris</a>


                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (session('error'))
            <div class="mx-auto alert alert-danger mb-0">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mx-auto alert alert-success mb-0">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="w-100 d-flex justify-content-center bg-light border-bottom">
            <img src="{{ asset('img/msa.png') }}" onclick="location.href='{{ asset('img/msa.png') }}'" height="350px" alt="Error">
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-light text-center text-lg-start w-100 " style="bottom: 0;">
            <div class="container p-3" style="margin-bottom: 40px;">
                <div class="row">
                    <div class="col-lg-8 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Droits de reproduction</h5>
                        <p>
                            Les contenus du site à l’exception des marques et logos et des contenus
                            grevés de droits de propriété intellectuelle de tiers ou contenant des données à caractère personnel,
                            sont des informations publiques librement et gratuitement réutilisables dans les conditions fixées
                            par la loi n°78-753 du 17 juillet 1978, formalisées dans les conditions générales de réutilisation
                            des informations publiques ou dans le respect des conditions générales de réutilisation des
                            informations publiques.
                        </p>
                    </div>
                    <div class="col-lg-1 col-md-6 mb-4 mb-md-0"> </div>
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-0">plus d'informations</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class="text-dark">aide</a>
                            </li>
                            <li>
                                <a href="#!" class="text-dark">contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center p-2 position-fixed w-100 bg-secondary text-white" style="bottom:0;height:40px;">
                © 2021 Copyright :
                <a class="text-white" href="">FRANCE.GOUV</a>
            </div>
        </footer>
        
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>