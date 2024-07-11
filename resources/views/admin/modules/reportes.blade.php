@extends('admin.master')

@section('title', 'Módulo de Reportes')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                REPORTES
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-pdf"></i> Reportes</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <h5 class="mb-3">Exportar Reporte:</h5>
                    <select name="optionReport" id="optionReport" class="form-control">
                        <option value="0">--Seleccione--</option>
                        <option value="1">Reporte General Productos</option>
                        <option value="2">Reporte Productos sin Stock</option>
                        <option value="3">Reporte Productos Digitales sin Stock</option>
                        <option value="4">Reporte Productos con descuento</option>
                        <option value="5">Reporte Órdenes no atendidas</option>
                        <option value="6">Reporte Órdenes rechazadas</option>
                        <option value="7">Reporte Órdenes Aprobadas</option>
                        <option value="8">Reporte Órdenes Atendidas</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">

                <div class="form-group">
                  
                    <button class="btn btn-sm btn-default-export btn-fw" id="btnexportExcel" onclick="exportExcelReport()"><img src="{{ url('admin_assets/images/excel.png') }}" alt="Exportar Excel" width="25px"> Exportar Excel</a>
                    <button class="btn btn-sm btn-default-export btn-fw ml-4" id="btnexportPdf" onclick="exportPdfReport()"><img src="{{ url('admin_assets/images/pdf.png') }}" alt="Exportar PDF" width="25px"> Exportar PDF</button>  
                
                </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function() {

            window.exportPdfReport = function()
            {
                let option = $('#optionReport').val();
                $("#btnexportExcel").prop('disabled', true);
                $("#btnexportPdf").prop('disabled', true);
                let url = $('meta[name=app-url]').attr("content") + "/admin" + "/reportes";
                let data = {
                    option: option,
                }
                if(option != 0)
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "POST",
                        data: data,
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(response) {
                            $("#btnexportExcel").prop('disabled', false);
                            $("#btnexportPdf").prop('disabled', false);
                            var blob = new Blob([response]);
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = "Reporte_General_Productos.pdf";
                            link.click();
                            // if(response.code == "200")
                            // {
                            //     console.log('success');
                            // }
                
                            // else 
                            // {
                            //     Swal.fire({
                            //             icon: 'error',
                            //             title: 'ERROR!',
                            //             text: 'Ha ocurrido un error al intentar obtener la información!'
                            //         });
                            //     }
                            // }
                        }
                    })
                }
                else 
                {
                    $("#btnexportExcel").prop('disabled', false);
                    $("#btnexportPdf").prop('disabled', false);

                    Swal.fire({
                            icon: 'error',
                            title: 'ERROR!',
                            text: 'Debe Seleccionar una opción para exportar el reporte!'
                        });
                }
            }

            window.exportExcelReport = function()
            {
                let option = $('#optionReport').val();
                if(option != 0)
                {
                    if(option == 1)
                    {
                     window.location="{{ url('admin/reportes/excel1') }}";
                    }
                    if(option == 2)
                    {
                     window.location="{{ url('admin/reportes/excel2') }}";
                    }
                    if(option == 3)
                    {
                     window.location="{{ url('admin/reportes/excel3') }}";
                    }
                    if(option == 4)
                    {
                     window.location="{{ url('admin/reportes/excel4') }}";
                    }
                    if(option == 5)
                    {
                     window.location="{{ url('admin/reportes/excel5') }}";
                    }
                    if(option == 6)
                    {
                     window.location="{{ url('admin/reportes/excel6') }}";
                    }
                    if(option == 7)
                    {
                     window.location="{{ url('admin/reportes/excel7') }}";
                    }
                    if(option == 8)
                    {
                     window.location="{{ url('admin/reportes/excel8') }}";
                    }
                }
                else 
                {
                    Swal.fire({
                            icon: 'error',
                            title: 'ERROR!',
                            text: 'Debe Seleccionar una opción para exportar el reporte!'
                        });
                }
            }

        }); 

    </script>

@endsection










































































































































