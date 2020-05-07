<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";

    protected $fillable = [
        "nombre_producto",
        "imagen",
        "categoria_id",
        "cantidad",
        "precio",
        "estado",
    ];

    public static $rules = [
        'nombre_producto' => 'required|min:2',
        'categoria_id' => 'required|exists:categoria,id',
        'precio'=> 'required',
        'cantidad'=> 'numeric|min:0',
        'estado'=> 'in:1,0'
    ];
}
