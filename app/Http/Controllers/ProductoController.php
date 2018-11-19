<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Categoria;
use App\Catalogo;
use App\User;
use App\Role;
use Image;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use DB;



class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }

    public function returnCreateProductViewAsAdmin()
    {
        $proveedoresTodos = User::all();
        $proveedores=[];
        $categorias = Categoria::orderBy('nombre')->pluck('nombre','id');
        foreach($proveedoresTodos as $proveedor)
        {
            if(!$proveedor->tieneRol('Administrator'))
            {
                $proveedores[] = $proveedor;
            }
        }
        return view('administrador.producto.NuevoProducto')
        ->with(compact('proveedores'))
        ->with(compact('categorias'));
    }

    


    public function returnCreateProductViewAsUser()
    {
        $proveedores = User::orderBy('name')->pluck('name','id');
        $categorias = Categoria::orderBy('nombre')->pluck('nombre','id');
        return view('user.producto.NuevoProducto')
        ->with(compact('proveedores'))
        ->with(compact('categorias'));
    } 

    public function returnViewProductAsNormalView($id)
    {
        $producto = Producto::find($id);
        $categoria = $producto->categoria;
        return view('user.viewProductAsUser')
        ->with(compact('producto'))
        ->with(compact('categoria'));
    }


   



    public function returnSearchProductsViewAsNormal(Request $request)
    {
        $busqueda = $request->input('search');
        $producto = Producto::find($busqueda);
        $categoria = Categoria::where('nombre','like','%'.$busqueda.'%')->get()->first();
        $proveedor = Catalogo::where('user_name','like','%'.$busqueda.'%')->get()->first();
        if($busqueda=='')
        {
            $productos = Producto::all();
            return view('user.searchProduct',compact('productos'));
        }
        elseif($categoria != null)
        {
            $productos=Producto::where('categoria_id','=',$categoria->id)->get();
            return view('user.searchProduct',compact('productos'));
        }
        elseif($proveedor != null)
        {
            $productos = $proveedor->productos;
            return view('user.searchProduct',compact('productos'));
        }
        else
        {
            $productos=Producto::where('nombre','like','%'.$busqueda.'%')
            ->orwhere('precio','like','%'.$busqueda.'%')
            ->get();
            return view('user.searchProduct',compact('productos'));
        }
    }



    
    public function returnEditProductsAsAdmin($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::orderBy('nombre')->pluck('nombre','id');
        return view('administrador.producto.EditarProducto')
        ->with(compact('producto'))
        ->with(compact('categorias'));
    }

    public function returnEditProductsAsUser($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::orderBy('nombre')->pluck('nombre','id');
        return view('user.producto.EditarProducto')
        ->with(compact('producto'))
        ->with(compact('categorias'));
    }


   



    public function createProductAsAdmin(Request $request)
    {
        $validator = $this->validatorAdmin($request->all());
        if($validator->passes())
        {
            if($request->hasFile('avatar-file'))
            {
                $avatar = $request->file('avatar-file');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save(public_path('/img/products/'.$filename));
                $this->create($request->all(),'/img/products/'.$filename);
            }else
            {
                $filename = 'default.jpg';
                $this->create($request->all(),'/img/products/'.$filename);
            }
        }else
        {
            return redirect()->back()->with('errors',$validator->errors());
        }
        $productos = Producto::all();
        return view('administrador.producto.VerProductos')
        ->with(compact('productos'))
        ->with('success', '¡Producto Ingresado Exitosamente!');

    }


    public function createProductAsUser(Request $request)
    {
        $validator = $this->validatorAdmin($request->all());
        if($validator->passes())
        {
            if($request->hasFile('avatar-file'))
            {
                $avatar = $request->file('avatar-file');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save(public_path('/img/products/'.$filename));
                $this->create($request->all(),'/img/products/'.$filename);
            }else
            {
                $filename = 'default.jpg';
                $this->create($request->all(),'/img/products/'.$filename);
            }
        }else
        {
            return redirect()->back()->with('errors',$validator->errors());
        }
        return redirect()->back()->with('success', '¡Producto Ingresado Exitosamente!');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function editProductAsAdmin(Request $request,$id)
    {
        $validator = $this->validateEditAdmin($request->all());
        if($validator->passes())
        {
            if($request->hasFile('avatar-file'))
            {
                $avatar = $request->file('avatar-file');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save(public_path('/img/products/'.$filename));
                $this->edit($request->all(),'/img/products/'.$filename,$id);
            }else
            {
                $producto = Producto::find($id);
                $this->edit($request->all(),$producto->imagen,$id);
            }
        }else
        {
            return redirect()->back()->with('errors',$validator->errors());
        }
        $productos = Producto::paginate('15');
        return view('administrador.producto.VerProductos')
        ->with(compact('productos'))
        ->with('success','Se ha editado el producto exitosamente');

    }


    public function editProductAsUser(Request $request,$id)
    {
        $validator = $this->validateEditAdmin($request->all());
        if($validator->passes())
        {
            if($request->hasFile('avatar-file'))
            {
                $avatar = $request->file('avatar-file');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save(public_path('/img/products/'.$filename));
                $this->edit($request->all(),'/img/products/'.$filename,$id);
            }else
            {
                $producto = Producto::find($id);
                $this->edit($request->all(),$producto->imagen,$id);
            }
        }else
        {
            return redirect()->back()->with('errors',$validator->errors());
        }
        $productos = Producto::paginate('15');
        return view('user.producto.VerProductos')
        ->with(compact('productos'))
        ->with('success','Se ha editado el producto exitosamente');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */


     public function destroyProductAsAdmin(Request $request,$id)
    {
        Producto::destroy($id);
        $productos = Producto::paginate('15');
        return redirect()->back()
        ->with(compact('productos'))
        ->with('success','Se ha editado el producto exitosamente');
    }



    public function destroyProductAsUser(Request $request,$id)
    {
        Producto::destroy($id);
        $productos = Producto::paginate('15');
        return redirect()->back()
        ->with(compact('productos'))
        ->with('success','Se ha editado el producto exitosamente');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(array $data,$filename,$id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $data['name'];
        $producto->precio = $data['precio'];
        $producto->descripcion = $data['descripcion'];
        $producto->imagen = $filename;
        
        $categoria = Categoria::find((int)$data['categoria']);
        $producto->categoria()->associate($categoria);
        $producto->save();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data, $filename)
    {
        /**Se crea el nuevo producto*/
        $producto=Producto::create([
            'nombre' => $data['name'],
            'precio' => $data['precio'],
            'descripcion' => $data['descripcion'],
            'imagen' => $filename,
        ]);
        /**Se busca la categoría ingresada por el usuario*/
        $categoria = Categoria::find((int)$data['categoria']);
        /**Se busca el usuario ingresado como proveedor por el usuario */
        $usuario = User::find((int)$data['proveedor']);
        /**Se obtiene el catalogo del usuario obtenido anteriormente*/
        $catalogo = $usuario->catalogo;
        /**Se agrega una categoria al producto*/
        $producto->categoria()->associate($categoria);
        /**Se guarda el producto en la base de datos*/
        $producto->save();
        /**Se agrega al catalogo de usuarios el nuevo producto*/
        $catalogo->productos()->attach($producto);
        /**Se guarda el catalago en la base de datos*/
        $catalogo->save();
    }

    public function searchProductsAdmin(Request $request)
    {
        $busqueda = $request->input('search');
        $producto = Producto::find($busqueda);
        $categoria = Categoria::where('nombre','like','%'.$busqueda.'%')->get()->first();
        $proveedor = Catalogo::where('user_name','like','%'.$busqueda.'%')->get()->first();
        
        if($producto)
        {
            $productos=Producto::where('id','=',$busqueda)->get();
            return view('administrador.producto.VerProductos',compact('productos'));
        }elseif($categoria != null)
        {
            $productos=Producto::where('categoria_id','=',$categoria->id)->get();
            return view('administrador.producto.VerProductos',compact('productos'));
        }
        elseif($proveedor != null)
        {
            $productos = $proveedor->productos;
            return view('administrador.producto.VerProductos',compact('productos'));
        }
        else
        {
            $productos=Producto::where('nombre','like','%'.$busqueda.'%')
            ->orwhere('precio','like','%'.$busqueda.'%')
            ->get();
            return view('administrador.producto.VerProductos',compact('productos'));
        }
    }

    public function searchProductsUser(Request $request)
    {
        $busqueda = $request->input('search');
        $producto = Producto::find($busqueda);
        $categoria = Categoria::where('nombre','like','%'.$busqueda.'%')->get()->first();
        $proveedor = Catalogo::where('user_name','like','%'.$busqueda.'%')->get()->first();
        
        if($producto)
        {
            $productos=Producto::where('id','=',$busqueda)->get();
            return view('user.producto.VerProductos',compact('productos'));
        }elseif($categoria != null)
        {
            $productos=Producto::where('categoria_id','=',$categoria->id)->get();
            return view('user.producto.VerProductos',compact('productos'));
        }
        elseif($proveedor != null)
        {
            $productos = $proveedor->productos;
            return view('user.producto.VerProductos',compact('productos'));
        }
        else
        {
            $productos=Producto::where('nombre','like','%'.$busqueda.'%')
            ->orwhere('precio','like','%'.$busqueda.'%')
            ->get();
            return view('user.producto.VerProductos',compact('productos'));
        }
    }

    public function buyProduct(Request $request)
    {
        $api_key='4Vj8eK4rloUd272L48hsrarnUA';
        
        $merchantid = $request->input('merchantId');
        $accountid = $request->input('accountId');
        
    }

    public function validateEditAdmin(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'categoria' => 'required',
            'precio' => 'required|integer',
            'descripcion' => 'required',
        ]);
    }
    public function validatorAdmin(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'proveedor' => 'required',
            'categoria' => 'required',
            'precio' => 'required|integer',
            'descripcion' => 'required',
        ]);
    }

    public function verProductosUser()
    {

        $productos = Auth::user()->catalogo->productos()->get();

        return view('user.producto.VerProductos',compact('productos'));
    }


    public function returnViewProductAsAdminView()
    {

        $productos = Producto::all();
        return view('administrador.producto.VerProductos',compact('productos'));
    }



}
