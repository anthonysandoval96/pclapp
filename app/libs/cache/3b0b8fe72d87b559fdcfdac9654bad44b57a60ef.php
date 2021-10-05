

<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<?php
    $primer_nombre = explode(" ", $userlogued["nombres"])[0];
?>

<div class="content">
    <div class="container">
        <div class="row pt-4">
            <div class="col-12 text-center">
                <h4>!Hola <?php echo e($primer_nombre); ?>!</h4>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-12 col-md-6 text-center mb-3">
                <a href="<?php echo e(BASE_URL); ?>usuario/manage" class="btn border-success">
                    <i class="fas fa-users-cog mr-2"></i>Administrar Usuarios
                </a>
            </div>
            <div class="col-12 col-md-6 text-center mb-3">
                <a href="<?php echo e(BASE_URL); ?>palabra" class="btn border-success">
                    <i class="far fa-file-alt mr-2"></i>Administrar Palabras
                </a>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/home.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/homeadmin.blade.php ENDPATH**/ ?>