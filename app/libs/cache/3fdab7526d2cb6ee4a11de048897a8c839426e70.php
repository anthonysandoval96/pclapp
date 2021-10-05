

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php
    if ($empresa["proceso"] == "1") { 
        $proceso = "<i class='fas fa-check-double mr-1'></i>Producción";
        $color_proceso = "text-teal";
    } else if ($empresa["proceso"] == "3") { 
        $proceso = "<i class='far fa-dot-circle mr-1'></i>Prueba";
        $color_proceso = "text-secondary"; 
    } else {
        $proceso = "Ocurrió un error";
        $color_proceso = "text-danger";
    }
?>

<?php $__env->startSection('content'); ?>
<form id="form-<?php echo e($controller); ?>" name="form-<?php echo e($controller); ?>" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="card avatar-change">
                <div class="card-header text-center"><h6 class="card-title float-none float-lg-left font-weight-bold text-secondary">Logo</h6></div>
                <div class="card-body text-center p-2">
                    <div class="avatar-default">
                        <img id="avatar-upload" src="<?php echo e(PUBLIC_ROUTE); ?>custom/img/default/<?php echo e($empresa['avatar']); ?>" class="avatar w-100" alt="avatar">
                    </div>
                </div>
                <div class="card-footer text-center bg-white border-top p-3">
                    <div class="avatar-btns">
                        <label for="file-upload" class=" btn btn-sm btn-info my-0 font-weight-normal">
                            Cambiar
                        </label>
                        <button id="btn-cancelar-avatar" data-avatar="default" class="btn btn-sm btn-danger" type="button">Cancelar</button>
                    </div>
                    <div class="btn-upload-custom">
                        <label for="file-upload" class="upload-custom mb-0 w-100">
                            <i class="fas fa-cloud-upload-alt mr-2"></i>Subir logo aquí
                        </label>
                    </div>
                    <input id="file-upload" name="file-upload" onchange="pasarInfoDocument()" type="file" class="d-none w-100">
                    <div id="info"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header text-center">
                    <h6 class="float-none float-md-left mt-md-1 mb-md-0 mb-2 font-weight-bold text-secondary" style="line-height:1.6;">Datos de la Empresa</h6>
                    <div class="float-none float-md-right mb-md-0 mb-1">
                        <button id="btn-change-proceso" class="btn btn-sm btn-success2 w-100" type="button">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Facturación Electrónica
                        </button>
                    </div>
                </div>
                <div class="card-header text-center">
                    <h6 class="font-weight-bold text-secondary mb-0" style="line-height:1.6;">
                        Tipo de Proceso:<span class="<?php echo e($color_proceso); ?> ml-3"><?php echo $proceso; ?></span>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 col-lg-5">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-ruc" class="control-label">RUC</label>
                                <div class="input-group">
                                <input type="text" class="form-control focus-input required W-80" id="in-<?php echo e($controller); ?>-ruc" name="in-<?php echo e($controller); ?>-ruc" maxlength="11" value="<?php echo e($empresa['numero_documento']); ?>" placeholder="Ejem. 10775059449">
                                    <button id="btn-search-ruc" class="btn btn-sm btn-info c-pointer" style="width: 18%;margin-left: 2%;" type="button"><i class="fas fa-sync-alt"></i></button>
                                </div>
                                <span id="error-<?php echo e($controller); ?>-ruc" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-razon" class="control-label">Razón Social</label>
                                <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-razon" name="in-<?php echo e($controller); ?>-razon" required value="<?php echo e($empresa['razon_social']); ?>" placeholder="Razón Social">
                                <span id="error-<?php echo e($controller); ?>-razon" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-comercial" class="control-label">Nombre Comercial</label>
                                <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-comercial" name="in-<?php echo e($controller); ?>-comercial" required maxlength="40" value="<?php echo e($empresa['nombre_comercial']); ?>" placeholder="Nombre Comercial">
                                <span id="error-<?php echo e($controller); ?>-comercial" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group pos-rel select2-custom">
                                <label for="sel-<?php echo e($controller); ?>-ubigeo" class="control-label">Ubigeo</label>
                                <div class="input-group">
                                    <select name="sel-<?php echo e($controller); ?>-ubigeo" id="sel-<?php echo e($controller); ?>-ubigeo" class="form-control select2bs4">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        for ($i = 0; $i < count($ubigeos); $i++) {
                                            $u = $ubigeos[$i];
                                            $cod_sunat = $u['cod_sunat'];
                                            $nombre = $u['nom_distrito'];
                                            if ($ubigeo_actual == $cod_sunat) {
                                                ?>
                                                <option value="<?= $cod_sunat; ?>" selected><?= $nombre; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $cod_sunat; ?>"><?= $nombre; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span id="error-<?php echo e($controller); ?>-ubigeo" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-domicilio" class="control-label">Domicilio Fiscal</label>
                                <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-domicilio" name="in-<?php echo e($controller); ?>-domicilio" required value="<?php echo e($empresa['domicilio_fiscal']); ?>">
                                <span id="error-<?php echo e($controller); ?>-domicilio" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="in-<?php echo e($controller); ?>-email" name="in-<?php echo e($controller); ?>-email" maxlength="45" value="<?php echo e($empresa['email']); ?>" placeholder="Ejem. venusfact@gmail.com">
                                <span id="error-<?php echo e($controller); ?>-email" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group pos-rel">
                                <label for="in-<?php echo e($controller); ?>-telefono" class="control-label">Teléfono</label>
                                <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-telefono" name="in-<?php echo e($controller); ?>-telefono" maxlength="9" value="<?php echo e($empresa['telefono']); ?>" placeholder="Ejem. 044425906">
                                <span id="error-<?php echo e($controller); ?>-telefono" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group pos-rel">
                                <label for="sel-<?php echo e($controller); ?>-stock" class="control-label">¿Restricción de Stock?</label>
                                <select name="sel-<?php echo e($controller); ?>-stock" id="sel-<?php echo e($controller); ?>-stock" class="form-control">
                                    <option value="si">SÍ</option>
                                    <option value="no">NO</option>
                                </select>
                                <span id="error-<?php echo e($controller); ?>-stock" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-lg-8 d-none d-md-block"></div>
                        <div class="col-6 col-lg-2">
                            <a href="<?php echo e(BASE_URL); ?>home" class="btn btn-sm btn-secondary w-100"><i class="far fa-arrow-alt-circle-left mr-2"></i>Regresar</a>
                        </div>
                        <div class="col-6 col-lg-2">
                            <button type="submit" class="btn btn-sm btn-primary w-100"><i class="far fa-check-circle mr-2"></i>Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/manage.js"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>select2/js/select2.full.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/empresa/manage.blade.php ENDPATH**/ ?>