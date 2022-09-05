<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container-fluid">
            <header>
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('home.index') }}">SHLink</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active link-secondary" aria-current="page" href="{{ route('home.index') }}">Início</a>
                                </li>

                            </ul>
                            <ul class="navbar-nav d-flex">
                                @if(!Auth::check())
                                    <li class="nav-item ">
                                        <a class="nav-link active link-primary" href="{{ route('login.index') }}">
                                            Minha conta
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item ">
                                        <a class="nav-link active link-primary" href="{{ route('login.index') }}">
                                            {{ Auth::user()->name }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="{{ route('login.desconnect') }}" class="nav-link active link-danger">
                                            Sair
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="container mt-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</html>
