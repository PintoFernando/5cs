<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//ESTO ES SOLO DE VALIDACION DEL LOGIN DEL ADMIN
Route::post('/login','api\UserController@login'); //login del admin
//Route::post('/register', 'api\UserController@register');//esta quitado actualmente"
Route::post('/recover', 'api\UserController@recover');


//TODO  ADMIN
//Route::resource('credito', 'apicredito\CreditoController')->except([ 'create','edit']);
Route::get('/index', 'apicredito\CreditoController@index'); //muestra toda la lista de credito
Route::get('/show/{id}', 'apicredito\CreditoController@show'); //muestra solo un id de credito con el id de credito
Route::post('/busqueda', 'apicredito\CreditoController@busqueda');//buscas a la persona y lista el credito y nombre
Route::post('/store','apicredito\CreditoController@store'); //guardar foto de parte del admin

//TODO USER
Route::post('/listuser','apicredito\CreditoController@listuser');//lista los credito del usuario
Route::post('/listarcarpetauser','apicredito\CreditoController@listarcarpetauser');   //lista las carpetas del ususario
Route::post('/nuevacarpeta','apicredito\CreditoController@nuevacarpeta');//crea una nueva carpeta de imagenes
//subir foto user

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('/logout', 'UserController@logout');

    Route::get('test', function(){
        return response()->json(['foo'=>bar]);
    });
});

    
