<?php
namespace App\Services\Admin;
 
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Services\Admin\ImageService;

class TagService
{
    public function moveImgEtiqueta($filename)
    {
        // $destino =  public_path('admin/images/banners/');
        $destino =  public_path('assets/images/tags/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public function existImageEtiqueta($filename)
    {
        $url = public_path($filename);
        echo ImageService::eliminarImg($url);
    }

    public function eliminarEtiquetaImg($categoria_id, $filename, $superpuesto)
    {
        // $url = public_path('admin/images/banners/'.$filename);
        $url = public_path('assets/images/categorias/'.$filename);
        $image = ImageService::eliminarImg($url);
        Tag::where("tag_id", $categoria_id)->update(["img" => "", "nombre_img" => "", "size_img" => ""]);

    }
}