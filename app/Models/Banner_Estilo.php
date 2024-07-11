<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner_Estilo extends Model
{
    use HasFactory;

    protected $table = 'banner__estilos';

    protected $primaryKey = 'banner__estilos_id';

    public $timestamps = false;

    protected $fillable = ['nombre','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function getBannerEstilo()
    {
        $data = Banner_Estilo::select('banner__estilo_id','nombre')->where('oculto',0)->get();

        return $data;
    }
}
