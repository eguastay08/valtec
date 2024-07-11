<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia_Tag extends Model
{
    use HasFactory;

    protected $table = 'noticia_tags';

    protected $primaryKey = 'noticia_tag_id';

    public $timestamps = false;

    protected $fillable = ['noticia_tag','url','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function getNoticiasTagsFront()
    {
        $data = Noticia_Tag::select('noticia_tag_id','noticia_tag','url')
                    ->where('estado',1)->where('oculto',0)
                    ->orderBy('noticia_tag','asc')
                    ->get();

        return $data;
    }

    public static function getNoticiaTagxUrl($url)
    {
        $data = Noticia_Tag::select('noticia_tag')
                    ->where('url', $url)
                    ->where('estado',1)
                    ->where('oculto',0)->get()->toArray();
        return $data;
    }

    public static function getNotTagxUrl($url)
    {
        $data  = Noticia_Tag::select('noticia_tag')
        ->where('url',$url)->where('estado',1)->where('oculto',0)->first();
        return $data;
    }


}
