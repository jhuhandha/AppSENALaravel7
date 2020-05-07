<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categoria
 * @package App\Models
 * @version May 2, 2020, 4:48 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection $productos
 * @property string $nombre_categoria
 */
class Categoria extends Model
{
    public $table = 'categoria';

    public $timestamps = false;

    public $fillable = [
        'nombre_categoria'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre_categoria' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre_categoria' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    // public function productos()
    // {
    //     return $this->hasMany(\App\Models\Producto::class, 'categoria_id');
    // }
}
