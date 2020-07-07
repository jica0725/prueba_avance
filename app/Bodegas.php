<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodegas extends Model
{
    protected $table = "bodegas";
    protected $guarded = [];

    /**
     * relacion con la tabla productos
     */
    public function productos()
    {
    	return $this->hasMany(Productos::class,'id_bodega');
    }
}
