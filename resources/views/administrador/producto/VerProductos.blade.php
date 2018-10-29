<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart_Farmers</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/simple-line-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/typicons.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700">
    <link rel="stylesheet" href="{{asset('css/Article-List.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/Footer-Dark.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/Login-Form-Clean.css')}}">
    <link rel="stylesheet" href="{{asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>

<body><div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <header>
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
                    <form class="form-inline d-inline-flex mr-auto" target="_self" id="busqueda">
                            <div class="form-group float-right">
                                <input class="form-control search-field" type="search" name="search" placeholder="Busque su producto" id="search-field" style="width:291px;border-radius:50px;background-color:#f5dfdf;">
                                <button class="btn btn-secondary" type="submit" style="background-color:#030303;border-radius:50px;position:relative;margin-left:-39px;" href="untitled-3.html"><i class="fa fa-search" data-bs-hover-animate="bounce" style="color:#feffff;"></i></button>
                            </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <p></p>
    <p></p>
    <div class="container">
        <div class="row">
         
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="Usuarios">
                        <div class="row">
                            <div class="col col-xs-6"></div>
                            <div class="col col-xs-6 text-right" style="margin-top: 30px; margin-bottom: 30px;">
                                <a href="{{route('crearProductoAdmin')}}" style="background-color: #f4a50b; border:#f4a50b " class="btn btn-sm btn-primary btn-create">Nuevo Producto</a>
                                <button type="button" id="cat" style="background-color: #f4a50b; border:#f4a50b " class="btn btn-sm btn-primary btn-create">Nueva Categoria</button>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <p></p>
                    <form method="POST" action="{{ route('buscarProductosAdmin') }}">
                        <div class="input-group">
                            @csrf
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div><input class="form-control" name="search" id="search" type="text" placeholder="Busque por nombre del producto, categoría, proveedor y precio">
                            <div class="input-group-append"><button class="btn btn-light" type="submit" >Buscar</button></div>                      
                        </div>
                    </form>
                    <p></p>
                    <p></p>
                    <div class="panel-body">
                        
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                                <tr>
                                    <th><em class="fa fa-cog"></em></th>
                                    <th class="hidden-xs">ID</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Proveedor</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form method="GET">
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td align="center">
                                            <a class="btn btn-default" href="{{route('editarProductosAdmin',$producto->id)}}"><em class="fa fa-pencil"></em></a>
                                            <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                        </td>
                                        <td>{{$producto->id}}</td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->categoria->nombre}}</td>
                                        <td>{{$producto->catalogos()->first()->user->name}}</td>
                                        <td>${{$producto->precio}} COP</td>
                                        <td><img class="hoja" src="{{$producto->imagen}}" style="height:40px;width:40px;"></td>
                                        
                                    </tr>
                                @endforeach  
                                </form> 
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/Contact-Form-v2-Modal--Full-with-Google-Map.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme-1.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme.js')}}"></script>
    <script src="{{asset('js/Profile-Edit-Form.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bs-animation.js')}}"></script>
   
    
</body>

</html>