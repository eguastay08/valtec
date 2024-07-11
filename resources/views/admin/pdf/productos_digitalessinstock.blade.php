<!DOCTYPE html>
<html>
<head>
    <title>Reporte Listado de Productos Digitales Sin Stock</title>
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
            <center><h2>REPORTE DE PRODUCTOS DIGITALES SIN STOCK</h2></center>
        </div>
        <div style="width: 10%; float: left;">
            <p>@php echo date('m/d/Y'); @endphp</p>
        </div>
    </div>

    <table style="position: relative; top: 70px;  width: 100%; margin-bottom:50px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>SKU</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Categorias</th>
                <th>CODIGOS</th>
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
                    <td data-column="Producto" style="font-size:14px">{{ $producto->producto }}</td>
                    <td data-column="Precio" style="font-size:13px">{{ $producto->precio }}</td>
                    <td data-column="Categorias" style="font-size:14px">{{ $producto->categorias }}</td>
                    <td data-column="Sku" style="font-size:13px">{{ $producto->codigos }}</td>
                </tr>
                @php($i++)
            @endforeach
        </tbody>
    </table>

</body>
</html>