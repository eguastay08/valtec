<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Estilo extends Model
{
    use HasFactory;

    protected $table = 'estilos';

    protected $primaryKey = 'estilo_id';

    public $timestamps = false;

    protected $fillable = ['nombre','variable','elemento','propiedad','valor','posicion','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function get_Estilos()
    {
        $data  = DB::table('estilos as e')
                ->select('e.estilo_id','e.estilo_tipo_id','et.nombre as estilotipo','e.nombre','e.variable','e.elemento','e.propiedad','e.valor')
                ->join('estilo_tipos as et', function($join)
                {
                    $join->on('e.estilo_tipo_id', '=', 'et.estilo_tipo_id');
                    $join->where('et.oculto',0);
                })
                ->where('e.oculto',0)->orderBy('posicion','asc')
                ->get()->toArray();

        $lista = array();

        foreach($data as $e){
            $tipo = $e->estilotipo;
            $lista[$tipo][] = $e;
        }

        return $lista;
    }

}
