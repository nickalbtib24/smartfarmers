<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMARTFAMRMERS</title>
   
    <link rel="stylesheet" type = "text/css" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/ionicons.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/typicons.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="https://fonts.googleapis.com/css?family=Poppins:400,700">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Article-List.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Footer-Clean.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Footer-Dark.css')}}">
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Login-Form-Clean.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Navigation-with-Search.css')}}">

   
</head>

<body style="width:100%;height:100%;">
    <nav class="navbar navbar-light navbar-expand-md d-flex navigation-clean-search navbar navbar-inverse" style="background-color:#4b4c4d;">
        <div class="container">
            <span>
                <img class="hoja" src="/img/foto.png" style="height:40px;width:40px; margin-left:-50px;margin-right:8px;">
            </span>
            <a class="navbar-brand" href="#" id="logo" >SMART FARMERS</a>
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
                                    <a class="dropdown-item" href="{{ route('verProductosAdmin') }}">
                                        {{ __('Productos') }}
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        {{ __('Usuarios') }}
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
                
                @if(Auth::user() != null)
                    @if(Auth::user()->roles()->first()->name != 'Administrator')
                        <form method="POST" class="form-inline d-inline-flex mr-auto" id="busqueda" action="{{route('buscarProductosNormal')}}">
                            @csrf
                            <div class="form-group float-right">
                                <input class="form-control search-field" type="search" name="search" placeholder="Busque su producto" id="search-field" style="width:291px;border-radius:50px;background-color:#f5dfdf;">
                                <button class="btn btn-secondary" type="submit" style="background-color:#030303;border-radius:50px;position:relative;margin-left:-39px;"><i class="fa fa-search" data-bs-hover-animate="bounce" style="color:#feffff;"></i></button>
                            </div>
                        </form>
                    @endif
                @else
                    <form method="POST" class="form-inline d-inline-flex mr-auto" id="busqueda" action="{{route('buscarProductosNormal')}}">
                        @csrf
                        <div class="form-group float-right">
                            <input class="form-control search-field" type="search" name="search" placeholder="Busque su producto" id="search-field" style="width:291px;border-radius:50px;background-color:#f5dfdf;">
                            <button class="btn btn-secondary" type="submit" style="background-color:#030303;border-radius:50px;position:relative;margin-left:-39px;"><i class="fa fa-search" data-bs-hover-animate="bounce" style="color:#feffff;"></i></button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </nav>
    <div class="carousel slide carousel-fade" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active"><img class="w-100 d-block" src="/img/landscape-176602_1280.jpg" alt="Slide Image" style="width:100%;height:auto;"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="/img/nature-213364_1280.jpg" alt="Slide Image"></div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
        <ol
            class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            </ol>
    </div>
    <div class="article-list" style="color:#000000;background-color:#edf5e1;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center" style="color:#030303;">Sobre nosotros</h2>
                <p class="text-center" style="color:#000000;">Somos una tienda virtual para ayudar a los campesinos a adquirir sus productos</p>
            </div>
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item" style="background-color:rgba(0,0,0,0.1);"><a href="#"><i class="fa fa-money" id="money" style="color:rgb(0,0,0);"></i></a>
                    <h3 class="name" style="color:#000000;">Realice sus pagos de manera fácil</h3>
                    <p class="description" style="color:#000000;">La página web cuenta con una manera en la cual puede realizar de forma rápida sus compras.</p><a href="#" class="action"></a></div>
                <div class="col-sm-6 col-md-4 item" style="background-color:rgba(0,0,0,0.1);"><a href="#"><i class="typcn typcn-group" id="socios" style="color:rgb(0,0,0);"></i></a>
                    <h3 class="name" style="color:#000000;">Venda productos</h3>
                    <p class="description" style="color:#000000;">Usted puede vender sus propios productos que ayuden a la agricultura del sector.</p><a href="#" class="action"></a></div>
                <div class="col-sm-6 col-md-4 item" style="background-color:rgba(0,0,0,0.1);"><a href="#"><i class="fa fa-cart-arrow-down" id="carro-de-compras" style="color:rgb(0,0,0);"></i></a>
                    <h3 class="name" style="color:#000000;">Compre productos</h3>
                    <p class="description" style="color:#000000;">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"></a></div>
            </div>
        </div>
    </div>
    <div class="footer-clean" style="background-color:rgba(0,0,0,0.84);">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3 style="color:rgb(244,165,11);">Services</h3>
                        <ul>
                            <li style="color:#ffffff;"><a href="#">Web design</a></li>
                            <li><a href="#" style="color:#ffffff;">Development</a></li>
                            <li><a href="#" style="color:#ffffff;">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3 style="color:rgb(244,165,11);">About</h3>
                        <ul>
                            <li style="color:#05386b;"><a href="#" style="color:rgb(255,255,255);">Company</a></li>
                            <li><a href="#" style="color:#ffffff;">Team</a></li>
                            <li><a href="#" style="color:#ffffff;">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#" style="color:#05386b;"><i class="icon ion-social-facebook" style="color:#ffffff;"></i></a><a href="#"><i class="icon ion-social-twitter" style="color:#ffffff;"></i></a><a href="#"><i class="icon ion-social-snapchat" style="color:#ffffff;"></i></a>
                        <a
                            href="#"><i class="icon ion-social-instagram" style="color:#ffffff;"></i></a>
                            <p class="copyright" style="color:rgb(161,167,173);">SMART FARMERS</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bs-animation-1.js')}}"></script>
    <script src="{{asset('js/bs-animation.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme-1.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme.js')}}"></script>
    <script src="{{asset('js/Profile-Edit-Form.js')}}"></script>
</body>

</html>