<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque_tipo extends Model
{
    use HasFactory;

    protected $table = 'bloque_tipos';

    protected $primaryKey = 'bloque_tipo_id';

    public $timestamps = false;

    protected $fillable = ['codigo','nombre','parametros','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    

}
