<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator, PDF;
use App\Models\Producto;
use App\Models\Ordens;
use App\Exports\ProducstReport1;
use App\Exports\ProductsReport2;
use App\Exports\ProductsReport3;
use App\Exports\ProductsReport4;
use App\Exports\OrdersReport1;
use App\Exports\OrdersReport2;
use App\Exports\OrdersReport3;
use App\Exports\OrdersReport4;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Configuracion;

class reporteController extends Controller
{
    //
    public function __construct()  
    {
        $this->middleware('auth');
    }
    
    public function getReportes(Request $Request)
    {

        $desarrollador = Configuracion::get_valorxvariable('desarrollador');
        
        return view('admin.modules.reportes',compact('desarrollador'));
    }

    public function postReportes(Request $Request)
    {
        $reporte = $Request->option;
        //Reporte General de Productos 
        if($reporte == 1)
        {
            $productos = Producto::getProductswithImageReporte();
            $pdf = PDF::loadView('admin/pdf/productos_pdf', array('productos' =>  $productos))
            ->setPaper('a4', 'landscape');

        // return response()->$pdf->download('reporte_general_productos.pdf');
        
            return $pdf->download('reporte_general_productos.pdf');
        }
        // Reporte de Productos sin Stock
        elseif($reporte == 2)
        {
            $productos = Producto::getProductsReporteSinStock();
            $pdf = PDF::loadView('admin/pdf/productos_sinstock', array('productos' =>  $productos))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte_productos_stock.pdf');
        }
        // Reporte de Productos Digitales sin Stock
        elseif($reporte == 3)
        {
            $productos = Producto::getProductsDigitalsReporteSinStock();
            $pdf = PDF::loadView('admin/pdf/productos_digitalessinstock', array('productos' =>  $productos))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte_productos_stock.pdf');
        }
        // Reporte de Productos con Descuento
        elseif($reporte == 4)
        {
            $productos = Producto::getProductsDescuento();
            $pdf = PDF::loadView('admin/pdf/productos_descuentopdf', array('productos' =>  $productos))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte_productos_stock.pdf');
        }
        // Reporte de Órdenes no Atendidas
        elseif($reporte == 5)
        {
            $ordens = Ordens::getOrdensReports($reporte);
            $pdf = PDF::loadView('admin/pdf/ordens_no_atendidas', array('ordens' =>  $ordens))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte.pdf');
        }
        // Reporte de Órdenes Rechazadas
        elseif($reporte == 6)
        {
            $ordens = Ordens::getOrdensReports($reporte);
            $pdf = PDF::loadView('admin/pdf/ordens_rechazadas', array('ordens' =>  $ordens))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte.pdf');
        }   
        // Reporte de Órdenes Verificadas
        elseif($reporte == 7)
        {
            $ordens = Ordens::getOrdensReports($reporte);
            $pdf = PDF::loadView('admin/pdf/ordens_aprobadas', array('ordens' =>  $ordens))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte.pdf');
        }
        // Reporte de Órdenes Atendidas
        elseif($reporte == 8)
        {
            $ordens = Ordens::getOrdensReports($reporte);
            $pdf = PDF::loadView('admin/pdf/ordens_atendidas', array('ordens' =>  $ordens))
            ->setPaper('a4', 'landscape');
        
            return $pdf->download('reporte.pdf');
        }
    }

    //reporte general de productos en formato Excel
    public function generarExcel1()
    {
        return Excel::download(new ProducstReport1, 'reporte_productos.xlsx');
    }

    public function generarExcel2()
    {
       return Excel::download(new ProductsReport2, 'reporte_productos_sin_stock.xlsx');
    }

    public function generarExcel3()
    {
        return Excel::download(new ProductsReport3, 'reporte_productos_digitales_sin_stock.xlsx');
    }

    public function generarExcel4()
    {
        return Excel::download(new ProductsReport4, 'reporte_productos_con_descuento.xlsx');
    }

    public function generarExcel5()
    {
        return Excel::download(new OrdersReport1, 'reporte_ordenes_no_Atendidas.xlsx');
    }

    public function generarExcel6()
    {
        return Excel::download(new OrdersReport2, 'reporte_ordenes_rechazadas.xlsx');
    }

    public function generarExcel7()
    {
        return Excel::download(new OrdersReport3, 'reporte_ordenes_aprobadas.xlsx');
    }

    public function generarExcel8()
    {
        return Excel::download(new OrdersReport4, 'reporte_ordenes_atendidas.xlsx');
    }
    
}
