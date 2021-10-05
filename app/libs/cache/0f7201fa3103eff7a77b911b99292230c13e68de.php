<?php $paises = listarPaises(); ?>



<?php $__env->startSection('title', $titulo); ?>

<?php $__env->startSection('content'); ?>
<div class="row p-4">
    <div class="login-logo col-12 col-md-4 m-auto">
        <img class="w-50 pr-2" src="<?php echo e(CUSTOM_ROUTE); ?>img/default/logo.png?<?php echo e(CACHE_VERSION); ?>" alt="">
    </div>
    <!-- /.login-logo -->
</div>

<div class="row pt-3">
    <div class="col-12">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-dev" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-primary text-center" style="color: #666;">Programa de Lectura del diccionario</h2>
                        <h4 class="text-right py-2">Practica diaria para mejorar nuestro vocabulario</h4>
                        <div class="row">
                            <div class="col-12 col-lg-8 text-center m-auto">
                                <p class="h5 py-3">Sea cual sea su nivel de conocimiento del lenguaje, repasemos diariamente el diccionario en línea, para mejorar nuestro vocabulario.</p>
                            </div>
                            <div class="col-12 col-lg-4 text-center m-auto">
                                <button id="btn-ir-formulario" class="btn btn-primary btn-lg w-100">
                                    <i class="far fa-hand-point-right mr-2"></i>Empecemos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-dev" id="formulario" role="tabpanel" aria-labelledby="formulario-tab" style="display: none;">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="float-left-0 float-md-left mb-0" style="color: #666;">Registro de usuario</h5>
                    </div>
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
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="in-usuario-email" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="in-usuario-email" name="in-usuario-email" maxlength="45" placeholder="Ingrese email válido">
                                        <span id="error-usuario-email" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="sel-usuario-pais" class="control-label">País</label>
                                        <select class="form-control" name="sel-usuario-pais" id="sel-usuario-pais">
                                            <option value="">Seleccionar país</option>
                                            <?php $__currentLoopData = $paises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pai); ?>"><?php echo e($pai); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span id="error-usuario-pais" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="in-usuario-dni" class="control-label">Documento Nacional de Identidad</label>
                                        <input type="text" class="form-control" id="in-usuario-dni" name="in-usuario-dni" maxlength="45" placeholder="DNI N° 06277610">
                                        <span id="error-usuario-dni" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-6 col-md-3">
                                    <button id="btn-atras" type="button" class="btn btn-secondary w-100"><i class="far fa-arrow-alt-circle-left mr-2"></i>Atrás</button>
                                </div>
                                <div class="col-6 col-md-3">
                                    <button id="btn-register" type="button" class="btn btn-primary w-100"><i class="far fa-check-circle mr-2"></i>Registrarme</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($name_route); ?>/create.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\applectura\app\views/usuario/create.blade.php ENDPATH**/ ?>