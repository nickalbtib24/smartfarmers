<?php
use App\Role;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'control'],function(){
    Auth::routes();
    
    Route::get('/home', 'HomeController@index');
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/admin/home',function(){
        return view('welcome');
    })->name('homeAdmin');
    
    Route::get('/normal/home',function(){
        return view('welcome');
    })->name('homeNormal');  

    Route::group(['middleware' => 'roles'],function(){

        Route::get('/admin/crearProducto',[
            'uses' => 'ProductoController@returnCreateProductViewAsAdmin',
            'roles' => ['Administrator']])->name('crearProductoAdmin');
    
        Route::post('/admin/crearProducto',[
            'uses' => 'ProductoController@createProductAsAdmin',
            'roles' => ['Administrator']])->name('postCrearProductoAdmin');
    
        Route::get('/admin/verProductos',[ 
            'uses' => 'ProductoController@returnViewProductAsAdminView',
            'roles' => ['Administrator']])->name('verProductosAdmin');
    
        Route::post('/admin/verProductos',[
            'uses' => 'ProductoController@searchProductsAdmin',
            'roles' => ['Administrator']])->name('buscarProductosAdmin');
        
        Route::get('/admin/verUsuarios',[
            'uses' => 'UserController@index',
            'roles' => ['Administrator']])->name('listaUserAdmin');
    
        Route::get('/admin/crearUsuario',[
            'uses' => 'CreateUsers@returnNewUserPage',
            'roles' => ['Administrator']]) ->name('crearUsuarioAdmin');
    
        Route::post('/admin/crearUsuario',[
            'uses' => 'CreateUsers@newUser',
            'roles' => ['Administrator']])->name('postCrearUsuario');
    
        Route::get('/admin/editarUsuario{id}',[
            'uses' => 'UserController@edit',
            'roles' => ['Administrator']])->name('editarUserAdmin');
    
        Route::post('/admin/editarUsuario{id}',[
            'uses' => 'UserController@update',
            'roles' => ['Administrator']])->name('postEditarUserAdmin');
    
        Route::post('/admin/eliminarUser{id}',[
            'uses' => 'UserController@eliminar',
            'roles' => ['Administrator']])->name('EliminarUser');
    
        Route::get('/admin/editarProducto{id}',[
            'uses' => 'ProductoController@returnEditProductsAsAdmin',
            'roles' => ['Administrator']])->name('editarProductosAdmin');
    
        Route::post('/admin/editarProducto{id}',[
            'uses' => 'ProductoController@editProductAsAdmin',
            'roles' => ['Administrator']])->name('postEditarProductoAdmin');
        
        Route::post('/admin/eliminarProducto{id}',[
            'uses'=>'ProductoController@destroyProductAsAdmin',
            'roles' => ['Administrator']])->name('postEliminarProductoAsAdmin');
    
    });
    Route::post('/normal/buscarProductos','ProductoController@returnSearchProductsViewAsNormal')->name('buscarProductosNormal');
    Route::get('/normal/perfilUser/','UserController@returnProfileView')->name('verPerfil');
    Route::get('/normal/editarperfil','UserController@returnEditUserAsUserView')->name('editarPerfilUsuario');
    Route::post('/normal/editarperfil','UserController@editUserAsUser')->name('postEditarPerfilComoUsuario');
    Route::get('/normal/editarperfil/contrasena','UserController@returnEditPasswordAsUserView')->name('editarContrasenaComoUsuario');
    Route::post('/normal/editarperfil/contrasena','UserController@editPasswordAsUser')->name('postEditarContrasenaComoUsuario');
    Route::get('/normal/verProducto/{id}','ProductoController@returnViewProductAsNormalView')->name('verProductoUsuario');
    Route::get('/user/activacion/{token}','Auth\RegisterController@activateUser');
  
  
  
    Route::get('/user/registrarce','CreateUsers@register')->name('registrarce');
    
    Route::get('/user/confirmacionPago','FacturaController@getPaymentInformation')->name('confirmacionPago');
    Route::get('/user/facturas','FacturaController@returnViewFacturasView')->name('verFacturasAsUser');
    Route::get('/user/factura/{id}','FacturaController@returnViewFactura')->name('verFacturaAsUser');
  
  
  
  
  
  Route::get('/user/verProductos','ProductoController@verProductosUser')->name('listaproductosuser');
  Route::get('/user/crearProducto','ProductoController@returnCreateProductViewAsUser')->name('nuevo_producto_user');
  Route::post('/user/crearProducto', 'ProductoController@createProductAsUser')->name('postCrearProductoUser');
  Route::get('/user/editarProducto{id}','ProductoController@returnEditProductsAsUser')->name('editarProductosUser');
  Route::post('/user/editarProducto{id}','ProductoController@editProductAsUser')->name('postEditarProductoUser');
  Route::post('/user/eliminarProducto{id}', 'ProductoController@destroyProductAsUser')->name('postEliminarProductoAsUser');
  Route::post('/user/verProductos', 'ProductoController@searchProductsUser')->name('buscarProductosUser');
  
  
  
  
  
  
  
  
  
  
  Route::get('/user/orden','OrdenController@returnViewFacturasView')->name('verFacturasAsUser1');
  Route::get('/user/orden/{id}','OrdenController@returnViewFactura')->name('verFacturaAsUser1')
  ;
  Route::post('/user/verFacturas', 'FacturaController@buscarFactura')->name('buscarFactura');
  Route::post('/user/verOrden', 'OrdenController@buscarOrden')->name('buscarOrden');
  Route::post('/user/verUsuarios', 'UserController@buscarUsuario')->name('buscarUsuarioAdmin');
  });

  


    
 
