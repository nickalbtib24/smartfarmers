<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart_Farmers</title>
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

<body><div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                                    @if(Auth::user()->roles()->first()->name === 'CompradorVendedor')
                                        <a class="dropdown-item" href="{{ route('verFacturasAsUser') }}">
                                            {{ __('Compras') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('verPerfil') }}">
                                            {{ __('Ventas') }}
                                        </a> 
                                    @endif
                                    
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
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <form method="POST" action="{{route('buscarProductosNormal')}}">
                        <div class="input-group">
                            @csrf
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div><input class="form-control" name="search" id="search" type="text" placeholder="Busque por nombre del producto, categoría, proveedor y precio">
                            <div class="input-group-append"><button class="btn btn-light" type="submit" >Buscar</button></div>                      
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-xl-10 offset-xl-1" style="margin-top: 50px;">
        <div class="row product-list">
            @foreach($productos as $producto)
            <div class="col-sm-6 col-md-4 product-item">
                <div class="product-container">
                    <div class="row">
                        <div class="col-md-12"><a href="{{route('verProductoUsuario',$producto->id)}}" class="product-image"><img style="margin-left:55px;height: 200px;" src="{{$producto->imagen}}"></a></div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <h4><a href="{{route('verProductoUsuario',$producto->id)}}">{{$producto->nombre}}&nbsp;</a></h4>
                        </div>
                        <div class="col-4"><a href="{{route('verProductoUsuario',$producto->id)}}" class="small-text">Ver Detalle</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="product-description" style="font-size: 15px;padding: 0px;">{{$producto->descripcion}}</p>
                            <div class="row">
                                <div class="col-6">
                                    @auth
                                    @php ($reference = str_random(16))
                                        <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                                            <input name="merchantId"    type="hidden"  value="508029"   >
                                            <input name="accountId"     type="hidden"  value="512321" >
                                            <input name="description"   type="hidden"  value="Compra SMARTFARMERS"  >
                                            <input name="referenceCode" type="hidden"  value="{{$producto->nombre."-".$producto->id."-".$producto->catalogos()->first()->user_name."-".$reference}}" >
                                            <input name="amount"        type="hidden"  value="{{$producto->precio}}"   >
                                            <input name="tax"           type="hidden"  value="0"  >
                                            <input name="taxReturnBase" type="hidden"  value="0" >
                                            <input name="currency"      type="hidden"  value="COP" >
                                            <input name="signature"     type="hidden"  value="{{md5("4Vj8eK4rloUd272L48hsrarnUA"."~"."508029"."~".$producto->nombre."-".$producto->id."-".$producto->catalogos()->first()->user_name."-".$reference."~".$producto->precio."~COP")}}"  >
                                            <input name="test"          type="hidden"  value="1" >
                                            <input name="buyerFullName"    type="hidden"  value="{{Auth::user()->name}}" >
                                            <input name="buyerEmail"    type="hidden"  value="{{Auth::user()->email}}" >
                                            <input name="responseUrl"    type="hidden"  value="http://smartfarmers.com/user/confirmacionPago" >
                                            <input name="confirmationUrl"    type="hidden"  value="http://smartfarmers.com/user/confirmacionPago" >
                                            <input class="btn btn-sm btn-primary btn-create" style="background-color: #f4a50b; border:#f4a50b " name="Submit" type="submit"  value="Comprar" >
                                        </form>
                                    @else
                                    <a class="btn btn-sm btn-primary btn-create" style="background-color: #f4a50b; border:#f4a50b " name="Submit" href="{{route('login')}}" value="Comprar" >Comprar</a>
                                    
                                    @endauth
                                   
                                </div>
                                <div class="col-6">
                                    <p class="product-price" style="padding: 0px;">${{$producto->precio}} COP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
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