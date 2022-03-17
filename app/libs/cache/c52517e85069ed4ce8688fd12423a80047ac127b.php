

<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>
    <section class="content pt-3">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-md-6 m-auto text-center">
                    <a href="<?php echo e(BASE_URL); ?>home" class="btn btn-info">
                        <i class="far fa-arrow-alt-circle-left mr-1"></i>Regresar al menú principal
                    </a>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-12 text-center">
                    <h3>Palabras Aprendidas</h3>
                </div>
            </div>
            <div class="row pt-2 pb-5">
                <?php $__currentLoopData = $palabras_aprendidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-md-3 border"><?php echo e($word["nombre"]); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/perfil.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pclapp\app\views/usuario/historial.blade.php ENDPATH**/ ?>