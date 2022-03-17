

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>datatables/jquery.dataTables.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>datatables/buttons.dataTables.min.css?<?php echo e(CACHE_VERSION); ?>">
<?php $__env->stopSection(); ?>

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
        <div class="row pb-5">
            <div class="col-md-12 text-center pb-3">
                <b class="text-primary">Registro de palabras que existen en la app.</b>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center px-3 py-2">
                        <h3 class="h5 mt-1 float-none float-md-left mb-3 mb-md-0"><?php echo e($title); ?></h3>
                        <div class="float-md-right mb-md-0 mb-1">
                            <button id="btn-import-<?php echo e($controller); ?>" data-modal="modal-import-<?php echo e($controller); ?>" class="btn btn-success2 w-100">
                                <i class="fa fa-plus mr-1"></i>Importar <?php echo e(ucwords(getPluralPrase($controller))); ?>

                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body px-3 pt-3 pb-2">
                        <div class="table-responsive" style="overflow-x: initial;">
                            <div class="text-center"><div class="spinner-border <?php echo e($controller); ?> text-secondary"></div></div>
                            <table id="table-<?php echo e(getPluralPrase($controller)); ?>" class="table table-bordered table-hover table-custom d-none">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Palabra</th>
                                        <th>Significado</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12">
                <?php echo $__env->make($controller.'/actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables/jquery.dataTables.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/dataTables.buttons.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/buttons.flash.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/buttons.colVis.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/jszip.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/pdfmake.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/vfs_fonts.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/buttons.html5.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>datatables-buttons/js/buttons.print.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/manage.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pclapp\app\views/palabra/manage.blade.php ENDPATH**/ ?>