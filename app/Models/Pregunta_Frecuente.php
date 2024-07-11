<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta_Frecuente extends Model
{
    use HasFactory;

    protected $table = 'pregunta__frecuentes';

    protected $primaryKey = 'pregunta_frecuente_id';

    public $timestamps = false;

    protected $fillable = ['pregunta','respuesta','posicion','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];


    public static function getPreguntasFrecuentes($estado)
    {
        $preguntas_frecuentes= Pregunta_Frecuente::select('pregunta_frecuente_id','pregunta','respuesta','posicion','estado');
        
        if (isset($estado) && $estado != '_all_'):
            $preguntas_frecuentes->where('estado',$estado);
        endif;  

        $preguntas_frecuentes = $preguntas_frecuentes->where('oculto',0)
                                                    ->orderBy('posicion', 'ASC')
                                                    ->paginate(10);

        return $preguntas_frecuentes;
    }

    public static function countPregunta()
    {
        $pregunta_frecuente = Pregunta_Frecuente::where('oculto',0)->count();
        return $pregunta_frecuente;
    }

    public static function latestPositionPregunta()
    {
        $pregunta_frecuente = Pregunta_Frecuente::select('posicion')->where('oculto',0)->max('posicion');
        return $pregunta_frecuente;
    }

    public static function getCountByPregunta($posicion)
    {
        $count = Pregunta_Frecuente::where('posicion',$posicion)->where('oculto',0)->count(); 
        return $count;
    }

    public static function getPreguntaByPosition($posicion)
    {
        $pregunta_frecuente = Pregunta_Frecuente::select('pregunta_frecuente_id')->where('posicion',$posicion)->first();
        return $pregunta_frecuente;
    }

    public static function preguntasFrecuentesFront()
    {
        $preguntas_frecuentes= Pregunta_Frecuente::select('pregunta_frecuente_id','pregunta','respuesta','posicion','estado')
                                                    ->where('estado',1)
                                                    ->where('oculto',0)
                                                    ->orderBy('posicion', 'ASC')
                                                    ->paginate(10);
        
        return $preguntas_frecuentes;
    }

}
