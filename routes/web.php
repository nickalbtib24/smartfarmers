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

   
  });

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

    Route::post('/admin/verUsuarios',[ 
        'uses'=>'UserController@buscarUsuario',
        'roles' => ['Administrator']])->name('buscarUsuarioAdmin');

    Route::get('/normal/verProductos',[
        'uses'=>'ProductoController@verProductosUser',
        'roles' => ['CompradorVendedor']])->name('listaproductosuser');

    Route::get('/normal/crearProducto',[
        'uses'=>'ProductoController@returnCreateProductViewAsUser',
        'roles' => ['CompradorVendedor']])->name('nuevo_producto_user');

    Route::post('/normal/crearProducto',[
        'uses'=> 'ProductoController@createProductAsUser',
        'roles' => ['CompradorVendedor']])->name('postCrearProductoUser');

    Route::get('/normal/editarProducto{id}',[
        'uses'=>'ProductoController@returnEditProductsAsUser',
        'roles' => ['CompradorVendedor']])->name('editarProductosUser');

    Route::post('/normal/editarProducto{id}',[
        'uses'=>'ProductoController@editProductAsUser',
        'roles' => ['CompradorVendedor']])->name('postEditarProductoUser');

    Route::post('/normal/eliminarProducto{id}',[
        'uses'=> 'ProductoController@destroyProductAsUser',
        'roles' => ['CompradorVendedor']])->name('postEliminarProductoAsUser');

    Route::post('/normal/verProductos',[
        'uses'=> 'ProductoController@searchProductsUser',
        'roles' => ['CompradorVendedor']])->name('buscarProductosUser');

    Route::get('/normal/orden',[
        'uses'=>'OrdenController@returnViewOrdenesView',
        'roles' => ['CompradorVendedor']])->name('verFacturasAsUser1');

    Route::get('/normal/orden/{id}',[
        'uses'=>'OrdenController@returnViewOrden',
        'roles' => ['CompradorVendedor']])->name('verFacturaAsUser1');

    Route::post('/normal/verFacturas',[
        'uses'=> 'FacturaController@buscarFactura',
        'roles' => ['CompradorVendedor']])->name('buscarFactura');

    Route::post('/normal/verOrden',[
        'uses'=> 'OrdenController@buscarOrden',
        'roles' => ['CompradorVendedor']])->name('buscarOrden');

    Route::get('/normal/confirmacionPago',[
        'uses'=>'FacturaController@getPaymentInformation',
        'roles' => ['CompradorVendedor']])->name('confirmacionPago');

    Route::get('/normal/facturas',[
        'uses'=>'FacturaController@returnViewFacturasView',
        'roles' => ['CompradorVendedor']])->name('verFacturasAsUser');

    Route::get('/normal/factura/{id}',[
        'uses'=>'FacturaController@returnViewFactura',
        'roles' => ['CompradorVendedor']])->name('verFacturaAsUser');

    Route::post('/normal/buscarProductos',[
        'uses'=>'ProductoController@returnSearchProductsViewAsNormal',
        'roles' => ['CompradorVendedor']])->name('buscarProductosNormal');

    Route::get('/normal/perfilUser/',[
        'uses'=>'UserController@returnProfileView',
        'roles' => ['CompradorVendedor','Administrator']])->name('verPerfil');

    Route::get('/normal/editarperfil',[
        'uses'=>'UserController@returnEditUserAsUserView',
        'roles' => ['CompradorVendedor','Administrator']])->name('editarPerfilUsuario');

    Route::post('/normal/editarperfil',[
        'uses'=>'UserController@editUserAsUser',
        'roles' => ['CompradorVendedor','Administrator']])->name('postEditarPerfilComoUsuario');

    Route::get('/normal/editarperfil/contrasena',[
        'uses'=>'UserController@returnEditPasswordAsUserView',
        'roles' => ['CompradorVendedor','Administrator']])->name('editarContrasenaComoUsuario');

    Route::post('/normal/editarperfil/contrasena',[
        'uses'=>'UserController@editPasswordAsUser',
        'roles' => ['CompradorVendedor','Administrator']])->name('postEditarContrasenaComoUsuario');

    Route::get('/normal/verProducto/{id}',[
        'uses'=>'ProductoController@returnViewProductAsNormalView',
        'roles' => ['CompradorVendedor','Administrator']])->name('verProductoUsuario');


});


Route::get('/user/activacion/{token}','Auth\RegisterController@activateUser');
Route::get('/user/registrarce','CreateUsers@register')->name('registrarce');




















    
 
