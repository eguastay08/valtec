<!DOCTYPE html>
<html>
<head>
    <title>Reporte Órdenes Verificadas</title>
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
            <center><h2>REPORTE ÓRDENES VERIFICADAS</h2></center>
        </div>
        <div style="width: 10%; float: left;">
            <p>@php echo date('m/d/Y'); @endphp</p>
        </div>
    </div>

    <table style="position: relative; top: 70px;  width: 100%; margin-bottom:50px;">
        <thead>
            <tr>
                <th style="font-size:12px">#</th>
                <th style="font-size:12px">Nombre</th>
                <th style="font-size:12px">Email</th>
                <th style="font-size:12px">Fecha de Pago</th>
                <th style="font-size:12px">Información Adicional</th>
                <th style="font-size:12px">Medio de Pago</th>
                <th style="font-size:12px">N° Operación</th>
                <th style="font-size:12px">Cupon</th>
                <th style="font-size:12px">Subtotal</th>
                <th style="font-size:12px">Descuento</th>
                <th style="font-size:12px">Total</th>
            </tr>
        </thead>
        <tbody>

            @if(count($ordens) > 0)

                @php($i=1)                 
                @foreach($ordens as $key => $or)

                    <tr>
                        <td style="font-size:11px">{{ $i }}</td>
                        <td style="font-size:13px">{{$or->nombres}}</td>
                        <td style="font-size:12px">{{ $or->email }}</td>
                        <td style="font-size:12px">{!! \Carbon\Carbon::parse($or->fecha_pago)->format('d/m/Y') !!}</td>
                        <td style="font-size:12px">{{$or->informacion_adicional}}</td>
                        @if($or->mediopago != "")
                        <td style="font-size:12px">{{$or->mediopago}}</td>
                        @else 
                        <td style="font-size:12px">{{$or->mediopago_online}}</td>
                        @endif
                        <td style="font-size:10px">{{$or->n_operacion}}</td>
                        <td style="font-size:12px">{{$or->cupon}}</td>
                        <td style="font-size:12px">{{$or->subtotal}}</td>
                        <td style="font-size:12px">{{$or->descuento}}</td>
                        <td style="font-size:12px">{{$or->total}}</td>
        
    </tr>

    @php($i++)
@endforeach

@else 

<tr>
    <td align="center" colspan="11">No se encontraron registros</td>
</tr>

@endif         
            
        </tbody>
    </table>

</body>
</html>