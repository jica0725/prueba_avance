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

        $productos_contar = [
            'total' => $productos->count(),
            'activos' => $productos->where('estado',1)->count(),
            'inactivos' => $productos->where('estado',2)->count(),
            'pendientes' => $productos->where('estado',3)->count(),
        ];

        $bodegas = Bodegas::withCount('productos')->get();
        return [
            "productos" => $productos,
            "bodegas" => $bodegas,
            'productos_contar' => $productos_contar
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
