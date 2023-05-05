<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuraciones';

    protected $primaryKey = 'configuracion_id';

    public $timestamps = false;

    protected $fillable = ['nombre','vaiable','valor','system'];

    public function get_Configuraciones()
    {
        $data  = Configuracion::select('configuracion_id','nombre','variable','valor')
                ->orderBy('configuracion_id','asc')
                ->get();

        return $data;
    }

    public function get_valorxvariable($variable)
    {
        $data  = Configuracion::select('valor')
                ->where('variable',$variable)
                ->first();

        return $data;
    }

}
