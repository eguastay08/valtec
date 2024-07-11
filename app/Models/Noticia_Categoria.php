<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia_Categoria extends Model
{
    use HasFactory;

    protected $table = 'noticia_categorias';

    protected $primaryKey = 'noticia_categoria_id';

    public $timestamps = false;

    protected $fillable = ['noticia_categoria','descripcion','parent_id','url','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];


    public static function getParentsNCExits($parent, $slug)
    {
        $noticia_categoria = Noticia_Categoria::where('parent_id',$parent)
                      ->where('url',$slug)->where('oculto',0)->count();

        return $noticia_categoria;
    }

    public static function getListParentsNoticias()
    {
        $data = Noticia_Categoria::select('noticia_categoria_id','noticia_categoria')
                ->where('parent_id',0)->where('estado',1)
                ->where('oculto',0)->orderBy('noticia_categoria', 'ASC')->get();

        return $data;
    }

    
    public static function getNoticiaCategoryExits($slug)
    {
        $categoria =  Noticia_Categoria::where('url',$slug)->where('oculto',0)->count();

        return $categoria;
    }

    public static function get_tree_select_noticias_categorias($parent = NULL)
    {
        $categoria = self::get_tree_noticias_categorias($parent);
        return self::multi_loop_noticias_categorias($categoria);
    }

    public static function get_tree_noticias_categorias($parent = NULL)
    {
        $array_menu = array();
        $where = array();
        
        if($parent == NULL || $parent == 0){
            $where['parent_id'] = 0;
        }else{
            $where['parent_id'] = (int) $parent;
        }

        $c = Noticia_Categoria::select('noticia_categoria_id','noticia_categoria','url','parent_id');
        
        foreach($where as $w => $x){
           $c->where($w, $x);
        }

        $c = $c->where('estado',1)->where('oculto',0)
                ->orderBy('noticia_categoria','ASC')->get()->toArray();

        foreach($c as $m)
        {
            $menu = array();
            $menu['noticia_categoria_id'] = $m['noticia_categoria_id'];
            $menu['url'] = $m['url'];
            $menu['noticia_categoria'] = $m['noticia_categoria'];
            $menu['parent_id'] = $m['parent_id'];
            $menu['sub_menu'] = self::get_tree_noticias_categorias($m['noticia_categoria_id']);
            $array_menu[] = $menu;
        }
        
        return $array_menu;
   
    }

    
    private static function multi_loop_noticias_categorias($noticia_categoria, $parentName = NULL)
    {
        $options = array();
        foreach ($noticia_categoria as $nc) {
            $name = ($parentName ? $parentName." / ": "").$nc['noticia_categoria'];
            $options[] = array(
                'noticia_categoria_id' => $nc['noticia_categoria_id'],
                'url' => $nc['url'],
                'noticia_categoria' => $name,
                'parent_id' => $nc['parent_id']
            );
            $options = array_merge($options, self::multi_loop_noticias_categorias($nc['sub_menu'], $name));
        }
        return $options;
    }

    public static function get_treeNoticiasCategories($parent = NULL)
    {
        $array_menu = array();
        $where = array();
        
        if($parent == NULL || $parent == 0){
            $where['parent_id'] = 0;
        }else{
            $where['parent_id'] = (int) $parent;
        }

        $c = Noticia_Categoria::select('noticia_categoria_id','noticia_categoria','url','parent_id');
        
        foreach($where as $w => $x){
           $c->where($w, $x);
        }

        $c = $c->where('estado',1)->where('oculto',0)
                ->orderBy('noticia_categoria','ASC')->get()->toArray();

        foreach($c as $m)
        {
            $menu = array();
            $menu['noticia_categoria_id'] = $m['noticia_categoria_id'];
            $menu['url'] = $m['url'];
            $menu['noticia_categoria'] = $m['noticia_categoria'];
            $menu['parent_id'] = $m['parent_id'];
            $menu['sub_menu'] = self::get_treeNoticiasCategories($m['noticia_categoria_id']);
            $array_menu[] = $menu;
        }
        
        return $array_menu;
   
    }

    public static function getNoticiaCategoriaxUrl($url)
    {
        $data = Noticia_Categoria::select('noticia_categoria')
                    ->where('url', $url)
                    ->where('estado',1)->where('oculto',0)->get()->toArray();
        return $data;
    }


    public static function getNotCatxUrl($url, $sub)
    {
        $noticia_categoria = Noticia_Categoria::select('noticia_categoria_id')
                ->where('url', $url)
                ->where('estado',1)->where('oculto',0)->first();

        $data = '';

        if($sub != ""):

            if($noticia_categoria ==NULL):
                $data = NULL;
            else:
                $subnotCat =  Noticia_Categoria::select('noticia_categoria_id')
                            ->where('parent_id', $noticia_categoria->noticia_categoria_id)
                            ->where('url',$sub)->where('estado',1)->where('oculto',0)->first();
                $data = $subnotCat;
            endif;

        else: 
            $data = $noticia_categoria;
        endif;

        return $data;
    }
}
