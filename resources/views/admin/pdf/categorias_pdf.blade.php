<!DOCTYPE html>
<html>
<head>
    <title>Reporte Listado de Categorias</title>
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
        <div style="width: 65%; float:left; margin-right: 20px;">
            <h1>Listado de Categorias</h1>
        </div>
        <div style="width: 10%; float: left;">
            <p>@php echo date('m/d/Y'); @endphp</p>
        </div>
    </div>

    <table style="position: relative; top: 70px;  width: 100%; margin-bottom:50px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Categoría</th>
                <th>Categoría Padre</th>
                <th>URL</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>

            @php($i=1)              
            @foreach ($categorias as $categoria)
                <tr>
                    <td data-column="id">  {{ $i }}</td>
                    <td data-column="categoria">{{ $categoria->categoria }}</td>
                    <td data-column="categoria">{{ $categoria->parent }}</td>
                    <td data-column="categoria">{{ $categoria->url }}</td>
                    <td data-column="categoria">{{ $categoria->activo }}</td>
                </tr>
                @php($i++)
            @endforeach
        </tbody>
    </table>

</body>
</html>