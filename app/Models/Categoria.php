<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'categoria_id';

    public $timestamps = false;

    protected $fillable = ['categoria','descripcion','parent_id','url','nombre_img','size_img','img','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function Categoria_ProductoCategoria(){
        return $this->HasMany(Producto_m_Categoria::class);
    }

    // Obtener Precio Máxico 
    public static function getCategoriesWithParents()
    {
        $categorias = DB::table('categorias')
        ->select('categorias.categoria_id','categorias.categoria','categorias.parent_id',
        DB::raw("(SELECT a.categoria from categorias a where a.categoria_id = categorias.parent_id) as parent"))
        ->where('categorias.estado',1)->where('categorias.oculto',0)->orderBy('parent','ASC')->get();

        return $categorias;
    }

    //Obtener Listado de Categorías Padres
    public static function getListParents()
    {
        $data = Categoria::select('categoria_id','categoria')
                ->where('parent_id',0)->where('estado',1)
                ->where('oculto',0)->orderBy('categoria', 'ASC')->get();

        return $data;
    }
    
      // Verificar si la categoría padre existe
    public static function getParentsExits($parent, $slug)
    {
        $categoria = Categoria::where('parent_id',$parent)
                      ->where('url',$slug)->where('oculto',0)->count();

        return $categoria;
    }

    // Verificar si la categoría existe
    public static function getCategoryExits($slug)
    {
        $categoria =  Categoria::where('url',$slug)->where('oculto',0)->count();

        return $categoria;
    }

      // Verificar si la categoría existe
    public static function get_tree_select($parent = NULL)
    {
        $categoria = self::get_tree($parent);
        return self::multi_loop($categoria);
    }

    public static function get_tree($parent = NULL)
    {
        $array_menu = array();
        $where = array();
        
        if($parent == NULL || $parent == 0){
            $where['parent_id'] = 0;
        }else{
            $where['parent_id'] = (int) $parent;
        }

        $c = Categoria::select('categoria_id','categoria','url','parent_id');
        
        foreach($where as $w => $x){
           $c->where($w, $x);
        }

        $c = $c->where('estado',1)->where('oculto',0)
                ->orderBy('categoria','ASC')->get()->toArray();

        foreach($c as $m)
        {
            $menu = array();
            $menu['categoria_id'] = $m['categoria_id'];
            $menu['url'] = $m['url'];
            $menu['categoria'] = $m['categoria'];
            $menu['parent_id'] = $m['parent_id'];
            $menu['sub_menu'] = self::get_tree($m['categoria_id']);
            $array_menu[] = $menu;
        }
        
        return $array_menu;
   
    }

    
    private static function multi_loop($categoria, $parentName = NULL)
    {
        $options = array();
        foreach ($categoria as $u) {
            $name = ($parentName ? $parentName." / ": "").$u['categoria'];
            $options[] = array(
                'categoria_id' => $u['categoria_id'],
                'url' => $u['url'],
                'categoria' => $name,
                'parent_id' => $u['parent_id']
            );
            $options = array_merge($options, self::multi_loop($u['sub_menu'], $name));
        }
        return $options;
    }

    public static function getCategoriaBloqueFront($categoria_id)
    {
        $categorias = Categoria::select('categoria_id','categoria','url')
                                ->where('categoria_id',$categoria_id)->first();
                                // ->where('estado',1)
                                // ->where('oculto',0)
        return $categorias;
    }

    // Obtener la url de la categoría por ID de la categoría
    public static function getUrlxCategoria($categoria_id)
    {
        $categorias = Categoria::select('url')
                        ->where('categoria_id',$categoria_id)->first();

        return $categorias;
    }  
    
    public static function get_frontCategoria()
    {
        $data = Categoria::select('categoria_id','categoria','url')
                ->where('parent_id',0)->where('estado',1)
                ->where('oculto',0)->orderBy('categoria', 'ASC')->take(7)->get();

        return $data;
    }

    // Obtener titulo de la categoría padre por URL como parámetro
    public static function getCategoriaTitleFront($url)
    {
        $data = Categoria::select('categoria_id','categoria','url')
                ->where('url',$url)->where('parent_id',0)->where('oculto',0)->first();

        return $data;
    }

     // Obtener titulo de la subcategoría por URL e ID de cateogría padre como parámetro

    public static function subCategoriaTitleFront($id, $url)
    {
        $data = Categoria::select('categoria')
                ->where('url',$url)->where('parent_id',$id)->where('oculto',0)->first();

        return $data;
    }

    public static function getImgCat($id, $sub)
    {
        $data = Categoria::select('categoria_id','nombre_img','size_img','img');
        if($sub!=""):
            $data = $data->where('parent_id',$id)
                        ->where('url',$sub);
        else:
            $data = $data->where('categoria_id', $id);
        endif;

        $data = $data->where('oculto',0)->first();

        return $data;
    }

    public static function getCatxUrl($url, $sub)
    {
        $categoria   = Categoria::select('categoria_id')
                ->where('url',$url)->where('parent_id',0)->where('estado',1)->where('oculto',0)->first();

        $data = '';

        if($sub!=""):
            $urlparam = $url .'/'.$sub;
            if($categoria == NULL):
                $data = NULL;
            else:
                $subcat =  Categoria::select('categoria_id')
                            ->where('parent_id', $categoria->categoria_id)
                            ->where('url',$urlparam)->where('estado',1)->where('oculto',0)->first();
                $data = $subcat;
            endif;
        else:
            $data = $categoria;
        endif;

        return $data;
    }

}
