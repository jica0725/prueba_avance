<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = "productos";
    protected $guarded = [];
    public $timestamps = false;

    /**
     * relacion con la tabla bodega
     */
    public function bodega()
    {
    	return $this->belongsTo(Bodegas::class,'id_bodega');
    }
}
