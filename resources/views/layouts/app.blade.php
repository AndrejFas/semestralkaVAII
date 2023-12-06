<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="/css/styl.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">

            <div>
                <a class="fri-image-a" href="https://www.fri.uniza.sk/"><img src="\pictures\FRI_logo.png" class="fri-image" alt="FRI"></a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('login') }}">Domov</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="{{ route('dokumenty') }}">Dokumenty</a>
                    </li>

                    <li class="nav-item">
                        @auth
                            @if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'veduci')
                                <a href="{{ route('pridaj') }}">Pridaj</a>
                            @endif
                        @endauth
                    </li>
                    <li class="nav-item">
                        @auth
                            @if(Auth::user()->user_type == 'admin')
                                <a href="{{ route('pridajuser') }}">Pridaj pouzivatela</a>
                            @endif
                        @endauth
                    </li>
                    <li class="nav-item">
                        @auth
                            @if(Auth::user()->user_type == 'admin')
                                <a href="{{ route('zobrazUzivatele') }}">Zobraz pouzivatelov</a>
                            @endif
                        @endauth
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Témy
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('prace')}}">Záverečné práce</a></li>
                            <li><a class="dropdown-item" href="#">Priradená téma</a></li>
                            <li><a class="dropdown-item" href="#">Informácie o štátnej skúške</a></li>
                            <li><a class="dropdown-item" href="#">Odovzdávanie súborov</a></li>
                        </ul>
                    </li>
                    

                </ul>

                <div class="login">
                    
                        
                        <span>{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <i class="bi bi-person-circle"></i>
                            <button type="submit" class="btn btn-warning">Logout</button>
                        </form>
                    
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')


    <footer>
        <div style="text-align: center">Copyright 2023 fasanok</div>
    
    </footer>

</body>