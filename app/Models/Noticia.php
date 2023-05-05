<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Noticia extends Model
{
    use HasFactory;
    
    protected $table = 'noticias';

    protected $primaryKey = 'noticia_id';

    public $timestamps = false;

    protected $fillable = ['noticia','descripcion','url','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function getNoticiasWithImage($ntitulo = '', $ncat = '', $nestado = '_all_')
    {

        $noticias =  DB::table('noticias as n')
        ->select('n.noticia_id','n.noticia','n.descripcion','n.url as link','n.estado','ni.url as imgnoticia',DB::raw('group_concat(ncat.noticia_categoria) as noticia_categorias'))
        ->leftJoin('noticia_imagens as ni', function($join)
        {
            $join->on('n.noticia_id', '=', 'ni.noticia_id');
            $join->where('ni.principal',1);
        })
        ->join('noticia_m_noticia_categorias as nc', function($join)
        {
            $join->on('n.noticia_id', '=', 'nc.noticia_id');
            $join->where('nc.oculto',0);
        })
        ->join('noticia_categorias as ncat', function($join)
        {
            $join->on('ncat.noticia_categoria_id', '=', 'nc.noticia_categoria_id');
            $join->where('ncat.oculto',0);
        });

        if (isset($ntitulo) && $ntitulo != ''):
            $noticias ->where('n.noticia','LIKE','%'.$ntitulo."%");
        endif;    

        if (isset($ncat) && $ncat!=''):
            $noticias->whereIn('nc.noticia_categoria_id', $ncat);
        endif;
        
        if (isset($nestado) && $nestado!='_all_'):

            $noticias->where('n.estado',$nestado);
        endif;
    
        $noticias= $noticias->where('n.oculto',0)
                            ->groupBy('n.noticia_id')
                            ->orderBy('n.noticia_id','ASC')->paginate(10);

        return $noticias;
    }

    public function getNoticiasFront()
    {
        $noticias =  DB::table('noticias as n')
        ->select('n.noticia_id','n.noticia','n.url as link','ni.url as imgnoticia')
        ->leftJoin('noticia_imagens as ni', function($join)
        {
            $join->on('n.noticia_id', '=', 'ni.noticia_id');
            $join->where('ni.principal',1);
        });
        $noticias= $noticias->where('n.oculto',0)
        ->groupBy('n.noticia_id')
        ->orderBy('n.noticia_id','DESC')->take(3)->get();

        return $noticias;

    }

    public function getNoticiasGlobal()
    {
        $noticias = Noticia::select('noticias.noticia_id', 'noticias.noticia',
        'noticias.estado','noticias.url','ni.url as imgnoticia')
        ->leftJoin('noticia_imagens as ni', function($join)
        {
            $join->on('noticias.noticia_id', '=', 'ni.noticia_id');
            $join->where('ni.principal',1);
        });

        $noticias = $noticias->where('noticias.estado',1)
        ->where('noticias.oculto',0)->orderBy('noticias.fecha_registro','DESC');

        $noticias = $noticias->paginate(10);

        return $noticias;
    }

    public function getNoticeUrlData($url)
    {
        $data = Noticia::select('noticia_id')
                ->where('url',$url)
                ->where('estado',1)
                ->where('oculto',0)->first();

        return $data;
    }

    public function getNoticiaxUrl($url)
    {
        $arrayNoticia= Noticia::select('noticias.noticia_id','noticias.noticia','noticias.descripcion','noticias.fecha_registro','noticias.url',
        'noticias.estado','ni.url as imgnoticia')
        ->leftJoin('noticia_imagens as ni', function($join)
        {
            $join->on('noticias.noticia_id', '=', 'ni.noticia_id');
            $join->where('ni.principal',1);
        })
        ->where('noticias.url',$url)
        ->where('noticias.estado',1)
        ->where('noticias.oculto',0)
        // ->orderBy('productos.producto','asc')
        // ->orderBy('noticias.fecha_registro', 'DESC')
        ->first()->toArray();

        $imagenesNoticia = self::getImagenesNoticia($arrayNoticia['noticia_id']);


        $arrayNoticia['imagenes_noticia'] = $imagenesNoticia;

        $categoriasNoticia = self::getCategoriasNoticia($arrayNoticia['noticia_id']);

        $arrayNoticia['noticia_categorias'] = $categoriasNoticia;

        
        $tagsNoticia = self::getEtiquetasNoticia($arrayNoticia['noticia_id']);

        $arrayNoticia['noticia_tags'] = $tagsNoticia;


        return $arrayNoticia;
    }

    public function getImagenesNoticia($noticia_id)
    {
        $dataimages = DB::table('noticia_imagens')
                            ->select('noticia_imagen_id', 'noticia_id', 'url')
                            ->where('noticia_id', $noticia_id) 
                            ->orderBy('principal','desc')
                            ->orderBy('fecha_registro','desc')
                            // ->where('principal',0)->orderBy('fecha_registro','desc')
                            ->get()->toArray();

        
        return $dataimages;
    }


    public function getCategoriasNoticia($noticia_id)
    {
        $datacategorias = DB::table('noticia_m_noticia_categorias as nmc')
                            ->select('nmc.noticia_m_noticia_categoria_id', 'nmc.noticia_id', 'nmc.noticia_categoria_id', 'nc.noticia_categoria', 'nc.url')
                            ->join('noticia_categorias as nc', function($join)
                            {
                                $join->on('nc.noticia_categoria_id', '=', 'nmc.noticia_categoria_id');
                                $join->where('nc.estado',1);
                                $join->where('nc.oculto',0);
                            })
                            ->where('nmc.noticia_id', $noticia_id) 
                            ->where('nmc.oculto',0)->orderBy('nmc.fecha_registro','desc')
                            ->get()->toArray();

        
        return $datacategorias;
    }

    public function getEtiquetasNoticia($noticia_id)
    {
        $dataTags = DB::table('noticia_m_noticia_tags as nmt')
                        ->select('nmt.noticia_m_noticia_tag_id', 'nmt.noticia_id', 'nmt.noticia_tag_id', 'nt.noticia_tag', 'nt.url')
                        ->join('noticia_tags as nt', function($join)
                        {
                            $join->on('nt.noticia_tag_id', '=', 'nmt.noticia_tag_id');
                            $join->where('nt.estado',1);
                            $join->where('nt.oculto',0);
                        })
                        ->where('nmt.noticia_id', $noticia_id) 
                        ->where('nmt.oculto',0)->orderBy('nmt.fecha_registro','desc')
                        ->get()->toArray();

        
        return $dataTags;
    }

    public function getNoticiasRelacionadas($url)
    {
        $categorias_noticias = DB::table('noticias as n')
                            ->select('n.noticia_id', 'nc.noticia_categoria_id')
                            ->join('noticia_m_noticia_categorias as nc', function($join)
                            {
                                $join->on('n.noticia_id', '=', 'nc.noticia_id');
                                $join->where('nc.oculto',0);
                            })
                            ->where('n.url', $url) 
                            ->where('n.oculto',0)->orderBy('nc.noticia_categoria_id','asc')
                            ->get()->toArray();

        $array_noticiacategorias = array();
        $array_noticia_id = array();
        // $producto_id = $categorias_producto[0]->producto_id;
        foreach($categorias_noticias as $cn):
        $array_noticia_id[] = $cn->noticia_id;
        $array_noticiacategorias[] = $cn->noticia_categoria_id;
        endforeach;


        $noticias_relacionadas = Noticia::select('noticias.noticia_id', 'noticias.noticia','noticias.estado',
                                    'noticias.url','ni.url as imgnoticia')
                                ->leftJoin('noticia_imagens as ni', function($join)
                                {
                                    $join->on('noticias.noticia_id', '=', 'ni.noticia_id');
                                    $join->where('ni.principal',1);
                                })
                                ->join('noticia_m_noticia_categorias as nmc', function($join)
                                {
                                    $join->on('noticias.noticia_id', '=', 'nmc.noticia_id');
                                    $join->where('nmc.oculto',0);
                                })
                                ->whereIn('nmc.noticia_categoria_id',$array_noticiacategorias)
                                ->whereNotIn('noticias.noticia_id',$array_noticia_id)
                                ->where('noticias.estado',1)
                                ->where('noticias.oculto',0)
                                ->orderBy('noticias.fecha_registro', 'DESC')
                                ->groupBy('noticias.noticia_id')
                                ->take(6)->get();

        return $noticias_relacionadas;

    }

    public function getNoticiasxCategoriaFront($url, $sub)
    {
        $noticiacategoria_id = DB::table('noticia_categorias')
                ->select('noticia_categoria_id')
                ->where('url', $url)
                ->where('estado',1)
                ->where('oculto',0)
                ->first();

        $subnoticiacategoria_id = '';

        if($sub!=''):
            $subnoticiacategoria_id = DB::table('noticia_categorias')
            ->select('noticia_categoria_id')
            ->where('parent_id',$noticiacategoria_id->noticia_categoria_id)
            ->where('url', $sub)
            ->where('estado',1)
            ->where('oculto',0)
            ->first();
        endif;   

        $noticias = Noticia::select('noticias.noticia_id', 'noticias.noticia','noticias.estado',
                                     'noticias.url','ni.url as imgnoticia')
                    ->leftJoin('noticia_imagens as ni', function($join)
                        {
                            $join->on('noticias.noticia_id', '=', 'ni.noticia_id');
                            $join->where('ni.principal',1);
                        })
                        ->join('noticia_m_noticia_categorias as nmc', function($join)
                        {
                            $join->on('noticias.noticia_id', '=', 'nmc.noticia_id');
                            $join->where('nmc.oculto',0);
                        })
                        ->join('noticia_categorias as nc', function($join)
                        {
                            $join->on('nmc.noticia_categoria_id', '=', 'nc.noticia_categoria_id');
                            $join->where('nc.oculto',0);
                        });

        if($subnoticiacategoria_id != ''):  
            $noticias->where('nc.noticia_categoria_id',$subnoticiacategoria_id->noticia_categoria_id);
        else:
            $noticias->where('nc.noticia_categoria_id',$noticiacategoria_id->noticia_categoria_id);
        endif;

        $noticias = $noticias ->where('noticias.estado',1)
        ->where('noticias.oculto',0);

        $noticias = $noticias->paginate(20);

        return $noticias;

    }

    public function getNoticiasByEtiquetaFront($url)
    {
        $noticias = Noticia::select('noticias.noticia_id', 'noticias.noticia','noticias.estado','noticias.url','ni.url as imgnoticia')
        ->leftJoin('noticia_imagens as ni', function($join)
        {
            $join->on('noticias.noticia_id', '=', 'ni.noticia_id');
            $join->where('ni.principal',1);
        })
        ->join('noticia_m_noticia_tags as nmt', function($join)
        {
            $join->on('noticias.noticia_id', '=', 'nmt.noticia_id');
            $join->where('nmt.oculto',0);
        })
        ->join('noticia_tags as nt', function($join)
        {
            $join->on('nmt.noticia_tag_id', '=', 'nt.noticia_tag_id');
            $join->where('nt.oculto',0);
        });

        
        $noticias = $noticias ->where('nt.url',$url)
                                ->where('noticias.estado',1)
                                ->where('noticias.oculto',0);

        $noticias = $noticias->paginate(20);

        return $noticias;
    }

}
