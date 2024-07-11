<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia_Imagens extends Model
{
    use HasFactory;
    
    protected $table = 'noticia_imagens';

    protected $primaryKey = 'noticia_imagen_id';

    public $timestamps = false;

    protected $fillable = ['noticia_id','imagen','size','url','principal','usuario_registro','fecha_registro', 'usuario_modifica','fecha_modifica'];

    public static function existNoticiaImage($noticia_image_id)
    {
        $data = Noticia_Imagens::where('noticia_imagen_id',$noticia_image_id)->count();

        return $data;
    }


}
