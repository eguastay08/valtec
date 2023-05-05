<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo_Tipo extends Model
{
    use HasFactory;

    protected $table = 'estilo_tipos';

    protected $primaryKey = 'estilo_tipo_id';

    public $timestamps = false;

    protected $fillable = ['nombre','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

}
