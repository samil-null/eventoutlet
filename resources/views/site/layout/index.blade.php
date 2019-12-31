<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="/">Eventoutlet</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('site.lk.profiles.show',  Auth::user()->id) }}">Личный кабинет</a>
                            </li>
                        @endauth
                    </ul>
                    <div class="form-inline">
                        <auth-form :user="{{ Auth::check()?Auth::user():'{}' }}"></auth-form>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>

