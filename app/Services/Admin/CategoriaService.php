<?php
namespace App\Services\Admin;
 
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Services\Admin\ImageService;

class CategoriaService
{
    public static function moveImgCategoria($filename)
    {
        // $destino =  public_path('admin/images/banners/');
        $destino =  public_path('assets/images/categorias/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public static function existImageCategoria($filename)
    {
        $url = public_path($filename);
        echo ImageService::eliminarImg($url);
    }

    public static function eliminarCategoriaImg($categoria_id, $filename, $superpuesto)
    {
        // $url = public_path('admin/images/banners/'.$filename);
        $url = public_path('assets/images/categorias/'.$filename);
        $image = ImageService::eliminarImg($url);
        Categoria::where("categoria_id", $categoria_id)->update(["img" => "", "nombre_img" => "", "size_img" => ""]);

    }
}