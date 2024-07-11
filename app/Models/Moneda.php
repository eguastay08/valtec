<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;

    protected $table = 'monedas';

    protected $primaryKey = 'moneda_id';

    public $timestamps = false;

    protected $fillable = ['nombre','codigo','prefijo','sufijo','tipo_cambio','estado','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function getMonedas()
    {
        $monedas = Moneda::select('moneda_id', 'nombre', 'codigo','prefijo','sufijo','tipo_cambio','estado')
                            ->where('oculto',0)->orderBy('moneda_id', 'asc')->paginate(10);
        return $monedas;
    }

    public static function getMonedaFront()
    {
        $monedas = Moneda::select('codigo', 'prefijo','sufijo','tipo_cambio')
                ->where('estado',1)->where('oculto',0)->get();
        return $monedas;
    }

    public static function getTipoCambio()
    {
        $data = Moneda::select('tipo_cambio')
                ->where('estado',1)->where('oculto',0)->get();
        return $data;
    }


}
