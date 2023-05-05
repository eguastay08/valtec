<?php
namespace App\Services\Admin;
 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ImageService
{
    public function subirImagenTmp($request)
    {
        // $pathtmp = public_path('admin_assets/images/tmp/');
        $pathtmp = public_path('assets/images/tmp/');
        $fileNames = time().'_'.$request->indice.'_'.$request->imagen->getClientOriginalName();
        $sizefiles = $request->imagen->getSize();
        // $urlfiles = "admin_assets/images/tmp/".$fileNames;
        $urlfiles = "assets/images/tmp/".$fileNames;
        if (!file_exists($pathtmp)):
            mkdir($pathtmp, 0777, true);
        endif;

        $request->imagen->move($pathtmp, $fileNames);

        $data = [
            "name" => $fileNames,
            "size"=> $sizefiles,
            "url"=>$urlfiles,
        ];

        return $data;
    }

    public function eliminarImagenTmp($request)
    {
        // if( File::exists(public_path('admin_assets/images/tmp/'.$request->filename))):
        //     File::delete(public_path('admin_assets/images/tmp/'.$request->filename));
        // endif;
        if( File::exists(public_path('assets/images/tmp/'.$request->filename))):
            File::delete(public_path('assets/images/tmp/'.$request->filename));
        endif;

        return true;
    }

    public function moveimage($filename, $destino)
    {
        // $origen = public_path('admin_assets/images/tmp');
        $origen = public_path('assets/images/tmp');
        // $destino =  public_path('admin/images/iconos/');

        if (!file_exists($destino)):
            mkdir($destino, 0777, true);
        endif;

        copy($origen.'/'.$filename, $destino.'/'.$filename);
        unlink($origen.'/'.$filename);
    }

    public function eliminarImg($url)
    {
        if( File::exists($url)):
            File::delete($url);
        endif;
        // return true;
    }
    

}