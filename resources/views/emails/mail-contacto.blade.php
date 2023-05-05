<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    
    <center>

        <h2>Hola !</h2> <br><br>

        Has recibido un correo de : {{ $data['name'] }} <br><br>

        Detalles del Correo: <br><br>

        Nombre:  {{ $data['name'] }}<br>
        Email:  {{ $data['email'] }}<br>
        Asunto:  {{ $data['subject'] }}<br>
        Mensaje:  {!! $data['message'] !!}<br><br>

        Thanks

    </center>
    
</body>