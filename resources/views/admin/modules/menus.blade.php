@extends('admin.master')

@section('title', 'Módulo de Menu')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                ADMINISTRADOR DE MENU
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <i class="fas fa-ellipsis-h"></i> Menu</li>
                    </ol>
                </nav>
            </div>

        </div>
        
        @can('admin.menu.crear')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 d-flex justify-content-end">

                <div class="form-group mr-20-sm">
                    <button type="button" class="btn btn-sm btn-dark btn-fw" data-toggle="modal" data-target="#ModalMenu"><img src="{{ url('admin_assets/images/add2.png') }}" alt="agregar" width="25px"> Agregar Menu</button>
                </div>

            </div>
        </div>
        @endcan

        <div class="row justify-content-md-center">

            <div class="col-md-6 col-md-offset-3">
                <h4 class="card-title">
                    <i class="fas fa-ellipsis-h"></i>
                    Menu    
                </h4>
                <div class="tbl-menus">
                    @if(isset($menus) && count($menus) > 0)
                                
                        @include('admin.data.load_menus_data')
                    
                    @else 

                        <ul class="list-group">

                            <li class="list-group-item list-group-item-info">
                                No se han encontrado registros
                            </li>

                        </ul>

                    @endif
                </div>
            </div>

        </div>

        @can('admin.menu.crear')
        <div class="row justify-content-center mt-5">
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
                                    <td style="font-size:14px">Editar Menu</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/delete3.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Eliminar Menu</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/on.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Activar Menu</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/off.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Desactivar Menu</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/arrow_down.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Bajar Posición del Menu</td>
                                </tr>
                                <tr>
                                    <td><img src="{{ url('admin_assets/images/arrow_up.png') }}" alt="Eliminar" style="width:22px;height:22px;"></td>
                                    <td style="font-size:14px">Subir Posición del Menu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>
        @endcan

    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="ModalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document" style="margin-top:20px;">
            <div class="modal-content">

                <form role="form" method="post" return="false" id="formMenu" name="formMenu">

                    <div class="modal-header" style="background-color:#3a3f51">
                        <h5 class="modal-title font-weight-bold text-primary" id="tituloModalMenu" style="color:white !important">AGREGAR MENU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclicK="limpiarModalMenu()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="card-body">

                                        <div id="error-div"></div>
                          
                                        <div class="form-group">
                                            <label for="txtNombreMenu"><b>Nombre:</b></label>
                                            <input type="hidden" name="hddmenu_id" id="hddmenu_id" value="">
                                            <input type="hidden" name="hdd_menu_posicion" id="hdd_menu_posicion" value="">
                                            <input type="hidden" name="padremenu_id" id="padremenu_id" value="0">
                                            <input type="text" class="form-control ml-2" id="txtNombreMenu"  name="txtNombreMenu" placeholder="Ingrese el nombre del número">
                                        </div>

                                        <div class="form-group">
                                            <label for="textLinkMenu"><b>Link:</b></label>
                                            <input type="text" class="form-control ml-2" id="textLinkMenu"  name="textLinkMenu" placeholder="Ingrese el Link del Menu">
                                        </div>

                                        <div class="select-padres">

                                            @include('admin.partials.select-menus-padres')
                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="chkEstadoMenu"><b>Estado:</b></label>
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input type="checkbox" class="custom-control-input" name="chkEstadoMenu" id="chkEstadoMenu" checked>  
                                                <label class="custom-control-label" for="chkEstadoMenu">Activo</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="iconoMenu"><b>&nbsp;&nbsp;Icono:</b></label>
                                            <input type="file" name="iconoMenu" id="iconoMenu" class="form-control">
                                            <input type="hidden" name="iconoactualMenu" id="iconoactualMenu" value="">
                                        </div>

                                        <div  id="iconoMenu_preview" class="form-group row">
                                        </div>
                                    
                                    </div>
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-dark" id="btnGuardarMenu"> <img src="{{ url('admin_assets/images/save.png') }}" width="20px" height="20px"> GUARDAR</button>
                        <button type="button" class="btn btn-secondary" id="btnCerrarMenu" data-dismiss="modal" onclick="limpiarModalMenu()"> <img src="{{ url('admin_assets/images/cancel.png') }}" width="20px" height="20px"> CERRAR</button>
                    
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        function loadmenus()
        {
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/menus";
            $.ajax({
                url: url
            }).done(function (data) {
                $('.tbl-menus').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
         
        function menupadres()
        {
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/menus/listarMenuPadres";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method:'POST',
            }).done(function (data) {
                $('.select-padres').html(data);
                $('#cbopadre').selectpicker("refresh");
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
        
        function limpiarModalMenu()
        {
            $('#tituloModalMenu').html('AGREGAR MENU');
            $('#hddmenu_id').val("");
            $('#hdd_menu_posicion').val("");
            $('#padremenu_id').val("");
            $('#txtNombreMenu').val("");
            $('#textLinkMenu').val("");
            $('#cbopadre').val(0);
            $('#cbopadre').selectpicker("refresh");
            $('#chkEstadoMenu').prop('checked', true);
            $('#iconoMenu').val("");
            $('#iconoactualMenu').val("");
            $('#iconoMenu_preview').html("");
        }

        $('#iconoMenu').change(function(){
            let iconMenu = $('input[name="iconoMenu"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus/subirImagenTmp";
            let iconMenuData = new FormData();
            let menu_id = generateString(3);
            iconMenuData.append("imagen",iconMenu[0]);
            iconMenuData.append("indice",1);
            $('#iconoMenu_preview').html("");
            $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: iconMenuData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function(response) {
                        if(response.code==200)
                        {
                            let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                            let urlIconoMenu = urlraiz + response.data.url;
                            let imgMenu = 'imgMenu'+menu_id;
                            previewtmpimage_col12(urlIconoMenu,'iconoMenu_preview',imgMenu,response.data.name,response.data.size,'imgMenu','removeMenu','menu_id');
                            document.getElementById('iconoMenu').value="";
                        }
                        else  if(response.code == "422")
                        {
                            document.getElementById('iconoMenu').value="";
                            let errors = response.errors;
                            let imgvalidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    imgvalidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                imgvalidation  + 
                                        '</ul>'
                            });
                        }
                        else
                        {
                            document.getElementById('iconoMenu').value="";

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                text: 'Se ha producido un error al intentar actualizar el registro!'
                            })
                        }
                    },
                    error: function(response) {
                        document.getElementById('iconoMenu').value="";
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
            });
        });

        $('body').on('click', '#removeMenu-icon', function(evt){
        
            let divNameImg = this.value;
            let filenameImg = $(this).attr('name');
            let temporalImg = $(this).attr('temporal');
            let menu_id  = $(this).attr('menu_id');


            if(temporalImg == 1)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus/eliminarImagenTmp";
                deleteTempImg(divNameImg, filenameImg, temporalImg, url);
            }
            else if(temporalImg == 0)
            {
                let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus/eliminarimg";
                deleteImg(divNameImg, filenameImg, menu_id, temporalImg, url);
                loadBloques();
            }
            
            evt.preventDefault();
        });

        $('#formMenu').submit(function(event){
            event.preventDefault();
            let hddmenu_id = $('#hddmenu_id').val();
            if(hddmenu_id!="")
            {
                ActualizarMenu(hddmenu_id);
            }
            else 
            {
                GuardarMenu();
            }
        });

        window.GuardarMenu = function()
        {
            $("#btnGuardarMenu").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/admin" + "/menus";
            let data = $('#formMenu').serialize() + "&usuario=" +<?php echo '"'.Auth::user()->usuario.'"'; ?>;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#btnGuardarMenu").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadmenus();
                        menupadres();
                        $("#ModalMenu").modal('hide');
                        limpiarModalMenu();
                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha registrado el Menu correctamente'
                        });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let menuValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    menuValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                menuValidation  + 
                                        '</ul>'
                                });
                    }                
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar registrar el Bloque!'
                            });
                    }
                }
            })
        }

        window.agregarSubMenu = function(padre)
        {
            url=$('meta[name=app-url]').attr("content")  + "/admin" + "/menus/decrypt";
            let data = {
                padre: padre,
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                url: url,
                method:'POST',
            }).done(function (data) {
                $("#ModalMenu").modal('show');
                $('#tituloModalMenu').html('AGREGAR SUBMENU');
                $('#cbopadre').val(data);
                $('#cbopadre').selectpicker("refresh");
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }

        window.mostrarMenu = function(menu_id)
        {
            url=$('meta[name=app-url]').attr("content") + "/admin" + "/menus/" +menu_id;
            $("#ModalMenu").modal('show');
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                console.log(data);
                $('#tituloModalMenu').html('EDITAR MENU');
                $('#hddmenu_id').val(menu_id);
                $('#hdd_menu_posicion').val(data.posicion);
                $('#padremenu_id').val(data.padre);
                $('#txtNombreMenu').val(data.nombre);
                $('#textLinkMenu').val(data.link);
                $('#cbopadre').val(data.padre);
                $('#cbopadre').selectpicker("refresh");
                if(data.estado == "1")
                {
                    $('#chkEstadoMenu').prop('checked', true)
                }
                else 
                {
                    $('#chkEstadoMenu').prop('checked', false)
                }

                if(data.icono!="")
                {
                    $('#iconoactualMenu').val(data.nombre_icono);
                    loadimage(data.icono,'iconoMenu_preview','imgMenu','removeMenu',data.nombre_icono, menu_id, data.size_icono,'menu_id',0);
                }
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

        window.ActualizarMenu = function(menu_id)
        {
            $("#btnGuardarMenu").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus/" + menu_id;
            let data = $('#formMenu').serialize() + "&usuario=" +<?php echo '"'.Auth::user()->usuario.'"'; ?>;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#btnGuardarMenu").prop('disabled', false);
                    if(response.code == "200")
                    {
                        loadmenus();
                        menupadres();
                        $("#ModalMenu").modal('hide');
                        limpiarModalMenu();
              
                        Swal.fire({
                            icon: 'success',
                            title: 'ÉXITO!',
                            text: 'Se ha actualizado el Menu correctamente'
                        });
                    }
                    else  if(response.code == "422")
                    {
                            let errors = response.errors;
                            let menuValidation = '';

                            $.each(errors, function(index, value) {

                                if (typeof value !== 'undefined' || typeof value !== "") 
                                {
                                    menuValidation += '<li>' + value + '</li>';
                                }

                            }); 

                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR...',
                                html: '<ul>'+
                                menuValidation  + 
                                        '</ul>'
                                });
                    }     
                    else 
                    {
                        Swal.fire({
                                icon: 'error',
                                title: 'ERROR!',
                                text: 'Ha ocurrido un error al intentar actualizar el Bloque!'
                            });
                    }    
                },
                error: function(response) {
                    $("#btnGuardarMenu").prop('disabled', false);
    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
        }

        window.eliminarMenu = function(menu_id)
        {
            Swal.fire({
            icon: 'warning',
            title: 'Está seguro de eliminar el Menu?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: "#EB1010",
            confirmButtonText: `Eliminar`,
            cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus/"  + menu_id;
                    let data = {
                        menu_id: menu_id
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
                                loadmenus();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ÉXITO!',
                                    text: 'Se ha eliminado el Menu correctamente'
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

        window.desactivarMenu = function(menu_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de desactivar el Menu?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Desactivar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus" +  "/desactivar/" + menu_id;
                        let data = {
                            menu_id: menu_id
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
                                    loadmenus();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha desactivado el Menu correctamente'
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

        window.activarMenu = function(menu_id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Está seguro de activar el Menu?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonColor: "#EB1010",
                confirmButtonText: `Activar`,
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus" +  "/activar/" + menu_id;
                        let data = {
                            menu_id: menu_id
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
                                    loadmenus();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ÉXITO!',
                                        text: 'Se ha activado el Menu correctamente'
                                    });
                                    // document.location.reload(true)
                                }
                            },
                            error: function(response) {                    
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR...',
                                    text: 'Se ha producido un error al intentar activar el registro!'
                                })
                            }
                        });
                    }
                })
        }

        window.bajarPosicion = function(menu_id, posicion, padre_id)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus" +  "/down/" + menu_id;
            let data = {
                menu_id: menu_id,
                posicion: posicion,
                padre:padre_id
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.code == "200")
                    {
                        loadmenus();
                    }
                },
                error: function(response) {                    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar activar el registro!'
                    })
                }
            });
        }

        window.subirPosicion = function(menu_id, posicion, padre_id)
        {
            let url = $('meta[name=app-url]').attr("content") +  "/admin" + "/menus" +  "/up/" + menu_id;
            let data = {
                menu_id: menu_id,
                posicion: posicion,
                padre: padre_id
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    if(response.code == "200")
                    {
                        loadmenus();
                    }
                },
                error: function(response) {                    
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar activar el registro!'
                    })
                }
            });
        }

    </script>

@endsection