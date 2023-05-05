<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $table = 'descuentos';

    protected $primaryKey = 'descuento_id';

    public $timestamps = false;

    protected $fillable = ['cupon','porcentaje','usado','uso','nro_productos','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function getDescuento()
    {
        $data = Descuento::select('descuento_id','cupon','porcentaje','uso','nro_productos','estado')
                            ->where('oculto',0)->orderBy('cupon','ASC')->paginate(10);

        return $data;
    }

    public function getCuponxValue($value)
    {
        $data = Descuento::select('descuento_id','cupon','porcentaje','nro_productos')
                            ->where('cupon',$value)->where('estado',1)->where('oculto',0)->get()->toArray();

        return $data;
    
    }

}
