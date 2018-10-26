<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart_Farmers</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/ionicons.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('fonts/typicons.min.css')}}">
    <link rel="stylesheet" type = "text/css" href="https://fonts.googleapis.com/css?family=Poppins:400,700">
    <link rel="stylesheet" href="{{asset('css/dh-agency-bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/Profile-Edit-Form-1.css')}}">
    <link rel="stylesheet" type = "text/css" href="{{asset('css/Navigation-with-Search.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
    <header>
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
<p></p><p></p>
   
   
    <div class="container profile profile-view" id="profile">
       
        <form  enctype="multipart/form-data" method="POST" action="{{route('postCrearProductoAdmin')}}">
            @csrf
            @if(session()->has('success'))
                <div class="alert alert-success">
                     {{ session()->get('message') }}
                </div>
            @endif
            <div class="form-row profile-row">
                <div class="col-md-8">
                    <h1>Agregar Producto</h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Producto</label><input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>Proveedor</label>
                                <select style="height: 40px; margin-top:0px;" name="proveedor" type="text" class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }}" value="{{ old('proveedor') }}" required autofocus>
                                    <option value="">{{'Seleccione el proveedor'}}</option>
                                    @foreach ($proveedores as $id => $proveedor)
                                        <option value="{{$id}}">{{$proveedor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Tipo de producto</label>
                                <select style="height: 40px; margin-top:0px;" name="categoria" type="text" class="form-control{{ $errors->has('categoria') ? ' is-invalid' : '' }}" value="{{ old('categoria') }}" required autofocus>
                                    <option value="">{{'Seleccione la categoria'}}</option>
                                    @foreach ($categorias as $id => $categoria)
                                        <option value="{{$id}}">{{$categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Precio producto</label>
                                <input class="form-control" type="text" name="precio">
                                @if ($errors->has('precio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif   
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Descripción del producto</label>
                                <textarea type="text Area" class="form-control" id="mio" name="descripcion">
                                </textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <button class="btn btn-primary form-btn" type="submit">SAVE </button>
                            <button class="btn btn-danger form-btn" type="reset">CANCEL </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4 relative">
                    <div class="avatar"></div>
                    <div class="avatar-bg center"></div><input type="file" class="form-control" name="avatar-file">
                </div>
            </div>
        </form>
    </div>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/Profile-Edit-Form.js')}}"></script>
    <script src="{{asset('js/Contact-Form-v2-Modal--Full-with-Google-Map.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme-1.js')}}"></script>
    <script src="{{asset('js/dh-agency-bootstrap-theme.js')}}"></script>
    <script src="{{asset('js/bs-animation.js')}}"></script>
</body>

</html>