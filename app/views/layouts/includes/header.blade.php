<?php
// /* INSTANCIAR LA CLASE */
require_once '../app/models/usuarios.php';
$Usuario = new Usuarios();
// $Usuario = $this->usuarioModelo;
// /* LLAMAR AL METODO => PARA PODER OBTENER DATOS DEL USUARIO EN SESION */
$data_user = $Usuario->userLoggedData();
$nombres = $data_user['nombres'];
$apellido_paterno = $data_user['apellido_paterno'];
$apellido_materno = $data_user['apellido_materno'];
$nombre_usuario = $nombres . " " . $apellido_paterno;
$avatar = $data_user['avatar'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a href="#" class="navbar-brand">Logo</a>
    {{-- <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse2">
        <span class="navbar-toggler-icon"></span>
    </button> --}}

    {{-- <div class="collapse navbar-collapse" id="navbarCollapse2"> --}}
        {{-- <div class="navbar-nav">
            <a href="#" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">About</a>
            <a href="#" class="nav-item nav-link">Products</a>
        </div> --}}
        <div class="ml-auto">
            <div class="rounded-circle bg-white p-1 d-inline-block cursor-pointer" data-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle" src="{{IMG_ROUTE}}usuarios/{{$avatar}}" alt="" width="35" height="35">
            </div>
            <div class="dropdown-menu dropdown-menu-lg custom dropdown-menu-right">
                <a href="{{BASE_URL}}usuario/perfil" class="dropdown-item custom">
                    <i class="fas fa-user mr-2"></i>Mi Perfil
                </a>
                <?php
                if (isset($_SESSION["usuario_id"])) {
                    if ($_SESSION["usuario_id"] !== "1") {
                        ?>
                        <div class="dropdown-divider"></div>
                        <a href="{{BASE_URL}}usuario/historial" class="dropdown-item custom">
                            <i class="fas fa-file-alt mr-2"></i>Historial
                        </a>
                        <?php
                    }
                }
                ?>
                <div class="dropdown-divider"></div>
                <a id="link-accion-logut" href="#" class="dropdown-item custom">
                    <i class="fas fa-power-off mr-2"></i>Cerrar sesión
                </a>
            </div>
        </div>

        
    {{-- </div> --}}
</nav>
