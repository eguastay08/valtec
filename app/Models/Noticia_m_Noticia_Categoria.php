<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia_m_Noticia_Categoria extends Model
{
    use HasFactory;
     
    protected $table = 'noticia_m_noticia_categorias';

    protected $primaryKey = 'noticia_m_noticia_categoria_id';

    public $timestamps = false;

    protected $fillable = ['noticia_id','noticia_categoria_id','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

}
