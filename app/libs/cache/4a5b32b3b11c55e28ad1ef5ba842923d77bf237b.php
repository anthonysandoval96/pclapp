

<?php $__env->startSection('title', $titulo); ?>

<?php
    if (isset($_SESSION["sesion_diaria"])) {
        $sesion_diaria = $_SESSION["sesion_diaria"];
    } else {
        $sesion_diaria = [];
    }

?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<div class="content px-2">
    <div id="body-palabras" class="container">
        <div class="row">
            <form class="col-md-7 m-auto" id="form-sesiones" name="form-sesiones">
                <div id="instrucciones" class="py-4 text-center h5"></div>
                <div class="text-center my-2"><div class="spinner-border <?php echo e($controller); ?> text-info"></div></div>
                <div id="body-palabras-sesion" style="display: none;"></div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="significado" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div id="text-significado" class="col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6"></div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-primary w-100" data-dismiss="modal">Listo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-instruccion" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="border-bottom p-2 text-center">
                    <h5 class="modal-title text-primary"></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="text-instruccion" class="col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <i class="far fa-check-circle mr-1"></i>Entendido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="instruc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="border-bottom p-2 text-center">
                    <h5 class="modal-title text-primary">Instrucciones generales de uso</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Luego de ingresar a su programa PCL, deberá seguir las instrucciones emergentes en cada recuadro:</p>
                            <ul>
                                <li>Primero, debe buscar y marcar las palabras ya conocidas para seleccionarlas y continuar.</li>
                                <li>Segundo, debe buscar y dar click en una sola palabra desconocida y continuar.</li>
                                <li>Tercero, debe leer en voz alta las veces que indica el recuadro, según su condición calificada</li>
                                <li>Cuarto, debe realizar este proceso hasta la lectura en voz alta de 15 palabras por día.</li>
                                <li>El programa le garantiza el éxito deseado, en 200 sesiones diarias de 8 a 10 minutos por día.</li>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <i class="far fa-check-circle mr-1"></i>Entendido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/<?php echo e($controller); ?>/manage.js?<?php echo e(CACHE_VERSION); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pclapp\app\views/sesion/manage.blade.php ENDPATH**/ ?>