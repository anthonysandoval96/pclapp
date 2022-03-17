

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
            <div class="col-12 text-center">
                <button id="btn-empezar" class="btn btn-success2">
                    <i class="fas fa-running mr-1"></i>Empezar
                </button>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <div id="body-sesiones" class="row py-2" style="display: none;"></div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/home.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pclapp\app\views/home.blade.php ENDPATH**/ ?>