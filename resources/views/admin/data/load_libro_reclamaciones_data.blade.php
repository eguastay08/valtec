<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres Completo</th>
                <th>Tipo Doc.</th>
                <th>Nro Doc.</th>
                <th>Correo</th>
                <th>Id Bien</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($libro_reclamaciones) > 0)

                @php($i=1)                 
                @foreach($libro_reclamaciones as $key => $lr)
                <?php $parameter=Hashids::encode($lr->libro_reclamacion_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $lr->nombre_apellidos }}</td>
                        @if($lr->tipo_doc == 1)
                            <td>RUC</td>
                        @elseif($lr->tipo_doc == 2) 
                            <td>DNI</td>
                        @elseif($lr->tipo_doc == 3) 
                            <td>Pasaporte</td>
                        @elseif($lr->tipo_doc == 4) 
                            <td>CE</td>
                        @endif
                        <td>{{ $lr->nro_documento }}</td>
                        <td>{{ $lr->correo }}</td>
                        @if($lr->id_bien_contratado == 1)
                            <td>Producto</td>
                        @elseif($lr->id_bien_contratado == 0) 
                            <td>Servicio</td>
                        @endif
                        <td>S/.{{ $lr->monto_reclamado }}</td>
                        @if($lr->tipo == 1)
                            <td>Reclamo</td>
                        @elseif($lr->tipo == 2) 
                            <td>Queja</td>
                        @elseif($lr->tipo == 3) 
                            <td>Sugerencia</td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.libro_reclamaciones.mostrar')
                                <img src="{{ url('admin_assets/images/eye.png') }}" onclick="showLibroReclamacion(<?php echo "'".$parameter."'"; ?>)" title="Mostrar Registro" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                &nbsp;&nbsp;
                                @can('admin.libro_reclamaciones.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarLibroReclamacion(<?php echo "'".$parameter."'"; ?>)" title="Eliminar Registro" style="cursor: pointer; height:24px; width:24px;">
                                @endcan    
                            
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="3">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $libro_reclamaciones->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>
