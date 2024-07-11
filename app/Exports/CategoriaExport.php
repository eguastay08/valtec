<?php

namespace App\Exports;

use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class CategoriaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            '#',
            'Categoría',
            'Categoría Padre',
            'URL',
            'Estado'
        ];
    } 

    public function collection()
    {
        $categorias = DB::table('categorias')
        ->select('categorias.categoria_id','categorias.categoria', DB::raw("(SELECT a.categoria from categorias a where a.categoria_id = categorias.parent_id) as parent"),
        'categorias.url',
        DB::raw("(SELECT IF(categorias.estado = 1, 'Activo', 'Inactivo')) as activo"))
        ->where('categorias.estado',1)->where('categorias.oculto',0)->orderBy('parent','ASC')->get();

        return $categorias;
    }
}
