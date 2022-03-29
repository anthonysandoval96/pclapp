<div class="modal fade" id="modal-<?php echo e($controller); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-<?php echo e($controller); ?>" name="form-<?php echo e($controller); ?>" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-secondary">Crear Palabra</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <label for="in-palabra-nombre" class="control-label">Palabra</label>
                                <input type="text" class="form-control" id="in-palabra-nombre" name="in-palabra-nombre" maxlength="50">
                                <span id="error-palabra-nombre" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <label for="in-palabra-significado" class="control-label">Significado</label>
                                <textarea class="form-control" name="in-palabra-significado" id="in-palabra-significado" cols="30" rows="6"></textarea>
                                <span id="error-palabra-significado" class="fields-errors"></span>
                            </div>
                        </div>
                        <input id="hdn-palabra-id" name="hdn-palabra-id" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modal-import-<?php echo e($controller); ?>" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form-import-<?php echo e($controller); ?>" name="form-import-<?php echo e($controller); ?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-secondary">Importar Palabras</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <a href="<?php echo e(BASE_URL); ?><?php echo e($controller); ?>/descargarPlantilla" class="btn btn-success"><i class="fas fa-file-excel mr-2"></i>Descargar plantilla aquí</a>
                        </div>
                        <div class="col-12 text-center">
                            <div class="position-relative">
                                <label for="file-upload" class="btn btn-info">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i>Subir archivo aquí
                                </label>
                                <input id="file-upload" name="file-upload" data-file="<?php echo e($controller); ?>" onchange='pasarInfoDocument()' type="file" accept=".csv, .xlsx, .xls" style='display: none;'/>
                                <div id="info">Ningún archivo seleccionado.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center"><div class="spinner-border import <?php echo e($controller); ?> text-secondary"></div></div>
                            <div class="row text-center my-3" id="row-ajaxdata-main" style="display: none;">
                                <div class="col-12 col-md-6 col-lg-4 my-3">Cantidad a importar:</div>
                                <div id="cantidad-de-palabras" class="col-12 col-md-6 col-lg-8 float-none float-md-left my-3"></div>
                                <div class="col-12">
                                    <div class="table-responsive" style="max-height: 300px;">
                                        <table id="table-import-<?php echo e(getPluralPrase($controller)); ?>" class="table table-bordered table-hover table-custom">
                                            <thead>
                                                <tr>
                                                    <th>Palabra</th>
                                                    <th>Significado</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-import-<?php echo e(getPluralPrase($controller)); ?>"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button id="btn-postimport-<?php echo e($controller); ?>" type="button" class="btn btn-primary">Importar</button>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\xampp\htdocs\pclapp\app\views/palabra/actions.blade.php ENDPATH**/ ?>