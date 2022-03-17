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
    

    
        
        <div class="ml-auto">
            <div class="rounded-circle bg-white p-1 d-inline-block cursor-pointer" data-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle" src="<?php echo e(IMG_ROUTE); ?>usuarios/<?php echo e($avatar); ?>" alt="" width="35" height="35">
            </div>
            <div class="dropdown-menu dropdown-menu-lg custom dropdown-menu-right">
                <a href="<?php echo e(BASE_URL); ?>usuario/perfil" class="dropdown-item custom">
                    <i class="fas fa-user mr-2"></i>Mi Perfil
                </a>
                <?php
                if (isset($_SESSION["usuario_id"])) {
                    if ($_SESSION["usuario_id"] !== "1") {
                        ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(BASE_URL); ?>usuario/historial" class="dropdown-item custom">
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

        
    
</nav>
<?php /**PATH C:\xampp\htdocs\pclapp\app\views/layouts/includes/header.blade.php ENDPATH**/ ?>