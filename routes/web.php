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

  Route::get('/admin/crearUsuario','CreateUsers@returnNewUserPage')->name('crearUsuarioAdmin');
  Route::post('/admin/crearUsuario','CreateUsers@newUser')->name('postCrearUsuario');
  Route::get('/admin/crearProducto','ProductoController@returnCreateProductViewAsAdmin')->name('crearProductoAdmin');
  Route::post('/admin/crearProducto','ProductoController@createProductAsAdmin')->name('postCrearProductoAdmin');
  Route::get('/admin/verProductos','ProductoController@returnViewProductsAsAdmin')->name('verProductosAdmin');
  Route::post('/admin/verProductos','ProductoController@searchProductsAdmin')->name('buscarProductosAdmin');
  Route::get('/admin/editarProducto{id}','ProductoController@returnEditProductsAsAdmin')->name('editarProductosAdmin');
  Route::post('/admin/editarProducto{id}','ProductoController@editProductAsAdmin')->name('postEditarProductoAdmin');
  Route::get('/normal/perfil','UserController@returnProfileView')->name('verPerfil');
  Route::get('/normal/editarperfil','UserController@returnEditUserAsUserView')->name('editarPerfilUsuario');
  Route::post('/normal/editarperfil','UserController@editUserAsUser')->name('postEditarPerfilComoUsuario');
  Route::get('/normal/editarperfil/contrasena','UserController@returnEditPasswordAsUserView')->name('editarContrasenaComoUsuario');
  Route::post('/normal/editarperfil/contrasena','UserController@editPasswordAsUser')->name('postEditarContrasenaComoUsuario');

  
  Route::get('/user/activacion/{token}','Auth\RegisterController@activateUser');

  
