<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SMARTFAMRMERS</title>
       
        <link rel="stylesheet" type = "text/css" href="{{asset('css/styles.css')}}">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type = "text/css" href="/fonts/font-awesome.min.css">
        <link rel="stylesheet" type = "text/css" href="/fonts/ionicons.min.css">
        <link rel="stylesheet" type = "text/css" href="/fonts/typicons.min.css">
        <link rel="stylesheet" type = "text/css" href="https://fonts.googleapis.com/css?family=Poppins:400,700">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/Article-List.css')}}">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/Footer-Clean.css')}}">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/Footer-Dark.css')}}">
        <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/Login-Form-Clean.css')}}">
        <link rel="stylesheet" type = "text/css" href="{{asset('css/Navigation-with-Search.css')}}">   
    </head>

<body style="background-color:rgb(205,209,213);">
    <nav class="navbar navbar-light navbar-expand-md d-flex navigation-clean-search navbar navbar-inverse" style="background-color:#4b4c4d;">
        <div class="container">
            <span>
                <img class="hoja" src="/img/foto.png" style="height:40px;width:40px; margin-left:-50px;margin-right:8px;">
            </span>
            <a class="navbar-brand" href="welcome" id="logo" >SMART FARMERS</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    @if (Route::has('login'))
                        
                        @auth
                        
                        <li class="nav-item dropdown" style="width: 400px;">
                                <a id="navbarDropdown" style="color:white; margin-right:120px;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{Auth::user()->avatar}}" style="width:32px; height: 32px; top:10px; left: 10px; border-radius: 50%;"/>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('verPerfil') }}">
                                        {{ __('Ver Perfil') }}
                                    </a>
                                    @can('admin-only', Auth::user())
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            {{ __('Tablero') }}
                                        </a>
                                    @endcan
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('register') }}" style="color:#fefefe;font-size:16px;">Registrarse</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('login') }}" style="color:#fafafb;font-size:16px;">Ingresar al sistema</a></li>
                        @endauth
                        
                    @endif
                </ul>
                <form class="form-inline d-inline-flex mr-auto">
                        <div class="form-group float-right">
                            <input class="form-control search-field" type="search" name="search" placeholder="Busque su producto" id="search-field" style="width:291px;border-radius:50px;background-color:#f5dfdf;">
                            <button class="btn btn-secondary" type="submit" style="background-color:#030303;border-radius:50px;position:relative;margin-left:-39px;" href="untitled-3.html"><i class="fa fa-search" data-bs-hover-animate="bounce" style="color:#feffff;"></i></button>
                        </div>
                </form>
            </div>
        </div>
    </nav>
    <main id="principal-forgot" class="container" style="margin-top:56px;width:453px;background-color:#ffffff;border-radius:20px;">
        <div class="row">
            <div class="col" align="center"><i class="fa fa-lock" style="font-size:109px;"></i></div>
        </div>
        <div class="row">
            <div class="col" align="center">
                <main class="container">
                    <div class="row">
                        <div class="col" align="center"><label id="main-label-forgot">¿Olvidaste tu contraseña?</label></div>
                    </div>
                    <div class="row">
                        <div class="col" align="center"><label id="label-forgot">Puedes reestablecer tu contraseña aquí</label></div>
                    </div>
                </main>
            </div>
        </div>
        <div class="row">
            <div class="col" style="margin-top:26px;">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope-o" style="color:black;"></i></span></div>
                            
                            <input id="email" placeholder="Ingresa tu correo aquí" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary btn btn-lg btn-primary btn-block" type="submit">Listo</button></div>
                </form>
            </div>
        </div>
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>