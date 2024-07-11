<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;


use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProductsReport2 implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, ShouldAutoSize,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            '#',
            'SKU',
            'Producto',
            'Precio',
            'Precio Oferta',
            'Categorias',
            'Stock'
        ];
    } 

    public function columnFormats():array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
            1  => ['font' => ['size' => 14]],
        ];
    }

    public function collection()
    {
        return $productos =  DB::table('productos as p')
            ->select('p.producto_id','p.sku','p.producto','p.precio','p.precio_oferta',
            DB::raw('group_concat(c.categoria) as categorias'),'p.stock')
            ->leftJoin('producto_codigos as pcod', function($join)
            {
                $join->on('p.producto_id', '=', 'pcod.producto_id');
                $join->where('pcod.estado',1);
            })
            ->join('producto_m__categorias as pc', function($join)
            {
                $join->on('p.producto_id', '=', 'pc.producto_id');
                $join->where('pc.oculto',0);
            })
            ->join('categorias as c', function($join)
            {
                $join->on('c.categoria_id', '=', 'pc.categoria_id');
                $join->where('c.oculto',0);
            })
            ->where('p.con_stock','=',1)
            ->where('p.stock','=',0)
            ->where('p.oculto',0)
            ->groupBy('p.producto_id')
            ->orderBy('p.producto','ASC')->get();
    }
}
