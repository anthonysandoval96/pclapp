<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(APP_NAME); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('layouts.includes.env', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>dist/css/adminlte.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>plugins/fontawesome-free/css/all.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/all-fonts.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/global.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/custom.css?<?php echo e(CACHE_VERSION); ?>">
    <?php echo $__env->yieldContent('csss'); ?>
</head>
<body class="hold-transition text-sm" style="background-color: #e9ecef;">
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
        <div class="spanner transaction text-white">
            <div class="spanner-content text-teal">
                <h3 class="mb-4">
                    <div>Cargando ...</div>
                    <div>espere un momento</div>
                </h3>
                <div class="spinner-border" style="width: 3rem; height: 3rem;"></div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(PUBLIC_ROUTE); ?>plugins/jquery/jquery.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PUBLIC_ROUTE); ?>dist/js/adminlte.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/global.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>sweetalert2/sweetalert2.all.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\pclapp\app\views/layouts/basic.blade.php ENDPATH**/ ?>