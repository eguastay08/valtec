<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

use App\Models\Ordens;
use App\Models\Ordens_Detalle;
use App\Models\Ordens_m_Orden_Estado;
use App\Models\Producto;
use App\Models\Producto_codigo;

// use Carbon\Carbon;
use App\Services\Admin\{
    ProductoService
};


class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('auth');
        // $this->middleware('can:admin.moneda.index');
    }

    public function index(Request $request)
    {
        //
        $ordenes = Ordens::getOrdenes();

        if($request->ajax()):
            return view('admin.data.load_ordenes_data', compact('ordenes'));
        endif;

        return view('admin.modules.ordenes', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($orden_id)
    {
        //
        $decrypt_id = Hashids::decode($orden_id); //-->desencripto el id
        if(count($decrypt_id) == 0):
            return redirect('/admin/ordenes');
        endif;

        $orden = Ordens::getOrdendata($decrypt_id[0]);  
        $orden_detalle = Ordens_Detalle::getOrdenDetalle($decrypt_id[0]);

        return view('admin.modules.orden-detalle', compact('orden', 'orden_detalle'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return redirect('/admin/404');
    }

    public function aprobar(Request $request, $orden_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/ordenes');
        endif;

        $decrypt_id = Hashids::decode($orden_id);
        $orden = Ordens_m_Orden_Estado::aprobarOrden($decrypt_id);
        if(Ordens_m_Orden_Estado::create($orden)):
            $productos = Ordens_Detalle::getProductosxOrden($decrypt_id);
            foreach($productos as $pr):
                if($pr['codigo_producto'] != ""):
                    $acodigos = Ordens_Detalle::aproCodigos($pr['codigo_producto']);
                    foreach($acodigos as $ac):
                        Producto_codigo::acodigos($ac);
                    endforeach;
                endif;
            endforeach;
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
       
      
        // $decrypt_id = Hashids::decode($orden_id);
        
   
    }

    public function rechazar(Request $request, $orden_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/ordenes');
        endif;

        $decrypt_id = Hashids::decode($orden_id);
        $orden = Ordens_m_Orden_Estado::reachazarOrden($decrypt_id);
        $ordenDetalles = Ordens_Detalle::getProductosxOrden($decrypt_id);
        foreach($ordenDetalles as $od):
            $constock = ProductoService::withStock($od['producto_id']);
            if($constock->con_stock != 0):
                $stock = Producto::getStock($od['producto_id']);
                $nuevostock = (int)$stock->stock + (int)$od['cantidad'];
                $producto = Producto::find($od['producto_id']);
                $dataStock = [
                        'stock' => $nuevostock
                ];
                $producto->update($dataStock);
            else:
                $arrayCodigos = json_decode($od['codigo_producto']);
                foreach($arrayCodigos as $ac):
                    $data = [
                        "estado"=>1
                    ];
                    $codigoProducto = Producto_codigo::find($ac);
                    $codigoProducto->update($data);
                endforeach;
            endif;
        endforeach;       
        if(Ordens_m_Orden_Estado::create($orden)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function atender(Request $request, $orden_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/ordenes');
        endif;

        $decrypt_id = Hashids::decode($orden_id);
        $orden = Ordens_m_Orden_Estado::atenderOrden($decrypt_id);
        if(Ordens_m_Orden_Estado::create($orden)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function getCodigos(Request $request, $codigos)
    {
        if (!$request->ajax()):
            return redirect('/admin/ordenes');
        endif;

        $arraycodigos = json_decode($codigos);

        $data = [];

        $i = 1;
        foreach($arraycodigos as $ac):
            $codigo = Producto_codigo::getCodigoxID($ac);
            $data[$i] = $codigo->codigo;
            $i++;
        endforeach;

        return $data;

    }
}
