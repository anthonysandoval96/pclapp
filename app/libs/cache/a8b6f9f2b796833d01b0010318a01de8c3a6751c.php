

<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>
<div class="row pt-5 px-3">
    <div class="container bg-white">
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
            <div class="col-8 col-md-6 text-left h5">924412</div>
            <div class="col-4 col-md-6 text-right h5"><b class="">Nombres:</b></div>
            <div class="col-8 col-md-6 text-left h5">Anthony Benito</div>
            <div class="col-4 col-md-6 text-right h5"><b>Apellidos:</b></div>
            <div class="col-8 col-md-6 text-left h5">Mosquera Sandoval</div>
            <div class="col-4 col-md-6 text-right h5"><b>Correo:</b></div>
            <div class="col-8 col-md-6 text-left h5">anthonysandoval1596@gmail.com</div>
            <div class="col-4 col-md-6 text-right h5"><b>Nro de Tarjeta:</b></div>
            <div class="col-8 col-md-6 text-left h5">497826XXXXXX0001</div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($name_route); ?>/create.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/usuario/success_payment.blade.php ENDPATH**/ ?>