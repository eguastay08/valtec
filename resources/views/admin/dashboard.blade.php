@extends('admin.master')

@section('title', 'Panel de Administración')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                DASHBOARD
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-home"></i> Inicio</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info das-box">
                    <div class="inner">
                        <h3>{{$nrocategorias}}</h3>
                        <p>Categorías Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <a href="{{url('admin/categorias')}}" class="small-box-footer">
                        <strong>Ver más</strong>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info das-box">
                    <div class="inner">
                        <h3>{{$nroProductos}}</h3>
                        <p>Productos Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dolly-flatbed"></i>
                    </div>
                    <a href="{{url('admin/productos')}}" class="small-box-footer">
                        <strong>Ver más</strong>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info das-box">
                    <div class="inner">
                        <h3>{{$nroTags}}</h3>
                        <p>Etiquetas Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{url('admin/tags')}}" class="small-box-footer">
                        <strong>Ver más</strong>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info das-box">
                    <div class="inner">
                        <h3>{{$nroUsers}}</h3>
                        <p>Usuarios Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{url('admin/usuarios')}}" class="small-box-footer">
                        <strong>Ver más</strong>
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection