<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Productos, 
    Bodegas
};

class ProductosController extends Controller
{
    
    public function listar_productos()
    {
        $productos = Productos::with('bodega')->get();

        $bodegas = Bodegas::withCount('productos')->get();
        return [
            "productos" => $productos,
            "bodegas" => $bodegas,
        ];
    }

    public function crear_producto(Request $request)
    {

        $producto = new Productos;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->existencia = $request->existencia;
        $producto->codigo = $request->codigo;
        $producto->id_bodega = $request->id_bodega;
        $producto->save();

        return ['exito'=>'Guardo'];

    }

    public function editar_producto($id,Request $request)
    {

        $producto = Productos::find($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->estado = $request->estado;
        $producto->existencia = $request->existencia;
        $producto->codigo = $request->codigo;
        $producto->id_bodega = $request->id_bodega;
        $producto->save();

        return ['exito'=>'Edito'];

    }

}
