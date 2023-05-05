@extends('admin.master')

@section('title', 'Módulo de Productos')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE PRODUCTOS
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-dolly-flatbed"></i> Productos</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="form-group">
                    <h5 class="mb-3">Buscar por:</h5>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="txtBuscarProduto" style="font-size:14px;">Producto: </label>
                    <input type="text" class="form-control form-control-sm" id="txtBuscarProduto" placeholder="Nombre del Producto...">
                </div>
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="BuscarCategoriaProducto" style="font-size:14px;">Categoría: </label>
                    <select id="BuscarCategoriaProducto" name="BuscarCategoriaProducto[]"class="form-control selectpicker" multiple data-live-search="true">
                        @if(isset($categorias) && count($categorias)>0)
                            @foreach ($categorias as $ctg)
                                <option value="{{$ctg['categoria_id']}}">{{$ctg['categoria']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="ofertaProductoBuscar" style="font-size:14px;">Oferta:</label>
                    <select name="ofertaProductoBuscar" id="ofertaProductoBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="carrouselProductoBuscar" style="font-size:14px;">Carrousel:</label>
                    <select name="carrouselProductoBuscar" id="carrouselProductoBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="estadoProductoBuscar" style="font-size:14px;">Estado:</label>
                    <select name="estadoProductoBuscar" id="estadoProductoBuscar" class="form-control">
                        <option value="_all_">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            
        </div>

        @can('admin.productos.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <a type="button" class="btn btn-sm btn-dark btn-fw"  href="{{ route('admin.productos.create') }}"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Producto</a>
                </div>

            </div>
        </div>
        @endcan

        <div class="row">
            <div class="col-12 grid-margin">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                        <i class="fas fa-dolly-flatbed"></i>
                            Listado de Productos
                        </h4>
                        <section class="productos">
                            @if(isset($productos) && count($productos) > 0)
                                
                                @include('admin.data.load_productos_data')
                            
                            @else 
                            
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Producto</th>
                                            <th>Categorías</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Precio Anterior</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center" colspan="9">No se encontraron registros</td>
                                            </tr>
                                    
                                        </tbody>
                                    </table>
                                </div>
                               
                            @endif
                        </section>
                    </div>  

                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-5 align-self-center text-center">
                <div class="card">
                    <div class="card-body">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Leyenda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/edit.png') }}" alt="Editar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Editar Producto</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Producto</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Producto</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Producto</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/code.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Códigos del Producto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>


    </div>

@endsection

@section('scripts')

   <script>

    $(window).on('hashchange',function(){
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else{
                loadproductos(page);
            }
        }
    });
    
    $(document).on('click', '.productos .pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            // console.log(page);
            loadproductos(page);
    });

    function loadproductos(page)
    {
        let url='';
        let txtproduto = $('#txtBuscarProduto').val();
        let selectedcategoria = [];
        for (let optionc of document.getElementById('BuscarCategoriaProducto').options)
        {
            if (optionc.selected) {
                selectedcategoria.push(optionc.value);
            }
        }
        let ofertaproducto = $('#ofertaProductoBuscar').val();
        let carrouselProductoBuscar = $('#carrouselProductoBuscar').val();
        let estado = $('#estadoProductoBuscar').val(); 
        url=$('meta[name=app-url]').attr("content")  + "/admin" + "/productos?page="+page;

        $.ajax({
            url: url,
            method:'GET',
            data: {producto: txtproduto,categoria: selectedcategoria,oferta: ofertaproducto,carrousel: carrouselProductoBuscar,estado: estado}
        }).done(function (data) {
            $('.productos').html(data);
        }).fail(function () {
            console.log("Failed to load data!");
        });
    }

    // function loadproductos(param='')
    // {
    //     let url='';
    //     if(param!="")
    //     {
    //         url= param;
    //     }
    //     else 
    //     {
    //         url=$('meta[name=app-url]').attr("content")  + "/admin" + "/productos";
    //     }

    //     $.ajax({
    //         headers: 
    //         {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: url
    //     }).done(function (data) {
    //         $('.productos').html(data);
    //     }).fail(function () {
    //         console.log("Failed to load data!");
    //     });
    // }

    $('#txtBuscarProduto').on('keyup', function(e){
        let selected2 = [];
        for (let option2 of document.getElementById('BuscarCategoriaProducto').options)
        {
            if (option2.selected) {
                selected2.push(option2.value);
            }
        }
        let producto = this.value;
        let ofertaproducto = $('#ofertaProductoBuscar').val();
        let carrouelproducto = $('#carrouselProductoBuscar').val();
        let estadoproducto = $('#estadoProductoBuscar').val();
        ajaxloadproductos(producto, selected2, ofertaproducto, carrouelproducto, estadoproducto);
    })

    $('#BuscarCategoriaProducto').on('change', function (e ){
        let selected = [];
        for (let option of this.options)
        {
            if (option.selected) {
                selected.push(option.value);
            }
        }
        let producto2 = $('#txtBuscarProduto').val();
        let ofertaproducto2 = $('#ofertaProductoBuscar').val();
        let carrouelproducto2 = $('#carrouselProductoBuscar').val();
        let estadoproducto2 = $('#estadoProductoBuscar').val();
        ajaxloadproductos(producto2, selected, ofertaproducto2, carrouelproducto2, estadoproducto2);
    });

    $('#ofertaProductoBuscar').on('change', function(e){
        let selected3 = [];
        for (let option3 of document.getElementById('BuscarCategoriaProducto').options)
        {
            if (option3.selected) {
                selected3.push(option3.value);
            }
        }
        let producto3 = $('#txtBuscarProduto').val();
        let ofertaproducto3 = this.value;
        let carrouelproducto3 = $('#carrouselProductoBuscar').val();
        let estadoproducto3 = $('#estadoProductoBuscar').val();
        ajaxloadproductos(producto3, selected3, ofertaproducto3, carrouelproducto3, estadoproducto3);
    })

    $('#carrouselProductoBuscar').on('change', function(e){
        let selected4 = [];
        for (let option4 of document.getElementById('BuscarCategoriaProducto').options)
        {
            if (selected4.selected) {
                selected3.push(option4.value);
            }
        }
        let producto4 = $('#txtBuscarProduto').val();
        let ofertaproducto4 = $('#ofertaProductoBuscar').val();
        let carrouelproducto4 = this.value;
        let estadoproducto4 = $('#estadoProductoBuscar').val();
        ajaxloadproductos(producto4, selected4, ofertaproducto4, carrouelproducto4, estadoproducto4);
    })

    $('#estadoProductoBuscar').on('change', function(e){
        let selected5 = [];
        for (let option5 of document.getElementById('BuscarCategoriaProducto').options)
        {
            if (option5.selected) {
                selected5.push(option5.value);
            }
        }
        let producto5 = $('#txtBuscarProduto').val();
        let ofertaproducto5 = $('#ofertaProductoBuscar').val();
        let carrouelproducto5 = $('#carrouselProductoBuscar').val();
        let estadoproducto5 = this.value;
        ajaxloadproductos(producto5, selected5, ofertaproducto5, carrouelproducto5, estadoproducto5);
    })


    function ajaxloadproductos(producto, categoria, oferta, carrousel, estado)
    {
        const url=$('meta[name=app-url]').attr("content") + "/admin" + "/productos";
        $.ajax({
            headers: 
            {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method:'GET',
            data: {producto: producto,categoria: categoria,oferta: oferta,carrousel: carrousel,estado: estado}
        }).done(function (data) {
            $('.productos').html(data);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    }


    window.eliminarProducto = function(producto_id)
    {
        Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar el Producto?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos/"  + producto_id;
                    let data = {
                        producto_id: producto_id
                    };
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "DELETE",
                        data: data,
                        success: function(response) {
                            // console.log(response);
                            if(response.code == "200")
                            {
                                loadproductos();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado el producto correctamente'
                                });
                            }
                        },
                        error: function(response) {                
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar eliminar el registro!'
                            })
                        }
                    });
                }
            })
    }

    window.desactivarProducto = function(producto_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar el Producto?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos" +  "/desactivar/" + producto_id;
                        let data = {
                            producto_id: producto_id
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: "POST",
                            data: data,
                            success: function(response) {
                                // console.log(response);
                                if(response.code == "200")
                                {
                                    loadproductos();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado el Producto correctamente'
                                    });
                                    // document.location.reload(true)
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    text: 'Se ha producido un error al intentar desactivar el registro!'
                                })
                            }
                        });
                    }
                })
    }

    window.activarProducto = function(producto_id)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar el Producto?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos" +  "/activar/" + producto_id;
                        let data = {
                            producto_id: producto_id
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: "POST",
                            data: data,
                            success: function(response) {
                                // console.log(response);
                                if(response.code == "200")
                                {
                                    loadproductos();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado el Producto correctamente'
                                    });
  
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    text: 'Se ha producido un error al intentar desactivar el registro!'
                                })
                            }
                        });
                    }
                })
    }

    window.agotadoProducto = function(producto_id, agotado)
    {
        Swal.fire({
                icon: 'warning',
                title: 'Está Seguro de Modificar el Producto?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/productos" +  "/agotado/" + producto_id;
                        let data = {
                            producto_id: producto_id,
                            agotado: agotado
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: "POST",
                            data: data,
                            success: function(response) {
                                // console.log(response);
                                if(response.code == "200")
                                {
                                    // loadcategorias();
                                    loadproductos();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha actualizado el Producto'
                                    });
                                  
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    text: 'Se ha producido un error al intentar desactivar el registro!'
                                })
                            }
                        });
                    }
                })
    }

   </script>

@endsection