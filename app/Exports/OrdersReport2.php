<?php

namespace App\Exports;

use App\Models\Ordens;
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

class OrdersReport2 implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, ShouldAutoSize,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            '#',
            'Nombre',
            'Email',
            'Fecha de Pago',
            'Información Adicional',
            'Medio de Pago',
            'N° de Operación',
            'Cupón',
            'Subtotal',
            'Descuento',
            'Total'
        ];
    } 

    public function columnFormats():array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
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
        return $ordenes =  Ordens::select('ordens.orden_id','ordens.nombres','ordens.email','ordens.fecha_pago','ordens.informacion_adicional',
        'mp.nombre as mediopago','ordens.n_operacion', 'des.cupon','ordens.subtotal','ordens.descuento','ordens.total')
        ->leftJoin('descuentos as des', function($join)
        {
            $join->on('ordens.descuento_id', '=', 'des.descuento_id');
        })
        ->leftJoin('medio_pagos as mp', function($join)
        {
            $join->on('ordens.medio_pago_id', '=', 'mp.medio_pago_id');
        })
        ->join('ordens_m_orden_estados as oee', function($join)
        {
            $join->on('ordens.orden_id', '=', 'oee.orden_id');
            $join->where('oee.estado',1);
        })
        ->join('ordens_estados as oest', function($join)
        {
            $join->on('oee.orden_estado_id', '=', 'oest.orden_estado_id');
            $join->where('oest.oculto',0);
        })
        ->where('oee.orden_estado_id','=',3)
        ->orderBy('orden_id','DESC')
        ->get();
    }
}
