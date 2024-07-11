<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator,PDF;
use App\Models\Tag;


class PdfController extends Controller
{
    //
    public function generarReportePdfTag(Request $request)
    {
        // $data = [
        //     'title' => 'Welcome to CodeSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
          
        // $pdf = PDF::loadView('admin/pdf/tags_pdf', $data);
    
        // return $pdf->download('reporte_tags.pdf');
        
        return view('admin.modules.productos');
    }
}
