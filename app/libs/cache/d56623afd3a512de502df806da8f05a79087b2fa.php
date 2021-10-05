

<?php $__env->startSection('title', $titulo); ?>

<?php
    $array_genero_values = array('masculino', 'femenino');
?>

<?php $__env->startSection('content'); ?>
    <section class="content pt-3">
        <div class="container">
            <form id="form-perfil-usuario" name="form-perfil-usuario" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="card avatar-change">
                            <div class="card-header"><h5 class="card-title">Avatar</h5></div>
                            <div class="card-body text-center p-2">
                                <div class="avatar-default">
                                    <div class="row">
                                        <div class="col-6 col-lg-12 m-auto">
                                            <img id="avatar-upload" src="<?php echo e(CUSTOM_ROUTE); ?>img/usuarios/<?php echo e($userlogued["avatar"]); ?>" class="avatar w-100 rounded" alt="avatar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-white border-top p-3">
                                <div class="avatar-btns">
                                    <label for="file-upload" class="btn btn-info my-0 font-weight-normal">
                                        Cambiar
                                    </label>
                                    <button id="btn-cancelar-avatar" data-avatar="usuarios" data-imgrecorded="<?php echo e($userlogued["avatar"]); ?>" class="btn btn-danger" type="button">Cancelar</button>
                                </div>
                                <div class="btn-upload-custom">
                                    <label for="file-upload" class="upload-custom mb-0 w-100">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i>Subir imagen aquí
                                    </label>
                                </div>
                                <input id="file-upload" name="file-upload" onchange="pasarInfoDocument()" type="file" class="d-none w-100">
                                <div id="info"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="h6 mt-md-1 mb-md-0 mb-2 float-none float-md-left" style="line-height:1.6;">Datos del usuario</h5>
                                <div class="float-md-right mb-md-0 mb-1">
                                    <button id="btn-change-password" class="btn btn-success2 w-100" type="button">
                                        <i class="fas fa-sync-alt mr-1"></i>
                                        Cambiar contraseña
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="in-reniec-nombres" class="control-label">Nombres</label>
                                            <input type="text" class="form-control" id="in-reniec-nombres" name="in-usuario-nombres" maxlength="50" value="<?php echo e($userlogued["nombres"]); ?>">
                                            <span id="error-reniec-nombres" class="fields-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="in-reniec-appaterno" class="control-label">Ap. Paterno</label>
                                            <input type="text" class="form-control" id="in-reniec-appaterno" name="in-usuario-appaterno" maxlength="40" value="<?php echo e($userlogued["apellido_paterno"]); ?>">
                                            <span id="error-reniec-appaterno" class="fields-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="in-reniec-apmaterno" class="control-label">Ap. Materno</label>
                                            <input type="text" class="form-control" id="in-reniec-apmaterno" name="in-usuario-apmaterno" maxlength="40" value="<?php echo e($userlogued["apellido_materno"]); ?>">
                                            <span id="error-reniec-apmaterno" class="fields-errors"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="in-reniec-fnacimiento" class="control-label">Fecha de nacimiento</label>
                                            <input type="date" class="form-control center-text" id="in-reniec-fnacimiento" name="in-usuario-fnacimiento" maxlength="45" value="<?php echo e($userlogued["fecha_nacimiento"]); ?>">
                                            <span id="error-reniec-fnacimiento" class="fields-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group position-relative">
                                            <label for="in-usuario-celular" class="control-label">Celular</label>
                                            <input type="number" step="1" class="form-control" id="in-usuario-celular" name="in-usuario-celular" placeholder="Ejem. 960794123" value="<?php echo e($userlogued["celular"]); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group position-relative">
                                            <label for="in-usuario-email" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="in-usuario-email" name="in-usuario-email" maxlength="45" value="<?php echo e($userlogued["email"]); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <a href="<?php echo e(BASE_URL); ?>principal" class="btn btn-secondary w-100"><i class="far fa-arrow-alt-circle-left mr-2"></i>Regresar</a>
                                    </div>
                                    <div class="col-6">
                                        <button id="btn-perfil-usuario" type="submit" class="btn btn-primary w-100"><i class="far fa-check-circle mr-2"></i>Actualizar</button>
                                    </div>
                                    <input id="hdn-usuario-id" name="hdn-usuario-id" type="hidden" value="<?php echo e($userlogued["id"]); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <form id="form-change-password" name="form-change-password" autocomplete="off">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cambiar contraseña</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label for="in-password-actual">Contraseña actual</label>
                                                <input id="in-password-actual" name="in-password-actual" type="password" class="form-control">
                                                <span id="error-password-actual" class="fields-errors"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label for="in-password-new">Nueva Contraseña</label>
                                                <input id="in-password-new" name="in-password-new" type="password" class="form-control">
                                                <span id="error-password-new" class="fields-errors"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group position-relative">
                                                <label for="in-password-confirm">Confirmar contraseña</label>
                                                <input id="in-password-confirm" name="in-password-confirm" type="password" class="form-control">
                                                <span id="error-password-confirm" class="fields-errors"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" id="btn-action-password">Actualizar</button>
                                    <input type="hidden" id="hdn-usuario-ps-id" name="hdn-usuario-ps-id" value="<?php echo e($userlogued["id"]); ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/perfil.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/usuario/perfil.blade.php ENDPATH**/ ?>