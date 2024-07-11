<?php

namespace App\Exports;

use App\Models\Tag;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TagExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Id',
            'Etiqueta',
            'URL'
        ];
    } 

    public function collection()
    {
       $tags = Tag::select('tag_id','tag','url')->where('oculto',0)->orderBy('tag','ASC')->get();
        return $tags;
    }
}
