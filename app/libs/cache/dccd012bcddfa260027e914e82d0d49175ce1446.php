

<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>
<div class="row p-4">
    <div class="login-logo col-12 col-md-4 m-auto">
        <img class="w-100 pr-2" src="<?php echo e(CUSTOM_ROUTE); ?>img/default/logo.jpg" alt="">
    </div>
    <!-- /.login-logo -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body login-card-body">
                <form id="form-register" name="form-register">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-nombres" class="control-label">Nombres</label>
                                <input type="text" class="form-control" id="in-reniec-nombres" name="in-usuario-nombres" maxlength="50" placeholder="Ingrese solo nombres">
                                <span id="error-reniec-nombres" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-appaterno" class="control-label">Ap. Paterno</label>
                                <input type="text" class="form-control" id="in-reniec-appaterno" name="in-usuario-appaterno" maxlength="40" placeholder="Ingrese apellido paterno">
                                <span id="error-reniec-appaterno" class="fields-errors" ></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-apmaterno" class="control-label">Ap. Materno</label>
                                <input type="text" class="form-control" id="in-reniec-apmaterno" name="in-usuario-apmaterno" maxlength="40" placeholder="Ingrese apellido materno">
                                <span id="error-reniec-apmaterno" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="sel-reniec-genero" class="control-label">Género</label>
                                <select id="sel-reniec-genero" name="sel-usuario-genero" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                                <span id="error-reniec-genero" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-fnacimiento" class="control-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control center-text" id="in-reniec-fnacimiento" name="in-usuario-fnacimiento" maxlength="45">
                                <span id="error-reniec-fnacimiento" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-usuario-celular" class="control-label">Celular</label>
                                <input type="number" step="1" class="form-control" id="in-usuario-celular" name="in-usuario-celular" placeholder="Ejem. 960794123">
                                <span id="error-usuario-celular" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group position-relative">
                                <label for="in-usuario-email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="in-usuario-email" name="in-usuario-email" maxlength="45" placeholder="Ingrese email válido">
                                <span id="error-usuario-email" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group position-relative">
                                <label for="in-usuario-direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control" id="in-usuario-direccion" name="in-usuario-direccion" maxlength="100" placeholder="Ingrese dirección actual">
                                <span id="error-usuario-direccion" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-6 col-md-3">
                            <a href="<?php echo e(BASE_URL); ?>login" class="btn btn-secondary w-100"><i class="far fa-arrow-alt-circle-left mr-2"></i>Atrás</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <button id="btn-register" type="submit" class="btn btn-primary w-100"><i class="far fa-check-circle mr-2"></i>Registrarme</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/register/manage.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/register/manage.blade.php ENDPATH**/ ?>