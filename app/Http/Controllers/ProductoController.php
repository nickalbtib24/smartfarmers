<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Categoria;
use App\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
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
        $proveedores = User::orderBy('name')->pluck('name','id');
        $categorias = Categoria::orderBy('nombre')->pluck('nombre','id');
        return view('administrador/producto/NuevoProducto')
        ->with(compact('proveedores'))
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
            return redirect()->back()->with('errors',$validator->errors('errors'));
        }
        return redirect()->back()->with('success', '¡Producto Ingresado Exitosamente!');

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
}
