<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_codigo extends Model
{
    use HasFactory;

    protected $table = 'producto_codigos';

    protected $primaryKey = 'producto_codigos_id';

    public $timestamps = false;

    protected $fillable = ['producto_id','codigo','descripcion','estado','oculto','usuario_registra','fecha_registro', 'usuario_modifica', 'fecha_modifica'];

    public static function productoCod(){
        return $this->belongsTo(Producto::class);
    }

    public static function getCodigosByProducto($codigoproducto, $estado)
    {
        $codigosProducto = Producto_codigo::where('producto_id',$codigoproducto);

        if($estado!='_all_'):
            $codigosProducto->where('estado',$estado);
        endif;
        
        $codigosProducto = $codigosProducto->where('oculto',0)->paginate(10);

        return $codigosProducto;
    }

    public static function getCodigoxID($id)
    {
        $dataCodigo = Producto_codigo::select('codigo')->where('producto_codigos_id',$id)->first();
        return $dataCodigo;
    }

    public static function acodigos($codigo_id)
    {
        $data = [
            "estado" => 3
        ];
        Producto_codigo::where('producto_codigos_id', $codigo_id)
                        ->update($data);
    }

}
