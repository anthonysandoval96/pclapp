<?php

// print_r($_SESSION["user_register"]);
if (!isset($_SESSION["user_register"])) header('Location: ' . BASE_URL . 'login');

$nombres = $_SESSION["user_register"]["in-usuario-nombres"];
$apellidos = $_SESSION["user_register"]["in-usuario-appaterno"] . " " . $_SESSION["user_register"]["in-usuario-apmaterno"];
$email = $_SESSION["user_register"]["in-usuario-email"];

$resp = json_decode($respuesta, true);
// print_r($resp);

?>



<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>


<div class="row pt-5 px-3">
    <div class="container bg-white">
        <?php
        if ($resp["orderStatus"] == "PAID") {
            ?>
            <div class="row py-4 pb-2">
                <div class="col-12 text-center">    
                    <!-- Tab panes -->
                    <h2 class="text-success">Transacción Exitosa!</h2>
                    <h5>Bienvenidos a la familia de app PCL.</h5>
                    <h5>Dirígete al correo que ingresaste, para poder visualizar tus credenciales.</h5>
                </div>
                <div class="login-logo col-12 col-md-6 m-auto pt-3">
                    <img src="<?php echo e(CUSTOM_ROUTE); ?>img/default/logo.png?<?php echo e(CACHE_VERSION); ?>" alt="Logo" style="width: 30%;">
                </div>
            </div>
    
            <div class="row pb-4">
                <h2 class="col-12 text-info text-center mb-3">Detalle del Pago</h2>
                <div class="col-4 col-md-6 text-right h5"><b>Nro de Transacción:</b></div>
                <div class="col-8 col-md-6 text-left h5"><?php echo e($resp["transactions"][0]["transactionDetails"]["cardDetails"]["legacyTransId"]); ?></div>
                <div class="col-4 col-md-6 text-right h5"><b class="">Nombres:</b></div>
                <div class="col-8 col-md-6 text-left h5"><?php echo e($nombres); ?></div>
                <div class="col-4 col-md-6 text-right h5"><b>Apellidos:</b></div>
                <div class="col-8 col-md-6 text-left h5"><?php echo e($apellidos); ?></div>
                <div class="col-4 col-md-6 text-right h5"><b>Correo:</b></div>
                <div class="col-8 col-md-6 text-left h5"><?php echo e($email); ?></div>
                <div class="col-4 col-md-6 text-right h5"><b>Nro de Tarjeta:</b></div>
                <div class="col-8 col-md-6 text-left h5"><?php echo e($resp["transactions"][0]["transactionDetails"]["cardDetails"]["pan"]); ?></div>
            </div>

            <div class="row pb-4">
                <div class="col-12 text-center">
                    <a href="<?php echo e(BASE_URL); ?>login" class="btn btn-info">Ir a login</a>
                </div>
            </div> 
            <script src="<?php echo e(PUBLIC_ROUTE); ?>plugins/jquery/jquery.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
            <script src="<?php echo e(CUSTOM_ROUTE); ?>js/usuario/send-message-user.js?<?php echo e(CACHE_VERSION); ?>"></script>
            <?php
        } else {
            ?>
            <div class="row py-4 pb-2">
                <div class="col-12 text-center">    
                    <!-- Tab panes -->
                    <h2 class="text-danger">Ocurrió un error!</h2>
                    <h5>Intente de nuevo ingresando los datos del formulario.</h5>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/usuario/response_payment.blade.php ENDPATH**/ ?>