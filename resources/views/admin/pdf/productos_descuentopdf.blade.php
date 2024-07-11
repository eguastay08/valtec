<!DOCTYPE html>
<html>
<head>
    <title>Reporte Listado de Productos con Descuento</title>
</head>
<style>
   
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #000000;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;
        }


    </style>
</style>
<body>
    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 20%; float:left; margin-right: 20px;">
            <img src="{{ asset('assets/images/faviconfinal.png') }}"  width="50px" height="50px"  alt="">
        </div>
        <div style="width: 65%; float:left; margin-right: 10px;">
            <center><h2>REPORTE LISTADO DE PRODUCTOS CON DESCUENTO</h2></center>
        </div>
        <div style="width: 10%; float: left;">
            <p>@php echo date('m/d/Y'); @endphp</p>
        </div>
    </div>

    <table style="position: relative; top: 70px;  width: 100%; margin-bottom:50px;margin-top:20px;">
        <thead>
            <tr>
                <th style="font-size:13px">#</th>
                <th style="font-size:13px">Imagen</th>
                <th style="font-size:13px">SKU</th>
                <th style="font-size:13px">Producto</th>
                <th style="font-size:12px">Precio</th>
                <th style="font-size:12px">Oferta</th>
                <th style="font-size:11px">Categorias</th>
                <th style="font-size:11px">Stock</th>
                <th style="font-size:13px">Descuento</th>
                <th style="font-size:13px">Fecha Fin</th>
            </tr>
        </thead>
        <tbody>

            @php($i=1)              
            @foreach ($productos as $producto)
                <tr>
                    <td data-column="id">  {{ $i }}</td>
                    @if($producto->imgproducto!= '')
                        <td data-column="Producto"><img src="{{URL::asset($producto->imgproducto)}}" alt="Imagen Producto" width="25px" height="45px"></td>
                    @else 
                        <td data-column="Producto"><img src="{{URL::asset('admin_assets/images/productos/producto.png')}}" alt="Imagen Producto" width="25px" height="45px"></td>
                    @endif
                    <td data-column="Sku" style="font-size:12px">{{ $producto->sku }}</td>
                    <td data-column="Producto" style="font-size:13px">{{ $producto->producto }}</td>
                    <td data-column="Precio" style="font-size:12px">{{ $producto->precio }}</td>
                    <td data-column="Precio" style="font-size:12px">{{ $producto->precio_oferta }}</td>
                    <td data-column="Categorias" style="font-size:12px">{{ $producto->categorias }}</td>
                    @if($producto->con_stock == 1)
                        <td data-column="Sku" style="font-size:12px">{{ $producto->stock }}</td>
                    @else 
                        <td data-column="Sku" style="font-size:12px">{{ $producto->codigos }}</td>
                    @endif
                    <td data-column="descuento" style="font-size:12px">{{ $producto->descuento }} %</td>
                    <td data-column="fecha" style="font-size:13px">{{ $producto->fecha_finalizacion }}</td>
                </tr>
                @php($i++)
            @endforeach
        </tbody>
    </table>

</body>
</html>