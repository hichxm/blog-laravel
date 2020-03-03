<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>BLOG - Laravel v6.12.0</title>
</head>

<body class="bg-secondary">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2 mb-2">
            <a class="navbar-brand" href="#">Laravel v6.12.0</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item">
                        <form action="{{ route('web.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">Déconnexion</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.register') }}">Inscription</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <div class="row">
            @yield('content')
        </div>
    </div>
</body>

</html>
