<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <title>VALTEC - Registro</title>
    <link href="{{ asset('admin_assets/vendors/iconfonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.addons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left">
                            <div class="p-3 d-flex justify-content-center">
                                <img src="{{asset('admin_assets/images/logo-ecommerce.png')}}" alt="logo" width="350px"/>
                            </div>

                            <div class="my-2 d-flex justify-content-center p-3" style="color:#3a3f51;">
                                <h4> ... :: Registro de <b>Cliente</b> :: ...</h4>
                            </div>

                            {!! Form::open(['url'=>'/register']) !!}

                            @csrf

                            <!-- Campo Nombres -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="RegisterNombres" name="RegisterNombres" placeholder="Ingrese sus Nombres" required>
                                </div>
                            </div>

                            <!-- Campo Apellidos -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="RegisterApellidos" name="RegisterApellidos" placeholder="Ingrese sus Apellidos" required>
                                </div>
                            </div>

                            <!-- Campo Email -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" id="RegisterEmail" name="RegisterEmail" placeholder="Ingrese su Correo Electrónico" required>
                                </div>
                            </div>

                            <!-- Campo Dirección -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-home"></i></div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="RegisterDireccion" name="RegisterDireccion" placeholder="Ingrese su Dirección" required>
                                </div>
                            </div>

                            <!-- Campo Teléfono -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="RegisterTelefono" name="RegisterTelefono" placeholder="Ingrese su Teléfono" required>
                                </div>
                            </div>

                            <!-- Campo Contraseña -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingrese una Contraseña" required>
                                </div>
                            </div>

                            <!-- Campo Confirmación de Contraseña -->
                            <div class="form-group pl-4 pr-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password_confirmation" placeholder="Confirme su Contraseña" required>
                                </div>
                            </div>

                           <!-- <div class="mt-3 d-flex justify-content-center pb-4">
                              <div class="text-center g-recaptcha" data-sitekey="6LeQZQ0qAAAAAGofMbS-m-Na--FmeDFkblBBwhu9"></div>
                            </div>-->
                            <!-- Botón de Registro -->
                            <div class="mt-3 pl-4 pr-4 pb-2">
                                <button type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn">Registrarse</button>
                            </div>

                            <!-- Enlace a Iniciar Sesión -->
                            <div class="mt-2 text-center">
                                <a href="/login" class="text-muted">¿Ya tienes una cuenta? Inicia sesión</a>
                            </div>

                            {!! Form::close() !!}

                            @if(Session::has('message'))
                            <div class="container">
                                <div class="alert alert-danger" style="display:block;">
                                    {{ Session::get('message') }}
                                    @if ($errors->any())
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
