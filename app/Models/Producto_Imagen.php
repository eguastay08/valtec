<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Imagen extends Model
{
    use HasFactory;

    protected $table = 'producto__imagens';

    protected $primaryKey = 'producto__imagens_id';

    public $timestamps = false;

    protected $fillable = ['producto_id','nombre','size','url','principal','usuario_registro','fecha_registro'];

    public function productoImg(){
        return $this->belongsTo(Producto::class);
    }

    public function existImage($producto_image_id)
    {
        $data = Producto_Imagen::where('producto__imagens_id',$producto_image_id)->count();

        return $data;
    }

}
