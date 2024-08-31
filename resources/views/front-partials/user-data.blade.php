@if($user)
    <div class="modal-header style-social-links">
        <h3 class="modal-title font-weight-bold">Mi Perfil</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
    </div>

    <div class="modal-body">
        <div class="user-info">
            <!-- Información del usuario -->
            <div class="user-detail mb-4">
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-muted">Nombre:</div>
                    <div class="col-8">{{ $user->nombres }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-muted">Apellido:</div>
                    <div class="col-8">{{ $user->apellidos ?? 'Apellido no disponible' }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-muted">Correo:</div>
                    <div class="col-8">{{ $user->email }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-muted">Dirección:</div>
                    <div class="col-8">{{ $user->direccion ?? 'Dirección no disponible' }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-muted">Teléfono:</div>
                    <div class="col-8">{{ $user->telefono ?? 'Teléfono no disponible' }}</div>
                </div>
            </div>
            
            <!-- Botones de acción -->
            <div class="user-actions d-flex justify-content-around mt-4">
                <a href="{{url('profile')}}" class="btn btn-outline-danger rounded-pill px-4" >Editar Perfil</a>
                <a href="{{url('logout')}}" class="btn btn-outline-primary rounded-pill px-4">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
    </div>
@else
    <div class="modal-body">
        <div class="divCartEmpty text-center">
            <i class="fas fa-user-circle" aria-hidden="true" style="font-size: 64px; color: #6c757d;"></i>
            <br>
            <a href="/login" class="btn btn-primary rounded-pill mt-4" style="width: 60%;">Iniciar Sesión</a>
        </div>
    </div>
@endif
