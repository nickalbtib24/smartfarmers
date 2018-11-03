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

    Route::get('/admin/crearUsuario',[ 
        'uses' => 'CreateUsers@returnNewUserPage',
        'roles' => ['Administrator']])->name('crearUsuarioAdmin');

    Route::post('/admin/crearUsuario',[ 
        'uses' => 'CreateUsers@newUser',
        'roles' => ['Administrator']])->name('postCrearUsuario');

    Route::get('/admin/crearProducto',[
        'uses' => 'ProductoController@returnCreateProductViewAsAdmin',
        'roles' => ['Administrator']])->name('crearProductoAdmin');

    Route::post('/admin/crearProducto',[
        'uses' => 'ProductoController@createProductAsAdmin',
        'roles' => ['Administrator']])->name('postCrearProductoAdmin');

    Route::get('/admin/verProductos',[ 
        'uses' => 'ProductoController@returnViewProductsAsAdmin',
        'roles' => ['Administrator']])->name('verProductosAdmin');

    Route::post('/admin/verProductos',[
        'uses' => 'ProductoController@searchProductsAdmin',
        'roles' => ['Administrator']])->name('buscarProductosAdmin');

    Route::get('/admin/editarProducto{id}',[
        'uses' => 'ProductoController@returnEditProductsAsAdmin',
        'roles' => ['Administrator']])->name('editarProductosAdmin');

    Route::post('/admin/editarProducto{id}',[
        'uses' => 'ProductoController@editProductAsAdmin',
        'roles' => ['Administrator']])->name('postEditarProductoAdmin');

    Route::post('/admin/eliminarProducto{id}',[
        'uses' => 'ProductoController@destroyProductAsAdmin',
        'roles' => ['Administrator']])->name('postEliminarProductoAdmin');

});
  
  Route::post('/normal/buscarProductos','ProductoController@returnSearchProductsViewAsNormal')->name('buscarProductosNormal');
  Route::get('/normal/perfil','UserController@returnProfileView')->name('verPerfil');
  Route::get('/normal/editarperfil','UserController@returnEditUserAsUserView')->name('editarPerfilUsuario');
  Route::post('/normal/editarperfil','UserController@editUserAsUser')->name('postEditarPerfilComoUsuario');
  Route::get('/normal/editarperfil/contrasena','UserController@returnEditPasswordAsUserView')->name('editarContrasenaComoUsuario');
  Route::post('/normal/editarperfil/contrasena','UserController@editPasswordAsUser')->name('postEditarContrasenaComoUsuario');
  Route::get('/normal/verProducto/{id}','ProductoController@returnViewProductAsNormalView')->name('verProductoUsuario');
  Route::get('/user/activacion/{token}','Auth\RegisterController@activateUser');
  Route::get('/user/confirmacionPago','FacturaController@getPaymentInformation');

  
