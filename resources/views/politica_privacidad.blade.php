@extends('template')

@section('content')

<div class="as-breadcrumb" aria-label="breadcrumb">
    <nav class="container-xxl">
        <ol class="breadcrumb as-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" title="E-Shop">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Politíca de Privacidad
            </li>
        </ol>
    </nav>
</div>

<div class="container-xxl container-fluid">

    <div class="row">
        <div class="col-12">
            <h3 class="text-center pb-10 mb-20 mx-5">POLÍTICAS DE PRIVACIDAD</h3>
            <hr>
        </div>
   </div>

    <div class="row">

        <div class="col-10 offset-1">

            <p>Eshop Ecommerce cuenta con una estricta política de privacidad y confidencialidad de la información otorgada por nuestros clientes. Nuestras bases de datos están codificadas y estructuradas de tal forma que garantizan la seguridad que nuestros clientes esperan.</p>

            <p>La información proporcionada por el usuario, está asegurada por una clave de acceso a la cual sólo el usuario podrá acceder y de la cual sólo él tiene conocimiento.</p>

            <p>El usuario es el único responsable de mantener en secreto su clave y la información de su cuenta. Para disminuir los riesgos, Necdigitalstore recomienda al usuario salir de su cuenta correctamente dando clic en el enlace Salir y cerrar la ventana de su navegador. La recomendación anterior debe tenerlo en cuenta cuando esté en su computador personal, cabina de internet, o en un establecimiento comercial con acceso a internet.</p>

            <p><strong>TIPO DE INFORMACIÓN QUE SE OBTIENE DE LOS USUARIOS.</strong></p>

            <p>La información personal que el usuario ingresa a nuestro sitio durante la inscripción o actualización son considerados estrictamente de carácter personal. El usuario puede modificar o actualizar esta información en cualquier momento ingresando con su respectivo correo y contraseña. En caso hubiese olvidado su contraseña podrá recuperarla ahora mismo.</p>

            <p><strong>FINALIDAD DE DICHA INFORMACIÓN REGISTRADA POR EL USUARIO</strong></p>

            <p>Los datos personales contenidos en la información confidencial, son utilizados para proveerle al usuario un servicio personalizado en el momento de realizar su compra por internet y llevar el control respectivo de las órdenes.</p>

        </div>

   </div>

</div>

@endsection