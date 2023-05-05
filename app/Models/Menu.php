<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $primaryKey = 'menu_id';

    public $timestamps = false;

    protected $fillable = ['nombre','link','padre','icono','nombre_icono','size_icono','posicion','estado','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

    public function getMenus($padre = 0)
    {
        $array_menu = array();

        $result = Menu::select('menu_id','nombre','link','padre','icono','posicion','estado')
                            ->where('padre',$padre)
                            ->where('oculto',0)
                            ->orderBy('posicion','asc')
                            ->get()->toArray();

        foreach ($result as $m) {
            $menu = array();
            $menu['menu_id'] = $m['menu_id'];
            $menu['nombre'] = $m['nombre'];
            $menu['link'] = $m['link'];
            $menu['padre'] = $m['padre'];
            $menu['icono'] = $m['icono'];
            $menu['sub_menu'] = self::getMenus($m['menu_id']);
            $menu['posicion'] = $m['posicion'];
            $menu['estado'] = $m['estado'];
            $array_menu[] = $menu;
        }

        return $array_menu;
    }

    public function getMenusxParent($parent_id) 
    {
        $menu = Menu::select('menu_id','nombre','link')->where('padre',$parent_id)->where('estado',1)->where('oculto',0)->orderBy('posicion','asc')->get();
        return $menu;
    }


    public function countMenuxPadre($padre)
    {
        $menu = Menu::where('padre',$padre)->where('oculto',0)->count();
        return $menu;
    }

    public function latestPositionxPadre($padre)
    {
        $menu = Menu::select('posicion')->where('padre',$padre)->where('oculto',0)->max('posicion');
        return $menu;
    }

    public function getPadresMenu()
    {
        $menu = Menu::select('menu_id','nombre')->where('padre',0)->where('oculto',0)->get();
        return $menu;
    }

    public function getMenuByPosition($posicion, $padre)
    {
        $bloque = Menu::select('menu_id')->where('padre',$padre)->where('posicion',$posicion)->where('oculto',0)->first();
        return $bloque;
    }

}
