



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


        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" type = "text/css" href="/fonts/font-awesome.min.css">
    <link rel="stylesheet" type = "text/css" href="/fonts/ionicons.min.css">
    <link rel="stylesheet" type = "text/css" href="/fonts/typicons.min.css">

    <link rel="stylesheet" href="{{asset('css/dh-agency-bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/Profile-Edit-Form.css')}}">



   
</head>

<body style="width:100%;height:100%;">
    <nav class="navbar navbar-light navbar-expand-md d-flex navigation-clean-search navbar navbar-inverse" style="background-color:#4b4c4d;">
        <div class="container">
            <span>
                <img class="hoja" src="{{asset('img/foto.png')}}" style="height:40px;width:40px; margin-left:-50px;margin-right:8px;">
            </span>
            <a class="navbar-brand" href="#" id="logo" >SMART FARMERS</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    @if (Route::has('login'))
                        
                        @auth
                        
                        <li class="nav-item dropdown" style="width: 400px;">
                            <a id="navbarDropdown" style="color:white; margin-right:120px;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{asset(Auth::user()->avatar)}}" 
                        
                                style="width:32px; height: 32px; top:10px; left: 10px; border-radius: 50%;"/>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('verPerfil') }}">
                                    {{ __('Mi perfil') }}
                                </a>
                                @if(Auth::user()->roles()->first()->name === 'CompradorVendedor')
                                    <a class="dropdown-item" href="{{ route('verFacturasAsUser') }}">
                                        {{ __('Registro de Compras') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('verFacturasAsUser1') }}">
                                        {{ __('Registro de ventas') }}
                                    </a> 

                                     <a class="dropdown-item" href="{{ route('listaproductosuser') }}">
                                        {{ __('Mis productos') }}
                                    </a> 

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                                @endif
                                
                                @can('admin-only', Auth::user())
                                    <a class="dropdown-item" href="{{ route('verProductosAdmin') }}">
                                        {{ __('Productos') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('listaUserAdmin') }}">
                                        {{ __('Usuarios') }}
                                    </a>

                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
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
        <form enctype="multipart/form-data" method="POST" action="{{route('postCrearUsuario')}}">
            @csrf
            <div class="form-row profile-row" style="margin-left: 50px;" >
                <div class="col-md-4 relative" style="margin-left:-50px; margin-right:15px; margin-top:40px;">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div>
                    <input type="file" class="form-control" name="avatar-file">
                </div>
                <div class="col-md-8">
                    <h1>Agregar Usuario</h1>
                    <hr>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Nombre</label>
                            <input class="form-control" type="text" name="name">                    
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Genero</label>
                            <select style="height: 40px; margin-top:0px;" placeholder="*Rol" id="registro-texto" type="text" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="genero" value="{{ old('role') }}" required autofocus>
                                <option value="">{{'Seleccione el Genero'}}</option>
                                <option value="Femenino">{{'Femenino'}}</option>
                                <option value="Masculino">{{'Masculino'}}</option>        
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                                    <label style="font-size: 20px !important; margin-left:0px">Dirección</label>
                                    <input class="form-control" type="text" name="direccion">
                                       
                                
                        </div>
                        <div class="col-sm-12 col-md-6">
                            
                                <label style="font-size: 20px !important; margin-left:0px">Teléfono</label>
                                <input class="form-control" type="text" name="telefono">
                                    
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Email </label>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" type="email" required name="email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif    
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Rol</label>
                            <select style="height: 40px; margin-top:0px;" placeholder="*Rol" id="registro-texto" type="text" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required autofocus>
                                <option value="">{{'Seleccione el rol'}}</option>
                                    @foreach ($roles as $id => $role)
                                        <option value="{{$id}}">{{$role}}</option>
                                    @endforeach
                            </select>
                              
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Contraseña</label>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" type="password" name="password" autocomplete="off" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label style="font-size: 20px !important; margin-left:0px">Confirmar contraseña</label>
                            <input class="form-control" type="password" name="password_confirmation" autocomplete="off" required="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <button class="btn btn-primary form-btn" type="submit">GUARDAR </button>
                            <a class="btn btn-danger form-btn" href="{{route('listaUserAdmin')}}">CANCELAR </a>
                        </div>
                    </div>
                </div>
            </div>
            <br></br>
        </form>
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