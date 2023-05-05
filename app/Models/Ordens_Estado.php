<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordens_Estado extends Model
{
    use HasFactory;
    
    protected $table = 'ordens_estados';

    protected $primaryKey = 'orden_estado_id';

    public $timestamps = false;

    protected $fillable = ['estado','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

}
