<div class="modal fade" id="modal-<?php echo e($controller); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-<?php echo e($controller); ?>" name="form-<?php echo e($controller); ?>" autocomplete="off">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-secondary"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <label for="in-<?php echo e($controller); ?>-nombre" class="required">Nombre</label>
                                <input id="in-<?php echo e($controller); ?>-nombre" name="in-<?php echo e($controller); ?>-nombre" type="text" class="form-control" maxlength="50" placeholder="Ingrese nombre">
                                <span id="error-<?php echo e($controller); ?>-nombre" class="fields-errors"></span>
                            </div>
                            <div class="form-group position-relative">
                                <label for="txt-<?php echo e($controller); ?>-descripcion">Descripción</label>
                                <textarea name="txt-<?php echo e($controller); ?>-descripcion" id="txt-<?php echo e($controller); ?>-descripcion" cols="30" rows="3" placeholder="Ingrese una descripción" class="form-control"></textarea>
                                <span id="error-<?php echo e($controller); ?>-descripcion" class="fields-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row permisos-modulo"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-action"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-<?php echo e($controller); ?>-<?php echo e(getPluralPrase($controller2)); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-<?php echo e($controller); ?>-<?php echo e($controller2); ?>" name="form-<?php echo e($controller); ?>-<?php echo e($controller2); ?>" autocomplete="off">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-secondary"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Módulo</th>
                                            <th class="text-center">Asignar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-<?php echo e($controller2); ?>"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-action"></button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\applectura\app\views/rol/actions.blade.php ENDPATH**/ ?>