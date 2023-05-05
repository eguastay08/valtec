<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_m_Tag extends Model
{
    use HasFactory;

    protected $table = 'producto_m__tags';

    protected $primaryKey = 'producto_m__tag_id';

    public $timestamps = false;

    protected $fillable = ['producto_id','tag_id','oculto','usuario_registra','fecha_registro', 'usuario_modifica', 'fecha_modifica'];

    public function Producto_productoTag(){
        return $this->belongsTo(Producto::class);
    }

    public function Tag_ProductoTag(){
        return $this->belongsTo(Tag::class);
    }

}
