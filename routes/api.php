<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([], function (){
  Route::prefix('productos')->group( function(){
    $controlador = 'ProductosController';
    Route::get("listar","$controlador@listar_productos");
    Route::post("crear","$controlador@crear_producto");
    Route::put("{id}/editar","$controlador@editar_producto");
    Route::delete("{id}/eliminar","$controlador@eliminar_producto");
  });
});