<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $primaryKey = 'tag_id';

    public $timestamps = false;

    protected $fillable = ['tag','url','nombre_img','size_img','img','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function ProductoTag_Tag(){
        return $this->HasMany(Producto_m_Tag::class);
    }

    public static function getTagsFront()
    {
        $data = Tag::select('tag_id','tag','url')
                    ->where('estado',1)->where('oculto',0)
                    ->orderBy('tag','asc')
                    ->get();

        return $data;
    }

    public static function getTagTitle($url)
    {
        $data = Tag::select('tag','url')
        ->where('estado',1)->where('oculto',0)->where('url',$url)
        ->first();

        return $data;
    }

    public static function getTagxUrl($url)
    {
        $data   = Tag::select('tag_id')
            ->where('url',$url)->where('estado',1)->where('oculto',0)->first();
        return $data;
    }

}
