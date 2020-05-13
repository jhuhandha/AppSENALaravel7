<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = "agenda";

    protected $fillable = [
        "usuario_id",
        "fecha",
        "hora_inicio",
        "hora_final",
        "descripcion",
        "estado",
    ];
}
