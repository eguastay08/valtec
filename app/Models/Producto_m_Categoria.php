<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_m_Categoria extends Model
{
    use HasFactory;

    protected $table = 'producto_m__categorias';

    protected $primaryKey = 'producto_m__categoria_id';

    public $timestamps = false;

    protected $fillable = ['producto_id','categoria_id','oculto','usuario_registra','fecha_registro', 'usuario_modifica', 'fecha_modifica'];

    public function ProductoCategoria_Producto(){
        return $this->belongsTo(Producto::class);
    }

    public function ProductoCategoria_Categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function getProductoCategoriasById($producto_id)
    {

    }

}
