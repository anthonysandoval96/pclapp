<div class="modal fade" id="modal-<?php echo e($controller); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-<?php echo e($controller); ?>" name="form-<?php echo e($controller); ?>" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-secondary">Crear Usuario</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav justify-content-center mb-3 d-none">
                        <li class="nav-item">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" data-pos="1" aria-selected="true" disabled>1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" data-pos="2" aria-selected="false">2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" data-pos="3" aria-selected="false">3</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-reniec-nrodocumento" class="control-label">Número de documento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control required w-70" id="in-reniec-nrodocumento" name="in-<?php echo e($controller); ?>-numdocumento" maxlength="8" placeholder="Ejem. 77505944">
                                            <button id="btn-search-<?php echo e($controller); ?>" class="btn btn-info btn-sm w-20 ml-2" type="button"><i class="fas fa-sync-alt"></i></button>
                                        </div>
                                        <span id="error-reniec-nrodocumento" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-reniec-nombres" class="control-label">Nombres</label>
                                        <input type="text" class="form-control" id="in-reniec-nombres" name="in-<?php echo e($controller); ?>-nombres" required maxlength="40" placeholder="Ingrese nombres">
                                        <span id="error-reniec-nombres" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-reniec-appaterno" class="control-label">Ap. Paterno</label>
                                        <input type="text" class="form-control" id="in-reniec-appaterno" name="in-<?php echo e($controller); ?>-appaterno" required maxlength="40" placeholder="Ingrese apellido paterno">
                                        <span id="error-reniec-appaterno" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-reniec-apmaterno" class="control-label">Ap. Materno</label>
                                        <input type="text" class="form-control" id="in-reniec-apmaterno" name="in-<?php echo e($controller); ?>-apmaterno" required maxlength="40" placeholder="Ingrese apellido materno">
                                        <span id="error-reniec-apmaterno" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="sel-reniec-genero" class="control-label">Género</label>
                                        <select id="sel-reniec-genero" name="sel-<?php echo e($controller); ?>-genero" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                        </select>
                                        <span id="error-reniec-genero" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label for="in-reniec-fnacimiento" class="control-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control center-text" id="in-reniec-fnacimiento" name="in-<?php echo e($controller); ?>-fnacimiento" required maxlength="45">
                                        <span id="error-reniec-fnacimiento" class="fields-errors"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group position-relative">
                                        <label for="in-<?php echo e($controller); ?>-celular" class="control-label">Celular</label>
                                        <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-celular" name="in-<?php echo e($controller); ?>-celular" maxlength="9" placeholder="Ejem. 960794123">
                                        <span id="error-<?php echo e($controller); ?>-celular" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group position-relative">
                                        <label for="in-<?php echo e($controller); ?>-email" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="in-<?php echo e($controller); ?>-email" name="in-<?php echo e($controller); ?>-email" maxlength="45" placeholder="Ejem. anthony123@gmail.com">
                                        <span id="error-<?php echo e($controller); ?>-email" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group position-relative">
                                        <label for="in-<?php echo e($controller); ?>-direccion" class="control-direccion">Dirección</label>
                                        <input type="text" class="form-control" id="in-<?php echo e($controller); ?>-direccion" name="in-<?php echo e($controller); ?>-direccion" maxlength="100" placeholder="Ingrese una dirección">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group position-relative">
                                        <label for="sel-<?php echo e($controller); ?>-rol">Rol</label>
                                        <select name="sel-<?php echo e($controller); ?>-rol" id="sel-<?php echo e($controller); ?>-rol" class="form-control required">
                                            <option value="">Selecccionar</option>
                                            <?php
                                            foreach ($roles as $r) {
                                                $rol_id = $r["id"];
                                                $rol_nombre = $r["nombre"];
                                                echo "<option value='$rol_id'>$rol_nombre</option>";
                                            }
                                            ?>
                                        </select>
                                        <span id="error-<?php echo e($controller); ?>-rol" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group position-relative">
                                        <label for="in-<?php echo e($controller); ?>-username">Username</label>
                                        <input type="text" id="in-<?php echo e($controller); ?>-username" name="in-<?php echo e($controller); ?>-username" class="form-control required" maxlength="15" placeholder="Ingrese un username">
                                        <span id="error-<?php echo e($controller); ?>-username" class="fields-errors"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group password position-relative">
                                        <label for="in-<?php echo e($controller); ?>-password">Contraseña</label>
                                        <input type="text" id="in-<?php echo e($controller); ?>-password" name="in-<?php echo e($controller); ?>-password" class="form-control required" maxlength="20" placeholder="Ingrese contraseña">
                                        <span id="error-<?php echo e($controller); ?>-password" class="fields-errors"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary btn-sm d-none" id="btn-action-prev">Anterior</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btn-action-next"></button>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\xampp\htdocs\pclapp\app\views/usuario/actions.blade.php ENDPATH**/ ?>