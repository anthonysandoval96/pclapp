

<?php $__env->startSection('title', $title); ?>

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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center px-3 py-2">
                        <h3 class="h5 mt-1 float-none float-md-left mb-3 mb-md-0"><?php echo e($title); ?></h3>
                    </div>
                    <form id="form-precio" name="form-precio">
                        <div class="card-body pt-3 pb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-precio-soles" class="control-label">Soles</label>
                                        <input type="number" step="0.01" class="form-control" id="in-precio-soles" name="in-precio-soles" value="<?php echo e($configuracion[0]["p_soles"]); ?>">
                                        <span id="error-precio-soles" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-precio-dolares" class="control-label">Dolares</label>
                                        <input type="number" step="0.01" class="form-control" id="in-precio-dolares" name="in-precio-dolares" value="<?php echo e($configuracion[0]["p_dolares"]); ?>">
                                        <span id="error-precio-dolares" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <b class="text-info">* Estos precios serán mostrados en la pasarela de pagos</b>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <button id="btn-action" class="btn btn-success2 w-100" type="button">
                                            <i class="fas fa-sync-alt mr-1"></i>
                                            Actualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/precio.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pclapp\app\views/usuario/precios.blade.php ENDPATH**/ ?>