<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th width="12%">Nombres Completo</th>
            <th width="5%">Email</th>
            <th width="10">Dirección</th>
            <th width="10">Teléfono</th>
            <th width="10">Usuario</th>
            <th>Foto</th>
            <th width="10%">Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @if(count($usuarios) > 0)

                @php($i=1)                 
                @foreach($usuarios as $key => $usu)
                <?php $encrypUserId=Hashids::encode($usu->user_id);?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="font-weight-bold">{{ $usu->apellidos }} {{ $usu->nombres }}</td>
                        <td class="text-muted">{{ $usu->email }}</td>
                        <td>{{ $usu->direccion }}</td>
                        <td>{{ $usu->telefono }}</td>
                        <td>{{ $usu->usuario}}</td>
                        @if($usu->foto!= '')
                        <td><img src="{{URL::asset($usu->foto)}}" alt="Foto Usuario"></td>
                        @else 
                        <td><img src="{{URL::asset('admin_assets/images/usuarios/default.png')}}" alt="Foto Usuario"></td>
                        @endif

                        @if($usu->estado!=0)
                            <td><label class="badge badge-success badge-pill">Activo</label></td>
                        @else 
                           <td><label class="badge badge-danger badge-pill">Inactivo</label></td>
                        @endif

                        <td>
                            <div class="btn-group" role="group">
                                @can('admin.usuarios.actualizar')
                                <a href="{{ route('admin.usuarios.edit',$encrypUserId) }}"><img src="{{ url('admin_assets/images/edit.png') }}" title="Editar Usuario" style="cursor: pointer; height:24px; width:24px;"></a>
                                @endcan
                                
                                @can('admin.usuarios.eliminar')
                                <img src="{{ url('admin_assets/images/delete3.png') }}" onclick="eliminarUsuario(<?php echo "'".$encrypUserId."'"; ?>)" title="Eliminar Usuario" style="cursor: pointer; height:24px; width:24px;">
                                @endcan
                                
                                @if($usu->estado!=0)
                                    @can('admin.usuarios.desactivar')
                                        <img src="{{ url('admin_assets/images/off.png') }}" onclick="desactivarUsuario(<?php echo "'".$encrypUserId."'"; ?>)" title="Desactivar Usuario" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @else 
                                    @can('admin.usuarios.activar')
                                        <img src="{{ url('admin_assets/images/on.png') }}" onclick="activarUsuario(<?php echo "'".$encrypUserId."'"; ?>)" title="Activar Usuario" style="cursor: pointer; height:24px; width:24px;">&nbsp;
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>

                    @php($i++)
                @endforeach

            @else 
            
                <tr>
                    <td align="center" colspan="9">No se encontraron registros</td>
                </tr>

            @endif
    
        </tbody>
    </table>

    {{ $usuarios->onEachSide(1)->links('admin.partials.my-paginate') }}


</div>