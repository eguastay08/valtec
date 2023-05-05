<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamaciones extends Model
{
    use HasFactory;

    protected $table = 'libro_reclamaciones';

    protected $primaryKey = 'libro_reclamacion_id';

    public $timestamps = false;

    protected $fillable = ['tipo_doc','nro_documento','nombre_apellidos','direccion','telefono','correo','id_bien_contratado','monto_reclamado','tipo','detalle_cliente','oculto','fecha_registro'];

}
