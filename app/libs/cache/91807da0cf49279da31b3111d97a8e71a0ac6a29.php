

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>jquery-nestable/css/nestable.css">
<?php $__env->stopSection(); ?>

<?php $controller2 = "modulo"; ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3 class="card-title">Listado de <?php echo e(getPluralPrase($controller, 'may')); ?></h3>
                    </div>
                    <div class="col-6 text-right">
                        <button id="btn-add-<?php echo e($controller); ?>" class="btn btn-success2 btn-sm" data-modal="modal-<?php echo e($controller); ?>">
                            <i class="fas fa-plus mr-1"></i>
                            Nuevo <?php echo e(ucwords($controller)); ?>

                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="text-center"><div class="spinner-border <?php echo e($controller); ?> text-info"></div></div>
                <div id="list-<?php echo e(getPluralPrase($controller)); ?>" class="list-drag"></div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8">
                        <h3 class="card-title">
                            <?php echo e(getPluralPrase($controller2, "may")); ?> de 
                            <span class="text-info" id="nom-<?php echo e($controller); ?>"></span>
                        </h3>
                        <div class="val d-none"></div>
                    </div>
                    <div class="col-12 col-md-4 mt-3 mt-md-0 text-center text-md-right">
                        <button id="btn-add-<?php echo e($controller2); ?>" class="btn btn-success2 btn-sm" data-modal="modal-<?php echo e($controller); ?>-<?php echo e($controller2); ?>">
                            <i class="fas fa-plus mr-1"></i>
                            Nuevo <?php echo e(ucwords($controller2)); ?>

                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body list-vistas">
                <div class="text-center"><div class="spinner-border <?php echo e($controller2); ?> text-info"></div></div>
                <p id="msj-aviso" style="font-size: 1.2em;"></p>
                <div id="list-<?php echo e(getPluralPrase($controller2)); ?>" class="list-drag"></div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make($controller.'/'.$controller2.'/actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>sortable/js/Sortable.min.js"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>jquery-nestable/js/jquery.nestable.js"></script>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/manage.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/menu/manage.blade.php ENDPATH**/ ?>